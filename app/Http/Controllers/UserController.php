<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('permission:users view', only: ['index','show']),
            new Middleware('permission:users create', only: ['create', 'store']),
            new Middleware('permission:users edit', only: ['edit', 'update']),
            new Middleware('permission:users delete', only: ['destroy', 'bulkDelete']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = User::with('roles');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Sorting kolom
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $data = [
            'title' => 'Page Users',
            'breadcrumbs' => 'Users',
            'menu' => 'users',
            'users' => $query->paginate(10)->appends($request->query())
        ];

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Page Registrasi Users',
            'breadcrumbs' => 'Registrasi Users',
            'menu' => 'users',
            'roles' => Role::orderBy('name','asc')->pluck('name','id')
        ];

        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:3|max:255',
            'password_confirmation' => 'required|same:password',
        ], [
            'fullname.required' => 'Nama lengkap harus diisi',
            'fullname.min' => 'Nama lengkap minimal 3 karakter',
            'fullname.max' => 'Nama lengkap maksimal 255 karakter',
            'username.required' => 'Username harus diisi',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 255 karakter',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 3 karakter',
            'password.max' => 'Password maksimal 255 karakter',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak sama dengan password',
        ]);

        try {

            $user = User::create([
                'name'     => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => $request->password == null ? Hash::make('12345678') : Hash::make($request->password),
            ]);

            $user->syncRoles($request->role);

            return redirect()->route('users.index')->with('success_html', 'Data dengan nama <b class="text-success">' . e($request->fullname) . '</b> berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
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
    public function edit(User $user)
    {
        // Eager load roles
        $user->load('roles');

        $data = [
            'title' => 'Page Edit Users',
            'breadcrumbs' => 'Edit Users',
            'menu' => 'users',
            'user' => $user,
            'roles' => Role::orderBy('name','asc')->pluck('name','id'),
            'userRoles' => $user->roles->pluck('name')->toArray(),
        ];

        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'email|email:dns,' . $user->id,
            'role'=> 'required',
        ], [
            'fullname.required' => 'Nama lengkap harus diisi',
            'fullname.min' => 'Nama lengkap minimal 3 karakter',
            'fullname.max' => 'Nama lengkap maksimal 255 karakter',
            'username.required' => 'Username harus diisi',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 255 karakter',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $user->id)->withInput()->withErrors($validator);
        }

        try {
            $user->update([
                'name'     => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
            ]);

            $user->syncRoles($request->role);

            return redirect('users')->with('success_html', 'Data dengan nama <b class="text-success">' . e($request->fullname) . '</b> berhasil diupdate.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
           
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // User::findOrFail($id)->delete();
            $user->delete();
            return redirect()->route('users.index')->with('success', 'users deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete users'. $e->getMessage());
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:3|max:255',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 3 karakter',
            'password.max' => 'Password maksimal 255 karakter',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak sama dengan password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $user->username)->withInput()->withErrors($validator);
        }

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('users.edit', $user->username)->with('success_html', 'Password berhasil diubah.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function updateSelfPassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            // Pesan Kustom untuk kasus gagal
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.different' => 'Password baru tidak boleh sama dengan Password lama.',
        ]);

        $user = Auth::user();

        // 2. Cek Password Lama (Penting: harus menggunakan ValidationException)
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password lama yang Anda masukkan tidak benar.'],
            ])->redirectTo(url()->previous() . '#userChangePasswordModal');
        }

        // 3. Hash dan Simpan Password Baru
        $user->password = Hash::make($request->password);
        $user->save();

        // 4. Redirect dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Password Anda berhasil diubah.');
    }

    /**
     * Bulk delete users
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        try {
            // Don't allow deleting the current user
            $ids = collect($request->ids)->reject(fn($id) => $id == auth()->id());
            
            User::whereIn('id', $ids)->delete();
            return redirect()->route('users.index')
                ->with('success', $ids->count() . ' users deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete users: ' . $e->getMessage());
        }
    }
}
