<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\VehicleType\VehicleTypeRequest;
use App\Models\VehicleType;
use App\Rules\Admin\DuplicateVehicleTypeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = fopen($request->file('file')->getRealPath(), 'r');

        $header = fgetcsv($file);

        $imported = 0;
        $skipped = 0;
        $import = [];

        while (($row = fgetcsv($file)) !== false) {
            try {
                $data = array_combine($header, $row);
            } catch (\Throwable $th) {
                Log::channel('metrocad')->error('Vehicle import file in wrong format.');

                return redirect()->route('admin.settings.vehicletype.index')->with('alerts', [['message' => 'Vehicle import file in wrong format.', 'level' => 'error']]);
            }

            $validator = Validator::make($data, [
                'type' => ['required', 'string'],
                'make' => ['required', 'string'],
                'model' => ['required', 'string', new DuplicateVehicleTypeRule],
                'price' => ['nullable', 'numeric'],
                'is_emergency_vehicle' => ['required', 'boolean'],
                'spawn_code' => ['nullable', 'string'],
            ]);

            if ($validator->fails()) {
                $context = [];
                $skipped++;
                $context['data'] = $data;
                $context['errors'] = $validator->errors()->toArray();
                Log::channel('metrocad')->error('Validation Errors for Vehicle Import', $context);

                continue;
            }

            $import[] = $data;

            $imported++;
        }

        VehicleType::insert($import);

        fclose($file);

        return redirect()->route('admin.settings.vehicletype.index')->with('alerts', [['message' => "Imported: $imported | Skipped: $skipped", 'level' => 'info']]);
    }
}
