<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\VehicleType\VehicleTypeRequest;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicle_types = VehicleType::orderBy('type', 'asc')->orderBy('make', 'asc')->orderBy('model', 'asc')->get();

        return view('admin.settings.vehicletype.index', compact('vehicle_types'));
    }

    public function create()
    {
        return view('admin.settings.vehicletype.create');
    }

    public function store(VehicleTypeRequest $request)
    {
        VehicleType::create($request->validated());

        return redirect()->route('admin.settings.vehicletype.index')->with('alerts', [['message' => 'Vehicle added.', 'level' => 'success']]);
    }

    public function edit($vehicleType)
    {
        $vehicle_type = VehicleType::findOrFail($vehicleType);

        return view('admin.settings.vehicletype.edit', compact('vehicle_type'));
    }

    public function update(VehicleTypeRequest $request, $vehicleType)
    {
        $vehicle_type = VehicleType::findOrFail($vehicleType);
        $vehicle_type->update($request->validated());

        return redirect()->route('admin.settings.vehicletype.index')->with('alerts', [['message' => 'Vehicle saved.', 'level' => 'success']]);
    }

    public function destroy(Request $request, $vehicleType)
    {
        $confirm = $request->input('confirm');
        $vehicle_type = VehicleType::findOrFail($vehicleType);

        if ($confirm == $vehicle_type->make.' '.$vehicle_type->model) {
            $vehicle_type->delete();

            return redirect()->route('admin.settings.vehicletype.index')->with('alerts', [['message' => 'Vehicle deleted.', 'level' => 'success']]);
        }

        return redirect()->route('admin.settings.vehicletype.edit', $vehicle_type->id)->with('alerts', [['message' => 'Vehicle delete confirm check didn\'t match.', 'level' => 'error']]);

    }

    public function import(Request $request)
    {
        if (! in_array($request->file->extension(), ['json'])) {
            return redirect()->route('admin.settings.vehicletype.index')->with('alerts', [['message' => 'Invalid file type. You can only import .json files', 'level' => 'error']]);
        }

        $json = file_get_contents($request->file);

        $vehicle_types = VehicleType::orderBy('make', 'asc')->orderBy('model', 'asc')->get(['make', 'model']);
        $vehicles = [];
        foreach ($vehicle_types as $vehicle_type) {
            $vehicles[] = $vehicle_type->make.' '.$vehicle_type->model;
        }

        $import = [];

        $failed = 0;
        $duplicate = 0;
        $import_count = 0;

        foreach (json_decode($json) as $vehicle) {
            if (isset($vehicle->type, $vehicle->make, $vehicle->model)) {
                if (in_array($vehicle->make.' '.$vehicle->model, array_values($vehicles))) {
                    $duplicate = $duplicate + 1;

                    continue;
                }
                $import[] = [
                    'type' => $vehicle->type,
                    'make' => $vehicle->make,
                    'model' => $vehicle->model,
                    'price' => $vehicle->price ?? 0,
                    'is_emergency_vehicle' => $vehicle->is_emergency_vehicle ?? 0,
                    'spawn_code' => $vehicle->spawn_code ?? null,
                ];
                $import_count = $import_count + 1;
            } else {
                $failed = $failed + 1;
            }
        }

        $alert = [['message' => $import_count.' vehicles imported.', 'level' => 'success']];

        if ($failed != 0) {
            $alert[] = ['message' => $failed.' vehicles failed to import.', 'level' => 'error'];
        }

        if ($duplicate != 0) {
            $alert[] = ['message' => $duplicate.' duplicates skipped.', 'level' => 'warning'];
        }

        VehicleType::insert($import);

        return redirect()->route('admin.settings.vehicletype.index')->with('alerts', $alert);
    }
}
