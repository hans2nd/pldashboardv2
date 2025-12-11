<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <a href="{{ route('dashboard.index') }}" class="logo">
                <img src="{{ asset('assets/template1') }}/img/kaiadmin/images.png" alt="navbar brand" class="navbar-brand"
                    height="40" width="180">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                @can('sales view')
                    <li
                        class="nav-item {{ in_array($slot, ['allSalesSda', 'sidoarjoFs', 'sidoarjoDist', 'sidoarjoRetail', 'sidoarjoFsm', 'sidoarjoPrivatelabel']) ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#submenu">
                            <i class="fas fa-chart-line"></i>
                            <p>Sales Dashboard</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ in_array($slot, ['allSalesSda', 'sidoarjoFs', 'sidoarjoDist', 'sidoarjoRetail', 'sidoarjoFsm', 'sidoarjoPrivatelabel']) ? 'show' : '' }}"
                            id="submenu">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-bs-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Sidoarjo</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse {{ in_array($slot, ['allSalesSda', 'sidoarjoFs', 'sidoarjoDist', 'sidoarjoRetail', 'sidoarjoFsm', 'sidoarjoPrivatelabel']) ? 'show' : '' }}"
                                        id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li class="nav-item {{ $slot == 'allSalesSda' ? 'active' : '' }}">
                                                <a href="{{ route('dashboard.sdaAllSales') }}">
                                                    <span class="sub-item">Over All Channel</span>
                                                </a>
                                            </li>

                                            <li class="nav-item {{ $slot == 'sidoarjoDist' ? 'active' : '' }}">
                                                <a href="{{ route('dashboard.sidoarjo_distributor') }}">
                                                    <span class="sub-item">Distributor</span>
                                                </a>
                                            </li>

                                            <li class="nav-item {{ $slot == 'sidoarjoFs' ? 'active' : '' }}">
                                                <a href="{{ route('dashboard.sidoarjo_fs') }}">
                                                    <span class="sub-item">Food Services</span>
                                                </a>
                                            </li>

                                            <li class="nav-item {{ $slot == 'sidoarjoPrivatelabel' ? 'active' : '' }}">
                                                <a href="{{ route('dashboard.sidoarjo_privatelabel') }}">
                                                    <span class="sub-item">Private Label</span>
                                                </a>
                                            </li>

                                            <li class="nav-item {{ $slot == 'sidoarjoRetail' ? 'active' : '' }}">
                                                <a href="{{ route('dashboard.sidoarjo_retail') }}">
                                                    <span class="sub-item">Retail (MT & GT)</span>
                                                </a>
                                            </li>


                                            <li class="nav-item {{ $slot == 'sidoarjoFsm' ? 'active' : '' }}">
                                                <a href="{{ route('dashboard.sidoarjo_fsm') }}">
                                                    <span class="sub-item">Food Services Manager</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('logistic view')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#submenu">
                            <i class="fas fa-car-side"></i>
                            <p>Logistic Dashboard</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $slot == 'logistic' || $slot == 'inventoryMOI' ? 'show' : '' }}"
                            id="submenu">
                            <ul class="nav nav-collapse">
                                <li class="nav-item {{ $slot == 'logistic' ? 'active' : '' }}">
                                    <a href="{{ route('dashboard.logistic_inventory_status') }}">
                                        <span class="sub-item">Inventory Status</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ $slot == 'inventoryMOI' ? 'active' : '' }}">
                                    <a href="{{ route('dashboard.logistic_inventory_moi') }}">
                                        <span class="sub-item">MOI Inventory</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan


                @can('user view')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Master Data</h4>
                    </li>


                    <li class="nav-item {{ $slot == 'users' ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endcan


                @can('role view')
                    <li class="nav-item {{ $slot == 'roles' ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fas fa-lock"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endcan


                @can('permission view')
                    <li class="nav-item {{ $slot == 'permissions' ? 'active' : '' }}">
                        <a href="{{ route('permissions.index') }}">
                            <i class="fas fa-check-square"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
