<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\ActiveUnit;

class OffDutyController extends Controller
{
    public function __invoke()
    {
        $active_unit = ActiveUnit::where('user_id', auth()->user()->id)->get()->first();
        $active_unit->update(['status' => 'OFFDTY', 'off_duty_at' => now(), 'off_duty_type_id' => 1]);
        $active_unit->delete();

        return redirect()->route('portal.dashboard')
            ->with('alerts', [['message' => 'You have went off duty.', 'level' => 'success']]);
    }
}
