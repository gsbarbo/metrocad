<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function create()
    {
        return view('mdt.reports.create');
    }

    public function store()
    {
        dd('store report');
    }
}
