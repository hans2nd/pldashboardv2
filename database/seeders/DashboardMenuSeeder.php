<?php

namespace Database\Seeders;

use App\Models\DashboardMenu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DashboardMenuSeeder extends Seeder
{
    /**
     * Seed the dashboard menus with automatic permission creation
     * 
     * This seeder creates:
     * - Dashboard menu hierarchy (parent -> child -> grandchild)
     * - Associated permissions for each menu (only 'view' permission)
     */
    public function run(): void
    {
        // Reset cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Seeding Dashboard Menus...');

        // =====================
        // SALES DASHBOARD
        // =====================
        $sales = $this->createMenu([
            'key' => 'sales',
            'name' => 'Sales Dashboard',
            'icon' => 'fas fa-chart-line',
            'type' => 'header',
            'order' => 1,
        ]);

        // Sidoarjo submenu (parent for sales items)
        $sidoarjo = $this->createMenu([
            'key' => 'sidoarjo',
            'name' => 'Sidoarjo',
            'icon' => 'fas fa-map-marker-alt',
            'type' => 'header',
            'parent_id' => $sales->id,
            'order' => 1,
        ]);

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
            $this->createMenu([
                'key' => $item['key'],
                'name' => $item['name'],
                'route' => $item['route'],
                'type' => 'dashboard',
                'parent_id' => $sidoarjo->id,
                'order' => $item['order'],
            ]);
        }

        // =====================
        // LOGISTIC DASHBOARD
        // =====================
        $logistic = $this->createMenu([
            'key' => 'logistics',
            'name' => 'Logistic Dashboard',
            'icon' => 'fas fa-car-side',
            'type' => 'header',
            'order' => 2,
        ]);

        $logisticItems = [
            ['key' => 'logisticInventoryStatus', 'name' => 'Inventory Status', 'route' => 'dashboard.logistic_inventory_status', 'order' => 1],
            ['key' => 'logisticInventoryMOI', 'name' => 'MOI Inventory', 'route' => 'dashboard.logistic_inventory_moi', 'order' => 2],
        ];

        foreach ($logisticItems as $item) {
            $this->createMenu([
                'key' => $item['key'],
                'name' => $item['name'],
                'route' => $item['route'],
                'type' => 'dashboard',
                'parent_id' => $logistic->id,
                'order' => $item['order'],
            ]);
        }

        // =====================
        // OPERATIONAL DASHBOARD
        // =====================
        $operational = $this->createMenu([
            'key' => 'operational',
            'name' => 'Operational Dashboard',
            'icon' => 'fas fa-cogs',
            'type' => 'header',
            'order' => 3,
        ]);

        $operationalItems = [
            ['key' => 'operationalPms', 'name' => 'PMS', 'route' => 'dashboard.operational_pms', 'order' => 1],
        ];

        foreach ($operationalItems as $item) {
            $this->createMenu([
                'key' => $item['key'],
                'name' => $item['name'],
                'route' => $item['route'],
                'type' => 'dashboard',
                'parent_id' => $operational->id,
                'order' => $item['order'],
            ]);
        }

        $this->command->info('Dashboard Menus seeded successfully!');
    }

    /**
     * Create a menu and its permission
     */
    private function createMenu(array $data): DashboardMenu
    {
        $menu = DashboardMenu::updateOrCreate(
            ['key' => $data['key']],
            array_merge($data, ['is_active' => true])
        );

        // Create permission for this menu (only view)
        $permissionName = $menu->permission_name; // This uses the accessor
        Permission::firstOrCreate(['name' => $permissionName]);
        
        $this->command->line("  Created menu: {$menu->name} -> Permission: {$permissionName}");

        return $menu;
    }
}
