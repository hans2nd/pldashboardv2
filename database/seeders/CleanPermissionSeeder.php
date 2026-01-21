<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class CleanPermissionSeeder extends Seeder
{
    /**
     * Clean up old permission names and create new readable ones
     */
    public function run(): void
    {
        $this->command->info('Cleaning up permission names...');

        // Reset cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Map old permission names to new readable names
        $permissionMap = [
            // Sales Dashboard
            'sales view' => 'sales dashboard view',
            'sales sidoarjo' => 'sales sidoarjo view',
            'sales allchannel view' => 'sales all channel view',
            'sales dist view' => 'sales distributor view',
            'sales fs view' => 'sales food services view',
            'sales plabel view' => 'sales private label view',
            'sales retail view' => 'sales retail view',
            'sales fsm view' => 'sales fsm view',
            'sdaAllSales view' => 'sales all channel view',
            'sidoarjoDist view' => 'sales distributor view',
            'sidoarjoFs view' => 'sales food services view',
            'sidoarjoPrivatelabel view' => 'sales private label view',
            'sidoarjoRetail view' => 'sales retail view',
            'sidoarjoFsm view' => 'sales fsm view',
            
            // Logistic Dashboard
            'logistic view' => 'logistic dashboard view',
            'logisticInventoryStatus view' => 'logistic inventory status view',
            'logisticInventoryMOI view' => 'logistic moi inventory view',
            
            // Operational Dashboard
            'operational view' => 'operational dashboard view',
            'operationalPms view' => 'operational pms view',
        ];

        // Create new permissions (view and update)
        $newPermissions = [
            // Sales
            'sales dashboard view',
            'sales dashboard update',
            'sales sidoarjo view',
            'sales sidoarjo update',
            'sales all channel view',
            'sales all channel update',
            'sales distributor view',
            'sales distributor update',
            'sales food services view',
            'sales food services update',
            'sales private label view',
            'sales private label update',
            'sales retail view',
            'sales retail update',
            'sales fsm view',
            'sales fsm update',
            
            // Logistic
            'logistic dashboard view',
            'logistic dashboard update',
            'logistic inventory status view',
            'logistic inventory status update',
            'logistic moi inventory view',
            'logistic moi inventory update',
            
            // Operational
            'operational dashboard view',
            'operational dashboard update',
            'operational pms view',
            'operational pms update',
            
            // Menu Management
            'menu view',
            'menu create',
            'menu edit',
            'menu delete',
            
            // Iframe Update (global)
            'iframe edit',
        ];

        foreach ($newPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $this->command->line("  Created: $permission");
        }

        $this->command->info('Permissions cleaned up successfully!');
        $this->command->newLine();
        $this->command->info('New permission format:');
        $this->command->line('  - {feature name} view (for viewing dashboards)');
        $this->command->line('  - {feature name} update (for updating iframe data)');
    }
}
