<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\DashboardMenu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class MenuController extends Controller implements HasMiddleware
{
    protected MenuService $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('permission:menu view', only: ['index', 'show']),
            new Middleware('permission:menu create', only: ['create', 'store']),
            new Middleware('permission:menu edit', only: ['edit', 'update']),
            new Middleware('permission:menu delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of menus
     */
    public function index(Request $request)
    {
        // Sorting
        $sort = $request->get('sort', 'order');
        $direction = $request->get('direction', 'asc');
        
        // Get menus with sorting
        $menus = DashboardMenu::root()
            ->with(['children' => function ($query) use ($sort, $direction) {
                $query->with(['children' => function ($q) use ($sort, $direction) {
                    $q->orderBy($sort, $direction);
                }])->orderBy($sort, $direction);
            }])
            ->orderBy($sort, $direction)
            ->get();
        
        $data = [
            'title' => 'Menu Management',
            'breadcrumbs' => 'Menus',
            'menu' => 'menus',
            'menus' => $menus,
            // Statistics
            'totalUsers' => \App\Models\User::count(),
            'totalRoles' => \Spatie\Permission\Models\Role::count(),
            'totalPermissions' => \Spatie\Permission\Models\Permission::count(),
            'totalMenus' => DashboardMenu::count(),
        ];

        return view('menus.list', $data);
    }

    /**
     * Show the form for creating a new menu
     */
    public function create()
    {
        $data = [
            'title' => 'Create Menu',
            'breadcrumbs' => 'Create Menu',
            'menu' => 'menus',
            'parents' => $this->menuService->getParentOptions(),
        ];

        return view('menus.create', $data);
    }

    /**
     * Store a newly created menu
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'icon' => 'nullable|string|max:100',
            'route' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:dashboard_menus,id',
            'type' => 'required|in:dashboard,link,header',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'auto_permission' => 'boolean',
        ], [
            'name.required' => 'Nama menu harus diisi',
            'name.min' => 'Nama menu minimal 2 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $menu = DashboardMenu::create([
                'name' => $request->name,
                'key' => $this->menuService->generateKey($request->name),
                'icon' => $request->icon,
                'route' => $request->route,
                'parent_id' => $request->parent_id,
                'type' => $request->type,
                'order' => $request->order ?? 0,
                'is_active' => $request->boolean('is_active', true),
            ]);

            // Auto-generate permission if checked
            if ($request->boolean('auto_permission', true)) {
                $this->menuService->generateAllPermissions($menu);
            }

            DB::commit();

            return redirect()->route('menus.index')->with('success', 'Menu berhasil dibuat!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat menu: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing a menu
     */
    public function edit(DashboardMenu $menu)
    {
        $data = [
            'title' => 'Edit Menu',
            'breadcrumbs' => 'Edit Menu',
            'menu' => 'menus',
            'menuItem' => $menu,
            'parents' => $this->menuService->getParentOptions($menu->id),
        ];

        return view('menus.edit', $data);
    }

    /**
     * Update the specified menu
     */
    public function update(Request $request, DashboardMenu $menu)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'key' => 'required|string|max:100|unique:dashboard_menus,key,' . $menu->id,
            'icon' => 'nullable|string|max:100',
            'route' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:dashboard_menus,id',
            'type' => 'required|in:dashboard,link,header',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama menu harus diisi',
            'key.required' => 'Key menu harus diisi',
            'key.unique' => 'Key menu sudah digunakan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Prevent self-referencing parent
        if ($request->parent_id == $menu->id) {
            return redirect()->back()->with('error', 'Menu tidak bisa menjadi parent dari dirinya sendiri')->withInput();
        }

        try {
            DB::beginTransaction();

            $oldKey = $menu->key;
            
            $menu->update([
                'name' => $request->name,
                'key' => $request->key,
                'icon' => $request->icon,
                'route' => $request->route,
                'parent_id' => $request->parent_id,
                'type' => $request->type,
                'order' => $request->order ?? 0,
                'is_active' => $request->boolean('is_active', true),
            ]);

            // Update permission name if key changed
            if ($oldKey !== $request->key) {
                $oldPermissionName = $oldKey . ' view';
                $newPermissionName = $request->key . ' view';
                
                \Spatie\Permission\Models\Permission::where('name', $oldPermissionName)
                    ->update(['name' => $newPermissionName]);
            }

            DB::commit();

            return redirect()->route('menus.index')->with('success', 'Menu berhasil diupdate!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal update menu: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified menu
     */
    public function destroy(DashboardMenu $menu)
    {
        try {
            DB::beginTransaction();

            // Optionally delete related permissions
            // $this->menuService->deletePermissions($menu);

            $menu->delete();

            DB::commit();

            return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }

    /**
     * Generate permissions for a menu
     */
    public function generatePermissions(DashboardMenu $menu)
    {
        try {
            $permissions = $this->menuService->generateAllPermissions($menu);
            
            return redirect()->back()->with('success', 'Permissions berhasil di-generate: ' . count($permissions) . ' permission');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate permissions: ' . $e->getMessage());
        }
    }

    /**
     * Store a new child menu via AJAX
     */
    public function storeChild(Request $request, DashboardMenu $menu)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'icon' => 'nullable|string|max:100',
            'route' => 'nullable|string|max:255',
            'type' => 'required|in:dashboard,link,header',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'auto_permission' => 'boolean',
        ], [
            'name.required' => 'Nama menu harus diisi',
            'name.min' => 'Nama menu minimal 2 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $child = DashboardMenu::create([
                'name' => $request->name,
                'key' => $this->menuService->generateKey($request->name),
                'icon' => $request->icon,
                'route' => $request->route,
                'parent_id' => $menu->id,
                'type' => $request->type,
                'order' => $request->order ?? 0,
                'is_active' => $request->boolean('is_active', true),
            ]);

            // Auto-generate permission if checked
            if ($request->boolean('auto_permission', true)) {
                $this->menuService->generateAllPermissions($child);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Child menu berhasil ditambahkan!',
                'data' => [
                    'id' => $child->id,
                    'name' => $child->name,
                    'key' => $child->key,
                    'icon' => $child->icon ?? 'fas fa-file',
                    'route' => $child->route,
                    'type' => $child->type,
                    'is_active' => $child->is_active,
                    'edit_url' => route('menus.edit', $child),
                    'delete_url' => route('menus.children.destroy', [$menu, $child]),
                ]
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat child menu: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a child menu via AJAX
     */
    public function destroyChild(DashboardMenu $menu, DashboardMenu $child)
    {
        // Verify the child belongs to this parent
        if ($child->parent_id !== $menu->id) {
            return response()->json([
                'success' => false,
                'message' => 'Child menu tidak ditemukan pada parent ini'
            ], 404);
        }

        try {
            DB::beginTransaction();

            $childName = $child->name;
            $child->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Child menu '{$childName}' berhasil dihapus!"
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus child menu: ' . $e->getMessage()
            ], 500);
        }
    }
}
