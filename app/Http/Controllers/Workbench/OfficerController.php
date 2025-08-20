<?php

namespace App\Http\Controllers\Workbench;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workbench\OfficerStoreRequest;
use App\Http\Requests\Workbench\OfficerUpdateRequest;
use App\Models\Officer;
use App\Models\UserDepartment;
use App\Services\ImageService;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = Officer::where('user_id', auth()->user()->id)->with('user_department')->get();

        return view('workbench.officer.index', compact('officers'));
    }

    public function store(OfficerStoreRequest $request)
    {
        $data = $request->validated();

        $userDepartment = UserDepartment::where('user_id', auth()->user()->id)
            ->where('id', $data['user_department_id'])
            ->where('officer_id', null)
            ->first();

        if (! $userDepartment) {
            return redirect()->route('workbench.officer.create')
                ->with('alerts', [['message' => 'Invalid department slot selected.', 'level' => 'error']]);
        }

        $officer = $userDepartment->officer()->create([
            'id' => rand(100000, 9999999),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'badge_number' => $data['badge_number'],
            'rank' => $data['rank'],
            'user_id' => auth()->user()->id,
        ]);

        $userDepartment->officer_id = $officer->id;
        $userDepartment->save();

        if ($request->input('image_url')) {
            $filename = 'officer_'.$officer->id;

            $data['picture'] = ImageService::saveFromUrl(
                url: $request->input('image_url'),
                folder: 'images/officers/',
                prefix: $filename);

            $officer->update(['picture' => $data['picture']]);
        }

        return redirect()->route('workbench.home')
            ->with('alerts', [['message' => 'Officer created successfully.', 'level' => 'success']]);
    }

    public function create()
    {
        $userDepartments = UserDepartment::where('user_id', auth()->user()->id)
            ->where('officer_id', null)
            ->get();

        //        if ($userDepartments->where('officer_id', null)->count() == 0) {
        //            return redirect()->route('workbench.home')
        //                ->with('alerts', [['message' => 'You have no open department slots to create an officer.', 'level' => 'error']]);
        //        }

        return view('workbench.officer.create', compact('userDepartments'));
    }

    public function update(OfficerUpdateRequest $request, Officer $officer)
    {
        $data = $request->validated();

        if ($data['user_department_id']) {
            $officer->user_department()->update(['officer_id' => null]);

            UserDepartment::where('id', $data['user_department_id'])->first()->update(['officer_id' => $officer->id]);
        }

        unset($data['user_department_id']);

        if ($data['image_url'] && $data['image_url'] != $officer->picture) {
            $filename = 'officer_'.$officer->id;

            $data['picture'] = ImageService::saveFromUrl(
                url: $request->input('image_url'),
                folder: 'images/officers/',
                prefix: $filename);
        }

        unset($data['image_url']);
        $officer->update($data);

        return redirect()->route('workbench.officer.index')
            ->with('alerts', [['message' => 'Officer updated successfully.', 'level' => 'success']]);
    }

    public function edit(Officer $officer)
    {
        $userDepartments = UserDepartment::where('user_id', auth()->user()->id)
            ->where('officer_id', null)
            ->get();

        return view('workbench.officer.edit', compact('officer', 'userDepartments'));
    }
}
