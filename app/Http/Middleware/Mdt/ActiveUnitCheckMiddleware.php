<?php

namespace App\Http\Middleware\Mdt;

use App\Models\ActiveUnit;
use Closure;
use Illuminate\Http\Request;

class ActiveUnitCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $active_unit_count = ActiveUnit::where('user_id', $request->user()->id)->without(['officer', 'user_department', 'calls', 'user'])->count();

        if ($active_unit_count != 1) {
            return redirect()->route('mdt.home');
        }

        return $next($request);
    }
}
