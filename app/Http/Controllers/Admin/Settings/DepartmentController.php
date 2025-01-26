<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\DepartmentsUpdateRequest;
use App\Models\Department;
use App\Services\DiscordService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();

        return view('admin.settings.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discord_roles = [];
        if (get_setting('feature_use_discord_department_roles') && get_setting('discord_guild_id')) {
            $discord_roles = (new DiscordService)->get_server_roles();
        }

        return view('admin.settings.department.create', compact('discord_roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! in_array($request->logo->extension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            return redirect()->route('admin.settings.department.create')->with('alerts', [['message' => 'Invalid Image Type.', 'level' => 'error']]);
        }

        $path = $request->logo->storePubliclyAs('public/images/departments/', Str::slug($request->input('name')).'.'.$request->logo->extension());

        $url = url('storage/images/departments/'.Str::slug($request->input('name')).'.'.$request->logo->extension());

        $department = Department::create([
            'name' => $request->input('name'),
            'initials' => $request->input('initials'),
            'type' => $request->input('type'),
            'slug' => Str::slug($request->input('name')),
            'logo' => $url,
        ]);

        if (get_setting('feature_use_discord_department_roles')) {
            $department->update(['discord_role_id' => $request->input('discord_role_id')]);
        }

        return redirect()->route('admin.settings.departments.index')->with('alerts', [['message' => 'Department Created.', 'level' => 'success']]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $discord_roles = [];
        if (get_setting('feature_use_discord_department_roles') && get_setting('discord_guild_id')) {
            $discord_roles = (new DiscordService)->get_server_roles();
        }

        return view('admin.settings.department.edit', compact('discord_roles', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentsUpdateRequest $request, Department $department)
    {
        if ($request->file('logo')) {
            if (! in_array($request->logo->extension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                return redirect()->route('admin.settings.department.edit', $department->slug)->with('alerts', [['message' => 'Invalid Image Type.', 'level' => 'error']]);
            }

            $path = $request->logo->storePubliclyAs('public/images/departments/', Str::slug($request->validated('name')).'.'.$request->logo->extension());

            $url = url('storage/images/departments/'.Str::slug($request->validated('name')).'.'.$request->logo->extension());

            $department->update(['logo' => $url]);
        }

        $department->update([
            'name' => $request->validated('name'),
            'initials' => $request->validated('initials'),
            'type' => $request->validated('type'),
            'slug' => Str::slug($request->validated('name')),
        ]);

        if (get_setting('feature_use_discord_department_roles')) {
            $department->update(['discord_role_id' => $request->input('discord_role_id')]);
        }

        return redirect()->route('admin.settings.departments.index')->with('alerts', [['message' => 'Department Saved.', 'level' => 'success']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('admin.settings.departments.index')->with('alerts', [['message' => 'Department Deleted.', 'level' => 'success']]);
    }
}
