<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('report_types')->insert([
            [
                'name' => 'Additional Report',
            ],
            [
                'name' => 'Crime/Incident Report',
            ],
            [
                'name' => 'Missing Person Report',
            ],
            [
                'name' => 'Field Interview',
            ],
            [
                'name' => 'Traffic Collision Report',
            ],
            [
                'name' => 'Supplemental Report',
            ],
            [
                'name' => 'Use of Force Report',
            ],
            [
                'name' => 'Other Report',
            ],
        ]);
    }
}
