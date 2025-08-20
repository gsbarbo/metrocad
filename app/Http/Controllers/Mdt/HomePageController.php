<?php

namespace App\Http\Controllers\Mdt;

use App\Enum\DepartmentType;
use App\Http\Controllers\Controller;
use App\Models\UserDepartment;
use App\Services\DiscordService;

class HomePageController extends Controller
{
    public function __invoke()
    {
        DiscordService::discordRoleSync(auth()->user()->id);

        if (isset(auth()->user()->active_unit)) {
            return redirect()->route('mdt.dashboard');
        }

        $userDepartments = UserDepartment::query()->where('user_id', auth()->user()->id)->with('officer')->get();
        $availableDepartments = [];

        foreach ($userDepartments as $userDepartment) {
            if ($userDepartment->department->type == DepartmentType::LawEnforcement->value
                || $userDepartment->department->type == DepartmentType::Dispatch->value
                || $userDepartment->department->type == DepartmentType::FireEMS->value
            ) {
                $availableDepartments[] = $userDepartment;
            }
        }

        return view('mdt.home', compact('availableDepartments'));
    }
}
