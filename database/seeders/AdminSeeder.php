<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin + assign role super_admin (صلاحية super_admin)
        $superAdmin = Admin::firstOrCreate(
            ['email' => 'super@test.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->syncRoles(['super']);

        // Create Regular Admin
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Create Test User
        $user = User::firstOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('user');

        // 2000 Users
        for ($i = 0; $i < 2000; $i++) {
            $u = User::factory()->create();
            $u->assignRole('user');
        }

        // 20 Admins
        for ($i = 0; $i < 20; $i++) {
            $a = Admin::factory()->create();
            $a->assignRole('admin');
        }
    }
}

