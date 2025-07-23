<?php

namespace App\Http\Controllers\Admin\Settings\Values;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Values\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::orderBy('postal', 'asc')->get();

        return view('admin.settings.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('admin.settings.addresses.create');
    }

    public function store(AddressRequest $request)
    {
        $data = $request->validated();
        Address::create($data);

        if ($request->input('action') === 'create_add_another') {
            return redirect()
                ->route('admin.settings.addresses.create')
                ->with('alerts', [['message' => 'Address added.', 'level' => 'success']]);
        }

        return redirect()->route('admin.settings.addresses.index')->with('alerts', [['message' => 'Address added.', 'level' => 'success']]);
    }

    public function edit(Address $address)
    {
        return view('admin.settings.addresses.edit', compact('address'));
    }

    public function update(AddressRequest $request, Address $address)
    {
        $data = $request->validated();
        $address->update($data);

        return redirect()->route('admin.settings.addresses.index')->with('alerts', [['message' => 'Address updated.', 'level' => 'success']]);
    }

    public function destroy(Request $request, Address $address)
    {
        $confirm = $request->input('confirm');

        if ($confirm == $address->postal.' '.$address->street) {
            $address->delete();

            return redirect()->route('admin.settings.addresses.index')->with('alerts', [['message' => 'Address deleted.', 'level' => 'success']]);
        }

        return redirect()->route('admin.settings.addresses.edit', $address->id)->with('alerts', [['message' => 'Address delete confirm check didn\'t match.', 'level' => 'error']]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = fopen($request->file('file')->getRealPath(), 'r');

        // Get the header row
        $header = fgetcsv($file);

        $imported = 0;
        $skipped = 0;
        $import = [];
        $errors = [];

        // Read each row
        while (($row = fgetcsv($file)) !== false) {
            try {
                $data = array_combine($header, $row);
            } catch (\Throwable $th) {
                Log::channel('metrocad')->error('Address import file in wrong format.');

                return redirect()->route('admin.settings.addresses.index')->with('alerts', [['message' => 'Address import file in wrong format.', 'level' => 'error']]);
            }

            $validator = Validator::make($data, [
                'postal' => ['required', 'numeric', 'unique:addresses,postal'],
                'street' => ['required'],
                'city' => ['required'],
                'name' => ['nullable', 'string'],
                'is_home' => ['required', 'boolean'],
                'is_business' => ['required', 'boolean'],
                'is_ownable' => ['required', 'boolean'],
            ]);

            if ($validator->fails()) {
                $context = [];
                $skipped++;
                $context['data'] = $data;
                $context['errors'] = $validator->errors()->toArray();
                Log::channel('metrocad')->error('Validation Errors for Address Import', $context);

                continue;
            }

            $import[] = $data;

            $imported++;
        }

        Address::insert($import);

        fclose($file);

        return redirect()->route('admin.settings.addresses.index')->with('alerts', [['message' => "Imported: $imported | Skipped: $skipped", 'level' => 'info']]);

    }
}
