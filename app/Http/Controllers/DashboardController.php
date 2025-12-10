<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class DashboardController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:sales view', only: ['index','show']),
            new Middleware('permission:logistic view', only: ['logistic_inventory_status','logistic_inventory_moi']),
        ];
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'breadcrumbs' => 'Dashboard',
            'menu' => 'dashboard'
        ];
        return view('welcome', $data);
    }

    public function logistic_inventory_status()
    {
        $data = [
            'title' => 'Dashboard Logistic',
            'breadcrumbs' => 'Inventory Status',
            'menu' => 'logistic'
        ];

        return view('logistics.inventoryStatus',$data);
    }

    public function logistic_inventory_moi()
    {
        $data = [
            'title' => 'Dashboard Logistic',
            'breadcrumbs' => 'Inventory MOI',
            'menu' => 'inventoryMOI'
        ];

        return view('logistics.inventoryMOI',$data);
    }
}
