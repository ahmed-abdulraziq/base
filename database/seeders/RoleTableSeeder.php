<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    protected $roles = [
        'super' => [
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
            'view.settings',
            'view.specializations',
            'view.doctors',
            'view.employees',
            'view.patients',
            'view.medications',
            'view.appointments',
            'manage.system',
            'view.system.logs',
        ],
        'admin' => [
            // Admin permissions (بدون إدارة الصلاحيات - للـ super فقط)
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
            'view.dashboard',
            'view.admin.dashboard',
            'view.specializations',
            'view.doctors',
            'view.employees',
            'view.patients',
            'view.medications',
            'view.appointments',
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
        // Create roles for admin guard (super_admin and admin)
        $adminRoles = ['super', 'admin'];
        foreach ($adminRoles as $roleName) {
            if (isset($this->roles[$roleName])) {
                $role = Role::firstOrCreate(
                    ['name' => $roleName, 'guard_name' => 'admin']
                );
                $role->syncPermissions($this->roles[$roleName]);
            }
        }

        // Create role for web guard (user)
        if (isset($this->roles['user'])) {
            $role = Role::firstOrCreate(
                ['name' => 'user', 'guard_name' => 'web']
            );
            $role->syncPermissions($this->roles['user']);
        }
    }
}
