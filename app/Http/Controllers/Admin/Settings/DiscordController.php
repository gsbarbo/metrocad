<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\DiscordChannel;
use App\Services\DiscordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordController extends Controller
{
    public function index()
    {
        $serverRoles = DiscordService::getServerRoles();

        return view('admin.settings.discord.index', compact('serverRoles'));
    }

    public function update_guild_id(Request $request)
    {
        $guildId = $request->input('discord_guildId');

        if (! $guildId) {
            update_setting([
                'discord.guildId' => 0,
                'discord.useRoles' => false,
                'discord.useRoles.memberRoleId' => 0,
                'discord.useRoles.suspendedRoleId' => 0,
                'discord.useRoles.useDepartmentRoles' => false,
                'discord.useAuditLog' => false,
            ]);

            return redirect()->route('admin.settings.discord.index');
        }

        if (! DiscordService::checkBotStatus($guildId)) {
            update_setting([
                'discord.guildId' => 0,
                'discord.useRoles' => false,
                'discord.useRoles.memberRoleId' => 0,
                'discord.useRoles.suspendedRoleId' => 0,
                'discord.useRoles.useDepartmentRoles' => false,
                'discord.useAuditLog' => false,
            ]);

            return redirect()->route('admin.settings.discord.index')->with('alerts', [['message' => 'The Discord bot is not in this server.', 'level' => 'error']]);
        }

        update_setting('discord.guildId', $guildId);

        return redirect()->route('admin.settings.discord.index')->with('alerts', [['message' => 'Discord bot is set up and running.', 'level' => 'success']]);
    }

    public function audit_log()
    {
        $discord_channels = [];
        if (get_setting('discord.useAuditLog') && get_setting('discord.guildId')) {
            $discord_channels = DiscordChannel::all();
        }

        $discord_guild_channels = Http::accept('application/json')
            ->withHeaders(['Authorization' => config('metrocad.discord_bot_token')])
            ->get('https://discord.com/api/guilds/'.get_setting('discord.guildId').'/channels')->body();

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
}
