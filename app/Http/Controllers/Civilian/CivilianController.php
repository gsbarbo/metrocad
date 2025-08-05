<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\CivilianUpdateRequest;
use App\Http\Requests\Civilian\StoreCivilianRequest;
use App\Models\Civilian;
use App\Services\CivilianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CivilianController extends Controller
{
    public function index()
    {
        $civilians = Civilian::ownedByCurrentUser()->with('user_department')->orderBy('user_department_id', 'desc')->orderBy('is_active', 'desc')->get();

        return view('civilians.index', compact('civilians'));
    }

    public function create()
    {
        return view('civilians.create');
    }

    public function store(StoreCivilianRequest $request)
    {
        $data = $request->validated();
        unset($data['image_url']);
        $civilian = Civilian::create($data);

        if ($request->input('image_url')) {
            $response = Http::get($request->input('image_url'));
            $contentType = $response->header('Content-Type');
            if (! str_starts_with($contentType, 'image/')) {
                return redirect()->route('civilians.index')->with('alerts', [
                    ['message' => 'Civilian created.', 'level' => 'success'],
                    ['message' => 'Image was not saved.', 'level' => 'error'],
                ]);

            }

            $extension = explode('/', $contentType)[1]; // e.g., 'jpeg'
            $filename = 'civilian_'.$civilian->id.'.'.$extension;
            $path = 'images/civilians/'.$filename;

            Storage::disk('public')->put($path, $response->body());

            $data['picture'] = asset($path);
            $civilian->update(['picture' => $data['picture']]);
        }

        return redirect()->route('civilians.index')->with('alerts', [['message' => 'Civilian Created', 'level' => 'success']]);
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

    public function update(CivilianUpdateRequest $request, Civilian $civilian)
    {
        $data = $request->validated();

        if ($data['image_url'] && $data['image_url'] != $civilian->picture) {

            $response = Http::get($request->input('image_url'));
            $contentType = $response->header('Content-Type');
            if (! str_starts_with($contentType, 'image/')) {
                return back()->withErrors(['image_url' => 'The URL does not point to a valid image.']);
            }

            $extension = explode('/', $contentType)[1]; // e.g., 'jpeg'
            $filename = 'civilian_'.$civilian->id.'.'.$extension;
            $path = 'images/civilians/'.$filename;

            Storage::disk('public')->put($path, $response->body());

            $data['picture'] = asset($path);
        }

        unset($data['image_url']);
        $civilian->update($data);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Civilian updated.', 'level' => 'success']]);
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
