<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    protected $permissions = [
        // API User Permissions
        'api.user.profile',
        'api.user.logout', 
        'api.user.verify.email',
        'api.user.change.password',
        'api.user.update.profile',
        
        // User Management Permissions
        'create.user',
        'edit.user', 
        'delete.user',
        'view.user',
        'view.users',
        
        // Admin Management Permissions
        'create.admin',
        'edit.admin',
        'delete.admin', 
        'view.admin',
        'view.admins',
        
        // Role Management Permissions
        'create.role',
        'edit.role',
        'delete.role',
        'view.role',
        'view.roles',
        
        // Permission Management Permissions
        'create.permission',
        'edit.permission',
        'delete.permission',
        'view.permission',
        'view.permissions',
        
        // Dashboard Permissions
        'view.dashboard',
        'view.admin.dashboard',

        // Settings (صفحة الإعدادات)
        'view.settings',
        
        // System Permissions
        'manage.system',
        'view.system.logs',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions for both web and admin guards
        $guards = ['web', 'admin'];
        foreach ($guards as $guard) {
            foreach ($this->permissions as $permission) {
                Permission::firstOrCreate(
                    ['name' => $permission, 'guard_name' => $guard]
                );
            }
        }
    }
}
