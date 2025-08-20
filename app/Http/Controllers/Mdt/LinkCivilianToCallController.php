<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Models\CallCivilian;
use App\Models\Civilian;
use Illuminate\Http\Request;

class LinkCivilianToCallController extends Controller
{
    public function __invoke(Request $request, Civilian $civilian)
    {
        if ($request->input('call_id') == 0 || $request->input('type') == 0) {
            return redirect()->route('mdt.civilianReturn', $civilian->id)->with('alerts', [['message' => 'You must choose a call and a type.', 'level' => 'error']]);
        }
        CallCivilian::create([
            'call_id' => $request->input('call_id'),
            'civilian_id' => $civilian->id,
            'type' => $request->input('type'),
        ]);

        return redirect()->route('mdt.civilianReturn', $civilian->id)->with('alerts', [['message' => 'Civilian added to call# '.$request->input('call_id'), 'level' => 'success']]);

    }
}
