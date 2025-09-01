@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tambah Produk</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">KoiNesia</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <form id="formAddProduct" action="{{ route('produk.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- FORM START -->
                        <div class="mb-4">
                            <h5 class="mb-3">Nama Produk</h5>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Nama Produk"
                                required>
                            <div class="invalid-feedback">
                                Nama produk wajib diisi.
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Deskripsi Produk</h5>
                            <textarea name="deskripsi_produk" class="form-control" cols="4" rows="6"
                                placeholder="Masukkan Deskripsi Produk" required>
                                            </textarea>
                            <div class="invalid-feedback">
                                Deskripsi wajib diisi.
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Gambar Produk</h5>
                            <input id="fancy-file-upload" type="file" name="gambar[]"
                                accept=".jpg, .png, image/jpeg, image/png" multiple required>
                            <div class="invalid-feedback">
                                Gambar produk harus diupload.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="btn btn-outline-secondary flex-fill"
                                onclick="window.history.back()">
                                <i class="bi bi-arrow-left-circle me-2"></i>
                                Batal
                            </button>
                            <button type="reset" form="formAddProduct" class="btn btn-outline-danger flex-fill">
                                <i class="bi bi-x-circle me-2"></i>
                                Reset
                            </button>
                            <button type="submit" form="formAddProduct" class="btn btn-outline-primary flex-fill">
                                <i class="bi bi-send me-2"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="kode_produk" class="form-label">
                                    Kode Produk
                                </label>
                                <input type="text" class="form-control" style="background-color: rgb(232, 227, 227)"
                                    id="kode_produk" name="kode_produk" value="KN-9099" readonly>
                            </div>
                            <div class="col-12">
                                <label for="stok_produk" class="form-label">
                                    Stok Produk
                                </label>
                                <input type="text" class="form-control" style="background-color: rgb(232, 227, 227)"
                                    id="stok_produk" name="stok_produk" value="989" readonly>
                            </div>
                            <div class="col-12">
                                <label for="ukuran" class="form-label">
                                    Ukuran
                                </label>
                                <input type="text" class="form-control" name="ukuran" id="Collection" placeholder="Masukkan Ukuran Produk"
                                    required>
                                <div class="invalid-feedback">
                                    Ukuran wajib diisi.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="harga_produk" class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" name="harga_produk" id="harga_produk"
                                    placeholder="Masukkan Harga Produk" required>
                                <div class="invalid-feedback">
                                    Harga produk wajib diisi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </form>

    @push('scripts')
        <script>
            // Fancy file upload init
            $('#fancy-file-upload').FancyFileUpload({
                params: {
                    action: 'fileuploader'
                },
                maxfilesize: 1000000
            });

            // bsValidation4 init
            (function () {
                'use strict'
                const forms = document.querySelectorAll('#formAddProduct')
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }
                            form.classList.add('was-validated')
                        }, false)

                        // Reset button handling
                        form.addEventListener('reset', function () {
                            form.classList.remove('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endpush
@endsection
