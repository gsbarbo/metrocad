<?php

namespace App\Http\Controllers\Mdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mdt\CallStoreRequest;
use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallController extends Controller
{
    public function index(): View {}

    public function store(CallStoreRequest $request)
    {
        $data = $request->validated();

        if (! isset($input['linked_civilians'])) {
            $call = Call::create($data);

            return redirect()->route('mdt.cadScreen');
        }
    }

    public function create(): View
    {
        return view('mdt.calls.create');
    }

    public function show($id): View {}

    public function edit($id): View {}

    public function update(Request $request, $id) {}
}
