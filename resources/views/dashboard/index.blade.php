@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">KoiNesia</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


    <div class="row">
        <!-- Kiri: 2 Card -->
        <div class="col-12 col-xl-4 d-flex flex-column gap-3">
            <!-- Card 1 -->
            <div class="card rounded-4 w-100">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- ICON -->
                        <div
                            class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle mb-2">
                            {{-- <span class="">favorite_border</span> --}}
                            <i class="lni lni-page-break text-danger fs-1"></i>
                        </div>
                        <!-- ANGKA & TEKS -->
                        <h4 class="mb-0">45.6K</h4>
                        <p class="mb-0">Total Produk</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card rounded-4 w-100">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- ICON -->
                        <div
                            class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle mb-2">
                            {{-- <span class="">favorite_border</span> --}}
                            <i class="lni lni-page-break text-danger fs-1"></i>
                        </div>
                        <!-- ANGKA & TEKS -->
                        <h4 class="mb-0">45.6K</h4>
                        <p class="mb-0">Total Produk</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Popular Products -->
        <div class="col-12 col-xl-8 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Popular Products</h5>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- List Produk -->
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('template/assets/images/orders/01.png') }}" width="78" class="rounded-3"
                                alt="">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">Apple Hand Watch</h6>
                                <p class="mb-0">Sale: 258</p>
                            </div>
                            <div>
                                <h6 class="mb-0">$199</h6>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('template/assets/images/orders/08.png') }}" width="78" class="rounded-3"
                                alt="">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">Mobile Phone Set</h6>
                                <p class="mb-0">Sale: 169</p>
                            </div>
                            <div>
                                <h6 class="mb-0">$159</h6>
                            </div>
                        </div>

                        <!-- Tambah produk lainnya di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->

    <div class="row">
        <!-- Kiri: 2 Card -->
        <div class="col-12 col-xl-4 d-flex flex-column gap-3">
            <!-- Card 1 -->
            <div class="card rounded-4 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">favorite_border</span>
                        </div>
                        <div class="">
                            <div class="d-flex align-items-center align-self-end text-success mb-1">
                            </div>
                            <h4 class="mb-0">45.6K</h4>
                            <p class="mb-0">Total Hearts</p>
                        </div>
                    </div>
                    <p class="mb-0">Average Weekly Sales</p>
                    <div id="chart1"></div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card rounded-4 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div
                            class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                            <span class="material-icons-outlined">favorite_border</span>
                        </div>
                        <div class="">
                            <div class="d-flex align-items-center align-self-end text-success mb-1">
                            </div>
                            <h4 class="mb-0">45.6K</h4>
                            <p class="mb-0">Total Hearts</p>
                        </div>
                    </div>
                    <p class="mb-0">Monthly Revenue</p>
                    <div id="chart2"></div>
                </div>
            </div>
        </div>

        <!-- Kanan: Popular Products -->
        <div class="col-12 col-xl-8 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Popular Products</h5>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- List Produk -->
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('template/assets/images/orders/01.png') }}" width="78"
                                class="rounded-3" alt="">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">Apple Hand Watch</h6>
                                <p class="mb-0">Sale: 258</p>
                            </div>
                            <div>
                                <h6 class="mb-0">$199</h6>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('template/assets/images/orders/08.png') }}" width="78"
                                class="rounded-3" alt="">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">Mobile Phone Set</h6>
                                <p class="mb-0">Sale: 169</p>
                            </div>
                            <div>
                                <h6 class="mb-0">$159</h6>
                            </div>
                        </div>

                        <!-- Tambah produk lainnya di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->
@endsection
