<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create all system permissions
     */
    public function run(): void
    {
        // Reset cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Seeding System Permissions...');

        // =====================
        // USER MANAGEMENT PERMISSIONS
        // =====================
        $this->createCrudPermissions('users', 'User Management');

        // =====================
        // ROLE MANAGEMENT PERMISSIONS
        // =====================
        $this->createCrudPermissions('role', 'Role Management');

        // =====================
        // PERMISSION MANAGEMENT PERMISSIONS
        // =====================
        $this->createCrudPermissions('permission', 'Permission Management');

        // =====================
        // MENU MANAGEMENT PERMISSIONS
        // =====================
        $this->createCrudPermissions('menu', 'Menu Management');

        // =====================
        // IFRAME UPDATE PERMISSION (Global)
        // =====================
        Permission::firstOrCreate(['name' => 'iframe edit']);
        $this->command->line('  Created: iframe edit');

        $this->command->info('System Permissions seeded successfully!');
        $this->command->newLine();

        // Assign all permissions to admin role
        $this->assignAdminPermissions();
    }

    /**
     * Create CRUD permissions for a resource
     */
    private function createCrudPermissions(string $resource, string $label): void
    {
        $permissions = [
            "{$resource} view",
            "{$resource} create",
            "{$resource} edit",
            "{$resource} delete",
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->line("  Created {$label} permissions: " . implode(', ', $permissions));
    }

    /**
     * Assign all permissions to admin role
     */
    private function assignAdminPermissions(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $allPermissions = Permission::all();
        $adminRole->syncPermissions($allPermissions);

        $this->command->info("Assigned all {$allPermissions->count()} permissions to admin role");
    }
}
