<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class DashboardController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        // return [
        //     new Middleware('permission:sales view', only: ['index','show']),
        //     new Middleware('permission:logistic view', only: ['logistic_inventory_status','logistic_inventory_moi']),
        // ];

        return [
            // 1. Semua metode memerlukan user login (middleware:auth)
            new Middleware('auth'), 
            
            // 2. Terapkan permission spesifik HANYA pada route yang memerlukannya
            
            // Metode sales (index, show dihilangkan)
            new Middleware('permission:sales view', only: [
                'sdaAllSales', 
                'sidoarjo_fs', 
                'sidoarjo_distributor', 
                'sidoarjo_retail', 
                'sidoarjo_fsm', 
                'sidoarjo_privatelabel',
            ]),
            
            // Metode logistic
            new Middleware('permission:logistic view', only: [
                'logistic_inventory_status', 
                'logistic_inventory_moi'
            ]),
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

    public function sdaAllSales()
    {
        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'All Sales Sidoarjo',
            'menu' => 'allSalesSda'
        ];
        return view('sales.sdaAllSales', $data);
    }

    public function sidoarjo_fs()
    {
        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Food Service Sidoarjo',
            'menu' => 'sidoarjoFs'
        ];
        return view('sales.sidoarjo_fs', $data);
    }

    public function sidoarjo_distributor()
    {
        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Distributor Sidoarjo',
            'menu' => 'sidoarjoDist'
        ];
        return view('sales.sidoarjo_dist', $data);
    }

    public function sidoarjo_retail()
    {
        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Retail (GT & MT) Sidoarjo',
            'menu' => 'sidoarjoRetail'
        ];
        return view('sales.sidoarjo_retail', $data);
    }

    public function sidoarjo_fsm()
    {
        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Food Service Manager Sidoarjo',
            'menu' => 'sidoarjoFsm'
        ];
        return view('sales.sidoarjo_fsm', $data);
    }

    public function sidoarjo_privatelabel()
    {
        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Private Label Sidoarjo',
            'menu' => 'sidoarjoPrivatelabel'
        ];
        return view('sales.sidoarjo_privatelabel', $data);
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
