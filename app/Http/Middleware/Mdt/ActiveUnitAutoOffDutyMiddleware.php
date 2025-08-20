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

        \Log::info('ActiveUnit timeout value', [
            'value' => get_setting('mdt.activeUnitTimeout'),
            'type' => gettype(get_setting('mdt.activeUnitTimeout')),
        ]);

        foreach ($active_units as $active_unit) {
            $timeout = get_setting('mdt.activeUnitTimeout');

            \Log::info('Timeout before subMinutes', [
                'value' => $timeout,
                'type' => gettype($timeout),
                'class' => is_object($timeout) ? get_class($timeout) : null,
            ]);

            \Log::info('ActiveUnit updated_at', [
                'raw' => $active_unit->getRawOriginal('updated_at'),
                'cast' => $active_unit->updated_at,
                'type' => gettype($active_unit->updated_at),
            ]);

            $cutoff = Carbon::now()->subMinutes((int) $timeout);

            if (Carbon::parse($active_unit->updated_at)->lt($cutoff)) {
                $active_unit->update(['off_duty_type_id' => 3]);
                $active_unit->delete();
            }
        }

        return $next($request);
    }
}
