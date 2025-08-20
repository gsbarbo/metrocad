<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Vehicle;

class VehicleReturnController extends Controller
{
    public function __invoke(Vehicle $vehicle)
    {
        $recentCalls = Call::where('created_at', '>', now()->subDay(4))->get();

        return view('mdt.vehicleReturn', compact('vehicle', 'recentCalls'));
    }
}
