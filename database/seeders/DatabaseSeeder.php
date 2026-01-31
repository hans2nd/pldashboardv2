<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Run with: php artisan db:seed
     * Or fresh with: php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        // Reset cached permissions first
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('  PLDASHBOARD V2 - Database Seeder');
        $this->command->info('========================================');
        $this->command->info('');

        // 1. Create Users and Roles
        $this->call(UserSeeder::class);
        $this->command->newLine();

        // 2. Create System Permissions (CRUD for users, roles, permissions, menus)
        $this->call(PermissionSeeder::class);
        $this->command->newLine();

        // 3. Create Dashboard Menus and their Permissions
        $this->call(DashboardMenuSeeder::class);
        $this->command->newLine();

        // 4. Assign all permissions to admin role
        $this->assignPermissionsToAdmin();

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('  Seeding Complete!');
        $this->command->info('========================================');
        $this->command->info('');
        $this->command->info('Login credentials:');
        $this->command->line('  Admin: admin@example.com / 12345678');
        $this->command->line('  User:  user@example.com / 12345678');
        $this->command->line('  Viewer: viewer@example.com / 12345678');
        $this->command->info('');
    }

    /**
     * Assign all permissions to admin role
     */
    private function assignPermissionsToAdmin(): void
    {
        $this->command->info('Assigning all permissions to admin role...');
        
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $allPermissions = Permission::all();
            $adminRole->syncPermissions($allPermissions);
            $this->command->line("  Assigned {$allPermissions->count()} permissions to admin");
        }

        // Assign basic view permissions to viewer role
        $viewerRole = Role::where('name', 'viewer')->first();
        if ($viewerRole) {
            $viewPermissions = Permission::where('name', 'like', '%view%')->get();
            $viewerRole->syncPermissions($viewPermissions);
            $this->command->line("  Assigned {$viewPermissions->count()} view permissions to viewer");
        }

        $this->command->info('Role permissions assigned successfully!');
    }
}
