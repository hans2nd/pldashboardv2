<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return redirect()->route('login');
});

# Jika user belum login
Route::middleware('isLogin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('authcheck')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('dashboard', DashboardController::class);
    Route::get('/logistic_inventory_status', [DashboardController::class, 'logistic_inventory_status'])->name('dashboard.logistic_inventory_status');
    Route::get('/logistic_inventory_moi', [DashboardController::class, 'logistic_inventory_moi'])->name('dashboard.logistic_inventory_moi');

    # Sales Sidoarjo
    Route::get('/sdaAllSales', [DashboardController::class, 'sdaAllSales'])->name('dashboard.sdaAllSales');
    Route::get('/sdaFS', [DashboardController::class, 'sidoarjo_fs'])->name('dashboard.sidoarjo_fs');



        Route::resource('users', UserController::class);
        # Roles
        Route::resource('roles', RoleController::class);
        // Route::delete('/roles',[RoleController::class, 'destroy'])->name('roles.destroy');
        # Permissions
        Route::resource('permissions', PermissionController::class);
        // Route::delete('/permissions',[PermissionController::class, 'destroy'])->name('permissions.destroy');
});