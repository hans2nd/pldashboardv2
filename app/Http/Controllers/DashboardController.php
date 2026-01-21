<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardSetting;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class DashboardController extends Controller implements HasMiddleware
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    private function getIframeByKey($key, $defaultTitle, $defaultSrc = null)
    {
        return $this->dashboardService->getIframeByKey($key, $defaultTitle, $defaultSrc);
    }

    private function extractAttribute($html, $attribute)
    {
        return $this->dashboardService->extractAttribute($html, $attribute);
    }

    public static function middleware(): array
    {
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

            // Metode operational
            new Middleware('permission:operational view', only: [
                'operationalPms',
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
        $key = 'sdaAllSales';
        $breadcrumbs = 'All Sales Sidoarjo';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => $breadcrumbs,
            'menu' => $key,
            'iframe' => $iframe,
            // 'iframe' => DashboardSetting::all()->first()
        ];
        return view('sales.sdaAllSales', $data);
    }

    public function sidoarjo_fs()
    {
        $key = 'sidoarjoFs';
        $breadcrumbs = 'Food Service Sidoarjo';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Food Service Sidoarjo',
            'menu' => 'sidoarjoFs',
            'iframe' => $iframe
        ];
        return view('sales.sidoarjo_fs', $data);
    }

    public function sidoarjo_distributor()
    {

        $key = 'sidoarjoDist';
        $breadcrumbs = 'Distributor Sidoarjo';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Distributor Sidoarjo',
            'menu' => 'sidoarjoDist',
            'iframe' => $iframe
        ];
        return view('sales.sidoarjo_dist', $data);
    }

    public function sidoarjo_retail()
    {
        $key = 'sidoarjoRetail';
        $breadcrumbs = 'Retail (GT & MT) Sidoarjo';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Retail (GT & MT) Sidoarjo',
            'menu' => 'sidoarjoRetail',
            'iframe' => $iframe
        ];
        return view('sales.sidoarjo_retail', $data);
    }

    public function sidoarjo_fsm()
    {
        $key = 'sidoarjoFsm';
        $breadcrumbs = 'Food Service Manager Sidoarjo';
        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Food Service Manager Sidoarjo',
            'menu' => 'sidoarjoFsm',
            'iframe' => $iframe
        ];
        return view('sales.sidoarjo_fsm', $data);
    }

    public function sidoarjo_privatelabel()
    {
        $key = 'sidoarjoPrivatelabel';
        $breadcrumbs = 'Private Label Sidoarjo';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Sidoarjo Sales',
            'breadcrumbs' => 'Private Label Sidoarjo',
            'menu' => 'sidoarjoPrivatelabel',
            'iframe' => $iframe
        ];
        return view('sales.sidoarjo_privatelabel', $data);
    }

    public function logistic_inventory_status()
    {
        $key = 'logisticInventoryStatus';
        $breadcrumbs = 'Inventory Status';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Dashboard Logistic',
            'breadcrumbs' => 'Inventory Status',
            'menu' => 'logistic',
            'iframe' => $iframe
        ];

        return view('logistics.inventoryStatus',$data);
    }

    public function logistic_inventory_moi()
    {
        $key = 'logisticInventoryMOI';
        $breadcrumbs = 'Inventory MOI';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Dashboard Logistic',
            'breadcrumbs' => 'Inventory MOI',
            'menu' => 'inventoryMOI',
            'iframe' => $iframe
        ];

        return view('logistics.inventoryMOI',$data);
    }

    // ========================
    // OPERATIONAL DASHBOARD
    // ========================

    public function operationalPms()
    {
        $key = 'operationalPms';
        $breadcrumbs = 'PMS';

        $iframe = $this->getIframeByKey($key, $breadcrumbs);

        $data = [
            'title' => 'Operational Dashboard',
            'breadcrumbs' => $breadcrumbs,
            'menu' => $key,
            'iframe' => $iframe
        ];

        return view('operational.pms', $data);
    }

    public function update(Request $request, string $key)
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(), [
            'iframe_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Menggunakan Laravel default response for API
            return response()->json(['success' => false, 'message' => 'Input iframe tidak valid.', 'errors' => $validator->errors()], 422);
        }

        $iframeCode = $request->input('iframe_code');
        
        // 2. Ekstrak 'src' dan 'title' dari kode iframe
        $src = $this->dashboardService->extractAttribute($iframeCode, 'src');
        $title = $this->dashboardService->extractAttribute($iframeCode, 'title');

        if (!$src) {
            return response()->json(['success' => false, 'message' => 'Gagal mengekstrak atribut SRC dari kode iframe. Pastikan tag <iframe> sudah benar.'], 400);
        }

        // Jika title tidak ditemukan, gunakan key sebagai fallback
        if (!$title) {
             $title = 'Dashboard Setting (' . $key . ')'; 
        }

        try {
            // 3. Update atau create data iframe
            $iframe = DashboardSetting::updateOrCreate(
                ['key' => $key],
                [
                    'title' => $title,
                    'src' => $src,
                ]
            );

            return response()->json([
                'success' => true, 
                'message' => 'Data iframe berhasil diupdate.',
                'iframe' => $iframe, 
            ]);

        } catch (\Exception $e) {
            // Log error untuk debugging yang lebih baik
            \Log::error("Failed to update iframe (Key: $key): " . $e->getMessage());
            
            return response()->json(['success' => false, 'message' => 'Gagal mengupdate iframe: ' . $e->getMessage()], 500);
        }
    }
    
}
