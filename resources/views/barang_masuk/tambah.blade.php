@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Tambah Barang Masuk </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
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

    <!-- Repeater Html Start -->
    <div id="repeater">
        <form action="{{ route('barang-masuk.store') }}" method="POST">
            @csrf
            <!-- Repeater Heading -->
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Barang Masuk</h5>
                        <div class="gap-2 ms-auto d-flex">
                            <a href="{{ url('barang-masuk') }}" class="px-4 btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Kembali">
                                <i class="bi bi-box-arrow-left"></i>
                            </a>
                            <button type="button" class="px-4 btn btn-success repeater-add-btn" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Tambah Barang Masuk">
                                <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                            </button>
                            <button type="submit" class="px-4 btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Simpan">
                                <i class="bi bi-send-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Repeater Items -->
            <div class="items" data-group="barang_masuk">
                <div class="mb-2 card">
                    <div class="card-body">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2">
                                <label for="inputTanggal1" class="form-label">Tanggal</label>
                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="inputTanggal1"/>
                            </div>
                            <div class="col-md-3">
                                <label for="select2-produk" class="form-label">Produk</label>
                                <select class="form-select" name="kode_produk" id="select2-produk"
                                    data-placeholder="Choose one thing">
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputJumlah1" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="inputJumlah1" placeholder="0"
                                    name="total_produk" />
                            </div>
                            <div class="col-md-3">
                                <label for="inputKeterangan1" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="inputKeterangan1"
                                    placeholder="Contoh: Dari Palembang" name="keterangan" />
                            </div>
                            <div class="text-center col-md-2">
                                <button class="px-3 mt-4 btn btn-danger remove-btn" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus Data">
                                    <i class="fadeIn animated bx bx-trash text-light"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
