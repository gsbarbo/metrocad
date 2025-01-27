<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::all();
        $data = [
            'active_members' => $users->where('status', 2)->where('last_login_at', '>', now()->subDays(14))->count(),
            'inactive_members' => $users->where('status', 2)->where('last_login_at', '<', now()->subDays(14))->count(),
            'total_members' => $users->where('status', 2)->count(),
            'pending_members' => $users->where('status', 1)->count(),
        ];

        return view('admin.dashboard', $data);
    }
}
