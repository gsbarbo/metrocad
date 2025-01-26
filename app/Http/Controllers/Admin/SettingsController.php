<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function general()
    {
        return view('admin.settings.general');
    }

    public function civilian()
    {
        return view('admin.settings.civilian');
    }

    public function cad()
    {
        return view('admin.settings.cad');
    }

    public function features()
    {
        return view('admin.settings.features');
    }

    public function api_key()
    {
        if (! in_array(auth()->user()->id, config('cad.owner_ids'))) {
            return redirect()->route('admin.settings.general')->with('alerts', [['message' => 'API Key is only available to owners.', 'level' => 'error']]);
        }

        return view('admin.settings.api_key');
    }

    public function generate_api_key()
    {
        if (! in_array(auth()->user()->id, config('cad.owner_ids'))) {
            return redirect()->route('admin.settings.general')->with('alerts', [['message' => 'API Key is only available to owners.', 'level' => 'error']]);
        }
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $key = substr(str_shuffle(str_repeat($pool, 64)), 0, 64);
        Setting::updateOrCreate(
            ['name' => 'api_key'],
            ['value' => $key]
        );

        Cache::forget('settings');

        return redirect()->route('admin.settings.api_key')->with('alerts', [['message' => 'API Key Generated.', 'level' => 'success']]);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');

        return redirect()->back()->with('alerts', [['message' => 'Settings Saved.', 'level' => 'success']]);
    }
}
