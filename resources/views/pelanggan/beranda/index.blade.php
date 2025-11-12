@extends('pelanggan.mainPelanggan')
@section('content')
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
        .btn-cart-add-1 {
            background: transparent;
            border: none;
            outline: none;
            color: transparent;
            box-shadow: none;
        }

        /* Floating effect untuk gambar ikan koi */
        .floating-img {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* Animasi halus tombol */
        .btn-animate {
            transition: all 0.3s ease;
        }

        .btn-animate:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        /* Badge Koi agar tampil lembut */
        .price-badge-md {
            /* background: rgba(255, 255, 255, 0.85);
                                            border-radius: 12px;
                                            padding: 10px 20px;
                                            backdrop-filter: blur(8px); */
            animation: fadeInBadge 2s ease;
        }

        @keyframes fadeInBadge {
            from {
                opacity: 0;
                transform: scale(0.10);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <!-- HERO-4 -->
    <section id="hero-4" class="bg-fixed hero-section division">
        <div class="container">
            <div class="row d-flex align-items-center">

                <!-- HERO IMAGE -->
                <div class="mb-4 col-md-7 mb-md-0" data-aos="fade-right" data-aos-duration="1200">
                    <div class="text-center hero-4-img position-relative">
                        <img class="img-fluid floating-img" src="{{ asset('files/images/koi-about.png') }}" alt="hero-image">

                        <!-- Price Badge -->
                        <!-- Price Badge -->
                        <div class="bg-fixed price-badge-md 1white-color">
                            <div class="badge-txt">
                                <h4 class="h4-xs">Koleksi</h4>
                                <h3 class="h6-lg">Koi Istimewa</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HERO IMAGE -->
                {{-- <div class="col-md-7">
                    <div class="text-center hero-4-img">

                        <img class="img-fluid" src="{{ asset('files/images/koi-about.png') }}"
                            alt="hero-image">

                        <!-- Price Badge -->
                        <div class="bg-fixed price-badge-md 1white-color">
                            <div class="badge-txt">
                                <h4 class="h4-xs">Koleksi</h4>
                                <h3 class="h6-lg">Koi Istimewa</h3>
                            </div>
                        </div>

                    </div>
                </div> --}}


                <!-- HERO TEXT -->
                <div class="col-md-5">
                    <div class="text-center hero-4-txt white-color">

                        <!-- Title -->
                        <h2>Azza Koi </h2>
                        <h3>Farm</h3>

                        <!-- Text -->
                        <p class="p-md">
                            Nikmati koleksi koi terbaik dengan warna memukau, sehat, dan dirawat dengan
                            penuh
                            ketelatenan.
                        </p>

                        <!-- Button -->
                        <a href="#" class="btn btn-md btn-yellow tra-white-hover">Tentang Kami</a>

                    </div>
                </div> <!-- END HERO TEXT -->


            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- END HERO-4 -->

    <!-- HERO-4 -->
    {{-- <section id="hero-4" class="py-5 bg-fixed hero-section division">
        <div class="container">
            <div class="row d-flex align-items-center">

                <!-- HERO IMAGE -->
                <div class="mb-4 col-md-7 mb-md-0" data-aos="fade-right" data-aos-duration="1200">
                    <div class="text-center hero-4-img position-relative">
                        <img class="img-fluid floating-img"
                            src="{{ asset('files/images/koi-about.png') }}" alt="hero-image">

                        <!-- Price Badge -->
                        <div class="bg-fixed price-badge-md white-color position-absolute top-50 start-50 translate-middle"
                            data-aos="zoom-in" data-aos-delay="600">
                            <div class="badge-txt">
                                <h4 class="h4-xs">Koleksi</h4>
                                <h3 class="h6-lg">Koi Istimewa</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HERO TEXT -->
                <div class="text-center col-md-5 text-md-start" data-aos="fade-left"
                    data-aos-duration="1200">
                    <div class="hero-4-txt white-color">
                        <h2 class="mb-0 fw-bold">Azza Koi</h2>
                        <h3 class="text-warning fw-semibold">Farm</h3>

                        <p class="mt-3 mb-4 p-md">
                            Nikmati koleksi koi terbaik dengan warna memukau, sehat, dan dirawat dengan
                            penuh ketelatenan.
                        </p>

                        <a href="#"
                            class="btn btn-md btn-yellow tra-white-hover btn-animate">Tentang Kami</a>
                    </div>
                </div>

            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- END HERO-4 --> --}}

    <section class="wide-40 about-section division">
        <div class="container">
            <div class="row d-flex align-items-center">

                <!-- Gambar -->
                <div class="col-md-5 col-lg-6" data-aos="fade-right" data-aos-duration="1200">
                    <div class="mb-40 text-center about-3-img">
                        <img class="img-fluid" src="{{ asset('files/images/about-8.png') }}" alt="about-image">
                    </div>
                </div>

                <!-- Teks -->
                <div class="col-md-7 col-lg-6" id="tentangKami" data-aos="fade-up" data-aos-delay="300"
                    data-aos-duration="1000">
                    <div class="mb-40 about-3-txt">
                        <h2 class="h2-sm" data-aos="zoom-in" data-aos-delay="400">Tentang Kami – Azza
                            Koi Farm</h2>
                        <p class="p-md grey-color" data-aos="fade-up" data-aos-delay="600">
                            Azza Koi Farm adalah tempat budidaya koi yang berfokus pada kualitas,
                            kesehatan, dan keindahan setiap ekor ikan. Kami percaya bahwa koi bukan
                            hanya
                            sekadar ikan hias, tetapi juga simbol ketenangan, keberuntungan, dan seni
                            alami
                            yang menambah nilai estetika pada kolam Anda.
                        </p>

                        <div class="mt-4 abox-2-wrapper ico-70">
                            <div class="text-center row">
                                <div class="col-sm-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            <i class="fa-solid fa-fish fs-1"></i>
                                        </div>
                                        <h6 class="mt-2 h6-lg">Kualitas Terjamin</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3" data-aos="flip-left" data-aos-delay="400">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            <i class="fa-regular fa-handshake fs-1"></i>
                                        </div>
                                        <h6 class="mt-2 h6-lg">Kepercayaan Pelanggan</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3" data-aos="flip-left" data-aos-delay="600">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            <i class="fa-solid fa-hand-holding-dollar fs-1"></i>
                                        </div>
                                        <h6 class="mt-2 h6-lg">Harga Bersahabat</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3" data-aos="flip-left" data-aos-delay="800">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            <i class="fa-regular fa-headphones fs-1"></i>
                                        </div>
                                        <h6 class="mt-2 h6-lg">Pelayanan Profesional</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="menu-6" class=" wide-70 menu-section division">
        <div class="container" id="produk">
            <div class="text-center">
                <h3 class="h3-md meat-color">
                    Produk Kami
                </h3>
                @if (empty($produk))
                    Belum ada produk yang tersedia. Silakan kunjungi kembali nanti.
                @else
                    <p class="p-md grey-color">
                        Kami menghadirkan pilihan produk yang beragam, terpercaya, dan sesuai dengan
                        kebutuhan Anda.
                    </p>
                @endif
            </div>
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
                                    {{-- <h5 class="h5-sm">{{ $prod->nama_produk }}</h5> --}}
                                    <h5 class="h5-sm nama-produk">
                                        <a href="{{ url('produk/rinci/'. $prod->kode_produk) }}"
                                            class="text-dark text-decoration-none hover-underline">
                                            {{ $prod->nama_produk }}
                                        </a>
                                    </h5>


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
                @endif
            </div>
            @if (!empty(count($produk) == 4))
                <div class="d-flex justify-content-center">
                    <a href="{{ route('produkLengkap') }}"
                        class="px-4 py-2 shadow-sm btn btn-outline-secondary rounded-pill"
                        style="transition: all 0.3s ease; font-weight: 500; color: #b3140a;">
                        Selengkapnya
                    </a>
                </div>
            @endif
        </div>
    </section>

    <div id="reviews-1" class="bg-scroll bg-image reviews-section division">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 testimonials white-color">

                    <!-- TRANSPARENT QUOTE ICON -->
                    <div class="quote-icon"></div>

                    <!-- TESTIMONIALS CONTENT -->
                    <div class="flexslider">
                        <ul class="text-center slides">

                            <li class="review-1">
                                <div class="mx-auto review-1-txt" style="max-width:700px;">
                                    <img src="{{ asset('files/images/review-author-1.jpg') }}" alt="pelanggan-azza"
                                        class="mb-3 shadow rounded-circle" width="90" height="90">

                                    <p class="">“Ikan koi dari Azza Koi Farm benar-benar
                                        berkualitas! Warna ikannya cerah dan sehat semua. Pelayanannya
                                        juga cepat dan ramah, saya pasti akan beli lagi.”</p>

                                    <div class="mb-2 review-rating text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>

                                    <p class="mb-0 fw-semibold">Andi Prasetyo</p>
                                    <small class="text-secondary">Pelanggan dari Surabaya</small>
                                </div>
                            </li>

                            <!-- TESTIMONI 2 -->
                            <li class="review-1">
                                <div class="mx-auto review-1-txt" style="max-width:700px;">
                                    <img src="{{ asset('files/images/review-author-2.jpg') }}" alt="pelanggan-azza"
                                        class="mb-3 shadow rounded-circle" width="90" height="90">

                                    <p class="">“Pesan koi jumbo di Azza Koi Farm ternyata
                                        gampang banget! Adminnya responsif dan ikan dikirim dalam
                                        kondisi segar. Recommended banget buat pecinta koi.”</p>

                                    <div class="mb-2 review-rating text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>

                                    <p class="mb-0 fw-semibold">Siti Rahmawati</p>
                                    <small class="text-secondary">Pelanggan dari Malang</small>
                                </div>
                            </li>

                            <!-- TESTIMONI 3 -->
                            <li class="review-1">
                                <div class="mx-auto review-1-txt" style="max-width:700px;">
                                    <img src="{{ asset('files/images/review-author-3.jpg') }}" alt="pelanggan-azza"
                                        class="mb-3 shadow rounded-circle" width="90" height="90">

                                    <p class="">“Saya kagum dengan hasil ternakan Azza Koi
                                        Farm. Varian ikannya lengkap dan kualitasnya bagus. Harga juga
                                        bersahabat, cocok buat pemula maupun kolektor.”</p>

                                    <div class="mb-2 review-rating text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>

                                    <p class="mb-0 fw-semibold"> Rizky Saputra</p>
                                    <small class="text-secondary">Pelanggan dari Blitar</small>
                                </div>
                            </li>

                        </ul>
                    </div>
                    </ul>
                </div>

            </div>
        </div> <!-- End row -->
    </div> <!-- End container -->
    </div> <!-- END TESTIMONIALS-1 -->

    <section id="kontak" class="wide-70 menu-section division">
        <div class="container">
            <div class="row g-4">

                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <h3 class="mb-3 fw-bold meat-color">Informasi Kontak Kami</h3>
                    <p>Hubungi kami dengan mudah melalui Informasi Kontak Kami yang mencakup alamat,
                        telepon, dan jam
                        operasional.</p>

                    <!-- Alamat -->
                    <div class="mb-3 border-0 shadow-sm card">
                        <div class="card-body d-flex align-items-center">
                            <i class="p-2 text-white rounded fa-solid fa-map-location-dot fs-3 me-3"
                                style="background-color:#a0522d;"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Alamat</h5>
                                <p class="mb-0">
                                    Lingkungan Klemunan, Klemunan, Kec. Wlingi, Kabupaten Blitar, Jawa
                                    Timur 66184
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="mb-3 border-0 shadow-sm card">
                        <div class="card-body d-flex align-items-center">
                            <i class="p-2 text-white rounded fa-solid fa-address-book fs-3 me-3"
                                style="background-color:#a0522d;"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">
                                    Kontak
                                </h5>
                                <p class="mb-0">WhatsApp: +62 82 142 222 142<br>
                                    Instagram:
                                    @azzakoifarm_
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="mb-3 border-0 shadow-sm card">
                        <div class="card-body d-flex align-items-center">
                            <i class="p-2 text-white rounded fa-solid fa-clock fs-3 me-3"
                                style="background-color:#a0522d;"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Jam Operasional</h5>
                                <p class="mb-0">Setiap Hari : 10:00 - 20:30 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.9320477314495!2d112.32966517412606!3d-8.108401881120022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7895dae64834b5%3A0xfd3f89b1af065dcc!2sBasecamp%20Aza%20Koi%20Farms!5e0!3m2!1sid!2sid!4v1758073424053!5m2!1sid!2sid"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </section>

    <section id="about-7" class="bg-05 about-section division">
        <div class="container white-color">
            <div class="abox-4-wrapper ico-80">

                <h2 class="mb-4 text-center">Sering Ditanyakan</h2>
                <div class="container my-5 accordion" id="faqAccordion">

                    <!-- 6 -->
                    <div class="accordion-item" style="background-color: transparent; border: 1px solid #fff;">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="text-white accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq6"
                                style="background-color: rgba(0,0,0,0.2);">
                                Berapa biaya ongkir untuk pembelian ikan koi?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="text-white accordion-body">
                                Ongkir bervariasi tergantung lokasi dan jumlah pembelian. Estimasi
                                ongkir akan muncul
                                saat checkout, atau bisa hubungi admin untuk detail lebih lanjut.
                            </div>
                        </div>
                    </div>

                    <!-- 7 -->
                    <div class="accordion-item" style="background-color: transparent; border: 1px solid #fff;">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="text-white accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq7"
                                style="background-color: rgba(0,0,0,0.2);">
                                Apakah bisa request ukuran atau jenis koi tertentu?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="text-white accordion-body">
                                Bisa. Silakan hubungi kami melalui WhatsApp atau form kontak, kami akan
                                cek ketersediaan
                                stok sesuai permintaan Anda.
                            </div>
                        </div>
                    </div>

                    <!-- 8 -->
                    <div class="accordion-item" style="background-color: transparent; border: 1px solid #fff;">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="text-white accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq8"
                                style="background-color: rgba(0,0,0,0.2);">
                                Apakah ada perawatan khusus setelah koi sampai di rumah?
                            </button>
                        </h2>
                        <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="text-white accordion-body">
                                Ya. Biarkan koi beradaptasi dengan air baru terlebih dahulu (proses
                                aklimatisasi sekitar
                                15–30 menit) sebelum dilepas ke kolam.
                            </div>
                        </div>
                    </div>

                    <!-- 9 -->
                    <div class="accordion-item" style="background-color: transparent; border: 1px solid #fff;">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="text-white accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq9"
                                style="background-color: rgba(0,0,0,0.2);">
                                Apakah ada diskon untuk pembelian dalam jumlah banyak (grosir)?
                            </button>
                        </h2>
                        <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="text-white accordion-body">
                                Ada. Untuk pembelian dalam jumlah besar, silakan hubungi admin untuk
                                mendapatkan harga
                                spesial.
                            </div>
                        </div>
                    </div>

                    <!-- 10 -->
                    <div class="accordion-item" style="background-color: transparent; border: 1px solid #fff;">
                        <h2 class="accordion-header" id="headingTen">
                            <button class="text-white accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq10"
                                style="background-color: rgba(0,0,0,0.2);">
                                Apakah bisa datang langsung ke tempat untuk melihat koi?
                            </button>
                        </h2>
                        <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="text-white accordion-body">
                                Bisa, tentu saja. Kami juga melayani kunjungan langsung ke farm/kolam
                                dengan perjanjian
                                terlebih dahulu.
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div> <!-- End container -->
    </section> <!-- END ABOUT-7 -->
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
            AOS.init();
        </script>
    @endpush
@endsection

{{-- kurang itu efek bergetar pas nambah ke keranjang, admin ttp sama kurangny --}}
