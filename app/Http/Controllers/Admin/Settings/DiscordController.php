<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\DiscordChannel;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordController extends Controller
{
    public function index()
    {
        return view('admin.settings.discord.index');
    }

    public function update_guild_id(Request $request)
    {
        $response = Http::accept('application/json')
            ->withHeaders(['Authorization' => config('cad.discord_bot_token')])
            ->get('https://discord.com/api/guilds/'.$request->input('discord_guild_id').'/roles');

        if ($response->status() != 200) {
            Setting::updateOrCreate(
                ['name' => 'discord_guild_id'],
                ['value' => 0]
            );
            Cache::forget('settings');

            return redirect()->route('admin.settings.discord.index')->with('alerts', [['message' => 'Discord Bot is not in server. Review docs to fix issue.', 'level' => 'error']])->withInput($request->input());
        }

        Setting::updateOrCreate(
            ['name' => 'discord_guild_id'],
            ['value' => $request->input('discord_guild_id')]
        );

        Cache::forget('settings');

        return redirect()->route('admin.settings.discord.index')->with('alerts', [['message' => 'Discord bot is set up and running.', 'level' => 'success']]);
    }

    public function audit_log()
    {
        $discord_channels = [];
        if (get_setting('feature_use_discord_audit_log')) {
            $discord_channels = DiscordChannel::all();
        }

        $discord_guild_channels = Http::accept('application/json')
            ->withHeaders(['Authorization' => config('cad.discord_bot_token')])
            ->get('https://discord.com/api/guilds/'.get_setting('discord_guild_id').'/channels')->body();

        $channel_choices = [];
        foreach (json_decode($discord_guild_channels) as $channel) {
            $channel_choices[$channel->id] = $channel->name;
        }

        return view('admin.settings.discord.audit_log', compact('discord_channels', 'channel_choices'));
    }

    public function update_channels(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            DiscordChannel::where('name', $key)->first()->update(['channel_id' => $value]);
        }

        return redirect()->route('admin.settings.discord.audit_log')->with('alerts', [['message' => 'Discord Channels Updated.', 'level' => 'success']]);
    }

    public function roles()
    {
        $discord_roles = [];

        if (get_setting('feature_use_discord_roles') && get_setting('discord_guild_id')) {
            $response =
                Http::accept('application/json')
                    ->withHeaders(['Authorization' => config('cad.discord_bot_token')])
                    ->get('https://discord.com/api/guilds/'.get_setting('discord_guild_id').'/roles');

            $discord_roles = json_decode($response->body());
        }

        return view('admin.settings.discord.roles', compact('discord_roles'));
    }
}
