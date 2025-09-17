@extends('main')
@section('content')
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Tambah Barang Masuk</div>
    </div>

    <form action="{{ route('barang-masuk.store') }}" method="POST">
        @csrf
        <div class="mb-3 card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Barang Masuk</h5>
                    <div class="gap-2 ms-auto d-flex">
                        <a href="{{ url('barang-masuk') }}" class="px-4 btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Kembali">
                                <i class="bi bi-box-arrow-left"></i>
                            </a>
                        <button type="button" class="px-4 btn btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Tambah Barang Masuk" id="addRow">
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

        <!-- Container untuk row -->
        <div id="formContainer">
            <!-- Row pertama -->
            <div class="mb-2 card form-row">
                <div class="card-body">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-2">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control"
                                name="barang_masuk[0][tanggal]" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Produk</label>
                            <select for="select2-produk" class="form-select" id="select2-produk" name="barang_masuk[0][kode_produk]">
                                <option value="">Pilih salah satu</option>
                                @foreach ($produk as $item)
                                    <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control"
                                name="barang_masuk[0][total_produk]" placeholder="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control"
                                name="barang_masuk[0][keterangan]" placeholder="Contoh: Dari Palembang">
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn btn-danger btn-remove">
                                <i class="fadeIn animated bx bx-trash text-light"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            let rowIndex = 1;

            document.getElementById('addRow').addEventListener('click', function () {
                let container = document.getElementById('formContainer');

                let newRow = document.createElement('div');
                newRow.classList.add('mb-2', 'card', 'form-row');
                newRow.innerHTML = `
                    <div class="card-body">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control"
                                    name="barang_masuk[${rowIndex}][tanggal]" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Produk</label>
                                <select class="form-select" name="barang_masuk[${rowIndex}][kode_produk]">
                                    <option value="">Pilih salah satu</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control"
                                    name="barang_masuk[${rowIndex}][total_produk]" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control"
                                    name="barang_masuk[${rowIndex}][keterangan]" placeholder="Contoh: Dari Palembang">
                            </div>
                            <div class="col-md-2 text-end">

                                <button type="button" class="btn btn-danger btn-remove">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(newRow);
                rowIndex++;
            });

            document.getElementById('formContainer').addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-remove')) {
                    e.target.closest('.form-row').remove();
                }
            });

             $(document).ready(function() {
                $('#select2-produk').select2({
                    placeholder: "Pilih salah satu",
                    allowClear: true,
                     width: '100%'
                });
            });
        </script>
    @endpush
@endsection
