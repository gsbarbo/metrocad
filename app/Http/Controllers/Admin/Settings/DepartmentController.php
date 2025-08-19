<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\DepartmentRequest;
use App\Models\Department;
use App\Services\DiscordService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.settings.department.index');
    }

    public function store(DepartmentRequest $request)
    {

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $data['logo'] = ImageService::saveFromUrl(
            url: $data['image_url'],
            folder: 'images/departments/',
            prefix: $data['slug']
        );

        unset($data['image_url']);

        Department::create($data);

        return redirect()->route('admin.settings.departments.index')->with('alerts', [['message' => 'Department created.', 'level' => 'success']]);
    }

    public function create()
    {
        $discordRoles = [];
        if (get_setting('discord.useRoles.useDepartmentRoles')) {
            $discordRoles = DiscordService::getServerRoles();
        }

        return view('admin.settings.department.create', compact('discordRoles'));
    }

    public function edit(Department $department)
    {
        $discordRoles = [];
        if (get_setting('discord.useRoles.useDepartmentRoles')) {
            $discordRoles = DiscordService::getServerRoles();
        }

        return view('admin.settings.department.edit', compact('discordRoles', 'department'));
    }

    public function destroy(Request $request, Department $department)
    {
        $confirm = $request->input('confirm');

        if ($confirm !== $department->name) {
            return redirect()->route('admin.settings.departments.edit', $department->slug)->with('alerts', [['message' => 'Department delete confirm check didn\'t match.', 'level' => 'error']]);
        }

        ImageService::deleteFromUrl($department->logo);
        $department->update(['logo' => null, 'discord_role_id' => null]);
        $department->delete();

        return redirect()->route('admin.settings.departments.index')->with('alerts', [['message' => 'Department deleted.', 'level' => 'success']]);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $data['logo'] = ImageService::saveFromUrl(
            url: $data['image_url'],
            folder: 'images/departments/',
            prefix: $data['slug']
        );

        unset($data['image_url']);

        $department->update($data);

        return redirect()->route('admin.settings.departments.index')->with('alerts', [['message' => 'Department saved.', 'level' => 'success']]);
    }
}
