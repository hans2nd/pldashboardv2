<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('permission:permission view', only: ['index','show']),
            new Middleware('permission:permission create', only: ['create', 'store']),
            new Middleware('permission:permission edit', only: ['edit', 'update']),
            new Middleware('permission:permission delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Page Permissions',
            'breadcrumbs' => 'Permissions',
            'menu' => 'permissions',
            'permissions' => Permission::orderBy('created_at','desc')->paginate(10)
        ];

        return view('permissions.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title'=> 'Page Create Permissions',
            'breadcrumbs' => 'Create Permissions',
            'menu' => 'permissions',
        ];

        return view('permissions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|unique:permissions,name',
        ], [
            'name.required' => 'Nama permission harus diisi',
            'name.min' => 'Nama permission minimal 3 karakter',
            'name.max' => 'Nama permission maksimal 255 karakter',
            'name.unique' => 'Nama permission sudah terdaftar',
        ]);

        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name,
            ]);

            return redirect()->route('permissions.index')->with('success','Permission created successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
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
        $data =[
            'title'=> 'Page Edit Permissions',
            'breadcrumbs' => 'Edit Permissions',
            'menu' => 'permissions',
            'permission' => Permission::findOrFail($id),
        ];

        return view('permissions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|unique:permissions,name,'.$id.',id',
            ], [
            'name.required' => 'Nama permission harus diisi',
            'name.min' => 'Nama permission minimal 3 karakter',
            'name.max' => 'Nama permission maksimal 255 karakter',
            'name.unique' => 'Nama permission sudah terdaftar',
        ]);

        if ($validator->passes()) {
            $permission = Permission::findOrFail($id);
            $permission->update([
                'name' => $request->name,
            ]);

            return redirect()->route('permissions.index')->with('success','Permission updated successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete permission'. $e->getMessage());
        }
    }
}
