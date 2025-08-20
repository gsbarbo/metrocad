<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\CallVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class LinkVehicleToCallController extends Controller
{
    public function __invoke(Request $request, Vehicle $vehicle)
    {
        if ($request->input('call_id') == 0 || $request->input('type') == 0) {
            return redirect()->route('mdt.vehicleReturn', $vehicle->id)->with('alerts', [['message' => 'You must choose a call and a type.', 'level' => 'error']]);
        }
        CallVehicle::create([
            'call_id' => $request->input('call_id'),
            'vehicle_id' => $vehicle->id,
            'type' => $request->input('type'),
        ]);

        return redirect()->route('mdt.vehicleReturn', $vehicle->id)->with('alerts', [['message' => 'Vehicle added to call# '.$request->input('call_id'), 'level' => 'success']]);
    }
}
