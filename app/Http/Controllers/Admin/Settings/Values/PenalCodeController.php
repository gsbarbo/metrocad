<?php

namespace App\Http\Controllers\Admin\Settings\Values;

use App\Http\Controllers\Controller;
use App\Models\PenalCode;

class PenalCodeController extends Controller
{
    public function index()
    {
        return view('admin.settings.penalCodes.index');
    }

    public function store()
    {
        PenalCode::create($request->validated());

        return redirect()->route('admin.settings.penalCode.index')->with('alerts', [['message' => 'Penal Code added.', 'level' => 'success']]);
    }

    public function create()
    {
        return view('admin.settings.penalCodes.create');
    }
}
