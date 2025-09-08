@extends('main')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Detail Produk</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- Gambar Produk -->
    <div class="row mb-4 text-center">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <img src="{{ asset('template/assets/images/projects/koi1.png') }}"
                        alt="Koi Kohaku Jumbo" class="img-fluid rounded-3"
                        style="max-height: 280px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="row g-4 mb-4">
        <!-- Card Kiri -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100 rounded-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted mb-3">Informasi Produk</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Produk</label>
                        <input type="text" class="form-control bg-light" value="{{$produk->kode_produk}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="text" class="form-control bg-light" value="{{$produk->stok_produk}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="p-3 text-white rounded text-center fs-5 fw-bold" style="background-color: rgb(43, 115, 214)">
                          {{$produk->harga_Satuan}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Kanan -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100 rounded-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted mb-3">Detail Tambahan</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" class="form-control bg-light" value="{{$produk->nama_produk}}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ukuran</label>
                        <input type="text" class="form-control bg-light" value="{{$produk->ukuran_produk}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <div class="p-3 bg-light rounded" style="min-height: 120px;">
                         {{$produk->deskripsi_produk}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="produk" class="btn btn-outline-secondary px-4 rounded-pill shadow-sm">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Produk
            </a>
        </div>
    </div>
@endsection
