@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tambah Barang Masuk </div>
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

    <!-- Repeater Html Start -->
    <div id="repeater">
        <!-- Repeater Heading -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Barang Masuk</h5>
                    <div class="ms-auto d-flex gap-2">
                        <a href="{{url('barang-masuk')}}" class="btn btn-danger px-4" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Kembali">
                            <i class="bi bi-box-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-success repeater-add-btn px-4" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Tambah Barang Masuk">
                            <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                        </button>
                        <button type="submit" class="btn btn-primary px-4" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Simpan">
                            <i class="bi bi-send-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repeater Items -->
        <div class="items" data-group="barang_masuk">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-2">
                            <label for="inputTanggal1" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="inputTanggal1" data-name="tanggal" />
                        </div>
                        <div class="col-md-3">
                            <label for="select2-produk" class="form-label">Produk</label>
                            <select class="form-select" id="select2-produk" data-placeholder="Choose one thing">
                                <option>Reactive</option>
                                <option>Solution</option>
                                <option>Conglomeration</option>
                                <option>Algoritm</option>
                                <option>Holistic</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputJumlah1" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="inputJumlah1" placeholder="0"
                                data-name="jumlah" />
                        </div>
                        <div class="col-md-3">
                            <label for="inputKeterangan1" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="inputKeterangan1"
                                placeholder="Contoh: Dari Palembang" data-name="keterangan" />
                        </div>
                        <div class="col-md-2 text-center">
                            <button class="btn btn-danger remove-btn mt-4 px-3" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Hapus Data">
                                <i class="fadeIn animated bx bx-trash text-light"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Repeater End -->

    @push('scripts')
        <script>
            /* Create Repeater */
            $("#repeater").createRepeater({
                showFirstItemToDefault: true,
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#select2-produk').select2({
                    placeholder: "Pilih salah satu",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection
