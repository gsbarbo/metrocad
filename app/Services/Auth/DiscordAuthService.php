<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class DiscordAuthService
{
    private const DISCORD_API = 'https://discord.com/api/v10';

    public function findOrCreateUser(SocialiteUser $discordUser): User
    {
        // $this->validateGuildMembership($discordUser->token);

        return User::updateOrCreate(
            ['id' => $discordUser->getId()],
            [
                'discord_username' => $discordUser->getName(),
                'discord_global_name' => $discordUser->user['global_name'],
                'email' => $discordUser->getEmail(),
                'discord_token' => $discordUser->token,
                'discord_refresh_token' => $discordUser->refreshToken,
                'avatar' => $discordUser->getAvatar(),
                'last_login_at' => now(),
            ]
        );
    }

    private function validateGuildMembership(string $accessToken): void
    {
        $guilds = $this->fetchUserGuilds($accessToken);

        $isMember = collect($guilds)->contains('id', config('services.discord.guild_id'));

        if (! $isMember) {
            throw new UnauthorizedException('You are not a member of the required Discord server.');
        }
    }

    private function fetchUserGuilds(string $accessToken): array
    {
        $response = Http::withToken($accessToken)
            ->get(self::DISCORD_API.'/users/@me/guilds');

        if ($response->failed()) {
            throw new \RuntimeException('Failed to fetch Discord guild membership.');
        }

        return $response->json();
    }
}
