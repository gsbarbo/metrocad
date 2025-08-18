<?php

namespace App\Services;

use App\Models\Civilian;
use App\Models\Department;
use App\Models\UserDepartment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordService
{
    public static function getServerRoles(): mixed
    {
        return Cache::remember('discord_roles', 60, function () {
            $response =
                Http::accept('application/json')
                    ->withHeaders(['Authorization' => config('metrocad.discord_bot_token')])
                    ->get('https://discord.com/api/guilds/'.get_setting('discord.guildId').'/roles');

            return json_decode($response->body());
        });
    }

    // TODO: I think this is broken, needs to be tested
    public static function discordRoleSync($user_id): void
    {
        $userRoles = DiscordService::get_user_roles($user_id);

        $departments = Department::query()->get(['id', 'discord_role_id'])->pluck('discord_role_id',
            'id')->toArray();

        foreach ($departments as $departmentId => $discordId) {

            if (! is_null($discordId) && in_array($discordId, array_values($userRoles))) {

                $user_department = UserDepartment::query()
                    ->where('user_id', $user_id)
                    ->where('department_id', $departmentId)
                    ->get()->first();

                if (! $user_department) {
                    UserDepartment::query()->create([
                        'user_id' => $user_id,
                        'department_id' => $departmentId,
                        'rank' => 'NEEDS SET',
                        'badge_number' => 'NEEDS SET',
                    ]);
                }
            } else {
                $userDepartment = UserDepartment::query()->where('user_id', $user_id)
                    ->where('department_id', $departmentId)->get()->first();

                if ($userDepartment) {
                    // TODO: Change this if we want to allow multiple civilians per department
                    $civilian = Civilian::query()->where('user_department_id', $userDepartment->id)->get()->first();
                    $civilian?->update([
                        'user_department_id' => null,
                    ]);
                    $userDepartment->delete();
                }
            }
        }
    }

    public static function getUserRoles($user_id): mixed
    {
        return Cache::remember('user_discord_roles_'.$user_id, 30, function () use ($user_id) {
            $response = Http::accept('application/json')
                ->withHeaders(['Authorization' => config('metrocad.discord_bot_token')])
                ->get('https://discord.com/api/guilds/'.get_setting('discord.guildId').'/members/'.$user_id);

            return json_decode($response->body())->roles;
        });
    }

    public static function checkBotStatus($guildId): bool
    {
        $response = Http::accept('application/json')
            ->withHeaders(['Authorization' => config('metrocad.discord_bot_token')])
            ->get('https://discord.com/api/guilds/'.$guildId.'/roles');

        if ($response->status() === 200) {
            return true;
        }

        return false;
    }
}
