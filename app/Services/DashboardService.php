<?php

namespace App\Services;

use App\Models\DashboardSetting;

class DashboardService
{
    /**
     * Get iframe data for a specific dashboard key
     */
    public function getIframeByKey(string $key, string $defaultTitle, ?string $defaultSrc = null): DashboardSetting
    {
        return DashboardSetting::firstOrCreate(
            ['key' => $key],
            [
                'title' => $defaultTitle,
                'src' => $defaultSrc ?? 'about:blank',
            ]
        );
    }

    /**
     * Extract an attribute from HTML code (e.g., src or title from iframe)
     */
    public function extractAttribute(string $html, string $attribute): ?string
    {
        if (preg_match('/' . $attribute . '=["\']([^"\']+)["\']/i', $html, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Get dashboard data for rendering a view
     */
    public function getDashboardData(string $key, string $title, string $breadcrumbs, string $menu): array
    {
        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        return [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'menu' => $menu,
            'iframe' => $iframe,
        ];
    }

    /**
     * Get all dashboard menu configurations
     */
    public function getDashboardMenus(): array
    {
        return config('dashboard_menus', []);
    }

    /**
     * Get menus by category
     */
    public function getMenuByCategory(string $category): array
    {
        return config("dashboard_menus.{$category}", []);
    }
}
