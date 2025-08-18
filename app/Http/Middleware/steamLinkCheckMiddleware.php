<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class steamLinkCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (get_setting('features.forceSteamLink', false)) {
            if ($request->user()) {
                if (! $request->user()->steam_hex) {
                    return redirect()->route('portal.user.settings')->with('alerts', [['message' => 'Your Steam account must be linked.', 'level' => 'warning']]);
                }
            }
        }

        return $next($request);
    }
}
