<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\CivilianUpdateRequest;
use App\Http\Requests\Civilian\StoreCivilianRequest;
use App\Models\Civilian;
use App\Services\CivilianService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CivilianController extends Controller
{
    public function index()
    {
        $civilians = Civilian::ownedByCurrentUser()->orderBy('is_active', 'desc')->get();

        return view('civilians.index', compact('civilians'));
    }

    public function store(StoreCivilianRequest $request)
    {
        $data = $request->validated();
        unset($data['image_url']);
        $civilian = Civilian::create($data);

        if ($request->input('image_url')) {
            $filename = 'civilian_'.$civilian->id;

            $data['picture'] = ImageService::saveFromUrl(
                url: $request->input('image_url'),
                folder: 'images/civilians/',
                prefix: $filename);

            $civilian->update(['picture' => $data['picture']]);
        }

        return redirect()->route('civilians.index')->with('alerts', [['message' => 'Civilian Created', 'level' => 'success']]);
    }

    public function create()
    {
        return view('civilians.create');
    }

    public function update(CivilianUpdateRequest $request, Civilian $civilian)
    {
        $data = $request->validated();

        if ($data['image_url'] && $data['image_url'] != $civilian->picture) {
            $filename = 'civilian_'.$civilian->id;

            $data['picture'] = ImageService::saveFromUrl(
                url: $request->input('image_url'),
                folder: 'images/civilians/',
                prefix: $filename);
        }

        unset($data['image_url']);
        $civilian->update($data);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Civilian updated.', 'level' => 'success']]);
    }

    public function show(Civilian $civilian)
    {
        $available_licenses = CivilianService::getAvailableLicenses($civilian, auth()->user());
        $vehicleOptions = getTableCache('vehicle_types')->where('is_emergency_vehicle', 0)->sortBy([['make', 'asc'], ['model', 'asc']]);

        return view('civilians.show', compact('civilian', 'available_licenses', 'vehicleOptions'));
    }

    public function edit(Civilian $civilian)
    {
        return view('civilians.edit', compact('civilian'));

    }

    public function destroy(Request $request, Civilian $civilian)
    {
        $confirm = $request->input('confirm');

        if ($confirm == $civilian->name) {
            $civilian->delete();

            return redirect()->route('civilians.index')->with('alerts', [['message' => 'Civilian deleted.', 'level' => 'success']]);
        }

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Civilian name didn\'t match.', 'level' => 'error']]);
    }
}
