<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\MedicalRecordRequest;
use App\Models\Civilian;
use App\Models\MedicalRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function store(MedicalRecordRequest $request, Civilian $civilian)
    {
        $input = $request->validated();
        $input['civilian_id'] = $civilian->id;
        MedicalRecord::create($input);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Record added.', 'level' => 'success']]);
    }

    public function destroy(Request $request, Civilian $civilian, MedicalRecord $medicalRecord): RedirectResponse
    {
        $medicalRecord->delete();

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Medical record deleted.', 'level' => 'success']]);
    }
}
