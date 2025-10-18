<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\Civilian;

class TicketController extends Controller
{
    public function create()
    {
        $civilian = Civilian::query()->findOrFail(request()->civilian_id);

        return view('mdt.tickets.create', compact('civilian'));
    }
}
