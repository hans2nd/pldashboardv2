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
                'embed_type' => 'iframe',
                'embed_code' => null,
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
     * Detect embed type from code (iframe or jotform)
     */
    public function detectEmbedType(string $code): string
    {
        // Check for JotForm specific patterns
        if (preg_match('/jotform-embed|jotfor\.ms|data-id=["\'][0-9]+["\']/i', $code)) {
            return 'jotform';
        }
        
        // Default to iframe (Power BI, etc)
        return 'iframe';
    }

    /**
     * Extract JotForm data-id from embed code
     */
    public function extractJotformDataId(string $code): ?string
    {
        if (preg_match('/data-id=["\']([0-9]+)["\']/i', $code, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Extract JotForm data-type from embed code
     */
    public function extractJotformDataType(string $code): string
    {
        if (preg_match('/data-type=["\']([^"\']+)["\']/i', $code, $matches)) {
            return $matches[1];
        }
        return 'interactive'; // default JotForm type
    }

    /**
     * Clean and normalize JotForm embed code
     */
    public function normalizeJotformCode(string $code): string
    {
        // Extract the essentials and create a clean embed code
        $dataId = $this->extractJotformDataId($code);
        $dataType = $this->extractJotformDataType($code);
        
        if (!$dataId) {
            return $code; // Return original if can't extract
        }

        // Generate clean JotForm embed code
        return '<div class="jotform-embed" style="min-height: 600px;" data-id="' . $dataId . '" data-type="' . $dataType . '"></div>';
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

