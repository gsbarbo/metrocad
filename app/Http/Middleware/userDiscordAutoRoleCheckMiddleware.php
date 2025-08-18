<?php

namespace App\Http\Middleware;

use App\Enum\User\UserStatuses;
use App\Services\DiscordService;
use Closure;
use Illuminate\Http\Request;

class userDiscordAutoRoleCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            if (get_setting('discord.useRoles.memberRoleId', 0) != 0) {
                $userRoles = DiscordService::getUserRoles($request->user()->id);

                if (in_array(get_setting('discord.useRoles.memberRoleId'), array_values($userRoles))) {
                    if ($request->user()->status == UserStatuses::PENDING->value) {
                        $request->user()->update(['status' => UserStatuses::MEMBER->value]);
                    }
                } else {
                    if ($request->user()->status == UserStatuses::PENDING->value || $request->user()->status == UserStatuses::MEMBER->value) {
                        $request->user()->update(['status' => UserStatuses::PENDING->value]);
                    }
                }
            }
        }

        return $next($request);
    }
}
