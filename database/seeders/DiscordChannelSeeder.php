<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscordChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discord_channels')->insert([
            [
                'name' => 'audit_log',
                'description' => 'Admin actions taken.',
            ],
            [
                'name' => 'cad_911_call',
                'description' => '911 calls submitted.',
            ],
            [
                'name' => 'cad_on_duty',
                'description' => 'Officers go on duty.',
            ],
            [
                'name' => 'cad_off_duty',
                'description' => 'Officers go off duty.',
            ],
        ]);
    }
}
