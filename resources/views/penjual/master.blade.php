<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjual Dashboard</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('assets-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- ==== WARNA ORANYE CUSTOM ==== -->
    <style>
        /* Sidebar jadi oranye */
        .bg-gradient-primary {
            background: linear-gradient(180deg, #e06629 10%, #cc5a25 100%) !important;
        }

        /* Warna teks sidebar */
        .sidebar .nav-item .nav-link,
        .sidebar-brand-text {
            color: #fff !important;
        }

        /* Hover sidebar */
        .sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Menu collapse inner */
        .collapse-inner a {
            color: #e06629 !important;
        }
        .collapse-inner a:hover {
            background-color: #ffe1d0 !important;
        }

        /* Topbar border */
        .topbar {
            border-bottom: 3px solid #e06629 !important;
        }

        /* Icon sidebar */
        .sidebar .nav-item .nav-link i {
            color: #ffffff !important;
        }

        /* Active link */
        .sidebar .nav-item.active .nav-link {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: #fff !important;
        }

        /* Text abu-abu */
        .text-gray-600 {
            color: #444 !important;
        }

        /* ============================
           FIX WARNA DROPDOWN LOGOUT
        ============================= */

        /* Warna teks dropdown */
        .dropdown-menu .dropdown-item {
            color: #e06629 !important;
        }

        /* Ikon di dropdown */
        .dropdown-menu .dropdown-item i {
            color: #e06629 !important;
        }

        /* Hover dropdown */
        .dropdown-menu .dropdown-item:hover {
            background-color: #ffe1d0 !important;
            color: #e06629 !important;
        }

        /* Hover ikon */
        .dropdown-menu .dropdown-item:hover i {
            color: #e06629 !important;
        }

    </style>
    <!-- ==== END ORANGE THEME ==== -->

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('penjual.dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Penjual</div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penjual.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Marketplace -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('produk.index') }}">
                <i class="fas fa-fw fa-store"></i>
                <span>Marketplace</span>
            </a>
        </li>

        <!-- Daftar Pesanan -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePesanan"
                aria-expanded="true" aria-controls="collapsePesanan">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Daftar Pesanan</span>
            </a>
            <div id="collapsePesanan" class="collapse" aria-labelledby="headingPesanan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('penjual.pesanan') }}?filter=cod">
                        <i class="fas fa-fw fa-box mr-2"></i> Konfirmasi Pesanan 
                    </a>
                    <a class="collapse-item" href="{{ route('pesanan.lihat') }}?filter=transfer">
                        <i class="fas fa-fw fa-shopping-cart mr-2"></i> Daftar Pesanan
                    </a>
                </div>
            </div>
        </li>

    </ul>
    <!-- End Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- User -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                {{ auth()->user()->name ?? 'Penjual' }}
                            </span>
                            <img class="img-profile rounded-circle" src="{{ asset('assets-admin/img/undraw_profile_1.svg') }}">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                            <a class="dropdown-item" href="{{ route('penjual.profile.edit') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2"></i> Profil Toko
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
                            </a>
                        </div>

                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid">
                @yield('konten')
            </div>

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto text-center">
                <span>Copyright &copy; Jobsy 2025</span>
            </div>
        </footer>

    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<!-- Scripts -->
<script src="{{ asset('assets-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
