<?php

namespace Database\Seeders;

use App\Models\DashboardMenu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DashboardMenuSeeder extends Seeder
{
    /**
     * Seed the existing dashboard menus to database
     */
    public function run(): void
    {
        $this->command->info('Seeding Dashboard Menus...');

        // =====================
        // SALES DASHBOARD
        // =====================
        $sales = DashboardMenu::firstOrCreate(
            ['key' => 'sales'],
            [
                'name' => 'Sales Dashboard',
                'icon' => 'fas fa-chart-line',
                'type' => 'header',
                'order' => 1,
                'is_active' => true,
            ]
        );
        Permission::firstOrCreate(['name' => 'sales view']);

        // Sidoarjo submenu (parent for sales items)
        $sidoarjo = DashboardMenu::firstOrCreate(
            ['key' => 'sidoarjo'],
            [
                'name' => 'Sidoarjo',
                'icon' => 'fas fa-map-marker-alt',
                'type' => 'header',
                'parent_id' => $sales->id,
                'order' => 1,
                'is_active' => true,
            ]
        );
        Permission::firstOrCreate(['name' => 'sidoarjo view']);

        // Sales items under Sidoarjo
        $salesItems = [
            ['key' => 'sdaAllSales', 'name' => 'Over All Channel', 'route' => 'dashboard.sdaAllSales', 'order' => 1],
            ['key' => 'sidoarjoDist', 'name' => 'Distributor', 'route' => 'dashboard.sidoarjo_distributor', 'order' => 2],
            ['key' => 'sidoarjoFs', 'name' => 'Food Services', 'route' => 'dashboard.sidoarjo_fs', 'order' => 3],
            ['key' => 'sidoarjoPrivatelabel', 'name' => 'Private Label', 'route' => 'dashboard.sidoarjo_privatelabel', 'order' => 4],
            ['key' => 'sidoarjoRetail', 'name' => 'Retail (MT & GT)', 'route' => 'dashboard.sidoarjo_retail', 'order' => 5],
            ['key' => 'sidoarjoFsm', 'name' => 'Food Services Manager', 'route' => 'dashboard.sidoarjo_fsm', 'order' => 6],
        ];

        foreach ($salesItems as $item) {
            DashboardMenu::firstOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'type' => 'dashboard',
                    'parent_id' => $sidoarjo->id,
                    'order' => $item['order'],
                    'is_active' => true,
                ]
            );
            Permission::firstOrCreate(['name' => $item['key'] . ' view']);
        }

        // =====================
        // LOGISTIC DASHBOARD
        // =====================
        $logistic = DashboardMenu::firstOrCreate(
            ['key' => 'logistics'],
            [
                'name' => 'Logistic Dashboard',
                'icon' => 'fas fa-car-side',
                'type' => 'header',
                'order' => 2,
                'is_active' => true,
            ]
        );
        Permission::firstOrCreate(['name' => 'logistic view']);

        $logisticItems = [
            ['key' => 'logisticInventoryStatus', 'name' => 'Inventory Status', 'route' => 'dashboard.logistic_inventory_status', 'order' => 1],
            ['key' => 'logisticInventoryMOI', 'name' => 'MOI Inventory', 'route' => 'dashboard.logistic_inventory_moi', 'order' => 2],
        ];

        foreach ($logisticItems as $item) {
            DashboardMenu::firstOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'type' => 'dashboard',
                    'parent_id' => $logistic->id,
                    'order' => $item['order'],
                    'is_active' => true,
                ]
            );
            Permission::firstOrCreate(['name' => $item['key'] . ' view']);
        }

        // =====================
        // OPERATIONAL DASHBOARD
        // =====================
        $operational = DashboardMenu::firstOrCreate(
            ['key' => 'operational'],
            [
                'name' => 'Operational Dashboard',
                'icon' => 'fas fa-cogs',
                'type' => 'header',
                'order' => 3,
                'is_active' => true,
            ]
        );
        Permission::firstOrCreate(['name' => 'operational view']);

        $operationalItems = [
            ['key' => 'operationalPms', 'name' => 'PMS', 'route' => 'dashboard.operational_pms', 'order' => 1],
        ];

        foreach ($operationalItems as $item) {
            DashboardMenu::firstOrCreate(
                ['key' => $item['key']],
                [
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'type' => 'dashboard',
                    'parent_id' => $operational->id,
                    'order' => $item['order'],
                    'is_active' => true,
                ]
            );
            Permission::firstOrCreate(['name' => $item['key'] . ' view']);
        }

        $this->command->info('Dashboard Menus seeded successfully!');
    }
}
