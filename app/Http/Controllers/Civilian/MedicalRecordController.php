<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\MedicalRecordRequest;
use App\Models\Civilian;
use App\Models\MedicalRecord;

class MedicalRecordController extends Controller
{
    public function store(MedicalRecordRequest $request, Civilian $civilian)
    {
        $input = $request->validated();
        $input['civilian_id'] = $civilian->id;
        MedicalRecord::create($input);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Record added.', 'level' => 'success']]);
    }
}
