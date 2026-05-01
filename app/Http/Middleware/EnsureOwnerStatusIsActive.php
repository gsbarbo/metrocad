<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOwnerStatusIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->is_owner && $user->status !== UserStatus::Active) {
            $user->update(['status' => UserStatus::Active]);
        }

        return $next($request);
    }
}
