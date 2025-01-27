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
            [
                'name' => 'admin:user:access',
                'guard_name' => 'web',
                'help_text' => 'Grants access to the user profiles.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:user:comment:create',
                'guard_name' => 'web',
                'help_text' => 'Grants access to leave comments on user profiles.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:user:suspend',
                'guard_name' => 'web',
                'help_text' => 'Grants access to suspend users.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:user:ban',
                'guard_name' => 'web',
                'help_text' => 'Grants access to ban users.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:user:unsuspend',
                'guard_name' => 'web',
                'help_text' => 'Grants access to unsuspend users.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:user:unban',
                'guard_name' => 'web',
                'help_text' => 'Grants access to unban users.',
                'category' => 'admin',
            ],
            [
                'name' => 'admin:user:status:reset',
                'guard_name' => 'web',
                'help_text' => 'Grants access to reset users.',
                'category' => 'admin',
            ],
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
