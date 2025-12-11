<x-header>{{ $title }}</x-header>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <x-sidebar>{{ $menu }}</x-sidebar>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">

                        <a href="#" class="logo">
                            <img src="{{ asset('template1') }}/img/kaiadmin/logo_light.svg" alt="navbar brand"
                                class="navbar-brand" height="20">
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
                <!-- Navbar Header -->
                <x-navbar />
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <x-breadcrumbs>{{ $breadcrumbs }}</x-breadcrumbs>

                    {{ $slot }}

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Pangan Lestari, PT
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
    @include('auth.changepassword')
    @include('components.alert')


    <x-footer />

    @stack('scripts')
</body>

</html>
