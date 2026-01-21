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

    # Update Dashboard
    Route::put('/iframe/{key}', [DashboardController::class, 'update'])->name('iframe.update');

    # Sales Sidoarjo
    Route::get('/sdaAllSales', [DashboardController::class, 'sdaAllSales'])->name('dashboard.sdaAllSales');
    Route::get('/sdaFS', [DashboardController::class, 'sidoarjo_fs'])->name('dashboard.sidoarjo_fs');
    Route::get('/sdaDistributor', [DashboardController::class, 'sidoarjo_distributor'])->name('dashboard.sidoarjo_distributor');
    Route::get('/sdaRetail', [DashboardController::class, 'sidoarjo_retail'])->name('dashboard.sidoarjo_retail');
    Route::get('/sdaFSM', [DashboardController::class, 'sidoarjo_fsm'])->name('dashboard.sidoarjo_fsm');
    Route::get('/sdaPrivateLabel', [DashboardController::class, 'sidoarjo_privatelabel'])->name('dashboard.sidoarjo_privatelabel');



        Route::resource('users', UserController::class);
        Route::put('users/{user:username}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
        Route::put('/profile/password', [UserController::class, 'updateSelfPassword'])->name('user.self.password.update');
        # Roles
        Route::resource('roles', RoleController::class);
        // Route::delete('/roles',[RoleController::class, 'destroy'])->name('roles.destroy');
        # Permissions
        Route::resource('permissions', PermissionController::class);
        // Route::delete('/permissions',[PermissionController::class, 'destroy'])->name('permissions.destroy');

    # Operational Dashboard
    Route::get('/operational/pms', [DashboardController::class, 'operationalPms'])->name('dashboard.operational_pms');
});