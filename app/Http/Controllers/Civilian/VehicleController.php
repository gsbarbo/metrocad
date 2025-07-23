<?php

namespace App\Http\Controllers\Civilian;

use App\Enum\VehicleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\VehicleRequest;
use App\Models\Civilian;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(VehicleRequest $request, Civilian $civilian)
    {
        // $current_civilian_level = CivilianLevel::where('id', auth()->user()->civilian_level_id)->get()->first();

        // if ($current_civilian_level->vehicle_limit <= $civilian->vehicles->count()) {
        //     return redirect()->route('civilian.civilians.show', $civilian->id)->with('alerts', [['message' => 'You have reached your max vehicles.', 'level' => 'error']]);
        // }

        $data = $request->validated();
        $data['civilian_id'] = $civilian->id;
        $data['expires_at'] = date('Y-m-d', strtotime('+30 Days'));
        $data['plate'] = strtoupper($data['plate']);

        if ($data['status'] == VehicleStatus::EXPIRED->value) {
            $data['expires_at'] = date('Y-m-d', strtotime('-30 Days'));
            $data['status'] = VehicleStatus::VALID->value;
        }

        Vehicle::create($data);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Vehicle created', 'level' => 'success']]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
