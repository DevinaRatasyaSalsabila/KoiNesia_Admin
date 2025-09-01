@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Produk</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        KoiNesia
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <a href="{{ url('produk/tambah') }}" class="btn btn-warning btn-sm px-3 shadow-sm my-2" data-bs-toggle="tooltip"
        data-bs-placement="top" title="Tambah Produk">
        <i class="bx bx-plus fs-5 text-light"></i>
    </a>

    <div class="row row-cols-1 row-cols-xl-3 g-4 mb-3">
        <div class="col">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4 text-center p-3">
                        <img src="{{ asset('template/assets/images/projects/koi1.png') }}" class="img-fluid rounded"
                            alt="Produk">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">Ikan Koi Ukuran 39</h5>
                            <span class="badge bg-secondary mb-2 px-3 p-1 fs-6 shadow-sm">
                                Stok: 20
                            </span>
                            <h6 class="fw-bold">
                                Harga :
                                <span class="text-primary">
                                    Rp12.000.000
                                </span>
                            </h6>
                            <div class="d-flex gap-2">
                                <a href="{{ url('produk/detail') }}"
                                    class="btn btn-primary btn-sm px-3 shadow-sm d-flex align-items-center gap-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Produk">
                                    <i class="bx bx-info-circle fs-5"></i>
                                </a>
                                <a href="{{ url('produk/edit') }}" class="btn btn-warning btn-sm px-3 shadow-sm"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Produk">
                                    <i class="bx bx-pencil fs-5 text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm px-3 shadow-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus Produk">
                                    <i class="bx bx-trash fs-5 text-light"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4 text-center p-3">
                        <img src="{{ asset('template/assets/images/projects/koi1.png') }}" class="img-fluid rounded"
                            alt="Produk">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">Ikan Koi Ukuran 39</h5>
                            <span class="badge bg-secondary mb-2 px-3 p-1 fs-6 shadow-sm">
                                Stok: 20
                            </span>
                            <h6 class="fw-bold">
                                Harga :
                                <span class="text-primary">
                                    Rp12.000.000
                                </span>
                            </h6>
                            <div class="d-flex gap-2">
                                <a href="{{ url('produk/detail') }}"
                                    class="btn btn-primary btn-sm px-3 shadow-sm d-flex align-items-center gap-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Produk">
                                    <i class="bx bx-info-circle fs-5"></i>
                                </a>
                                <a href="{{ url('produk/edit') }}" class="btn btn-warning btn-sm px-3 shadow-sm"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Produk">
                                    <i class="bx bx-pencil fs-5 text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm px-3 shadow-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus Produk">
                                    <i class="bx bx-trash fs-5 text-light"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4 text-center p-3">
                        <img src="{{ asset('template/assets/images/projects/koi1.png') }}" class="img-fluid rounded"
                            alt="Produk">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">Ikan Koi Ukuran 39</h5>
                            <span class="badge bg-secondary mb-2 px-3 p-1 fs-6 shadow-sm">
                                Stok: 20
                            </span>
                            <h6 class="fw-bold">
                                Harga :
                                <span class="text-primary">
                                    Rp12.000.000
                                </span>
                            </h6>
                            <div class="d-flex gap-2">
                                <a href="{{ url('produk/detail') }}"
                                    class="btn btn-primary btn-sm px-3 shadow-sm d-flex align-items-center gap-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Produk">
                                    <i class="bx bx-info-circle fs-5"></i>
                                </a>
                                <a href="{{ url('produk/edit') }}" class="btn btn-warning btn-sm px-3 shadow-sm"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Produk">
                                    <i class="bx bx-pencil fs-5 text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm px-3 shadow-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus Produk">
                                    <i class="bx bx-trash fs-5 text-light"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
