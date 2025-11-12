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
                                                    Produk Lengkap
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

    {{-- <section id="menu-6" class="wide-70 menu-section division">
        <div class="container">
            <div class="row">
                @if (!empty($produk))
                    @foreach ($produk as $prod)
                        @php
                            $gambarList = json_decode($prod->gambar_produk, true);
                            $gambarUtama = !empty($gambarList)
                                ? asset('storage/produk/final/' . $gambarList[0])
                                : asset('files/images/default.jpg');
                        @endphp

                        <div class="col-sm-4 col-lg-3">
                            <div class="bg-white menu-6-item">
                                <div class="menu-6-img rel">
                                    <div class="hover-overlay">
                                        <img src="{{ $gambarUtama }}" class="mb-2 img-fluid"
                                            alt="{{ $prod->nama_produk }}">
                                        <span class="item-code bg-tra-dark">Kode: {{ $prod->kode_produk }}</span>
                                        <div class="menu-img-zoom ico-25">
                                            <a href="{{ $gambarUtama }}" class="image-link">
                                                <span class="flaticon-zoom"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="menu-6-txt rel">
                                    <div class="like-ico ico-25">
                                        <a href="#"><span class="flaticon-heart"></span></a>
                                    </div>
                                    <h5 class="h5-sm">{{ $prod->nama_produk }}</h5>

                                    <p class="grey-color">
                                        {{ \Illuminate\Support\Str::limit($prod->deskripsi_produk, 25) }}
                                    </p>

                                    @if ($prod->stok_produk > 0)
                                        <div class="menu-6-price bg-meat">
                                            <h5 class="h6-xs white-color">
                                                {{ 'Rp ' . number_format($prod->harga_Satuan, 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <div class="add-to-cart bg-yellow ico-10">
                                            <button type="button"
                                                class="shadow-none btn-cart-add-1 bg-yellow text-light ico-10"
                                                data-id="{{ $prod->kode_produk }}" data-nama="{{ $prod->nama_produk }}"
                                                data-harga="{{ $prod->harga_Satuan }}" data-stok="{{ $prod->stok_produk }}"
                                                data-ukuran="{{ $prod->ukuran_produk }}"
                                                data-gambar="{{ $gambarUtama }}">
                                                <span class="flaticon-shopping-bag"></span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="mt-3 text-center">
                                            <button type="button" class="shadow-none btn btn-danger w-100" disabled>
                                                <i class="flaticon-error"></i> Stok Habis
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Tidak Ada Produk.</p>
                @endif
            </div>
        </div>
    </section> --}}
    <div class="container">
        {{-- <div class="mb-5 row justify-content-start my-5">
            <div class="col-lg-6 col-md-8">
                <form id="searchForm" class="search-box d-flex">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari produk favorit kamu..."
                        aria-label="Search" />
                    <button type="submit" class="btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div> --}}
        <div class="mb-5 row justify-content-end my-5 fade-in">
            <div class="col-lg-4 col-md-6">
                <form id="searchForm" class="search-box d-flex align-items-center">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari produk favorit kamu..."
                        aria-label="Search" />
                    <button type="submit" class="btn-search d-flex align-items-center justify-content-center">
                        <i class="bi bi-search fs-5"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <section id="menu-6" class="my-5 menu-section division">
        <div class="container">

            {{-- 🔍 Search Bar Modern --}}
            <div class="row" id="produkContainer">
                @if (!empty($produk))
                    @foreach ($produk as $prod)
                        @php
                            $gambarList = json_decode($prod->gambar_produk, true);
                            $gambarUtama = !empty($gambarList)
                                ? asset('storage/produk/final/' . $gambarList[0])
                                : asset('files/images/default.jpg');
                        @endphp

                        <div class="col-sm-4 col-lg-3 produk-item">
                            <div class="bg-white menu-6-item">
                                <div class="menu-6-img rel">
                                    <div class="hover-overlay">
                                        <img src="{{ $gambarUtama }}" class="mb-2 img-fluid"
                                            alt="{{ $prod->nama_produk }}">
                                        <span class="item-code bg-tra-dark">Kode:
                                            {{ $prod->kode_produk }}</span>
                                        <div class="menu-img-zoom ico-25">
                                            <a href="{{ $gambarUtama }}" class="image-link">
                                                <span class="flaticon-zoom"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="menu-6-txt rel">
                                    <div class="like-ico ico-25">
                                        <a href="#"><span class="flaticon-heart"></span></a>
                                    </div>
                                    <h5 class="h5-sm nama-produk">
                                        <a href="{{ url('pelanggan/produk/rinci/' . $prod->kode_produk) }}"
                                            class="text-dark text-decoration-none hover-underline">
                                            {{ $prod->nama_produk }}
                                        </a>
                                    </h5>
                                    <p class="grey-color deskripsi-produk">
                                        {{ \Illuminate\Support\Str::limit($prod->deskripsi_produk, 25) }}
                                    </p>

                                    @if ($prod->stok_produk > 0)
                                        <div class="menu-6-price bg-meat">
                                            <h5 class="h6-xs white-color">
                                                {{ 'Rp ' . number_format($prod->harga_Satuan, 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <div class="add-to-cart bg-yellow ico-10">
                                            <button type="button"
                                                class="shadow-none btn-cart-add-1 bg-yellow text-light ico-10 "
                                                data-id="{{ $prod->kode_produk }}" data-nama="{{ $prod->nama_produk }}"
                                                data-harga="{{ $prod->harga_Satuan }}"
                                                data-stok="{{ $prod->stok_produk }}"
                                                data-ukuran="{{ $prod->ukuran_produk }}"
                                                data-gambar="{{ $gambarUtama }}">
                                                <span class="flaticon-shopping-bag"></span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="mt-3 text-center">
                                            <button type="button" class="shadow-none btn btn-danger w-100" disabled>
                                                <i class="flaticon-error"></i> Stok Kosong
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Tidak Ada Produk.</p>
                @endif
            </div>
        </div>
    </section>


    @push('script')
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

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const searchInput = document.getElementById("searchInput");
                const produkItems = document.querySelectorAll(".produk-item");

                // 🔍 Live Search: jalan setiap kali user mengetik
                searchInput.addEventListener("keyup", function() {
                    const keyword = this.value.toLowerCase().trim();

                    produkItems.forEach(item => {
                        const nama = item.querySelector(".nama-produk").textContent
                            .toLowerCase();
                        const deskripsi = item.querySelector(".deskripsi-produk")
                            .textContent
                            .toLowerCase();

                        // kalau keyword kosong → tampilkan semua produk
                        if (keyword === "" || nama.includes(keyword) || deskripsi
                            .includes(keyword)) {
                            item.style.display = "block";
                            item.classList.add("fade-in");
                        } else {
                            item.style.display = "none";
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
