<?php

namespace App\Http\Controllers\Civilian;

use App\Enum\LicenseStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Civilian\LicenseRequest;
use App\Models\Civilian;
use App\Models\License;
use App\Models\LicenseType;
use App\Services\LicenseService;

class LicenseController extends Controller
{
    public function store(LicenseRequest $request, Civilian $civilian)
    {
        $data = $request->validated();
        $licenseTypeData = LicenseType::where('id', $data['license_type_id'])->get()->first();

        $data['civilian_id'] = $civilian->id;
        $data['expires_at'] = date('Y-m-d', strtotime('+30 Days'));
        $data['number'] = LicenseService::generateLicenseNumber($licenseTypeData->format, $licenseTypeData->prefix);

        if ($data['status'] == LicenseStatuses::EXPIRED->value) {
            $data['expires_at'] = date('Y-m-d', strtotime('-30 Days'));
            $data['status'] = LicenseStatuses::VALID->value;
        }

        License::create($data);

        return redirect()->route('civilians.show', $civilian->id)->with('alerts', [['message' => 'License created', 'level' => 'success']]);
    }
}
