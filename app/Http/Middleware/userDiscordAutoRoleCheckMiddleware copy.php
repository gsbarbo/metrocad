<?php

namespace App\Http\Middleware;

use App\Services\DiscordService;
use Closure;
use Illuminate\Http\Request;

class userDiscordAutoRoleCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            if (get_setting('discord_auto_approval_role_id', 0) != 0) {
                $user_roles = (new DiscordService)->get_user_roles($request->user()->id);

                if (in_array(get_setting('discord_auto_approval_role_id'), array_values($user_roles))) {
                    if ($request->user()->status == 1) {
                        $request->user()->update(['status' => 2]);
                    }
                } else {
                    if ($request->user()->status == 1 || $request->user()->status == 2) {
                        $request->user()->update(['status' => 1]);
                    }

                }
            }
        }

        return $next($request);
    }
}
