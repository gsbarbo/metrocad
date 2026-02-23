<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        $discordUser = Socialite::driver('discord')->user();
        $user = $this->findOrNewUser($discordUser);
        Auth::login($user, true);

        return redirect()->intended('/portal')->with('alerts', [['message' => 'Welcome!', 'level' => 'success']]);
    }

    protected function findOrNewUser($discordUser)
    {
        $user = User::where('id', $discordUser->getId())->first();
        if ($user) {
            if (is_null($discordUser->avatar)) {
                $avatar = 'https://ui-avatars.com/api/?name='.urlencode($discordUser->user['global_name']);
            } else {
                $avatar = $discordUser->avatar;
            }
            $user->update([
                'discord_name' => $discordUser->user['global_name'],
                'discord_discriminator' => $discordUser->user['discriminator'],
                'discord_username' => $discordUser->user['username'],
                'avatar' => $avatar,
                'email' => $discordUser->email,
                'last_login_at' => now(),
            ]);
        } else {
            if (is_null($discordUser->avatar)) {
                $avatar = 'https://ui-avatars.com/api/?name='.urlencode($discordUser->user['global_name']);
            } else {
                $avatar = $discordUser->avatar;
            }
            User::create([
                'id' => $discordUser->user['id'],
                'discord_name' => $discordUser->user['global_name'],
                'discord_discriminator' => $discordUser->user['discriminator'],
                'discord_username' => $discordUser->user['username'],
                'avatar' => $avatar,
                'email' => $discordUser->email,
                'last_login_at' => now(),
            ]);
        }
        $user = User::where('id', $discordUser->getId())->first();

        return $user;
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('alerts', [['message' => 'Logged out.', 'level' => 'success']]);
    }
}
