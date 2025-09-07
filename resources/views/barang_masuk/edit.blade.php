@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Barang Masuk </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Azza Koi Farm
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div>
        <!-- Repeater Heading -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Barang Masuk</h5>
                    <div class="ms-auto d-flex gap-2">
                        <a href="{{ url('barang-masuk') }}" class="btn btn-danger px-4" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Kembali">
                            <i class="bi bi-box-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary px-4" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Simpan">
                            <i class="bi bi-send-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repeater Items -->
        <div class="items" data-group="pesanan">
            <div class="card">
                <div class="card-body">
                    <!-- Repeater Content -->
                    <div class="item-content">
                        <div class="mb-3">
                            <label for="inputTanggal1" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="inputTanggal1" data-name="tanggal" value=""/>
                        </div>
                        <div class="mb-3">
                            <label for="select2-produk" class="form-label">Produk</label>
                            <select name="" class="form-select" id="select2-produk" data-placeholder="Choose one thing">
                                <option>Reactive</option>
                                <option>Solution</option>
                                <option>Conglomeration</option>
                                <option>Algoritm</option>
                                <option>Holistic</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputJumlah1" class="form-label">Jumlah Barang</label>
                            <input name="" type="number" class="form-control" id="inputJumlah1" placeholder="0"
                                data-name="jumlah" />
                        </div>
                        <div class="mb-3">
                            <label for="inputKeterangan1" class="form-label">Keterangan</label>
                            <textarea name="" class="form-control" id="inputKeterangan1" rows="2" placeholder="Contoh: Dari Palembang"
                                data-name="keterangan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
