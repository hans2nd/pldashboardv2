<?php

namespace Database\Seeders;

use App\Models\DashboardMenu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DashboardMenuSeeder extends Seeder
{
    /**
     * Seed the existing dashboard menus to database with clean permission names
     */
    public function run(): void
    {
        $this->command->info('Seeding Dashboard Menus with clean permissions...');

        // =====================
        // SALES DASHBOARD
        // =====================
        $sales = DashboardMenu::updateOrCreate(
            ['key' => 'sales'],
            [
                'name' => 'Sales Dashboard',
                'icon' => 'fas fa-chart-line',
                'type' => 'header',
                'order' => 1,
                'is_active' => true,
                'permission_name' => 'Sales Dashboard',
            ]
        );
        $this->createPermissions('Sales Dashboard');

        // Sidoarjo submenu (parent for sales items)
        $sidoarjo = DashboardMenu::updateOrCreate(
            ['key' => 'sidoarjo'],
            [
                'name' => 'Sidoarjo',
                'icon' => 'fas fa-map-marker-alt',
                'type' => 'header',
                'parent_id' => $sales->id,
                'order' => 1,
                'is_active' => true,
                'permission_name' => 'Sales Sidoarjo',
            ]
        );
        $this->createPermissions('Sales Sidoarjo');

        // Sales items under Sidoarjo
        $salesItems = [
            [
                'key' => 'sdaAllSales', 
                'name' => 'Over All Channel', 
                'route' => 'dashboard.sdaAllSales', 
                'order' => 1,
                'permission_name' => 'Sales All Channel'
            ],
            [
                'key' => 'sidoarjoDist', 
                'name' => 'Distributor', 
                'route' => 'dashboard.sidoarjo_distributor', 
                'order' => 2,
                'permission_name' => 'Sales Distributor'
            ],
            [
                'key' => 'sidoarjoFs', 
                'name' => 'Food Services', 
                'route' => 'dashboard.sidoarjo_fs', 
                'order' => 3,
                'permission_name' => 'Sales Food Services'
            ],
            [
                'key' => 'sidoarjoPrivatelabel', 
                'name' => 'Private Label', 
                'route' => 'dashboard.sidoarjo_privatelabel', 
                'order' => 4,
                'permission_name' => 'Sales Private Label'
            ],
            [
                'key' => 'sidoarjoRetail', 
                'name' => 'Retail (MT & GT)', 
                'route' => 'dashboard.sidoarjo_retail', 
                'order' => 5,
                'permission_name' => 'Sales Retail'
            ],
            [
                'key' => 'sidoarjoFsm', 
                'name' => 'Food Services Manager', 
                'route' => 'dashboard.sidoarjo_fsm', 
                'order' => 6,
                'permission_name' => 'Sales FSM'
            ],
        ];

        foreach ($salesItems as $item) {
            DashboardMenu::updateOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'type' => 'dashboard',
                    'parent_id' => $sidoarjo->id,
                    'order' => $item['order'],
                    'is_active' => true,
                    'permission_name' => $item['permission_name'],
                ]
            );
            $this->createPermissions($item['permission_name']);
        }

        // =====================
        // LOGISTIC DASHBOARD
        // =====================
        $logistic = DashboardMenu::updateOrCreate(
            ['key' => 'logistics'],
            [
                'name' => 'Logistic Dashboard',
                'icon' => 'fas fa-car-side',
                'type' => 'header',
                'order' => 2,
                'is_active' => true,
                'permission_name' => 'Logistic Dashboard',
            ]
        );
        $this->createPermissions('Logistic Dashboard');

        $logisticItems = [
            [
                'key' => 'logisticInventoryStatus', 
                'name' => 'Inventory Status', 
                'route' => 'dashboard.logistic_inventory_status', 
                'order' => 1,
                'permission_name' => 'Logistic Inventory Status'
            ],
            [
                'key' => 'logisticInventoryMOI', 
                'name' => 'MOI Inventory', 
                'route' => 'dashboard.logistic_inventory_moi', 
                'order' => 2,
                'permission_name' => 'Logistic MOI Inventory'
            ],
        ];

        foreach ($logisticItems as $item) {
            DashboardMenu::updateOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'type' => 'dashboard',
                    'parent_id' => $logistic->id,
                    'order' => $item['order'],
                    'is_active' => true,
                    'permission_name' => $item['permission_name'],
                ]
            );
            $this->createPermissions($item['permission_name']);
        }

        // =====================
        // OPERATIONAL DASHBOARD
        // =====================
        $operational = DashboardMenu::updateOrCreate(
            ['key' => 'operational'],
            [
                'name' => 'Operational Dashboard',
                'icon' => 'fas fa-cogs',
                'type' => 'header',
                'order' => 3,
                'is_active' => true,
                'permission_name' => 'Operational Dashboard',
            ]
        );
        $this->createPermissions('Operational Dashboard');

        $operationalItems = [
            [
                'key' => 'operationalPms', 
                'name' => 'PMS', 
                'route' => 'dashboard.operational_pms', 
                'order' => 1,
                'permission_name' => 'Operational PMS'
            ],
        ];

        foreach ($operationalItems as $item) {
            DashboardMenu::updateOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'type' => 'dashboard',
                    'parent_id' => $operational->id,
                    'order' => $item['order'],
                    'is_active' => true,
                    'permission_name' => $item['permission_name'],
                ]
            );
            $this->createPermissions($item['permission_name']);
        }

        $this->command->info('Dashboard Menus seeded successfully!');
    }

    /**
     * Create view and update permissions for a given name
     */
    private function createPermissions(string $name): void
    {
        $baseName = strtolower($name);
        
        // Create view permission
        Permission::firstOrCreate(['name' => $baseName . ' view']);
        
        // Create update permission
        Permission::firstOrCreate(['name' => $baseName . ' update']);
        
        $this->command->line("  Created permissions: {$baseName} view, {$baseName} update");
    }
}
