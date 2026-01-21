<?php

namespace App\Services;

use App\Models\DashboardMenu;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class MenuService
{
    /**
     * Get all active root menus with their children
     */
    public function getActiveMenuTree(): Collection
    {
        return DashboardMenu::root()
            ->active()
            ->with(['activeChildren' => function ($query) {
                $query->with('activeChildren');
            }])
            ->orderBy('order')
            ->get();
    }

    /**
     * Get all menus for admin management
     */
    public function getAllMenusTree(): Collection
    {
        return DashboardMenu::root()
            ->with(['children' => function ($query) {
                $query->with('children')->orderBy('order');
            }])
            ->orderBy('order')
            ->get();
    }

    /**
     * Generate permission for a menu
     */
    public function generatePermission(DashboardMenu $menu): Permission
    {
        $permissionName = $menu->key . ' view';
        
        return Permission::firstOrCreate(['name' => $permissionName]);
    }

    /**
     * Generate all permissions for a menu
     */
    public function generateAllPermissions(DashboardMenu $menu): array
    {
        $permissions = [];
        
        foreach ($menu->getRelatedPermissions() as $permissionName) {
            $permissions[] = Permission::firstOrCreate(['name' => $permissionName]);
        }

        return $permissions;
    }

    /**
     * Delete permissions for a menu
     */
    public function deletePermissions(DashboardMenu $menu): void
    {
        foreach ($menu->getRelatedPermissions() as $permissionName) {
            Permission::where('name', $permissionName)->delete();
        }
    }

    /**
     * Generate unique key from name
     */
    public function generateKey(string $name): string
    {
        $key = Str::camel($name);
        $originalKey = $key;
        $counter = 1;

        while (DashboardMenu::where('key', $key)->exists()) {
            $key = $originalKey . $counter;
            $counter++;
        }

        return $key;
    }

    /**
     * Get menus formatted for sidebar component
     */
    public function getMenusForSidebar(): array
    {
        $menus = $this->getActiveMenuTree();
        $result = [];

        foreach ($menus as $menu) {
            $result[$menu->key] = $this->formatMenuForSidebar($menu);
        }

        return $result;
    }

    /**
     * Format single menu for sidebar
     */
    protected function formatMenuForSidebar(DashboardMenu $menu): array
    {
        $formatted = [
            'icon' => $menu->icon ?? 'fas fa-folder',
            'label' => $menu->name,
            'permission' => $menu->permission_name,
            'collapse_id' => $menu->key . 'Menu',
        ];

        if ($menu->hasChildren()) {
            $formatted['items'] = [];
            foreach ($menu->activeChildren as $child) {
                $formatted['items'][$child->key] = [
                    'label' => $child->name,
                    'route' => $child->route,
                    'permission' => $child->permission_name,
                ];
            }
        } elseif ($menu->route) {
            $formatted['route'] = $menu->route;
        }

        return $formatted;
    }

    /**
     * Get available parent menus for dropdown
     */
    public function getParentOptions(?int $excludeId = null): Collection
    {
        $query = DashboardMenu::root()->orderBy('name');
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }
}
