<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
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

    # Update Dashboard
    Route::put('/iframe/{key}', [DashboardController::class, 'update'])->name('iframe.update');

    # Sales Sidoarjo
    Route::get('/sdaAllSales', [DashboardController::class, 'sdaAllSales'])->name('dashboard.sdaAllSales');
    Route::get('/sdaFS', [DashboardController::class, 'sidoarjo_fs'])->name('dashboard.sidoarjo_fs');
    Route::get('/sdaDistributor', [DashboardController::class, 'sidoarjo_distributor'])->name('dashboard.sidoarjo_distributor');
    Route::get('/sdaRetail', [DashboardController::class, 'sidoarjo_retail'])->name('dashboard.sidoarjo_retail');
    Route::get('/sdaFSM', [DashboardController::class, 'sidoarjo_fsm'])->name('dashboard.sidoarjo_fsm');
    Route::get('/sdaPrivateLabel', [DashboardController::class, 'sidoarjo_privatelabel'])->name('dashboard.sidoarjo_privatelabel');

    # Operational Dashboard
    Route::get('/operational/pms', [DashboardController::class, 'operationalPms'])->name('dashboard.operational_pms');

    # Master Data - Users
    Route::delete('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');
    Route::resource('users', UserController::class);
    Route::put('users/{user:username}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
    Route::put('/profile/password', [UserController::class, 'updateSelfPassword'])->name('user.self.password.update');
    
    # Roles
    Route::delete('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulk-delete');
    Route::resource('roles', RoleController::class);
    
    # Permissions
    Route::delete('permissions/bulk-delete', [PermissionController::class, 'bulkDelete'])->name('permissions.bulk-delete');
    Route::resource('permissions', PermissionController::class);
    
    # Menu Management
    Route::resource('menus', MenuController::class);
    Route::post('menus/{menu}/generate-permissions', [MenuController::class, 'generatePermissions'])->name('menus.generate-permissions');
    Route::post('menus/{menu}/children', [MenuController::class, 'storeChild'])->name('menus.children.store');
    Route::delete('menus/{menu}/children/{child}', [MenuController::class, 'destroyChild'])->name('menus.children.destroy');

    # Dynamic Menu Route - handles all menus from database
    Route::get('/menu/{key}', [DashboardController::class, 'dynamicMenu'])->name('dashboard.dynamic_menu');
});