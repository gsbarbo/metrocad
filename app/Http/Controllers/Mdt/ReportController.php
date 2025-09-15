<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mdt\ReportRequest;
use App\Models\Call;
use App\Models\Report;
use App\Models\ReportType;

class ReportController extends Controller
{
    public function store(ReportRequest $request)
    {
        $data = $request->validated();
        $data['officer_id'] = auth()->user()->active_unit->officer->id;
        $report = Report::create($data);

        return redirect()->route('mdt.reports.edit', $report->id)
            ->with('alerts', [['message' => 'Report Created', 'level' => 'success']]);
    }

    public function create()
    {
        $call = Call::findOrFail(request()->call_id);
        $reportTypes = ReportType::get();

        return view('mdt.reports.create', compact('call', 'reportTypes'));
    }

    public function edit(Report $report)
    {
        return view('mdt.reports.edit', compact('report'));
    }

    public function update()
    {
        dd('edit report');
    }
}
