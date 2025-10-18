<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Civilian;

class NameReturnController extends Controller
{
    public function __invoke(Civilian $civilian)
    {
        $recentCalls = Call::where('created_at', '>', now()->subDay(4))->orWhere('status', 'not like', 'clo-%')->get();

        return view('mdt.nameReturn', compact('civilian', 'recentCalls'));
    }
}
