<?php

namespace App\Http\Controllers\Mdt;

use App\Enum\ReportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mdt\ReportRequest;
use App\Models\Call;
use App\Models\Report;
use App\Models\ReportType;
use Illuminate\Http\Request;

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
        if (in_array($report->status, [\App\Enum\ReportStatus::PENDING, \App\Enum\ReportStatus::COMPLETED]) || auth()->user()->active_unit->officer->id != $report->officer_id) {
            return redirect()->route('mdt.reports.show', $report->id)
                ->with('alerts', [['message' => 'You cannot edit an Pending or Completed report', 'level' => 'danger']]);
        }

        return view('mdt.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        if ($request->submitForReview) {
            $report->update(['status' => ReportStatus::PENDING, 'narrative' => $request->narrative]);

            return redirect()->route('mdt.reports.edit', $report->id)
                ->with('alerts', [['message' => 'Report submitted for review', 'level' => 'success']]);
        }

        $report->update(['narrative' => $request->narrative]);

        return redirect()->route('mdt.reports.edit', $report->id)
            ->with('alerts', [['message' => 'Report saved', 'level' => 'success']]);
    }

    public function show(Report $report)
    {
        return view('mdt.reports.show', compact('report'));
    }
}
