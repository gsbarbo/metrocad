<?php

namespace App\Http\Controllers\Workbench;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function __invoke()
    {
        return view('workbench.home');
    }
}
