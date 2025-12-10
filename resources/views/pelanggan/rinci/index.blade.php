@extends('pelanggan.mainPelanggan')
@section('content')
    <style>
        .btn-cart-add-1 {
            background: transparent;
            border: none;
            outline: none;
            color: transparent;
            box-shadow: none;
        }
    </style>

    <style>
        .btn-outline-secondary {
            border: 1.5px solid #aaa;
            color: #555;
            background-color: transparent;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #000;
            border-color: #888;
            transform: scale(1.03);
        }
    </style>

    <style>
        <style>

        /* Biar gambar & teks sejajar tengah dan proporsional */
        .produk-detail {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Saat di layar kecil (HP), ubah jadi vertikal */
        @media (max-width: 768px) {
            .produk-detail {
                flex-direction: column;
            }

            .produk-detail img {
                max-height: 320px !important;
            }
        }

        /* Tabel info produk rapi dan tidak renggang */
        .produk-detail table td {
            padding: 4px 8px;
            vertical-align: middle;
        }
    </style>

    </style>

    <style>
        /* ✨ Animasi dan Style Tambahan */
        .fade-in {
            animation: fadeIn 0.4s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.98);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        #searchForm input:focus {
            box-shadow: none !important;
        }

        #searchForm button:hover {
            opacity: 0.9;
            transform: scale(1.03);
            transition: all 0.2s ease-in-out;
        }

        /* 🎨 Desain Search Box */
        .search-box {
            border: 2px solid #dc3545;
            /* biru */
            border-radius: 30px;
            overflow: hidden;
            background-color: white;
        }

        .search-box input {
            border: none;
            outline: none;
            padding: 10px 15px;
            flex: 1;
            border-radius: 30px 0 0 30px;
        }

        .search-box .btn-search {
            background-color: #dc3545;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 0 30px 30px 0;
            transition: all 0.2s ease-in-out;
        }

        .search-box .btn-search:hover {
            background-color: #dc3545;
        }
    </style>
    <div id="cart-page" class="page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="text-center hero-txt white-color">
                        <div id="breadcrumb">
                            <div class="row">
                                <div class="col">
                                    <div class="breadcrumb-nav">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="demo-1.html">Produk</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    Detail Lengkap
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h2 class="h2-xl">Produk</h2> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="product-1" class="pt-100 single-product division">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-7 text-center">
                    @php
                        $gambarList = json_decode($produk->gambar_produk, true);
                        $gambarUtama = !empty($gambarList)
                            ? asset('storage/produk/final/' . $gambarList[0])
                            : asset('files/images/default.jpg');

                        $ekstensiUtama = pathinfo($gambarList[0] ?? '', PATHINFO_EXTENSION);
                    @endphp

                    <div class="text-center">
                        @if (in_array(strtolower($ekstensiUtama), ['mp4', 'mov', 'avi']))
                            <!-- Jika file pertama adalah video -->
                            <video id="gambarUtama" class="img-fluid rounded shadow-sm mb-3"
                                style="max-height: 400px; object-fit: contain;" controls autoplay muted>
                                <source src="{{ $gambarUtama }}" type="video/mp4">
                                Browser kamu tidak mendukung video tag.
                            </video>
                        @else
                            <!-- Jika file pertama adalah gambar -->
                            <img id="gambarUtama" src="{{ $gambarUtama }}" alt="{{ $produk->nama_produk }}"
                                class="img-fluid rounded shadow-sm mb-3" style="max-height: 400px; object-fit: contain;">
                        @endif
                    </div>
                    <!-- Thumbnail -->
                    @if (!empty($gambarList) && count($gambarList) > 1)
                        <div id="carouselGambar" class="d-flex justify-content-center flex-nowrap overflow-auto"
                            style="gap: 10px;">
                            @foreach ($gambarList as $gambar)
                                @php
                                    $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($ekstensi, ['mp4', 'mov', 'avi']))
                                    <!-- Thumbnail Video -->
                                    <video onclick="gantiMedia('{{ asset('storage/produk/final/' . $gambar) }}', true)"
                                        style="width: 90px; height: 90px; cursor: pointer; object-fit: cover;" muted>
                                        <source src="{{ asset('storage/produk/final/' . $gambar) }}" type="video/mp4">
                                        Browser kamu tidak mendukung video tag.
                                    </video>
                                @else
                                    <!-- Thumbnail Gambar -->
                                    <img src="{{ asset('storage/produk/final/' . $gambar) }}"
                                        onclick="gantiMedia('{{ asset('storage/produk/final/' . $gambar) }}', false)"
                                        class="img-thumbnail"
                                        style="width: 90px; height: 90px; object-fit: cover; cursor: pointer;">
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>


                <div class="col-lg-5">
                    <div class="project-title"> <!-- Title -->
                        <h2 class="h2-lg"> {{ $produk->nama_produk }} </h2> <!-- Price -->
                        <div class="project-price">
                            <h4 class="h4-xl yellow-color"> {{ 'Rp ' . number_format($produk->harga_Satuan, 0, ',', '.') }}
                            </h4>
                            @if ($produk->harga_diskon ?? false)
                                <del class="text-muted ms-2 fs-6">
                                    {{ 'Rp ' . number_format($produk->harga_diskon, 0, ',', '.') }} </del>
                            @endif
                        </div>
                        <div class="product-txt"> <!-- Product Data -->
                            <div class="product-info">
                                <p>Kode: <span>{{ $produk->kode_produk }}</span> </p>
                                <p>Ukuran: <span>{{ $produk->ukuran_produk }}</span> </p>
                                <p>Stok: @if ($produk->stok_produk > 0)
                                        <span class="badge bg-success text-light">{{ $produk->stok_produk }}
                                            tersedia</span>
                                    @else
                                        <span class="badge bg-danger text-light">Stok Habis</span>
                                    @endif
                                </p>
                            </div>
                            @if ($produk->stok_produk > 0)
                                <div class="d-flex align-items-center gap-3"> <input type="number" min="1"
                                        max="{{ $produk->stok_produk }}" value="1"
                                        class="form-control w-25 text-center" />
                                    <button type="button" class="btn btn-cart-add-1 text-white fw-semibold btn-sm"
                                        style="background-color: #ecbb28" data-id="{{ $produk->kode_produk }}"
                                        data-nama="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga_Satuan }}"
                                        data-stok="{{ $produk->stok_produk }}" data-ukuran="{{ $produk->ukuran_produk }}"
                                        data-gambar="{{ $gambarUtama }}"> <i class="flaticon-shopping-bag"></i>
                                        {{-- Keranjang --}}
                                    </button>
                                    <button type="button" class="btn btn-buy-1 text-white fw-semibold btn-sm"
                                        style="background-color: #ec2828" data-id="{{ $produk->kode_produk }}"
                                        data-nama="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga_Satuan }}"
                                        data-stok="{{ $produk->stok_produk }}" data-ukuran="{{ $produk->ukuran_produk }}"
                                        data-gambar="{{ $gambarUtama }}">
                                        <i class="flaticon-buy me-2"></i>
                                        Beli Sekarang
                                    </button>
                                </div>
                            @else
                                <button class="btn btn-danger mt-2" disabled> <i class="flaticon-error"></i> Stok Kosong
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
    </section>

    <section id="product-1-data" class="wide-80 single-product-data division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <!-- TABS NAVIGATION -->
                        <div class="tabs-nav">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <ul class="tabs-1 clearfix">

                                        <!-- TAB-1 LINK -->
                                        <li class="tab-link current" data-tab="tab-1">
                                            <h5 class="h5-sm">Deskripsi</h5>
                                        </li>

                                        {{-- <!-- TAB-2 LINK -->
                                        <li class="tab-link" data-tab="tab-2">
                                            <h5 class="h5-sm">Gambar</h5>
                                        </li> --}}

                                    </ul>
                                </div>
                            </div>
                        </div> <!-- END TABS NAVIGATION -->

                        <!-- TABS CONTENT -->
                        <div class="tabs-content">
                            <!-- TAB-1 CONTENT -->
                            <div id="tab-1" class="tab-content current">
                                <!-- Text -->
                                <p>
                                    {{ $produk->deskripsi_produk }}
                                </p>

                                <ul class="txt-list">
                                    <h6 class="fw-semibold"> Catatan :</h6>
                                    <li class="list-item">
                                        Pembayaran via WhatsApp
                                    </li>
                                    <li class="list-item">
                                        Koi dijamin sehat saat dikirim
                                    </li>
                                    <li class="list-item">
                                        Respon admin 08.00–21.00 WIB
                                    </li>
                                </ul>
                            </div> <!-- END TAB-1 CONTENT -->
                        </div> <!-- END TABS CONTENT -->
                    </div>
                </div>
            </div> <!-- End row -->
        </div> <!-- End container -->
    </section>

    <section id="menu-6" class="bg-lightgrey wide-70 menu-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-title mb-60 text-center">
                        <!-- Title 	-->
                        <h2 class="h3-xl">Produk Lain yang Mungkin Kamu Suka</h2>

                        <!-- Text -->
                        <p class="fs-6">
                            Lihat rekomendasi produk lainnya yang mungkin sesuai dengan kebutuhan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                @if (!empty($products))
                    @foreach ($products as $product)
                        @php
                            $gambarList = json_decode($product->gambar_produk, true);
                            $gambarUtama = !empty($gambarList)
                                ? asset('storage/produk/final/' . $gambarList[0])
                                : asset('files/images/default.jpg');
                        @endphp

                        <div class="col-sm-4 col-lg-3 mb-4">
                            <div class="bg-white menu-6-item shadow-sm rounded p-2">
                                <!-- GAMBAR PRODUK -->
                                <div class="menu-6-img rel position-relative">
                                    <div class="hover-overlay">
                                        <img src="{{ $gambarUtama }}" alt="{{ $product->nama_produk }}"
                                            class="img-fluid mb-2 rounded">
                                        <span
                                            class="item-code bg-tra-dark position-absolute top-0 start-0 m-2 px-2 py-1 small text-white rounded">
                                            Kode: {{ $product->kode_produk }}
                                        </span>

                                        <div
                                            class="menu-img-zoom ico-25 position-absolute top-50 start-50 translate-middle">
                                            <a href="{{ $gambarUtama }}" class="image-link text-white">
                                                <span class="flaticon-zoom"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- TEKS PRODUK -->
                                <div class="menu-6-txt rel mt-2">
                                    <div class="like-ico ico-25 position-absolute top-0 end-0 mt-2 me-2">
                                        <a href="#"><span class="flaticon-heart"></span></a>
                                    </div>

                                    <h5 class="h5-sm nama-produk mb-1">
                                        <a href="{{ url('pelanggan/produk/rinci/' . $product->kode_produk) }}"
                                            class="text-dark text-decoration-none">
                                            {{ $product->nama_produk }}
                                        </a>
                                    </h5>

                                    <p class="grey-color small">
                                        {{ \Illuminate\Support\Str::limit($product->deskripsi_produk, 25) }}
                                    </p>

                                    @if ($product->stok_produk > 0)
                                        <div class="menu-6-price bg-meat rounded py-1 text-center">
                                            <h5 class="h6-xs text-white mb-0">
                                                {{ 'Rp ' . number_format($product->harga_Satuan, 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <div class="add-to-cart bg-yellow text-center mt-2">
                                            <button type="button" class="btn btn-warning text-white fw-semibold w-100"
                                                data-id="{{ $product->kode_produk }}"
                                                data-nama="{{ $product->nama_produk }}"
                                                data-harga="{{ $product->harga_Satuan }}"
                                                data-stok="{{ $product->stok_produk }}"
                                                data-ukuran="{{ $product->ukuran_produk }}"
                                                data-gambar="{{ $gambarUtama }}">
                                                <i class="flaticon-shopping-bag"></i> Keranjang
                                            </button>
                                        </div>
                                    @else
                                        <div class="mt-2 text-center">
                                            <button type="button" class="btn btn-danger w-100" disabled>
                                                <i class="flaticon-error"></i> Stok Kosong
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p>Tidak ada produk lain yang tersedia.</p>
                    </div>
                @endif
            </div>
            @if (!empty(count($products) == 4))
                <div class="d-flex justify-content-center">
                    <a href="{{ route('produkLengkap') }}"
                        class="px-4 py-2 shadow-sm btn btn-outline-secondary rounded-pill"
                        style="transition: all 0.3s ease; font-weight: 500; color: #b3140a;">
                        Selengkapnya
                    </a>
                </div>
            @endif
        </div> <!-- End container -->
    </section>

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                // AMBIL DATA CHECKOUT SEKARANG
                let checkout = JSON.parse(localStorage.getItem("checkout")) || [];

                // ==========================================================
                // 1. FUNGSI - KLIK BELI SEKARANG (btn-buy-1)
                // ==========================================================
                const buyButtons = document.querySelectorAll(".btn-buy-1");

                buyButtons.forEach(btn => {
                    btn.addEventListener("click", function() {

                        // produk dari dataset tombol
                        const produk = {
                            id: this.dataset.id,
                            nama: this.dataset.nama,
                            harga: parseInt(this.dataset.harga),
                            stok: parseInt(this.dataset.stok),
                            ukuran: this.dataset.ukuran,
                            gambar: this.dataset.gambar,
                            qty: 1,
                            dipilih: true
                        };

                        // kosongkan checkout lama (karena ini "Beli Sekarang", hanya 1 item)
                        checkout = [];
                        checkout.push(produk);

                        // simpan ke localStorage
                        localStorage.setItem("checkout", JSON.stringify(checkout));

                        // redirect ke halaman format pesanan
                       window.location.href = "{{ route('format') }}";
                        // ganti dengan route pesanan kamu bila berbeda
                    });
                });

            });
        </script>
        <script>
            function gantiMedia(src, isVideo) {
                const container = document.querySelector('#gambarUtama');
                if (isVideo) {
                    container.outerHTML = `
            <video id="gambarUtama" class="img-fluid rounded shadow-sm mb-3" 
                   style="max-height: 400px; object-fit: contain;" controls autoplay>
                <source src="${src}" type="video/mp4">
                Browser kamu tidak mendukung video tag.
            </video>`;
                } else {
                    container.outerHTML = `
            <img id="gambarUtama" src="${src}" 
                 class="img-fluid rounded shadow-sm mb-3" 
                 style="max-height: 400px; object-fit: contain;">`;
                }
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];

                const buttons = document.querySelectorAll(".btn-cart-add-1");

                buttons.forEach(btn => {
                    btn.addEventListener("click", function(e) {
                        e.preventDefault();

                        const produk = {
                            id: this.dataset.id,
                            nama: this.dataset.nama,
                            harga: parseInt(this.dataset.harga),
                            stok: parseInt(this.dataset.stok),
                            ukuran: this.dataset.ukuran,
                            gambar: this.dataset.gambar,
                            qty: 1
                        };

                        if (!cart.find(item => item.id === produk.id)) {
                            cart.push(produk);
                        }

                        localStorage.setItem("cart", JSON.stringify(cart));
                        updateCartUI();
                    });
                });

                function updateCartUI() {
                    const cartCount = document.getElementById('cart-count'); // desktop
                    const cartCountFixed = document.getElementById(
                        'cart-count-fixed'); // mobile fixed
                    const cartIcon = document.getElementById('cart-icon');
                    const cartIconFixed = document.getElementById('cart-icon-fixed');

                    if (cartCount) cartCount.textContent = cart.length;
                    if (cartCountFixed) cartCountFixed.textContent = cart.length;

                    // shake desktop + mobile fixed icon
                    [cartIcon, cartIconFixed].forEach(icon => {
                        if (icon) {
                            icon.classList.add('shake');
                            setTimeout(() => icon.classList.remove('shake'), 500);
                        }
                    });
                }

                updateCartUI(); // init badge
            });
        </script>
    @endpush
@endsection