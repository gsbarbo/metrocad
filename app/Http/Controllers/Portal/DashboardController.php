<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $announcements = Announcement::where('department_id', null)->latest()->limit(2)->get();

        return view('portal.dashboard', compact('announcements'));
    }
}
