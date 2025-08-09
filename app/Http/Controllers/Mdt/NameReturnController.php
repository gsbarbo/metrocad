<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\Civilian;

class NameReturnController extends Controller
{
    public function __invoke(Civilian $civilian)
    {

        return view('mdt.nameReturn', compact('civilian'));
    }
}
