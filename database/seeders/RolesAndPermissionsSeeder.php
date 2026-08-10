<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'access admin panel',
            'manage candidates',
            'verify candidates',
            'manage portal settings',
            'manage roles',
            'view applications',
            'approve applications',
            'reject applications',
            'toggle payment status',
            'submit application',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions($permissions);

        $verifier = Role::firstOrCreate(['name' => 'verifier', 'guard_name' => 'web']);
        $verifier->syncPermissions([
            'access admin panel',
            'view applications',
            'verify candidates',
            'approve applications',
            'reject applications',
            'toggle payment status',
        ]);

        $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $student->syncPermissions([
            'submit application',
            'view applications',
        ]);

        // Assign admin role to existing admin users
        $adminEmails = ['admin@uhs.edu.pk', 'adminbig@uhs.com'];
        $adminUsers = \App\Models\User::whereIn('email', $adminEmails)->get();
        foreach ($adminUsers as $user) {
            $user->assignRole('admin');
        }

        // Assign student role to all other existing users
        $otherUsers = \App\Models\User::whereNotIn('email', $adminEmails)->get();
        foreach ($otherUsers as $user) {
            if (! $user->hasAnyRole(['admin', 'verifier', 'student'])) {
                $user->assignRole('student');
            }
        }
    }
}
