<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('permission:role view', only: ['index','show']),
            new Middleware('permission:role create', only: ['create', 'store']),
            new Middleware('permission:role edit', only: ['edit', 'update']),
            new Middleware('permission:role delete', only: ['destroy', 'bulkDelete']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Role::with('permissions');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }
        
        // Sorting
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);
        
        $data = [
            'title' => 'Page Roles',
            'breadcrumbs' => 'Roles',
            'menu' => 'roles',
            'roles' => $query->paginate(20)->appends($request->query())
        ];

        return view('roles.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title'=> 'Page Create Roles',
            'breadcrumbs' => 'Create Roles',
            'menu' => 'roles',
            'permissions' => Permission::orderBy('name','asc')->get(),
        ];
        
        return view('roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|min:3|max:255|unique:roles,name',
        ],[
            'name'=> 'Nama role harus diisi',
            'name.min'=> 'Nama role minimal 3 karakter',
            'name.max'=> 'Nama role maksimal 255 karakter',
            'name.unique'=> 'Nama role sudah terdaftar',
        ]);

        if ($validator->passes())
        {
            $role = Role::create([
                'name' => $request->name,
            ]);

            if (!empty($request->permission))
            {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('roles.index')->with('success','Role created successfully');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        $data =[
            'title'=> 'Page Edit Roles',
            'breadcrumbs' => 'Edit Roles',
            'menu' => 'roles',
            'role' => $role,
            'permissions' => Permission::orderBy('name','asc')->get(),
            'rolePermissions' => $role->permissions->pluck('name'),
        ];

        return view('roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|unique:roles,name,'.$id.',id',
            ], [
            'name.required' => 'Nama role harus diisi',
            'name.min' => 'Nama role minimal 3 karakter',
            'name.max' => 'Nama role maksimal 255 karakter',
            'name.unique' => 'Nama role sudah terdaftar',
        ]);

        if ($validator->passes()) {
            $role->name = $request->name;
            $role->save();

            if (!empty($request->permission))
            {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }

            return redirect()->route('roles.index')->with('success','Role updated successfully');
        } else {
            return redirect()->route('roles.edit', $id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete role: '. $e->getMessage());
        }
    }

    /**
     * Bulk delete roles
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:roles,id'
        ]);

        try {
            Role::whereIn('id', $request->ids)->delete();
            return redirect()->route('roles.index')
                ->with('success', count($request->ids) . ' roles deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete roles: ' . $e->getMessage());
        }
    }
}
