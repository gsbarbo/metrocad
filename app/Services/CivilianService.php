<?php

namespace App\Services;

use App\Models\Civilian;
use App\Models\LicenseType;
use App\Models\User;

class CivilianService
{
    public static function getAvailableLicenses(Civilian $civilian, User $user)
    {
        $allowed_licenses = LicenseType::get();
        $owned_licenses = $civilian->licenses->pluck('license_type_id')->toArray();

        $available_licenses = [];
        foreach ($allowed_licenses as $license) {
            if (! in_array($license->id, $owned_licenses)) {
                $available_licenses[] = $license;
            }
        }

        return $available_licenses;
    }
}
