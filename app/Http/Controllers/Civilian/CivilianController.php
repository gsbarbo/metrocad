<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\StoreCivilianRequest;
use App\Models\Civilian;

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
        return view('civilians.show', compact('civilian'));

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
