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

                {{-- All Menus from Database --}}
                @php
                    $dbMenus = \App\Models\DashboardMenu::root()->active()->with(['activeChildren' => function($q) {
                        $q->with('activeChildren');
                    }])->orderBy('order')->get();
                    $isSuperAdmin = auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin');
                    
                    // Helper function to get dynamic menu URL
                    $getDynamicMenuUrl = function($menuKey, $customRoute = null) {
                        if (!empty($customRoute) && \Illuminate\Support\Facades\Route::has($customRoute)) {
                            return route($customRoute);
                        }
                        return route('dashboard.dynamic_menu', ['key' => $menuKey]);
                    };
                @endphp
                
                @foreach($dbMenus as $dbMenu)
                    @if($isSuperAdmin || auth()->user()->can($dbMenu->permission_name))
                        @if($dbMenu->hasChildren())
                            {{-- Menu with children --}}
                            @php
                                $allChildKeys = collect();
                                foreach($dbMenu->activeChildren as $child) {
                                    $allChildKeys->push($child->key);
                                    foreach($child->activeChildren as $grandchild) {
                                        $allChildKeys->push($grandchild->key);
                                    }
                                }
                                $isMenuActive = $allChildKeys->contains($slot->toHtml());
                            @endphp
                            <li class="nav-item {{ $isMenuActive ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#dbMenu{{ $dbMenu->id }}">
                                    <i class="{{ $dbMenu->icon ?? 'fas fa-folder' }}"></i>
                                    <p>{{ $dbMenu->name }}</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ $isMenuActive ? 'show' : '' }}" id="dbMenu{{ $dbMenu->id }}">
                                    <ul class="nav nav-collapse">
                                        @foreach($dbMenu->activeChildren as $child)
                                            @if($isSuperAdmin || auth()->user()->can($child->permission_name))
                                                @if($child->activeChildren->count() > 0)
                                                    {{-- Sub-submenu (3 level) --}}
                                                    @php
                                                        $isChildActive = $child->activeChildren->pluck('key')->contains($slot->toHtml());
                                                    @endphp
                                                    <li class="nav-item {{ $isChildActive ? 'active' : '' }}">
                                                        <a data-bs-toggle="collapse" href="#dbSubMenu{{ $child->id }}">
                                                            <span class="sub-item">{{ $child->name }}</span>
                                                            <span class="caret"></span>
                                                        </a>
                                                        <div class="collapse {{ $isChildActive ? 'show' : '' }}" id="dbSubMenu{{ $child->id }}">
                                                            <ul class="nav nav-collapse subnav">
                                                                @foreach($child->activeChildren as $grandchild)
                                                                    @if($isSuperAdmin || auth()->user()->can($grandchild->permission_name))
                                                                        <li class="{{ $slot->toHtml() === $grandchild->key ? 'active' : '' }}">
                                                                            <a href="{{ $getDynamicMenuUrl($grandchild->key, $grandchild->route) }}">
                                                                                <span class="sub-item">{{ $grandchild->name }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @else
                                                    {{-- Regular child item --}}
                                                    <li class="{{ $slot->toHtml() === $child->key ? 'active' : '' }}">
                                                        <a href="{{ $getDynamicMenuUrl($child->key, $child->route) }}">
                                                            <span class="sub-item">{{ $child->name }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            {{-- Single menu item without children --}}
                            <li class="nav-item {{ $slot->toHtml() === $dbMenu->key ? 'active' : '' }}">
                                <a href="{{ $getDynamicMenuUrl($dbMenu->key, $dbMenu->route) }}">
                                    <i class="{{ $dbMenu->icon ?? 'fas fa-file' }}"></i>
                                    <p>{{ $dbMenu->name }}</p>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach


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

                @can('menu view')
                    <li class="nav-item {{ $slot == 'menus' ? 'active' : '' }}">
                        <a href="{{ route('menus.index') }}">
                            <i class="fas fa-bars"></i>
                            <p>Menu Management</p>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
