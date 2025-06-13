<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: Add new picture links
        DB::table('departments')->insert([
            [
                'name' => 'Blane County Sheriffs Office',
                'initials' => 'BCSO',
                'slug' => 'blane-county-sheriffs-office',
                'logo' => 'https://communitycad.app/images/default_images/BCSO-2.png',
                'type' => 1,
                'discord_role_id' => null,
            ],
            [
                'name' => 'Los Santos Police Department',
                'initials' => 'LSPD',
                'slug' => 'los-santos-police-department',
                'logo' => 'https://communitycad.app/images/default_images/Police-6.png',
                'type' => 1,
                'discord_role_id' => null,
            ],
            [
                'name' => 'San Andreas Highway Patrol',
                'initials' => 'SAHP',
                'slug' => 'san-andreas-highway-patrol',
                'logo' => 'https://static.wikia.nocookie.net/alterlifepolicedepartement/images/b/b5/SAHP_logo.png',
                'type' => 1,
                'discord_role_id' => null,
            ],
            [
                'name' => 'Civilian Operations',
                'initials' => 'CIV',
                'slug' => 'civilian-operations',
                'logo' => 'https://content.invisioncic.com/y305077/monthly_2021_03/RCiv_Logo.png.62e84cd49d883db8492dc588c771b8bd.png',
                'type' => 3,
                'discord_role_id' => null,
            ],
            [
                'name' => 'Communications',
                'initials' => 'DISP',
                'slug' => 'communications',
                'logo' => 'https://static.wikia.nocookie.net/ultimate-roleplay/images/c/cb/LCPD-GTA4-logo.png',
                'type' => 2,
                'discord_role_id' => null,
            ],
            [
                'name' => 'San Andreas Fire Rescue',
                'initials' => 'SAFR',
                'slug' => 'san-andreas-fire-rescue',
                'logo' => 'https://communitycad.app/images/default_images/Fire Department-4.png',
                'type' => 4,
                'discord_role_id' => null,
            ],
        ]);
    }
}
