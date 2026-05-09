<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\CivilianStoreRequest;
use App\Models\Civilian;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CivilianController extends Controller
{
    public function __construct(
        protected ImageService $imageService
    ) {}

    public function index(): View
    {
        $civilians = auth()->user()->civilians()->latest()->get();

        return view('civilian.index', compact('civilians'));
    }

    public function create(): View
    {
        return view('civilian.create');
    }

    public function store(CivilianStoreRequest $request)
    {
        $data = $request->validated();
        unset($data['image_url']);
        $civilian = Civilian::create($data);

        if ($request->input('image_url')) {
            $filename = 'civilian_'.$civilian->id;

            $image = $this->imageService->saveFromUrl(
                url: $request->image_url,
                folder: 'civilians/avatars',
                filename: (string) $filename,
                unique: false,
            );

            if (! $image->ok) {
                toast('success', 'Civilian created successfully.');
                toast('warning', "Civilian saved but profile picture was not set: {$image->error}");

                return redirect()->route('civilian.index');
            }

            $civilian->update(['picture_url' => $image->path]);
        }

        toast('success', 'Civilian created successfully.');

        return redirect()->route('civilian.index');
    }

    public function show(Civilian $civilian)
    {
        return view('civilian.show', compact('civilian'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
