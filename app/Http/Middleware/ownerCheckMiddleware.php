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
            if ($request->user()->is_owner
                || in_array($request->user()->id, config('metrocad.developer_ids'))
                || $request->user()->id == config('metrocad.owner_id')) {
                $request->user()->update(['status' => UserStatuses::MEMBER->value, 'is_owner' => 1]);
            }
        }

        return $next($request);
    }
}
