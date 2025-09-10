<?php

namespace App\Http\Controllers\Portal;

use App\Enum\User\UserStatuses;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $announcements = Announcement::where('department_id', null)->latest()->limit(2)->get();
        $allMembers = User::where('status', UserStatuses::MEMBER->value)
            ->whereNotIn('id', config('metrocad.developer_ids'))
            ->count();
        $newMembers = User::where('status', UserStatuses::MEMBER->value)
            ->whereNotIn('id', config('metrocad.developer_ids'))
            ->where('became_member_at', '>', now()->subDays(30))
            ->count();
        $activeMembers = User::where('status', UserStatuses::MEMBER->value)
            ->whereNotIn('id', config('metrocad.developer_ids'))
            ->where('last_login_at', '>', now()->subDays(5))
            ->count();

        return view('portal.dashboard', compact('announcements', 'allMembers', 'activeMembers', 'newMembers'));
    }
}
