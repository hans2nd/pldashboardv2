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

                @php
                    $dashboardMenus = config('dashboard_menus', []);
                @endphp

                {{-- Sales Dashboard --}}
                @if(isset($dashboardMenus['sales']))
                    @can($dashboardMenus['sales']['permission'])
                        <x-sidebar-menu-item 
                            :menuKey="'sales'" 
                            :menu="$dashboardMenus['sales']" 
                            :activeMenu="$slot->toHtml()" 
                        />
                    @endcan
                @endif

                {{-- Logistics Dashboard --}}
                @if(isset($dashboardMenus['logistics']))
                    @can($dashboardMenus['logistics']['permission'])
                        <x-sidebar-menu-item 
                            :menuKey="'logistics'" 
                            :menu="$dashboardMenus['logistics']" 
                            :activeMenu="$slot->toHtml()" 
                        />
                    @endcan
                @endif

                {{-- Operational Dashboard --}}
                @if(isset($dashboardMenus['operational']))
                    @can($dashboardMenus['operational']['permission'])
                        <x-sidebar-menu-item 
                            :menuKey="'operational'" 
                            :menu="$dashboardMenus['operational']" 
                            :activeMenu="$slot->toHtml()" 
                        />
                    @endcan
                @endif


                @can('users view')
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
