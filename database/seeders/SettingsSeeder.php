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
                'name' => 'cad.max_units',
                'value' => '50',
                'type' => 'integer',
                'label' => 'Max Active Units',
                'description' => 'Maximum number of units that can be active simultaneously.',
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
