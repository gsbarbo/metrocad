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
                'value' => 'Police dispatch software is a critical tool designed to streamline communication and coordination between dispatchers and officers in the field. It provides real-time tracking, efficient call management, and quick access to vital information, ensuring rapid response to emergencies. Equipped with features like integrated Computer-Aided Dispatch (CAD), mapping systems, and incident reporting, this software enhances situational awareness, improves resource allocation, and boosts overall operational efficiency for law enforcement agencies. By automating workflows and centralizing data, police dispatch software empowers teams to respond more effectively, keeping communities safer.',
            ],
        ]);
    }
}
