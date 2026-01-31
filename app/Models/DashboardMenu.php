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
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // When a menu is deleted, also delete its linked permission
        static::deleting(function ($menu) {
            $permission = $menu->getLinkedPermission();
            if ($permission) {
                $permission->delete();
            }
            
            // Also delete child menus and their permissions recursively
            foreach ($menu->children as $child) {
                $child->delete();
            }
        });
    }

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
     * For child menus: "{parent name} {child name} view" (e.g., "sidoarjo food services view")
     */
    public function getPermissionNameAttribute(): string
    {
        // If custom permission_name is set, use it
        if (!empty($this->attributes['permission_name'] ?? null)) {
            return strtolower($this->attributes['permission_name']) . ' view';
        }
        
        // If this is a child menu, include parent name
        if ($this->parent_id) {
            $parent = $this->parent;
            if ($parent) {
                $parentBaseName = !empty($parent->attributes['permission_name'] ?? null) 
                    ? strtolower($parent->attributes['permission_name'])
                    : strtolower($parent->name);
                return $parentBaseName . ' ' . strtolower($this->name) . ' view';
            }
        }
        
        // Generate from menu name for root menus
        return strtolower($this->name) . ' view';
    }

    /**
     * Get the base permission name (without 'view' suffix)
     * Used for generating and referencing permissions
     */
    public function getBasePermissionNameAttribute(): string
    {
        // If custom permission_name is set, use it
        if (!empty($this->attributes['permission_name'] ?? null)) {
            return strtolower($this->attributes['permission_name']);
        }
        
        // If this is a child menu, include parent name
        if ($this->parent_id) {
            $parent = $this->parent;
            if ($parent) {
                $parentBaseName = !empty($parent->attributes['permission_name'] ?? null) 
                    ? strtolower($parent->attributes['permission_name'])
                    : strtolower($parent->name);
                return $parentBaseName . ' ' . strtolower($this->name);
            }
        }
        
        // Generate from menu name for root menus
        return strtolower($this->name);
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
     * Get all permissions related to this menu (only view permission)
     */
    public function getRelatedPermissions(): array
    {
        return [
            $this->base_permission_name . ' view',
        ];
    }

    /**
     * Get the linked Permission model for this menu
     */
    public function getLinkedPermission(): ?\Spatie\Permission\Models\Permission
    {
        return \Spatie\Permission\Models\Permission::where('name', $this->permission_name)->first();
    }

    /**
     * Find menus that match a permission name
     * @param string $permissionName The permission name to search for
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function findByPermission(string $permissionName): \Illuminate\Database\Eloquent\Collection
    {
        // Extract base name by removing common suffixes like ' view', ' update', ' create', ' delete'
        $baseName = preg_replace('/\s+(view|update|create|delete|edit)$/i', '', strtolower($permissionName));
        
        return static::with('parent')
            ->get()
            ->filter(function ($menu) use ($baseName) {
                return strtolower($menu->base_permission_name) === $baseName;
            })
            ->values();
    }
}

