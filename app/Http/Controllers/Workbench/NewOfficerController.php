<?php

namespace App\Http\Controllers\Workbench;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workbench\OfficerStoreRequest;
use App\Models\UserDepartment;

class NewOfficerController extends Controller
{
    public function store(OfficerStoreRequest $request)
    {
        $data = $request->validated();

        $userDepartment = UserDepartment::where('user_id', auth()->user()->id)
            ->where('id', $data['user_department_id'])
            ->where('officer_id', null)
            ->first();

        if (! $userDepartment) {
            return redirect()->route('workbench.newOfficer.create')
                ->with('alerts', [['message' => 'Invalid department slot selected.', 'level' => 'error']]);
        }

        $officer = $userDepartment->officer()->create([
            'id' => rand(100000, 9999999),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'badge_number' => $data['badge_number'],
            'rank' => $data['rank'],
        ]);

        $userDepartment->officer_id = $officer->id;
        $userDepartment->save();

        return redirect()->route('workbench.home')
            ->with('alerts', [['message' => 'Officer created successfully.', 'level' => 'success']]);
    }

    public function create()
    {
        $userDepartments = UserDepartment::where('user_id', auth()->user()->id)
            ->get();

        if ($userDepartments->where('officer_id', null)->count() == 0) {
            return redirect()->route('workbench.home')
                ->with('alerts', [['message' => 'You have no open department slots to create an officer.', 'level' => 'error']]);
        }

        return view('workbench.newOfficer.create');
    }
}
