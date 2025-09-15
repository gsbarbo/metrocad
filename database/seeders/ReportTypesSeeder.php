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
                'title' => 'Additional Report',
            ],
            [
                'title' => 'Crime/Incident Report',
            ],
            [
                'title' => 'Missing Person Report',
            ],
            [
                'title' => 'Field Interview',
            ],
            [
                'title' => 'Traffic Collision Report',
            ],
            [
                'title' => 'Supplemental Report',
            ],
            [
                'title' => 'Use of Force Report',
            ],
            [
                'title' => 'Other Report',
            ],
        ]);
    }
}
