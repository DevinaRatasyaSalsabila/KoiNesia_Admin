@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tambah Produk</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form id="formAddProduct" action="{{ route('produk.store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
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
                                placeholder="Masukkan Deskripsi Produk" required></textarea>
                            <div class="invalid-feedback">
                                Deskripsi wajib diisi.
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="mb-3">Gambar Produk</h5>
                            <input type="file" id="fancy-file-upload" required multiple accept=".jpg,.jpeg,.png,.mp4,.webm,.ogg">
                            <div id="hidden-gambar"></div>
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
                        <button type="button" class="btn btn-outline-secondary flex-fill" onclick=".history.back()">
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
                            <input type="text" class="form-control" name="kode_produk" id="kode_produk" readonly
                                style="background-color: rgb(232, 227, 227)">
                        </div>
                        <div class="col-12">
                            <label for="stok_produk" class="form-label">
                                Stok Produk
                            </label>
                            <input type="text" class="form-control" name="stok_produk"
                                style="background-color: rgb(232, 227, 227)" id="stok_produk" value="0" readonly>
                        </div>
                        <div class="col-12">
                            <label for="ukuran" class="form-label">
                                Ukuran
                            </label>
                            <input type="text" class="form-control" id="Collection" name="ukuran_produk"
                                placeholder="Masukkan Ukuran Produk" required>
                            <div class="invalid-feedback">
                                Ukuran wajib diisi.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="harga_produk" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" id="harga_produk" name="harga_produk"
                                placeholder="Masukkan Harga Produk" required>
                            <div class="invalid-feedback">
                                Harga produk wajib diisi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // fungsi generate kode produk
                function generateKodeProduk() {
                    let random = Math.floor(1000 + Math.random() * 9000); // random 4 digit
                    return "KN-" + random;
                }

                // isi kode produk saat halaman form dibuka
                let kode = generateKodeProduk();
                $('#kode_produk').val(kode);
                console.log("✅ Kode Produk Generated:", kode);
            });

            $(document).ready(function () {
                $('#fancy-file-upload').FancyFileUpload({
                    params: {
                        action: 'fileuploader'
                    },
                    maxfilesize: 50 * 1024 * 1024, // 50MB
                    edit: false,
                    added: function (e, data) {
                        let file = data.files[0];
                        let type = file.type;

                        // 🕵️ Debug log
                        console.log("📂 File ditambahkan:");
                        console.log("Nama:", file.name);
                        console.log("Type:", type);
                        console.log("Size:", file.size);

                        if (type.startsWith("image/")) {
                            // convert image ke base64 → hidden input
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                let hidden = $('<input>').attr({
                                    type: 'hidden',
                                    name: 'gambar_produk[]',
                                    value: e.target.result
                                });
                                $('#formAddProduct').append(hidden);
                            };
                            reader.readAsDataURL(file);

                        } else if (type.startsWith("video/")) {
                            let dt = new DataTransfer();
                            dt.items.add(file);

                            let videoInput = $('<input>').attr({
                                type: 'file',
                                name: 'video_files[]',
                                style: 'display:none'
                            })[0];

                            videoInput.files = dt.files;
                            $('#formAddProduct').append(videoInput);
                        }
                    }
                });
            });

            function formatUang(subject) {
                subject = subject.replace(/[^,\d]/g, "");
                let rupiah = subject.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return "Rp" + rupiah;
            }

            $('#harga_produk').on('input', function () {
                let value = $(this).val();
                $(this).val(formatUang(value));
            });

            $('#formAddProduct').on('submit', function () {
                let value = $('#harga_produk').val();
                let angkaMurni = value.replace(/[^0-9]/g, "");
                $('#harga_produk').val(angkaMurni);
            });

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

                        form.addEventListener('reset', function () {
                            form.classList.remove('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endpush
@endsection
