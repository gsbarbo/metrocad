<?php

namespace App\Http\Middleware;

use App\Services\DiscordService;
use Closure;
use Illuminate\Http\Request;

class userDiscordSuspendedRoleCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            if (get_setting('discord.useRoles.suspendedRoleId', 0) != 0) {
                $user_roles = (new DiscordService)->get_user_roles($request->user()->id);

                if (in_array(get_setting('discord.useRoles.suspendedRoleId'), array_values($user_roles))) {
                    $request->user()->update(['status' => 3]);
                } else {
                    if ($request->user()->status == 3) {
                        $request->user()->update(['status' => 2]);
                    }
                }
            }
        }

        return $next($request);
    }
}
