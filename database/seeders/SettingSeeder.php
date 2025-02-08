<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'name' => 'community_name',
                'value' => 'MetroCAD',
            ],
            [
                'name' => 'community_logo',
                'value' => 'https://metrocad.com/assets/images/metrocad-logo.png',
            ],
            [
                'name' => 'community_intro',
                'value' => 'MetroCAD is a critical tool designed to streamline communication and coordination between dispatchers and officers in the field. It provides real-time tracking, efficient call management, and quick access to vital information, ensuring rapid response to emergencies. Equipped with features like integrated Computer-Aided Dispatch (CAD), mapping systems, and incident reporting, this software enhances situational awareness, improves resource allocation, and boosts overall operational efficiency for law enforcement agencies. By automating workflows and centralizing data, MetroCAD empowers teams to respond more effectively, keeping communities safer.',
            ],
            [
                'name' => 'state',
                'value' => 'San Andreas',
            ],
            [
                'name' => 'county',
                'value' => 'Blaine County',
            ],
            [
                'name' => 'city',
                'value' => 'Los Santos',
            ],
            [
                'name' => 'date_format',
                'value' => 'm/d/Y',
            ],
            [
                'name' => 'force_steam_link',
                'value' => '0',
            ],
            [
                'name' => 'allow_same_name_civilians',
                'value' => '0',
            ],
            [
                'name' => 'allow_same_plate_vehicles',
                'value' => '0',
            ],
            [
                'name' => 'use_metric_system',
                'value' => '0',
            ],
            [
                'name' => 'use_ten_codes',
                'value' => '0',
            ],
            [
                'name' => 'officer_name_format',
                'value' => 'F. Last',
            ],
            [
                'name' => 'aop_location',
                'value' => '',
            ],
            [
                'name' => 'allow_members_to_update_badge_number',
                'value' => '0',
            ],
            [
                'name' => 'allow_members_to_update_rank',
                'value' => '0',
            ],
            [
                'name' => 'suspend_roleplay',
                'value' => '0',
            ],
            [
                'name' => 'api_key',
                'value' => '',
            ],
            [
                'name' => 'feature_loa_requests',
                'value' => '',
            ],
        ]);
    }
}
