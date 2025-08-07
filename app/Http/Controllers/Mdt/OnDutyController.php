<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\ActiveUnit;
use App\Models\Civilian;
use App\Models\UserDepartment;
use Illuminate\Http\Request;

class OnDutyController extends Controller
{
    public function __invoke(Request $request)
    {
        if (isset(auth()->user()->active_unit)) {
            return redirect()->route('mdt.dashboard');
        }

        $validated = $request->validate([
            'user_department_id' => ['required', 'numeric'],
        ]);

        $userDepartment = UserDepartment::query()->findOrFail($validated['user_department_id']);
        $civilian = Civilian::query()->where('user_id', auth()->user()->id)->where('user_department_id', $userDepartment->id)->get()->first();

        if (! $civilian) {
            return redirect()->route('portal.dashboard')
                ->with('alerts', [['message' => 'You have not linked a civilian to this department.', 'level' => 'error']]);
        }

        if ($userDepartment->rank == 'NEEDS SET' || $userDepartment->badge_number == 'NEEDS SET') {
            $help_message = 'Please see a staff or admin.';

            if (get_setting('feature_use_discord_department_roles')) {
                $help_message = 'Please update in the civilian page.';
            }

            return redirect()->route('portal.dashboard')->with('alerts', [['message' => 'You do not have a valid rank or badge number. '.$help_message, 'level' => 'error']]);
        }

        $input['user_id'] = auth()->user()->id;
        $input['user_department_id'] = $userDepartment->id;
        $input['civilian_id'] = $civilian->id;
        $input['department_type_id'] = $userDepartment->department->type;
        $input['status'] = 'OFFDTY';
        $input['description'] = 'SIGNED IN: '.date('G:i:s').' | ON DASHBOARD';

        ActiveUnit::create($input);

        return redirect()->route('mdt.dashboard')->with('alerts', [['message' => 'You are now signed in.', 'level' => 'success']]);
    }
}
