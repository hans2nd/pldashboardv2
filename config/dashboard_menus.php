<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sales Dashboard Configuration
    |--------------------------------------------------------------------------
    */
    'sales' => [
        'icon' => 'fas fa-chart-line',
        'label' => 'Sales Dashboard',
        'permission' => 'sales view',
        'collapse_id' => 'salesMenu',
        'children' => [
            'sidoarjo' => [
                'label' => 'Sidoarjo',
                'permission' => 'sales sidoarjo',
                'collapse_id' => 'sidoarjoSubmenu',
                'items' => [
                    'sdaAllSales' => [
                        'label' => 'Over All Channel',
                        'route' => 'dashboard.sdaAllSales',
                        'permission' => 'sales allchannel view',
                    ],
                    'sidoarjoDist' => [
                        'label' => 'Distributor',
                        'route' => 'dashboard.sidoarjo_distributor',
                        'permission' => 'sales dist view',
                    ],
                    'sidoarjoFs' => [
                        'label' => 'Food Services',
                        'route' => 'dashboard.sidoarjo_fs',
                        'permission' => 'sales fs view',
                    ],
                    'sidoarjoPrivatelabel' => [
                        'label' => 'Private Label',
                        'route' => 'dashboard.sidoarjo_privatelabel',
                        'permission' => 'sales plabel view',
                    ],
                    'sidoarjoRetail' => [
                        'label' => 'Retail (MT & GT)',
                        'route' => 'dashboard.sidoarjo_retail',
                        'permission' => 'sales retail view',
                    ],
                    'sidoarjoFsm' => [
                        'label' => 'Food Services Manager',
                        'route' => 'dashboard.sidoarjo_fsm',
                        'permission' => 'sales fsm view',
                    ],
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Logistics Dashboard Configuration
    |--------------------------------------------------------------------------
    */
    'logistics' => [
        'icon' => 'fas fa-car-side',
        'label' => 'Logistic Dashboard',
        'permission' => 'logistic view',
        'collapse_id' => 'logisticMenu',
        'items' => [
            'logistic' => [
                'label' => 'Inventory Status',
                'route' => 'dashboard.logistic_inventory_status',
            ],
            'inventoryMOI' => [
                'label' => 'MOI Inventory',
                'route' => 'dashboard.logistic_inventory_moi',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Operational Dashboard Configuration
    |--------------------------------------------------------------------------
    */
    'operational' => [
        'icon' => 'fas fa-cogs',
        'label' => 'Operational Dashboard',
        'permission' => 'operational view',
        'collapse_id' => 'operationalMenu',
        'items' => [
            'operationalPms' => [
                'label' => 'PMS',
                'route' => 'dashboard.operational_pms',
                'permission' => 'operational pms view',
            ],
        ],
    ],
];
