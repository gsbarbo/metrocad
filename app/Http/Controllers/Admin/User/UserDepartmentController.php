<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserDepartmentRequest;
use App\Http\Requests\Admin\User\UserDepartmentUpdateRequest;
use App\Models\Civilian;
use App\Models\Department;
use App\Models\History;
use App\Models\User;
use App\Models\UserDepartment;
use Illuminate\Http\Request;

class UserDepartmentController extends Controller
{
    public function index(User $user)
    {
        return view('admin.user.userDepartments.index', compact('user'));
    }

    public function create(User $user)
    {
        $departments = Department::where('id', '>', 0)->get(['name', 'id']);
        $userDepartments = $user->userDepartments;

        $memberDepartments = [];
        $allDepartments = [];

        foreach ($userDepartments as $userDepartment) {
            $memberDepartments[] = $userDepartment->department_id;
        }

        foreach ($departments as $department) {
            $allDepartments[$department->id] = $department->name;
        }

        foreach ($allDepartments as $id => $name) {
            if (in_array($id, $memberDepartments)) {
                unset($allDepartments[$id]);
            }
        }

        return view('admin.user.userDepartments.create', compact('user', 'allDepartments'));
    }

    public function store(UserDepartmentRequest $request, User $user)
    {
        $input = $request->validated();
        $input['user_id'] = $user->id;
        UserDepartment::create($input);

        History::create([
            'subject_type' => 'user',
            'subject_id' => $user->id,
            'user_id' => auth()->user()->id,
            'description' => 'Department added.',
        ]);

        return redirect()->route('admin.user.userDepartments.index', $user->id)->with('alerts', [['message' => 'Department added.', 'level' => 'success']]);
    }

    public function edit(User $user, UserDepartment $userDepartment)
    {
        return view('admin.user.userDepartments.edit', compact('user', 'userDepartment'));

    }

    public function update(UserDepartmentUpdateRequest $request, User $user, UserDepartment $userDepartment)
    {
        $userDepartment->update($request->validated());

        return redirect()->route('admin.user.userDepartments.index', $user->id)->with('alerts', [['message' => 'Department updated.', 'level' => 'success']]);
    }

    public function destroy(Request $request, User $user, UserDepartment $userDepartment)
    {
        $confirm = $request->input('confirm');

        if ($confirm == $userDepartment->badge_number.' '.$userDepartment->rank) {
            Civilian::where('user_department_id', $userDepartment->id)->get()->first()?->update(['user_department_id', null]);
            $userDepartment->delete();

            return redirect()->route('admin.user.userDepartments.index', $user->id)->with('alerts', [['message' => 'User removed from department.', 'level' => 'success']]);
        }

        return redirect()->route('admin.settings.userDepartments.edit', ['userDepartment' => $userDepartment->id, 'user' => $user->id])
            ->with('alerts', [['message' => 'Confirm check didn\'t match.', 'level' => 'error']]);
    }
}
