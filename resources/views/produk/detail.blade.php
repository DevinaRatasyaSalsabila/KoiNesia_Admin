@extends('main')
@section('content')
    <style>
        #miniCarousel {
            position: relative;
            /* penting biar child absolute nempel ke sini */
            overflow: hidden;
            /* biar ga keluar-keluar */
        }

        /* tombol panah */
        .custom-prev,
        .custom-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #00000070;
            color: white;
            border: none;
            padding: 8px 14px;
            font-size: 22px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 5;
            /* cukup kecil biar ga nutup navbar */
        }

        .custom-prev {
            left: 10px;
        }

        .custom-next {
            right: 10px;
        }

        .custom-prev:hover,
        .custom-next:hover {
            background: #000000a0;
        }
    </style>

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
    @php
        $gambarArray = json_decode($produk->gambar_produk, true);
    @endphp
    {{-- @if (!empty($gambarArray))
        @foreach ($gambarArray as $gambar)
            <img src="{{ asset('storage/produk/final/' . $gambar) }}" class="img-fluid rounded">
        @endforeach
    @endif --}}
    <!-- Gambar Produk -->
    <div class="row mb-4 text-center">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div id="miniCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner">
                            @php
                                $first = true;
                                $index = 0;
                            @endphp
                            @foreach ($gambarArray as $file)
                                @php
                                    $isImage = Str::endsWith($file, ['.jpg', '.jpeg', '.png']);
                                    $isVideo = Str::endsWith($file, ['.mp4', '.webm', '.ogg']);
                                @endphp
                                <div class="carousel-item {{ $first ? 'active' : '' }}" data-index="{{ $index }}">
                                    @if ($isImage)
                                        <img src="{{ asset('storage/produk/final/' . $file) }}"
                                            class="rounded-3 d-block mx-auto" style="max-height:280px; object-fit:cover;">
                                    @elseif($isVideo)
                                        <video controls class="rounded-3 d-block mx-auto"
                                            style="max-height:280px; width:auto; max-width:100%; object-fit:cover;">
                                            <source src="{{ asset('storage/produk/final/' . $file) }}">
                                            Browser Anda tidak mendukung video
                                        </video>
                                    @endif
                                </div>
                                @php
                                    $first = false;
                                    $index++;
                                @endphp
                            @endforeach
                        </div>

                        <button class="custom-prev" type="button" data-bs-target="#miniCarousel"
                            data-bs-slide="prev">&lt;</button>
                        <button class="custom-next" type="button" data-bs-target="#miniCarousel"
                            data-bs-slide="next">&gt;</button>
                    </div>

                    <div class="d-flex justify-content-center mt-3 gap-2">
                        @php $thumbIndex = 0; @endphp
                        @foreach ($gambarArray as $file)
                            @php
                                $isImage = Str::endsWith($file, ['.jpg', '.jpeg', '.png']);
                            @endphp
                            @if ($isImage)
                                <img src="{{ asset('storage/produk/final/' . $file) }}"
                                    class="thumb-img rounded {{ $thumbIndex == 0 ? 'active-thumb' : '' }}"
                                    data-bs-target="#miniCarousel" data-bs-slide-to="{{ $thumbIndex }}"
                                    style="width:60px; height:60px; object-fit:cover; cursor:pointer; opacity: {{ $thumbIndex == 0 ? '1' : '0.5' }};">
                            @endif
                            @php $thumbIndex++; @endphp
                        @endforeach
                    </div>

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
                        <input type="text" class="form-control bg-light" value="{{ $produk->kode_produk }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="text" class="form-control bg-light" value="{{ $produk->stok_produk }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="p-3 text-white rounded text-center fs-5 fw-bold"
                            style="background-color: rgb(43, 115, 214)">
                            {{ $produk->harga_Satuan }}
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
                        <input type="text" class="form-control bg-light" value="{{ $produk->nama_produk }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ukuran</label>
                        <input type="text" class="form-control bg-light" value="{{ $produk->ukuran_produk }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <div class="p-3 bg-light rounded" style="min-height: 120px;">
                            {{ $produk->deskripsi_produk }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <button onclick="window.history.back()" class="btn btn-outline-secondary px-4 rounded-pill shadow-sm">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Produk
            </button>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('miniCarousel');
            const thumbs = document.querySelectorAll('.thumb-img');

            carousel.addEventListener('slid.bs.carousel', function(e) {
                const activeIndex = e.to;
                thumbs.forEach((thumb, i) => {
                    thumb.style.opacity = (i === activeIndex) ? '1' : '0.5';
                });
            });
        });
    </script>
@endsection
