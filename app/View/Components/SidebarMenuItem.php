<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenuItem extends Component
{
    public string $menuKey;
    public array $menu;
    public string $activeMenu;

    /**
     * Create a new component instance.
     */
    public function __construct(string $menuKey, array $menu, string $activeMenu = '')
    {
        $this->menuKey = $menuKey;
        $this->menu = $menu;
        $this->activeMenu = $activeMenu;
    }

    /**
     * Check if this menu or any of its children is active
     */
    public function isActive(): bool
    {
        // Check direct items
        if (isset($this->menu['items'])) {
            foreach ($this->menu['items'] as $key => $item) {
                if ($key === $this->activeMenu) {
                    return true;
                }
            }
        }

        // Check nested children
        if (isset($this->menu['children'])) {
            foreach ($this->menu['children'] as $child) {
                if (isset($child['items'])) {
                    foreach ($child['items'] as $key => $item) {
                        if ($key === $this->activeMenu) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-menu-item');
    }
}
