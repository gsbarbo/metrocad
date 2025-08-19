<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\RoleRequest;
use App\Models\Role;
use App\Services\DiscordService;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.settings.role.index');
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'discord_role_id' => $request->input('discord_role_id'),
        ]);

        $numericPermissionArray = [];
        foreach ($request->permissions as $permission) {
            $numericPermissionArray[] = intval($permission);
        }
        $role->syncPermissions($numericPermissionArray);

        return redirect()->route('admin.settings.role.index')->with('alerts', [['message' => 'Role Created.', 'level' => 'success']]);

    }

    public function create()
    {
        $permissions = Permission::all();

        $serverRoles = [];
        if (get_setting('discord.useRoles')) {
            $serverRoles = DiscordService::getServerRoles();
        }

        return view('admin.settings.role.create', compact('permissions', 'serverRoles'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        //        dd($role->permissions->pluck('id')->toArray());

        $serverRoles = [];
        if (get_setting('discord.useRoles')) {
            $serverRoles = DiscordService::getServerRoles();
        }

        return view('admin.settings.role.edit', compact('role', 'permissions', 'serverRoles'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->input('name'),
            'discord_role_id' => $request->input('discord_role_id'),
            'updated_at' => now(),
        ]);

        $numericPermissionArray = [];
        foreach ($request->permissions as $permission) {
            $numericPermissionArray[] = intval($permission);
        }
        $role->syncPermissions($numericPermissionArray);

        return redirect()->route('admin.settings.role.index')->with('alerts', [['message' => 'Role Updated.', 'level' => 'success']]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.settings.role.index')->with('alerts', [['message' => 'Role Deleted.', 'level' => 'success']]);

    }
}
