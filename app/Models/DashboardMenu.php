<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DashboardMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'icon',
        'route',
        'parent_id',
        'type',
        'order',
        'is_active',
        'permission_name', // Custom permission name (optional)
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the parent menu
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(DashboardMenu::class, 'parent_id');
    }

    /**
     * Get the child menus
     */
    public function children(): HasMany
    {
        return $this->hasMany(DashboardMenu::class, 'parent_id')->orderBy('order');
    }

    /**
     * Get active children
     */
    public function activeChildren(): HasMany
    {
        return $this->hasMany(DashboardMenu::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Get the permission name for viewing this menu
     * Format: "{readable name} view" (e.g., "sales dashboard view")
     */
    public function getPermissionNameAttribute(): string
    {
        // If custom permission_name is set, use it
        if (!empty($this->attributes['permission_name'] ?? null)) {
            return strtolower($this->attributes['permission_name']) . ' view';
        }
        
        // Generate from menu name
        return strtolower($this->name) . ' view';
    }

    /**
     * Get the update permission name for this menu
     */
    public function getUpdatePermissionNameAttribute(): string
    {
        if (!empty($this->attributes['permission_name'] ?? null)) {
            return strtolower($this->attributes['permission_name']) . ' update';
        }
        
        return strtolower($this->name) . ' update';
    }

    /**
     * Scope to get only root menus (no parent)
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope to get only active menus
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if menu has children
     */
    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get all permissions related to this menu
     */
    public function getRelatedPermissions(): array
    {
        $baseName = !empty($this->attributes['permission_name'] ?? null) 
            ? strtolower($this->attributes['permission_name'])
            : strtolower($this->name);
            
        return [
            $baseName . ' view',
            $baseName . ' update',
        ];
    }
}
