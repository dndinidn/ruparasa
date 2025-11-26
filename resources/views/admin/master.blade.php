<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- === WARNA ORANYE #e06629 UNTUK SIDEBAR === -->
    <style>
        .bg-orange {
            background-color: #f77f00 !important;
            background-image: linear-gradient(180deg, #f77f00 10%, #c75720 100%) !important;
        }

        .sidebar-dark .nav-link,
        .sidebar-dark .nav-link i,
        .sidebar-dark .sidebar-brand-text {
            color: #ffffff !important;
        }

        .sidebar-dark .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }
        /* ==================== GANTI SEMUA WARNA PRIMARY JADI OREN ==================== */

        :root {
            --primary: #e06629;
        }

        .text-primary {
            color: #e06629 !important;
        }

        .bg-primary {
            background-color: #e06629 !important;
        }

        .border-left-primary {
            border-left: .25rem solid #e06629 !important;
        }

        .btn-primary {
            background-color: #e06629 !important;
            border-color: #e06629 !important;
        }

        .btn-primary:hover {
            background-color: #c75720 !important;
            border-color: #c75720 !important;
        }

        .page-item.active .page-link {
            background-color: #e06629 !important;
            border-color: #e06629 !important;
        }

        .card-header.bg-primary,
        .card-header.border-primary {
            background-color: #e06629 !important;
            border-color: #e06629 !important;
        }
        .table-orange {
        background-color: #e06629 !important;
        color: white !important;
        }
        .bg-gradient-orange {
        background-color: #e06629 !important;
        background-image: linear-gradient(180deg, #e06629 10%, #b84f1f 100%) !important;
        color: white !important;
    
    }

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-orange sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">

            <!-- Akun Pengguna -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkun">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Akun Pengguna</span>
                </a>
                <div id="collapseAkun" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.user') }}">Pengguna biasa</a>
                        <a class="collapse-item" href="{{ route('admin.penjual') }}">Penjual</a>
                    </div>
                </div>
            </li>

            <!-- Rupa -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.lihatrupa') }}">
                    <i class="fas fa-fw fa-palette"></i>
                    <span>Rupa</span>
                </a>
            </li>

            <!-- Rasa -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('resep.index') }}">
                    <i class="fas fa-fw fa-utensils"></i>
                    <span>Rasa (Resep)</span>
                </a>
            </li>

            <!-- Agenda -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.agenda.index') }}">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Agenda Budaya</span>
                </a>
            </li>

            <!-- Pustaka -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePustaka">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Pustaka Budaya</span>
                </a>
                <div id="collapsePustaka" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.video.index') }}">
                            <i class="fas fa-fw fa-video mr-2"></i> Video Dokumenter
                        </a>
                        <a class="collapse-item" href="{{ route('admin.artikel.index') }}">
                            <i class="fas fa-fw fa-newspaper mr-2"></i> Artikel
                        </a>
                        <a class="collapse-item" href="{{ route('admin.buku.index') }}">
                            <i class="fas fa-fw fa-book-open mr-2"></i> Buku
                        </a>
                    </div>
                </div>
            </li>

            <!-- Cerita -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCerita">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Cerita</span>
                </a>
                <div id="collapseCerita" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('cerita.index') }}">
                            <i class="fas fa-fw fa-eye mr-2"></i> Lihat Semua Cerita
                        </a>
                        <a class="collapse-item" href="{{ route('lihat.status') }}">
                            <i class="fas fa-fw fa-hourglass-half mr-2"></i> Status cerita
                        </a>
                    </div>
                </div>
            </li>

            <!-- Marketplace -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.marketplace') }}">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Marketplace</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                     src="{{ asset('assets-admin/img/undraw_profile_1.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                @yield('konten')

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RupaRasa 2025</span>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('assets-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets-admin/js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
