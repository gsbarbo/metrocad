<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mdt\CallStoreRequest;
use App\Models\Call;
use App\Models\CallCivilian;
use App\Models\CallVehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallController extends Controller
{
    public function index(): View {}

    public function store(CallStoreRequest $request)
    {
        $data = $request->validated();

        if (! isset($data['linked_civilians']) && ! isset($data['linked_vehicles'])) {
            $call = Call::create($data);

            return redirect()->route('mdt.cadScreen');
        }

        $linked_civilians = $data['linked_civilians'] ?? [];
        $linked_civilians_types = $data['linked_civilians_types'] ?? [];
        $linked_vehicles = $data['linked_vehicles'] ?? [];
        $linked_vehicles_types = $data['linked_vehicles_types'] ?? [];

        unset($data['linked_civilians'], $data['linked_civilians_types'], $data['linked_vehicles'], $data['linked_vehicles_types']);

        $call = Call::create($data);

        if (! empty($linked_civilians)) {
            $index = 0;
            foreach ($linked_civilians as $civilianId) {
                CallCivilian::create([
                    'call_id' => $call->id,
                    'civilian_id' => $civilianId,
                    'type' => $linked_civilians_types[$index],
                ]);
                $index++;
            }
        }

        if (! empty($linked_vehicles)) {
            $index = 0;
            foreach ($linked_vehicles as $vehicleId) {
                CallVehicle::create([
                    'call_id' => $call->id,
                    'vehicle_id' => $vehicleId,
                    'type' => $linked_vehicles_types[$index],
                ]);
                $index++;
            }
        }

        return redirect()->route('mdt.cadScreen');
    }

    public function create(): View
    {
        return view('mdt.calls.create');
    }

    public function show($id): View {}

    public function edit($id): View {}

    public function update(Request $request, $id) {}
}
