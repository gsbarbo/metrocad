<?php

namespace App\Http\Middleware;

use App\Enum\User\UserStatuses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ownerCheckMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user()) {
            if ($request->user()->is_owner) {
                $request->user()->update(['status' => UserStatuses::MEMBER->value]);
            }
        }

        return $next($request);
    }
}
