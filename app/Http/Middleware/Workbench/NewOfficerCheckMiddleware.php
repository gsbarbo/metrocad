<?php

namespace App\Http\Middleware\Workbench;

use App\Models\UserDepartment;
use Closure;
use Illuminate\Http\Request;

class NewOfficerCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $userDepartments = UserDepartment::where('user_id', $request->user()->id)
            ->without('department')
            ->get(['officer_id']);

        foreach ($userDepartments as $userDepartment) {
            if ($userDepartment->officer_id == null) {
                redirect()->route('workbench.officer.create')
                    ->with('alerts', [['message' => 'You must create an officer continuing.', 'level' => 'error']])
                    ->send();

                return $next($request);
            }
        }

        return $next($request);
    }
}
