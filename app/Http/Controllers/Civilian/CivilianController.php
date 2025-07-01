<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCivilianRequest;
use App\Http\Requests\UpdateCivilianRequest;
use App\Models\Civilian;

class CivilianController extends Controller
{
    public function index()
    {
        $civilians = Civilian::ownedByCurrentUser()->get();

        return view('civilians.index', compact('civilians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCivilianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Civilian $civilian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Civilian $civilian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCivilianRequest $request, Civilian $civilian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Civilian $civilian)
    {
        //
    }
}
