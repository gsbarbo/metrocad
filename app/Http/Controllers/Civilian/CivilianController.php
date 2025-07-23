<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\StoreCivilianRequest;
use App\Models\Civilian;
use App\Models\VehicleType;
use App\Services\CivilianService;

class CivilianController extends Controller
{
    public function index()
    {
        $civilians = Civilian::ownedByCurrentUser()->get();

        return view('civilians.index', compact('civilians'));
    }

    public function create()
    {
        return view('civilians.create');
    }

    public function store(StoreCivilianRequest $request)
    {
        Civilian::create($request->validated());

        return redirect()->route('civilians.index')->with('alerts', [['message' => 'Civilian Created', 'level' => 'success']]);
    }

    public function show(Civilian $civilian)
    {
        $available_licenses = CivilianService::getAvailableLicenses($civilian, auth()->user());
        $vehicleOptions = VehicleType::where('is_emergency_vehicle', 0)->orderBy('type', 'asc')->orderBy('make', 'asc')->orderBy('model', 'asc')->get();

        return view('civilians.show', compact('civilian', 'available_licenses', 'vehicleOptions'));
    }

    public function edit(Civilian $civilian)
    {
        //
    }

    public function update(UpdateCivilianRequest $request, Civilian $civilian)
    {
        //
    }

    public function destroy(Civilian $civilian)
    {
        //
    }
}
