@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Produk</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $gambarArray = json_decode($produk->gambar_produk, true);
    @endphp

    <div class="row mb-4 text-center">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if (!empty($gambarArray))
                        @foreach ($gambarArray as $file)
                            @if (Str::endsWith($file, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/produk/final/' . $file) }}" class="img-fluid rounded-3"
                                    style="max-height:280px;object-fit:cover;">
                            @elseif(Str::endsWith($file, ['.mp4', '.webm', '.ogg']))
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/produk/final/' . $file) }}">
                                    Browser kamu ga support video 😭
                                </video>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- FORM START -->
                    <form id="formAddProduct" action="{{ route('produk.update', $produk->id_produk) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <h5 class="mb-3">Nama Produk</h5>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Nama Produk"
                                value="{{ $produk->nama_produk }}" required>
                            <div class="invalid-feedback">
                                Nama produk wajib diisi.
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Deskripsi Produk</h5>
                            <textarea name="deskripsi_produk" class="form-control" cols="4" rows="6"
                                placeholder="Masukkan Deskripsi Produk" required>{{ $produk->deskripsi_produk }}</textarea>
                            <div class="invalid-feedback">
                                Deskripsi wajib diisi.
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Gambar Produk</h5>

                            {{-- Input file untuk upload baru --}}
                            <input id="fancy-file-upload" type="file" name="gambar_produk"
                                accept=".jpg,.jpeg,.png,.mp4,.webm,.ogg" multiple>
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
                        <button type="button" class="btn btn-outline-secondary flex-fill" onclick="window.history.back()">
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
                            <input type="text" class="form-control" name="kode_produk"
                                style="background-color: rgb(232, 227, 227)" id="kode_produk"
                                value="{{ $produk->kode_produk }}">
                        </div>
                        <div class="col-12">
                            <label for="stok_produk" class="form-label">
                                Stok Produk
                            </label>
                            <input type="text" class="form-control" name="stok_produk"
                                style="background-color: rgb(232, 227, 227)" id="stok_produk"
                                value="{{ $produk->stok_produk }}">
                        </div>
                        <div class="col-12">
                            <label for="ukuran" class="form-label">
                                Ukuran
                            </label>
                            <input type="text" class="form-control" id="Collection" name="ukuran_produk"
                                placeholder="Masukkan Ukuran Produk" value="{{ $produk->ukuran_produk }}" required>
                            <div class="invalid-feedback">
                                Ukuran wajib diisi.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="harga_produk" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" id="harga_produk" name="harga_produk"
                                placeholder="Masukkan Harga Produk" value="{{ $produk->harga_Satuan }}" required>
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
            $('#fancy-file-upload').FancyFileUpload({
                url: '', // kosongin
                autoUpload: false,
                added: function(e, data) {
                    let file = data.files[0];
                    let type = file.type;

                    console.log("📂 File ditambahkan:", file.name, "type:", type);

                    if (type.startsWith("image/")) {
                        let reader = new FileReader();
                        reader.onload = function(evt) {
                            let base64 = evt.target.result;
                            let input = $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'gambar_produk[]')
                                .val(base64);

                            $('#hidden-gambar').append(input);
                            console.log("📸 Base64 ditambahkan:", base64.substring(0, 50) + "...");
                        };
                        reader.readAsDataURL(file);

                    } else if (type.startsWith("video/")) {
                        // pake DataTransfer biar Laravel bisa baca sebagai file asli
                        let dt = new DataTransfer();
                        dt.items.add(file);

                        let videoInput = $('<input>').attr({
                            type: 'file',
                            name: 'video_files[]',
                            style: 'display:none'
                        })[0];

                        videoInput.files = dt.files;
                        $('#formAddProduct').append(videoInput);

                        console.log("🎥 Video input ditambahkan:", file.name);
                    }
                }
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


            (function() {
                'use strict'
                const forms = document.querySelectorAll('#formAddProduct')
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }
                            form.classList.add('was-validated')
                        }, false)

                        form.addEventListener('reset', function() {
                            form.classList.remove('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endpush
@endsection
