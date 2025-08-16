<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\ActiveUnit;
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

        if (is_null($userDepartment->officer)) {
            return redirect()->route('portal.dashboard')
                ->with('alerts', [['message' => 'You have not linked an officer to this department.', 'level' => 'error']]);
        }

        $input['user_id'] = auth()->user()->id;
        $input['user_department_id'] = $userDepartment->id;
        $input['officer_id'] = $userDepartment->officer->id;
        $input['department_type_id'] = $userDepartment->department->type;
        $input['status'] = 'OFFDTY';
        $input['description'] = 'SIGNED IN: '.date('G:i:s');

        ActiveUnit::create($input);

        return redirect()->route('mdt.dashboard')->with('alerts', [['message' => 'You are now signed in.', 'level' => 'success']]);
    }
}
