<?php

namespace App\Services;

use App\Models\Civilian;
use App\Models\Department;
use App\Models\UserDepartment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordService
{
    public static function get_server_roles()
    {
        return Cache::remember('discord_roles', 60, function () {
            $response =
                Http::accept('application/json')
                    ->withHeaders(['Authorization' => config('metrocad.discord_bot_token')])
                    ->get('https://discord.com/api/guilds/'.get_setting('discord_guild_id').'/roles');

            return json_decode($response->body());
        });
    }

    public static function discordRoleSync($user_id)
    {
        $userRoles = DiscordService::get_user_roles(auth()->user()->id);

        $departments = Department::query()->get(['id', 'discord_role_id'])->pluck('discord_role_id',
            'id')->toArray();

        foreach ($departments as $departmentId => $discordId) {

            if (! is_null($discordId) && in_array($discordId, array_values($userRoles))) {

                $user_department = UserDepartment::query()
                    ->where('user_id', auth()->user()->id)
                    ->where('department_id', $departmentId)
                    ->get()->first();

                if (! $user_department) {
                    UserDepartment::query()->create([
                        'user_id' => auth()->user()->id,
                        'department_id' => $departmentId,
                        'rank' => 'NEEDS SET',
                        'badge_number' => 'NEEDS SET',
                    ]);
                }
            } else {
                $userDepartment = UserDepartment::query()->where('user_id', auth()->user()->id)
                    ->where('department_id', $departmentId)->get()->first();

                if ($userDepartment) {
                    $civilian = Civilian::query()->where('user_department_id', $userDepartment->id)->get()->first();
                    $civilian->update([
                        'user_department_id' => null,
                    ]);
                    $userDepartment->delete();
                }
            }
        }
    }

    public static function get_user_roles($user_id)
    {
        return Cache::remember('user_discord_roles_'.$user_id, 30, function () use ($user_id) {
            $response = Http::accept('application/json')
                ->withHeaders(['Authorization' => config('metrocad.discord_bot_token')])
                ->get('https://discord.com/api/guilds/'.get_setting('discord_guild_id').'/members/'.$user_id);

            return json_decode($response->body())->roles;
        });
    }
}
