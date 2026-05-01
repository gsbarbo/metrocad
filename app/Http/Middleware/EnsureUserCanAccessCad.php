<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanAccessCad
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user->status->canLogin()) {
            return match ($user->status) {
                UserStatus::Pending => redirect()->route('status.pending'),
                UserStatus::Banned => redirect()->route('status.banned'),
                UserStatus::Denied => redirect()->route('status.denied'),
                UserStatus::Suspended => redirect()->route('status.suspended'),
                default => redirect()->route('status.inactive'),
            };
        }

        return $next($request);
    }
}
