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
                'name' => 'community.name',
                'value' => 'MetroCAD',
                'type' => 'string',
            ],
            [
                'name' => 'community.logo',
                'value' => 'https://metrocad.app/images/community_logo.png',
                'type' => 'string',
            ],
            [
                'name' => 'community.aboutUs',
                'value' => 'MetroCAD is a critical tool designed to streamline communication and coordination between dispatchers and officers in the field. It provides real-time tracking, efficient call management, and quick access to vital information, ensuring rapid response to emergencies. Equipped with features like integrated Computer-Aided Dispatch (CAD), mapping systems, and incident reporting, this software enhances situational awareness, improves resource allocation, and boosts overall operational efficiency for law enforcement agencies. By automating workflows and centralizing data, MetroCAD empowers teams to respond more effectively, keeping communities safer.',
                'type' => 'text',
            ],
            [
                'name' => 'developer.apiKey',
                'value' => '{last}, {first}',
                'type' => 'string',
            ],
            [
                'name' => 'names.state',
                'value' => 'San Andreas',
                'type' => 'string',
            ],
            [
                'name' => 'names.county',
                'value' => 'Blaine County',
                'type' => 'string',
            ],
            [
                'name' => 'names.city',
                'value' => 'Los Santos',
                'type' => 'string',
            ],
            [
                'name' => 'general.dateFormat',
                'value' => 'm/d/Y',
                'type' => 'string',
            ],
            [
                'name' => 'general.measurementUnits',
                'value' => 'imperial',
                'type' => 'string',
            ],
            [
                'name' => 'roleplay.areaOfPatrol',
                'value' => '',
                'type' => 'string',
            ],
            [
                'name' => 'roleplay.isSuspended',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'features.forceSteamLink',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'discord.guildId',
                'value' => '',
                'type' => 'integer',
            ],
            [
                'name' => 'discord.useRoles',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'discord.useRoles.memberRoleId',
                'value' => '',
                'type' => 'integer',
            ],
            [
                'name' => 'discord.useRoles.suspendedRoleId',
                'value' => '',
                'type' => 'integer',
            ],
            [
                'name' => 'discord.useRoles.useDepartmentRoles',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'discord.useAuditLog',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'civilian.allowDuplicateCivilianNames',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'civilian.allowDuplicateVehiclePlates',
                'value' => 'false',
                'type' => 'boolean',
            ],
            [
                'name' => 'mdt.officerNameFormat',
                'value' => '{last}, {first}',
                'type' => 'string',
            ],
            [
                'name' => 'mdt.activeUnitTimeout',
                'value' => '120',
                'type' => 'integer',
            ],
        ]);
    }
}
