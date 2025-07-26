<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\FirearmRequest;
use App\Models\Civilian;
use App\Models\Firearm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FirearmController extends Controller
{
    public function store(FirearmRequest $request, Civilian $civilian): RedirectResponse
    {
        $data = $request->validated();
        $data['civilian_id'] = $civilian->id;
        if ($data['serial_number'] == '' || ! isset($data['serial_number'])) {
            $data['serial_number'] = generateRandomString(length: 15, lowerLetters: false);
        }

        Firearm::create($data);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Firearm created', 'level' => 'success']]);
    }

    public function destroy(Request $request, Civilian $civilian, Firearm $firearm): RedirectResponse
    {
        $firearm->delete();

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'Firearm deleted.', 'level' => 'success']]);
    }
}
