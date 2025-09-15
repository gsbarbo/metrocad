<?php

namespace App\Http\Controllers\Mdt;

use App\Enum\CallCivilianTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mdt\CallStoreRequest;
use App\Http\Requests\Mdt\CallUpdateRequest;
use App\Http\Resources\Mdt\CallResource;
use App\Models\Call;
use App\Models\CallCivilian;
use App\Models\CallVehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CallController extends Controller
{
    public function index(): View
    {
        $calls = Call::query()
            ->orderBy('id', 'desc')
            ->get();

        $calls = CallResource::collection($calls)->toArray(request());

        return view('mdt.calls.index', compact('calls'));
    }

    public function store(CallStoreRequest $request)
    {
        $data = $request->validated();

        if (! isset($data['linked_civilians']) && ! isset($data['linked_vehicles'])) {
            $call = Call::create($data);

            return redirect()->route('mdt.cadScreen');
        }

        $linked_civilians = $data['linked_civilians'] ?? [];
        $linked_civilians_types = $data['linked_civilians_types'] ?? [];
        $linked_vehicles = $data['linked_vehicles'] ?? [];
        $linked_vehicles_types = $data['linked_vehicles_types'] ?? [];

        unset($data['linked_civilians'], $data['linked_civilians_types'], $data['linked_vehicles'], $data['linked_vehicles_types']);

        $call = Call::create($data);

        if (! empty($linked_civilians)) {
            $index = 0;
            foreach ($linked_civilians as $civilianId) {
                CallCivilian::create([
                    'call_id' => $call->id,
                    'civilian_id' => $civilianId,
                    'type' => $linked_civilians_types[$index],
                ]);
                $index++;
            }
        }

        if (! empty($linked_vehicles)) {
            $index = 0;
            foreach ($linked_vehicles as $vehicleId) {
                CallVehicle::create([
                    'call_id' => $call->id,
                    'vehicle_id' => $vehicleId,
                    'type' => $linked_vehicles_types[$index],
                ]);
                $index++;
            }
        }

        return redirect()->route('mdt.cadScreen');
    }

    public function create(): View
    {
        return view('mdt.calls.create');
    }

    public function show(Call $call): View
    {
        $reportingParties = $call->call_civilians->where('type', CallCivilianTypes::REPORTER->value);
        $callsAtPostal = Call::query()->where('postal', $call->postal)->where('id', '!=', $call->id)->get();
        $call->load(['reports']);

        return view('mdt.calls.show', compact('call', 'reportingParties', 'callsAtPostal'));
    }

    public function update(CallUpdateRequest $request, Call $call): RedirectResponse
    {
        $name = '';
        $data = $request->validated();

        //        if (auth()->user()->active_unit->user_department->department->type == 1) {
        //            $name = 'Officer';
        //        } elseif (auth()->user()->active_unit->user_department->department->type == 2) {
        //            $name = 'Dispatcher';
        //        } elseif (auth()->user()->active_unit->user_department->department->type == 4) {
        //            $name = 'Fire/EMS';
        //        }

        //        if ($call->status != $request->status) {
        //            //            CallLog::create([
        //            //                'from' => $name.' '.auth()->user()->active_unit->user_department->badge_number,
        //            //                'text' => 'Call Status Updated to: '.$validated['status'],
        //            //                'call_id' => $call->id,
        //            //            ]);
        //
        //            if ($validated['status'] == 'CLO' || explode('-', $validated['status'], 2)[0] == 'CLO') {
        // //                foreach ($call->attached_units as $unit) {
        // //                    $unit->update(['status' => 'AVL']);
        // //                    $unit->touch();
        // //                    $call->attached_units()->detach($unit->id);
        // //                }
        // //
        // //                $call->attached_units()->detach();
        // //
        // //                CallLog::create([
        // //                    'from' => auth()->user()->active_unit->officer->name.' ('.auth()->user()->active_unit->badge_number.')',
        // //                    'text' => 'Call '.$call->id.' has been closed and all units removed from call.',
        // //                    'call_id' => $call->id,
        // //                ]);
        //            }
        //        }
        //
        //        if ($call->nature != $validated['nature']) {
        // //            CallLog::create([
        // //                'from' => $name.' '.auth()->user()->active_unit->user_department->badge_number,
        // //                'text' => 'Call Nature Updated to: '.$validated['nature'],
        // //                'call_id' => $call->id,
        // //            ]);
        //        }
        //
        //        if ($call->nature != $validated['priority']) {
        // //            CallLog::create([
        // //                'from' => $name.' '.auth()->user()->active_unit->user_department->badge_number,
        // //                'text' => 'Call Priority Updated to: P'.$validated['priority'],
        // //                'call_id' => $call->id,
        // //            ]);
        //        }

        $call->update($data);

        return redirect()->route('mdt.calls.show', $call->id);
    }
}
