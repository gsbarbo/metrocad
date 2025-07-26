<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\FirearmRequest;
use App\Models\Civilian;
use App\Models\Firearm;

class FirearmController extends Controller
{
    public function store(FirearmRequest $request, Civilian $civilian)
    {
        $data = $request->validated();
        $data['civilian_id'] = $civilian->id;
        if ($data['serial_number'] == '' || ! isset($data['serial_number'])) {
            $data['serial_number'] = generateRandomString(length: 15, lowerLetters: false);
        }

        Firearm::create($data);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Firearm created', 'level' => 'success']]);
    }
}
