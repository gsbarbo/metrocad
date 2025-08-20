<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\Call;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $callCount = Call::where('status', 'not like', 'CLO-')->count();

        return view('mdt.dashboard', compact('callCount'));
    }
}
