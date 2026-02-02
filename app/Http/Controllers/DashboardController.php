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
            
            // Metode sales - gunakan permission parent "sales dashboard view"
            new Middleware('permission:sales dashboard view', only: [
                'sdaAllSales', 
                'sidoarjo_fs', 
                'sidoarjo_distributor', 
                'sidoarjo_retail', 
                'sidoarjo_fsm', 
                'sidoarjo_privatelabel',
            ]),
            
            // Metode logistic - gunakan permission parent "logistic dashboard view"
            new Middleware('permission:logistic dashboard view', only: [
                'logistic_inventory_status', 
                'logistic_inventory_moi'
            ]),

            // Metode operational - gunakan permission parent "operational dashboard view"
            new Middleware('permission:operational dashboard view', only: [
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
            'menu' => $key,
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
            'menu' => $key,
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
            return response()->json(['success' => false, 'message' => 'Input tidak valid.', 'errors' => $validator->errors()], 422);
        }

        $embedCode = $request->input('iframe_code');
        
        // 2. Deteksi tipe embed (auto-detect atau dari input)
        $embedType = $this->dashboardService->detectEmbedType($embedCode);
        
        $src = null;
        $title = null;
        $cleanEmbedCode = null;

        if ($embedType === 'jotform') {
            // Proses JotForm embed
            $dataId = $this->dashboardService->extractJotformDataId($embedCode);
            
            if (!$dataId) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Gagal mengekstrak data-id dari kode JotForm. Pastikan kode embed JotForm sudah benar.'
                ], 400);
            }
            
            // Normalize dan simpan embed code
            $cleanEmbedCode = $this->dashboardService->normalizeJotformCode($embedCode);
            $title = 'JotForm Report (' . $key . ')';
            $src = 'jotform://' . $dataId; // Virtual src for reference
            
        } else {
            // Proses iframe biasa (Power BI, dll)
            $src = $this->dashboardService->extractAttribute($embedCode, 'src');
            $title = $this->dashboardService->extractAttribute($embedCode, 'title');

            if (!$src) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Gagal mengekstrak atribut SRC dari kode iframe. Pastikan tag <iframe> sudah benar.'
                ], 400);
            }

            // Jika title tidak ditemukan, gunakan key sebagai fallback
            if (!$title) {
                $title = 'Dashboard Setting (' . $key . ')'; 
            }
        }

        try {
            // 3. Update atau create data
            $iframe = DashboardSetting::updateOrCreate(
                ['key' => $key],
                [
                    'title' => $title,
                    'src' => $src,
                    'embed_type' => $embedType,
                    'embed_code' => $cleanEmbedCode,
                ]
            );

            return response()->json([
                'success' => true, 
                'message' => 'Data ' . ($embedType === 'jotform' ? 'JotForm' : 'iframe') . ' berhasil diupdate.',
                'iframe' => $iframe, 
            ]);

        } catch (\Exception $e) {
            // Log error untuk debugging yang lebih baik
            \Log::error("Failed to update embed (Key: $key): " . $e->getMessage());
            
            return response()->json(['success' => false, 'message' => 'Gagal mengupdate: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Dynamic menu handler for menus created via Menu Management
     */
    public function dynamicMenu(string $key)
    {
        // Find menu from database
        $menu = \App\Models\DashboardMenu::where('key', $key)->first();
        
        if (!$menu) {
            abort(404, 'Menu tidak ditemukan');
        }

        // Check permission (superadmin/admin bypass)
        $user = auth()->user();
        if (!$user->hasRole('superadmin') && !$user->hasRole('admin')) {
            if (!$user->can($menu->permission_name)) {
                abort(403, 'Anda tidak memiliki akses ke menu ini');
            }
        }

        // Get iframe settings
        $iframe = $this->getIframeByKey($key, $menu->name);

        $data = [
            'title' => $menu->parent ? $menu->parent->name : $menu->name,
            'breadcrumbs' => $menu->name,
            'menu' => $key,
            'iframe' => $iframe,
            'menuItem' => $menu,
        ];

        return view('dynamic.dashboard', $data);
    }
    
}
