<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;

class NameSearchController extends Controller
{
    public function __invoke()
    {
        return view('mdt.nameSearch');
    }
}
