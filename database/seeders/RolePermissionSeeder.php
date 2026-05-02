<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permissions (atomic & spesifik)
        $permissions = [
            'dashboard.view',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
            'permission.view',
            'post.view',
            'post.create',
            'post.edit',
            'post.delete',
            // tambahkan sesuai kebutuhan project kamu
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Assign semua permission ke Admin
        $admin->givePermissionTo(Permission::all());

        // Manager
        $manager->givePermissionTo([
            'dashboard.view',
            'user.view',
            'user.edit',
            'post.view',
            'post.create',
            'post.edit'
        ]);

        // Editor
        $editor->givePermissionTo([
            'post.view',
            'post.create',
            'post.edit'
        ]);

        // User biasa (minimal)
        $user->givePermissionTo(['dashboard.view', 'post.view']);
    }
}
