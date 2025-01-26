<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name' => 'admin:access',
                'guard_name' => 'web',
                'help_text' => 'Grants access to the admin dashboard.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:announcement:access',
                'guard_name' => 'web',
                'help_text' => 'Grants access to the announcement.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:audit_log:access',
                'guard_name' => 'web',
                'help_text' => 'Grants access to the audit log.',
                'category' => 'admin',
            ],
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
