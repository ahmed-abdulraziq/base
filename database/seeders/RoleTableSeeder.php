<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    protected $roles = [
        'super_admin' => [
            // All permissions
            'api.user.profile',
            'api.user.logout', 
            'api.user.verify.email',
            'api.user.change.password',
            'api.user.update.profile',
            'create.user',
            'edit.user', 
            'delete.user',
            'view.user',
            'view.users',
            'create.admin',
            'edit.admin',
            'delete.admin', 
            'view.admin',
            'view.admins',
            'create.role',
            'edit.role',
            'delete.role',
            'view.role',
            'view.roles',
            'create.permission',
            'edit.permission',
            'delete.permission',
            'view.permission',
            'view.permissions',
            'view.dashboard',
            'view.admin.dashboard',
            'manage.system',
            'view.system.logs',
        ],
        'admin' => [
            // Admin permissions
            'api.user.profile',
            'api.user.logout', 
            'api.user.verify.email',
            'api.user.change.password',
            'api.user.update.profile',
            'create.user',
            'edit.user', 
            'delete.user',
            'view.user',
            'view.users',
            'view.admin',
            'view.admins',
            'view.role',
            'view.roles',
            'view.permission',
            'view.permissions',
            'view.dashboard',
            'view.admin.dashboard',
        ],
        'user' => [
            // Basic user permissions
            'api.user.profile',
            'api.user.logout', 
            'api.user.verify.email',
            'api.user.change.password',
            'api.user.update.profile',
            'view.user',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }
    }
}
