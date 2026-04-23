<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\DiscordAuthService;
use Illuminate\Http\RedirectResponse;
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
            return redirect()->route('login')
                ->withErrors(['discord' => $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['discord' => 'Discord authentication failed. Please try again.']);
        }

        $user = $this->discordAuth->findOrCreateUser($discordUser);

        auth()->login($user, remember: true);

        return redirect()->intended(route('dashboard'));
    }
}
