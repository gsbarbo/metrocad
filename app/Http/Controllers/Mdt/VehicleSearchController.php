<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;

class VehicleSearchController extends Controller
{
    public function __invoke()
    {
        return view('mdt.vehicleSearch');

    }
}
