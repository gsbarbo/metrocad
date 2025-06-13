<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SteamLinkController extends Controller
{
    public function handle()
    {
        $steamUser = Socialite::driver('steam')->user();

        if (! is_null($steamUser)) {

            if ($this->userCheck($steamUser->getId())) {
                return redirect()->route('portal.user.settings')->with('alerts', [['message' => 'Steam account linked to a different user. If this is in error contact an admin.', 'level' => 'error']]);
            }

            auth()->user()->update([
                'steam_hex' => User::dec2hex($steamUser->getId()),
                'steam_id' => $steamUser->getId(),
                'steam_name' => $steamUser->nickname,
            ]);

            return redirect()->route('portal.user.settings')->with('alerts', [['message' => 'Steam account linked.', 'level' => 'success']]);
        }

        return redirect()->route('portal.user.settings')->with('alerts', [['message' => 'Something went wrong. Try again.', 'level' => 'error']]);

    }

    protected function userCheck($steamId)
    {
        $user = User::where('steam_id', $steamId)->first();

        if ($user) {
            return true;
        }

        return false;
    }
}
