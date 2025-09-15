@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Edit Barang Masuk </div>
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

    <div>
        <form action="{{ route('barang-masuk.update', $barang->id_pemasukan) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Barang Masuk {{ $barang->keterangan }}</h5>
                        <div class="gap-2 ms-auto d-flex">
                            <a href="{{ url('barang-masuk') }}" class="px-4 btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Kembali">
                                <i class="bi bi-box-arrow-left"></i>
                            </a>
                            <button type="submit" class="px-4 btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Simpan">
                                <i class="bi bi-send-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="items" data-group="pesanan">
                <div class="card">
                    <div class="card-body">
                        <div class="item-content">
                            <div class="mb-3">
                                <label for="inputTanggal1" class="form-label">Tanggal</label>
                                <input type="date" value="{{ $barang->tanggal }}" name="tanggal" class="form-control"
                                    id="inputTanggal1" data-name="tanggal" value="" />
                            </div>
                            <div class="mb-3">
                                <label for="produkEdit" class="form-label">Produk</label>
                                <select name="kode_produk" class="form-select" id="produkEdit"
                                    data-placeholder="Choose one thing">
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->kode_produk }}"
                                            {{ $item->kode_produk == $barang->kode_produk ? 'selected' : '' }}>
                                            {{ $item->nama_produk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputJumlah1" class="form-label">Jumlah Barang</label>
                                <input name="stok_barang" value="{{ $barang->total_produk }}" type="number"
                                    class="form-control" id="inputJumlah1" placeholder="0" data-name="jumlah" />
                            </div>
                            <div class="mb-3">
                                <label for="inputKeterangan1" class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="inputKeterangan1" rows="2"
                                    placeholder="Contoh: Dari Palembang" data-name="keterangan">{{ $barang->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#produkEdit').select2({
                    placeholder: "Pilih salah satu",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection
