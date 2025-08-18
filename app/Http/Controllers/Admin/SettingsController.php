<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        //        dd(app('settings')->where('name', 'community.logo')->first()->value);

        return view('admin.settings.index');
    }

    public function api_key()
    {
        if (! auth()->user()->is_owner) {
            return redirect()->route('admin.settings.index')->with('alerts', [['message' => 'API Key is only available to owners.', 'level' => 'error']]);
        }

        return view('admin.settings.api_key');
    }

    public function generate_api_key()
    {
        if (! auth()->user()->is_owner) {
            return redirect()->route('admin.settings.index')->with('alerts', [['message' => 'API Key is only available to owners.', 'level' => 'error']]);
        }

        $key = generate_random_string(length: 64);
        update_setting('developer.apiKey', $key);

        return redirect()->route('admin.settings.api_key')->with('alerts', [['message' => 'API Key Generated.', 'level' => 'success']]);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        if (isset($data['community_logo'])) {
            $pictureUrl = ImageService::saveFromUrl(
                url: $request->input('community_logo'),
                prefix: 'community_logo'
            );

            if ($pictureUrl) {
                $data['community_logo'] = $pictureUrl;
            } else {
                return redirect()->back()->with('alerts', [
                    ['message' => 'Settings were not saved.', 'level' => 'error'],
                    ['message' => 'Issue with URL for picture.', 'level' => 'error'],
                ]);
            }
        }

        $data = $this->settingValidation($data);

        update_setting($data);

        return redirect()->back()->with('alerts', [['message' => 'Settings Saved.', 'level' => 'success']]);
    }

    private function settingValidation(array $data): array
    {
        if (isset($data['discord_useRoles']) && $data['discord_useRoles'] == 'false') {
            // TODO: Remove roles from CAD Roles
            $data['discord_useRoles_memberRoleId'] = 0;
            $data['discord_useRoles_suspendedRoleId'] = 0;
        }

        if (isset($data['discord_useRoles_useDepartmentRoles']) && $data['discord_useRoles_useDepartmentRoles'] == 'false') {
            // TODO: Remove roles from Department Roles

        }

        return $data;

    }
}
