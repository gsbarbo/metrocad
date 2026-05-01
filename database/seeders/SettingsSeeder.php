<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'name' => 'community.name',
                'value' => 'Metro CAD',
                'type' => 'string',
                'label' => 'CAD Name',
                'description' => 'The name of the CAD system displayed in the UI.',
            ],
            [
                'name' => 'community.logo_url',
                'value' => 'false',
                'type' => 'boolean',
                'label' => 'Maintenance Mode',
                'description' => 'Puts the CAD into maintenance mode.',
            ],
            [
                'name' => 'community.units',
                'value' => 'imperial',
                'type' => 'string',
                'label' => 'Measurement Units',
                'description' => 'The units used for measurements in the CAD system.',
            ],
            [
                'name' => 'civilian.allowDuplicateCivilianNames',
                'value' => 'false',
                'type' => 'boolean',
                'label' => 'Allow Duplicate Civilian Names',
                'description' => 'Allows creating civilians with duplicate names.',
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['name' => $setting['name']],
                array_merge($setting, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
