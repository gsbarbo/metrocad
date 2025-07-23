<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('license_types')->insert([
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
        ]);
    }
}
