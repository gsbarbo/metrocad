<?php

namespace App\Http\Middleware;

use App\Services\DiscordService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Lottery;

class DiscordDepartmentRoleSyncMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (get_setting('feature_use_discord_department_roles', 0)) {
            Lottery::odds(1, 3)->winner(
                function () use ($request) {
                    DiscordService::discordRoleSync($request->user()->id);
                }
            )->choose();
        }

        return $next($request);
    }
}
