<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ownerCheckMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            if ($request->user()->is_owner) {
                $request->user()->update(['status' => 2]);
            }
        }

        return $next($request);
    }
}
