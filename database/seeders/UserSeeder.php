<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Seeding Roles and Users...');

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);

        $this->command->line('  Created roles: admin, user, viewer');

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->syncRoles(['admin']);

        // Create regular user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'username' => 'user',
                'name' => 'User Test',
                'password' => Hash::make('12345678'),
            ]
        );
        $user->syncRoles(['user']);

        // Create viewer user
        $viewer = User::firstOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'username' => 'viewer',
                'name' => 'Viewer Only',
                'password' => Hash::make('12345678'),
            ]
        );
        $viewer->syncRoles(['viewer']);

        $this->command->line('  Created users: admin, user, viewer');
        $this->command->info('Users seeded successfully!');
    }
}
