<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class DiscordAuthService
{
    private const DISCORD_API = 'https://discord.com/api/v10';

    public function findOrCreateUser(SocialiteUser $discordUser): User
    {
        $this->validateGuildMembership($discordUser->token);

        dd($discordUser);
        return User::updateOrCreate(
            ['discord_id' => $discordUser->getId()],
            [
                'name'           => $discordUser->getName(),
                'email'          => $discordUser->getEmail(),
                'discord_token'  => $discordUser->token,
                'discord_refresh_token' => $discordUser->refreshToken,
                'avatar'         => $discordUser->getAvatar(),
                'password'       => bcrypt(Str::random(32)),
            ]
        );
    }

    private function validateGuildMembership(string $accessToken): void
    {
        $guilds = $this->fetchUserGuilds($accessToken);

        dd($guilds);

        $isMember = collect($guilds)->contains('id', config('services.discord.guild_id'));

        if (! $isMember) {
            throw new UnauthorizedException('You are not a member of the required Discord server.');
        }
    }

    private function fetchUserGuilds(string $accessToken): array
    {
        $response = Http::withToken($accessToken)
            ->get(self::DISCORD_API . '/users/@me/guilds');

        if ($response->failed()) {
            throw new \RuntimeException('Failed to fetch Discord guild membership.');
        }

        return $response->json();
    }
}
