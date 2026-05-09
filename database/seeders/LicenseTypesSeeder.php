<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $licenseTypes = [
            [
                'name' => 'Drivers License',
                'perm_name' => 'drivers-license',
                'prefix' => 'DL',
                'format' => '##########',
            ],
            [
                'name' => 'ID Card',
                'perm_name' => 'id-card',
                'prefix' => 'ID',
                'format' => '##########',
            ],
            [
                'name' => 'Firearm License',
                'perm_name' => 'firearm-license',
                'prefix' => 'FL',
                'format' => '##########',
            ],
            [
                'name' => 'Pilot License',
                'perm_name' => 'pilot-license',
                'prefix' => 'PL',
                'format' => '##########',
            ],
            [
                'name' => 'Boating License',
                'perm_name' => 'boating-license',
                'prefix' => 'BL',
                'format' => '##########',
            ],
        ];

        foreach ($licenseTypes as $licenseType) {
            DB::table('license_types')->updateOrInsert(
                ['name' => $licenseType['name']],
                array_merge($licenseType, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
