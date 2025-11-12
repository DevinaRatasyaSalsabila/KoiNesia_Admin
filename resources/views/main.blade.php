<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Azza Koi Farm</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('template/assets/images/projects/logo2.jpg') }}" type="image/jpg">

    <!--plugins-->
    <link href="{{ asset('template/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/plugins/metismenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/plugins/metismenu/mm-vertical.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.min.css
    " rel="stylesheet">

    <!--bootstrap css-->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">

    <!--main css-->
    <link href="{{ asset('template/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/responsive.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template/assets/css/extra-icons.css') }}">

    {{-- datatable --}}
    {{-- <link href="{{ asset('template/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <link href="{{ asset('template/assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet">

    <style>
        .video-container {
            width: 100%;
            max-width: 600px;
            aspect-ratio: 16 / 9;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 12px;
        }

        .video-preview {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <!--start header-->
    <header class="top-header">
        <nav class="gap-4 navbar navbar-expand align-items-center">
            <div class="btn-toggle">
                <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative">
                    <div class="p-3 search-popup">
                        <div class="overflow-hidden card rounded-4">
                            <div class="card-header d-lg-none">
                                <div class="position-relative">
                                    <input class="px-5 form-control rounded-5 mobile-search-control" type="text"
                                        placeholder="Search">
                                    <span
                                        class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                                    <span
                                        class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 mobile-search-close">close</span>
                                </div>
                            </div>
                            <div class="card-body search-content">
                                <p class="search-title">Recent Searches</p>
                                <div class="flex-wrap gap-2 d-flex align-items-start kewords-wrapper">
                                    <a href="javascript:;" class="kewords"><span>Angular
                                            Template</span><i class="material-icons-outlined fs-6">search</i></a>
                                    <a href="javascript:;" class="kewords"><span>Dashboard</span><i
                                            class="material-icons-outlined fs-6">search</i></a>
                                    <a href="javascript:;" class="kewords"><span>Admin
                                            Template</span><i class="material-icons-outlined fs-6">search</i></a>
                                    <a href="javascript:;" class="kewords"><span>Bootstrap 5
                                            Admin</span><i class="material-icons-outlined fs-6">search</i></a>
                                    <a href="javascript:;" class="kewords"><span>Html
                                            eCommerce</span><i class="material-icons-outlined fs-6">search</i></a>
                                    <a href="javascript:;" class="kewords"><span>Sass</span><i
                                            class="material-icons-outlined fs-6">search</i></a>
                                    <a href="javascript:;" class="kewords"><span>laravel 9</span><i
                                            class="material-icons-outlined fs-6">search</i></a>
                                </div>
                                <hr>
                                <p class="search-title">Tutorials</p>
                                <div class="gap-2 search-list d-flex flex-column">
                                    <div class="gap-3 search-list-item d-flex align-items-center">
                                        <div class="list-icon">
                                            <i class="material-icons-outlined fs-5">play_circle</i>
                                        </div>
                                        <div class="">
                                            <h5 class="mb-0 search-list-title ">Wordpress Tutorials
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="gap-3 search-list-item d-flex align-items-center">
                                        <div class="list-icon">
                                            <i class="material-icons-outlined fs-5">shopping_basket</i>
                                        </div>
                                        <div class="">
                                            <h5 class="mb-0 search-list-title">eCommerce Website
                                                Tutorials</h5>
                                        </div>
                                    </div>

                                    <div class="gap-3 search-list-item d-flex align-items-center">
                                        <div class="list-icon">
                                            <i class="material-icons-outlined fs-5">laptop</i>
                                        </div>
                                        <div class="">
                                            <h5 class="mb-0 search-list-title">Responsive Design
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <p class="search-title">Members</p>

                                <div class="gap-2 search-list d-flex flex-column">
                                    <div class="gap-3 search-list-item d-flex align-items-center">
                                        <div class="memmber-img">
                                            <img src="assets/images/avatars/01.png" width="32" height="32"
                                                class="rounded-circle" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="mb-0 search-list-title ">Andrew Stark</h5>
                                        </div>
                                    </div>

                                    <div class="gap-3 search-list-item d-flex align-items-center">
                                        <div class="memmber-img">
                                            <img src="assets/images/avatars/02.png" width="32" height="32"
                                                class="rounded-circle" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="mb-0 search-list-title ">Snetro Jhonia</h5>
                                        </div>
                                    </div>

                                    <div class="gap-3 search-list-item d-flex align-items-center">
                                        <div class="memmber-img">
                                            <img src="assets/images/avatars/03.png" width="32" height="32"
                                                class="rounded-circle" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="mb-0 search-list-title">Michle Clark</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center bg-transparent card-footer">
                                <a href="javascript:;" class="btn w-100">See All Search
                                    Results</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="gap-1 navbar-nav nav-right-links align-items-center">
                <li class="nav-item d-lg-none mobile-search-btn">
                    <a class="nav-link" href="javascript:;"><i class="material-icons-outlined">search</i></a>
                </li>
                <li class="nav-item dropdown position-static">
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                        data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:;"><i
                            class="material-icons-outlined">notifications</i>
                        <span class="badge-notify">5</span>
                    </a>
                    <div class="shadow dropdown-menu dropdown-notify dropdown-menu-end">
                        <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                            <h5 class="mb-0 notiy-title">Notifications</h5>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret option"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="material-icons-outlined">
                                        more_vert
                                    </span>
                                </button>
                                <div class="shadow dropdown-menu dropdown-option dropdown-menu-end">
                                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center"
                                            href="javascript:;"><i
                                                class="material-icons-outlined fs-6">inventory_2</i>Archive
                                            All</a>
                                    </div>
                                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center"
                                            href="javascript:;"><i
                                                class="material-icons-outlined fs-6">done_all</i>Mark
                                            all as read</a>
                                    </div>
                                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center"
                                            href="javascript:;"><i
                                                class="material-icons-outlined fs-6">mic_off</i>Disable
                                            Notifications</a></div>
                                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center"
                                            href="javascript:;"><i
                                                class="material-icons-outlined fs-6">grade</i>What's
                                            new ?</a></div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center"
                                            href="javascript:;"><i
                                                class="material-icons-outlined fs-6">leaderboard</i>Reports</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="notify-list">
                            <div>
                                <a class="py-2 dropdown-item border-bottom" href="javascript:;">
                                    <div class="gap-3 d-flex align-items-center">
                                        <div class="">
                                            <img src="assets/images/avatars/01.png" class="rounded-circle"
                                                width="45" height="45" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="notify-title">Congratulations Jhon</h5>
                                            <p class="mb-0 notify-desc">Many congtars jhon. You
                                                have won the gifts.</p>
                                            <p class="mb-0 notify-time">Today</p>
                                        </div>
                                        <div class="notify-close position-absolute end-0 me-3">
                                            <i class="material-icons-outlined fs-6">close</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a class="py-2 dropdown-item border-bottom" href="javascript:;">
                                    <div class="gap-3 d-flex align-items-center">
                                        <div class="user-wrapper bg-primary text-primary bg-opacity-10">
                                            <span>RS</span>
                                        </div>
                                        <div class="">
                                            <h5 class="notify-title">New Account Created</h5>
                                            <p class="mb-0 notify-desc">From USA an user has
                                                registered.</p>
                                            <p class="mb-0 notify-time">Yesterday</p>
                                        </div>
                                        <div class="notify-close position-absolute end-0 me-3">
                                            <i class="material-icons-outlined fs-6">close</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a class="py-2 dropdown-item border-bottom" href="javascript:;">
                                    <div class="gap-3 d-flex align-items-center">
                                        <div class="">
                                            <img src="assets/images/apps/13.png" class="rounded-circle"
                                                width="45" height="45" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="notify-title">Payment Recived</h5>
                                            <p class="mb-0 notify-desc">New payment recived
                                                successfully</p>
                                            <p class="mb-0 notify-time">1d ago</p>
                                        </div>
                                        <div class="notify-close position-absolute end-0 me-3">
                                            <i class="material-icons-outlined fs-6">close</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a class="py-2 dropdown-item border-bottom" href="javascript:;">
                                    <div class="gap-3 d-flex align-items-center">
                                        <div class="">
                                            <img src="assets/images/apps/14.png" class="rounded-circle"
                                                width="45" height="45" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="notify-title">New Order Recived</h5>
                                            <p class="mb-0 notify-desc">Recived new order from
                                                michle</p>
                                            <p class="mb-0 notify-time">2:15 AM</p>
                                        </div>
                                        <div class="notify-close position-absolute end-0 me-3">
                                            <i class="material-icons-outlined fs-6">close</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a class="py-2 dropdown-item border-bottom" href="javascript:;">
                                    <div class="gap-3 d-flex align-items-center">
                                        <div class="">
                                            <img src="assets/images/avatars/06.png" class="rounded-circle"
                                                width="45" height="45" alt="">
                                        </div>
                                        <div class="">
                                            <h5 class="notify-title">Congratulations Jhon</h5>
                                            <p class="mb-0 notify-desc">Many congtars jhon. You
                                                have won the gifts.</p>
                                            <p class="mb-0 notify-time">Today</p>
                                        </div>
                                        <div class="notify-close position-absolute end-0 me-3">
                                            <i class="material-icons-outlined fs-6">close</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a class="py-2 dropdown-item" href="javascript:;">
                                    <div class="gap-3 d-flex align-items-center">
                                        <div class="user-wrapper bg-danger text-danger bg-opacity-10">
                                            <span>PK</span>
                                        </div>
                                        <div class="">
                                            <h5 class="notify-title">New Account Created</h5>
                                            <p class="mb-0 notify-desc">From USA an user has
                                                registered.</p>
                                            <p class="mb-0 notify-time">Yesterday</p>
                                        </div>
                                        <div class="notify-close position-absolute end-0 me-3">
                                            <i class="material-icons-outlined fs-6">close</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link position-relative" data-bs-toggle="offcanvas" href="#offcanvasCart"><i
                            class="material-icons-outlined">shopping_cart</i>
                        <span class="badge-notify bg-dark">8</span>
                    </a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <img src="{{ asset('template/assets/images/avatars/01.png') }}"
                            class="p-1 border rounded-circle" width="45" height="45">
                    </a>
                    <div class="shadow dropdown-menu dropdown-user dropdown-menu-end">
                        <a class="gap-2 py-2 dropdown-item" href="javascript:;">
                            <div class="text-center">
                                <img src="{{ asset('template/assets/images/avatars/01.png') }}"
                                    class="p-1 mb-3 shadow rounded-circle" width="90" height="90"
                                    alt="">
                                @if (Auth::check())
                                    <h5 class="mb-0 user-name fw-bold">Hello, {{ auth()->user()->nama }}</h5>
                                @else
                                    <h5 class="mb-0 user-name fw-bold">Hello, user</h5>
                                @endif
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="material-icons-outlined">power_settings_new</i>Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <!--end top header-->


    <!--start sidebar-->
    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="logo-icon">
                <img src="{{ asset('template/assets/images/projects/logo.jpg') }}" class="logo-img" alt="">
                {{-- <h3></h3> --}}
            </div>
            <div class="logo-name flex-grow-1">
                <h5 class="mb-0">Azza Koi Farm</h5>
            </div>
            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
        </div>
        <div class="sidebar-nav" data-simplebar="true">
            <!--navigation-->
            <ul class="metismenu" id="sidenav">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">home</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('produk.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">widgets</i>
                        </div>
                        <div class="menu-title">Daftar Barang</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('barang-masuk.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">inventory_2</i>
                        </div>
                        <div class="menu-title">Barang Masuk</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengeluaran.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">join_right</i>
                        </div>
                        <div class="menu-title">Pengeluaran</div>
                    </a>
                </li>
                <li class="menu-label">Transaksi</li>
                <li>
                    <a href="{{ route('pesanan.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">shopping_bag</i>
                        </div>
                        <div class="menu-title">Pesanan</div>
                    </a>
                </li>

                <li>
                    <a href="#" class="has-arrow">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">apps</i>
                        </div>
                        <div class="menu-title">Laporan</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('riwayat.index') }}">
                                <i class="material-icons-outlined">arrow_right</i>
                                Riwayat Transaksi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rekap.index') }}">
                                <i class="material-icons-outlined">arrow_right</i>
                                Rekap Penjualan
                            </a>
                        </li>
                    </ul>
                    <!--end navigation-->
                </li>
            </ul>
        </div>
        <div class="gap-4 sidebar-bottom">
            <div class="dark-mode">
                <a href="javascript:;" class="footer-icon dark-mode-icon">
                    <i class="material-icons-outlined">dark_mode</i>
                </a>
            </div>
            <div class="dropdown dropup-center dropup dropdown-laungauge">
                <a class="dropdown-toggle dropdown-toggle-nocaret footer-icon" href="avascript:;"
                    data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22" alt="">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/01.png" width="20" alt=""><span
                                class="ms-2">English</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/02.png" width="20" alt=""><span
                                class="ms-2">Catalan</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/03.png" width="20" alt=""><span
                                class="ms-2">French</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/04.png" width="20" alt=""><span
                                class="ms-2">Belize</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/05.png" width="20" alt=""><span
                                class="ms-2">Colombia</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/06.png" width="20" alt=""><span
                                class="ms-2">Spanish</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/07.png" width="20" alt=""><span
                                class="ms-2">Georgian</span></a>
                    </li>
                    <li><a class="py-2 dropdown-item d-flex align-items-center" href="javascript:;"><img
                                src="assets/images/county/08.png" width="20" alt=""><span
                                class="ms-2">Hindi</span></a>
                    </li>
                </ul>
            </div>
            <div class="dropdown dropup-center dropup dropdown-help">
                <a class="footer-icon dropdown-toggle dropdown-toggle-nocaret option" href="javascript:;"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-icons-outlined">
                        info
                    </span>
                </a>
                <div class="shadow dropdown-menu dropdown-option dropdown-menu-end">
                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center" href="javascript:;"><i
                                class="material-icons-outlined fs-6">inventory_2</i>Archive All</a>
                    </div>
                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center" href="javascript:;"><i
                                class="material-icons-outlined fs-6">done_all</i>Mark all as
                            read</a></div>
                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center" href="javascript:;"><i
                                class="material-icons-outlined fs-6">mic_off</i>Disable
                            Notifications</a></div>
                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center" href="javascript:;"><i
                                class="material-icons-outlined fs-6">grade</i>What's new ?</a>
                    </div>
                    <div>
                        <hr class="dropdown-divider">
                    </div>
                    <div><a class="gap-2 py-2 dropdown-item d-flex align-items-center" href="javascript:;"><i
                                class="material-icons-outlined fs-6">leaderboard</i>Reports</a>
                    </div>
                </div>
            </div>

        </div>
    </aside>
    <!--end sidebar-->


    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            @yield('content')
        </div>
    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--start footer-->
    <footer class="text-center page-footer bg-light border-top fixed-bottom">
        <p class="mb-0">Copyright © 2025. CodeWave.</p>
    </footer>
    <!--top footer-->

    <!--start cart-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart">
        <div class="offcanvas-header border-bottom h-70 justify-content-between">
            <h5 class="mb-0" id="offcanvasRightLabel">8 New Orders</h5>
            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
                <i class="material-icons-outlined">close</i>
            </a>
        </div>
        <div class="p-0 offcanvas-body">
            <div class="order-list">
                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/01.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">White Men Shoes</h5>
                        <p class="mb-0 order-price">$289</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/02.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Red Airpods</h5>
                        <p class="mb-0 order-price">$149</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/03.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Men Polo Tshirt</h5>
                        <p class="mb-0 order-price">$139</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/04.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Blue Jeans Casual</h5>
                        <p class="mb-0 order-price">$485</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/05.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Fancy Shirts</h5>
                        <p class="mb-0 order-price">$758</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/06.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Home Sofa Set </h5>
                        <p class="mb-0 order-price">$546</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/07.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Black iPhone</h5>
                        <p class="mb-0 order-price">$1049</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="gap-3 p-3 order-item d-flex align-items-center border-bottom">
                    <div class="order-img">
                        <img src="assets/images/orders/08.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Goldan Watch</h5>
                        <p class="mb-0 order-price">$689</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 offcanvas-footer h-70 border-top">
            <div class="d-grid">
                <button type="button" class="btn btn-dark" data-bs-dismiss="offcanvas">View
                    Products</button>
            </div>
        </div>
    </div>
    <!--end cart-->


    <!--start switcher-->
    <button class="bottom-0 gap-2 m-3 btn btn-primary position-fixed end-0 d-flex align-items-center" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop">
        <i class="material-icons-outlined">tune</i>Customize
    </button>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">
        <div class="offcanvas-header border-bottom h-70 justify-content-between">
            <div class="">
                <h5 class="mb-0">Theme Customizer</h5>
                <p class="mb-0">Customize your theme</p>
            </div>
            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
                <i class="material-icons-outlined">close</i>
            </a>
        </div>
        <div class="offcanvas-body">
            <div>
                <p>Theme variation</p>

                <div class="row g-3">
                    <div class="col-12 col-xl-6">
                        <input type="radio" class="btn-check" name="theme-options" id="LightTheme" checked>
                        <label
                            class="gap-1 p-4 btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center"
                            for="LightTheme">
                            <span class="material-icons-outlined">light_mode</span>
                            <span>Light</span>
                        </label>
                    </div>
                    <div class="col-12 col-xl-6">
                        <input type="radio" class="btn-check" name="theme-options" id="DarkTheme">
                        <label
                            class="gap-1 p-4 btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center"
                            for="DarkTheme">
                            <span class="material-icons-outlined">dark_mode</span>
                            <span>Dark</span>
                        </label>
                    </div>
                    <div class="col-12 col-xl-6">
                        <input type="radio" class="btn-check" name="theme-options" id="SemiDarkTheme">
                        <label
                            class="gap-1 p-4 btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center"
                            for="SemiDarkTheme">
                            <span class="material-icons-outlined">contrast</span>
                            <span>Semi Dark</span>
                        </label>
                    </div>
                    <div class="col-12 col-xl-6">
                        <input type="radio" class="btn-check" name="theme-options" id="BoderedTheme">
                        <label
                            class="gap-1 p-4 btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center"
                            for="BoderedTheme">
                            <span class="material-icons-outlined">border_style</span>
                            <span>Bordered</span>
                        </label>
                    </div>
                </div><!--end row-->

            </div>
        </div>
    </div>
    <!--start switcher-->

    <script src="{{ asset('template/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    {{-- ====== Buttons (Export) ====== --}}
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    {{-- select 2 --}}
    <script src="
                        https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js
                        "></script>
    <script src="{{ asset('template/assets/plugins/select2/js/select2-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('template/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>

    <!--main js-->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

    {{-- datatable --}}
    {{-- <script src="{{ asset('template/assets/plugins/datatable/js/jquery.dataTables.min.js') }}">
    </script>
    <script src="{{ asset('template/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}">
    </script> --}}
    <script src="{{ asset('template/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>

    <script src="{{ asset('template/assets/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/chartjs/js/chartjs-custom.js') }}"></script>

    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>

    {{-- validation --}}
    <script src="{{ asset('template/assets/plugins/validation/validation-script.js') }}"></script>

    {{-- upload --}}
    <script src="{{ asset('template/assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>

    <script src="{{ asset('template/assets/plugins/form-repeater/repeater.js') }}"></script>
    @stack('scripts')
</body>

</html>
