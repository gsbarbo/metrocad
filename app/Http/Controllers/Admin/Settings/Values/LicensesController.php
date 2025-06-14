<?php

namespace App\Http\Controllers\Admin\Settings\Values;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Values\LicenseValueRequest;
use App\Models\LicenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $license_types = LicenseType::orderBy('type', 'asc')->get();

        return view('admin.settings.license_type.index', compact('license_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.license_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LicenseValueRequest $request)
    {
        $data = $request->validated();
        $data['perm_name'] = Str::slug($data['name']);
        LicenseType::create($data);

        return redirect()->route('admin.settings.license_type.index')->with('alerts', [['message' => 'License added.', 'level' => 'success']]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LicenseType $license_type)
    {
        return view('admin.settings.license_type.edit', compact('license_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LicenseValueRequest $request, LicenseType $license_type)
    {
        $data = $request->validated();
        $data['perm_name'] = Str::slug($data['name']);
        $license_type->update($data);

        return redirect()->route('admin.settings.license_type.index')->with('alerts', [['message' => 'License updated.', 'level' => 'success']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, LicenseType $license_type)
    {
        $confirm = $request->input('confirm');

        if ($confirm == $license_type->name) {
            $license_type->delete();

            return redirect()->route('admin.settings.license_type.index')->with('alerts', [['message' => 'License deleted.', 'level' => 'success']]);
        }

        return redirect()->route('admin.settings.license_type.edit', $license_type->id)->with('alerts', [['message' => 'License delete confirm check didn\'t match.', 'level' => 'error']]);

    }
}
