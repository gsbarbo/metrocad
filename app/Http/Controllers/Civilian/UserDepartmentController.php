<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Models\Civilian;
use Illuminate\Http\Request;

class UserDepartmentController extends Controller
{
    public function update(Civilian $civilian, Request $request)
    {
        $civilian->update(['user_department_id' => $request->input('user_department_id')]);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Civilian added to the department.', 'level' => 'success']]);
    }

    public function destroy(Civilian $civilian, Request $request)
    {
        $civilian->update(['user_department_id' => null]);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Civilian removed from the department.', 'level' => 'success']]);
    }
}
