<?php

namespace App\Http\Middleware\Mdt;

use App\Models\ActiveUnit;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ActiveUnitAutoOffDutyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $active_units = ActiveUnit::without(['officer', 'user_department', 'calls', 'user'])->get(['id', 'updated_at']);

        foreach ($active_units as $active_unit) {
            if ($active_unit->updated_at < Carbon::now()->subMinutes(get_setting('mdt.activeUnitTimeout'))) {
                $active_unit->update(['off_duty_type_id' => 3]);
                $active_unit->delete();
            }
        }

        return $next($request);
    }
}
