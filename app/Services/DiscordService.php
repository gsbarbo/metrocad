<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordService
{
    public static function get_server_roles()
    {
        return Cache::remember('discord_roles', 60, function () {
            $response =
                Http::accept('application/json')
                    ->withHeaders(['Authorization' => config('cad.discord_bot_token')])
                    ->get('https://discord.com/api/guilds/'.get_setting('discord_guild_id').'/roles');

            return json_decode($response->body());
        });
    }

    public static function get_user_roles($user_id)
    {
        return Cache::remember('user_discord_roles_'.$user_id, 30, function () use ($user_id) {
            $response = Http::accept('application/json')
                ->withHeaders(['Authorization' => config('cad.discord_bot_token')])
                ->get('https://discord.com/api/guilds/'.get_setting('discord_guild_id').'/members/'.$user_id);

            if ($response->status() != 200) {
                throw new Exception('Discord Bot is not in your server or doesn\'t have correct permissions.');
            }

            return json_decode($response->body())->roles;
        });
    }
}
