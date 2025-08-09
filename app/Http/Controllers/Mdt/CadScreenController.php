<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\ActiveUnit;

class CadScreenController extends Controller
{
    public function __invoke()
    {
        $activeUnits = ActiveUnit::query()->get();

        return view('mdt.cadScreen', compact('activeUnits'));
    }
}
