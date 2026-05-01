<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->status === UserStatus::Active) {
            return redirect()->route('portal.dashboard');
        }

        return $next($request);
    }
}
