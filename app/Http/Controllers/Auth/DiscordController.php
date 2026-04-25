<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\DiscordAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function __construct(private DiscordAuthService $discordAuth) {}

    public function redirect(): RedirectResponse
    {
        return Socialite::driver('discord')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $discordUser = Socialite::driver('discord')->user();
            $user = $this->discordAuth->findOrCreateUser($discordUser);
        } catch (UnauthorizedException $e) {
            toast('error', $e->getMessage());

            return redirect()->route('home')
                ->withErrors(['discord' => $e->getMessage()]);
        } catch (\Exception $e) {
            toast('error', $e->getMessage());

            return redirect()->route('home')
                ->withErrors(['discord' => 'Discord authentication failed. Please try again.']);
        }

        $user = $this->discordAuth->findOrCreateUser($discordUser);

        Auth::login($user, remember: true);

        return redirect()->intended(route('portal.dashboard'));
    }
}
