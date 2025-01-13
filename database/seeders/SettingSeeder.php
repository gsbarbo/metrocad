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
                'value' => 'https://metrocad.test/assets/images/metrocad-logo.png',
            ],
            [
                'name' => 'community_intro',
                'value' => 'This is the community intro.',
            ],
        ]);
    }
}
