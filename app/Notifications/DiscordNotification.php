<?php

namespace App\Notifications;

use App\Models\DiscordChannel;
use Illuminate\Support\Facades\Http;

class DiscordNotification
{
    public $channel;

    public $embeds;

    public function embed($title = '', $description = '', $color = null, $fields = [])
    {
        $this->embeds[] = [
            'title' => $title,
            'color' => $color,
            'description' => $description,
            'fields' => $fields,
        ];

        return $this;
    }

    public function channel($channel)
    {
        $this->channel = DiscordChannel::where('name', $channel)->first()->channel_id;

        return $this;
    }

    public function send()
    {
        $contents = [
            'embeds' => $this->embeds,
        ];

        return $response = Http::accept('application/json')
            ->withHeaders(['Authorization' => config('metro.discord_bot_token')])
            ->post('https://discord.com/api/channels/'.$this->channel.'/messages', $contents);
    }
}
