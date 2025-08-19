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

        return view('admin.settings.licenseValues.index', compact('license_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LicenseValueRequest $request)
    {
        $data = $request->validated();
        $data['perm_name'] = Str::slug($data['name']);
        LicenseType::create($data);

        return redirect()->route('admin.settings.licenseValues.index')->with('alerts', [['message' => 'License added.', 'level' => 'success']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.licenseValues.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LicenseType $licenseValue)
    {
        if ($licenseValue->id === 1 || $licenseValue->id === 2) {
            return redirect()->route('admin.settings.licenseValues.index')->with('alerts', [['message' => 'You can not update that licenses.', 'level' => 'error']]);
        }

        return view('admin.settings.licenseValues.edit', compact('licenseValue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LicenseValueRequest $request, LicenseType $licenseValue)
    {
        if ($licenseValue->id === 1 || $licenseValue->id === 2) {
            return redirect()->route('admin.settings.licenseValues.index')->with('alerts', [['message' => 'You can not update that licenses.', 'level' => 'error']]);
        }

        $data = $request->validated();
        $data['perm_name'] = Str::slug($data['name']);
        $licenseValue->update($data);

        return redirect()->route('admin.settings.licenseValues.index')->with('alerts', [['message' => 'License updated.', 'level' => 'success']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, LicenseType $licenseValue)
    {
        $confirm = $request->input('confirm');

        if ($confirm == $licenseValue->name) {
            $licenseValue->delete();

            return redirect()->route('admin.settings.licenseValues.index')->with('alerts', [['message' => 'License deleted.', 'level' => 'success']]);
        }

        return redirect()->route('admin.settings.licenseValues.edit', $licenseValue->id)->with('alerts', [['message' => 'License delete confirm check didn\'t match.', 'level' => 'error']]);

    }
}
