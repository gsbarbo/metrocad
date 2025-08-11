<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class VehicleReturnController extends Controller
{
    public function __invoke(Vehicle $vehicle)
    {
        return view('mdt.vehicleReturn', compact('vehicle'));

    }
}
