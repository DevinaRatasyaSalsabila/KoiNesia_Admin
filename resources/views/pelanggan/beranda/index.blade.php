@extends('main')
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
    {{-- <section id="hero-9" class="bg-03 hero-section">
        <div class="bg-fixed bg-inner division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center hero-9-txt white-color">
                            <h2>Azza Koi Farm</h2>
                            <p class="p-xl">
                                Nikmati koleksi koi terbaik dengan warna memukau, sehat, dan dirawat dengan penuh
                                ketelatenan.
                            </p>
                            <a href="#" class="btn btn-lg btn-meat tra-white-hover">
                                Tentang Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- HERO-4
                                                                                                                                               ============================================= -->
    <section id="hero-4" class="bg-fixed hero-section division">
        <div class="container">
            <div class="row d-flex align-items-center">


                <!-- HERO IMAGE -->
                <div class="col-md-7">
                    <div class="text-center hero-4-img">

                        <img class="img-fluid" src="{{ asset('files/images/koi-about.png') }}" alt="hero-image">

                        <!-- Price Badge -->
                        <div class="bg-fixed price-badge-md 1white-color">
                            <div class="badge-txt">
                                <h4 class="h4-xs">Koleksi</h4>
                                <h3 class="h6-lg">Koi Istimewa</h3>
                            </div>
                        </div>

                    </div>
                </div>


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



    <section id="" class="wide-40 about-section division">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-5 col-lg-6">
                    <div class="mb-40 text-center about-3-img">
                        <img class="img-fluid" src="{{ asset('files/images/about-8.png') }}" alt="about-image">
                    </div>
                </div>

                <div class="col-md-7 col-lg-6">
                    <div class="mb-40 about-3-txt">
                        <h2 class="h2-sm">Tentang Kami – Azza Koi Farm</h2>
                        <p class="p-md grey-color">
                            Azza Koi Farm adalah tempat budidaya koi yang berfokus pada kualitas,
                            kesehatan, dan keindahan
                            setiap ekor ikan. Kami percaya bahwa koi bukan hanya sekadar ikan hias,
                            tetapi juga simbol
                            ketenangan, keberuntungan, dan seni alami yang menambah nilai estetika pada
                            kolam Anda.
                        </p>
                        <div class="abox-2-wrapper ico-70">
                            <div class="text-center row">
                                <div class="col-sm-3">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            {{-- <span class="flaticon-fish"></span> --}}
                                            <i class="fa-solid fa-fish fs-1"></i>
                                        </div>
                                        <h6 class="h6-lg">Kualitas Terjamin</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            {{-- <span class="flaticon-fried-chicken"></span> --}}
                                            <i class="fa-regular fa-handshake fs-1"></i>
                                        </div>
                                        <h6 class="h6-lg">Kepercayaan Pelanggan</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            {{-- <span class="flaticon-best-price"></span> --}}
                                            <i class="fa-solid fa-hand-holding-dollar fs-1"></i>
                                        </div>
                                        <h6 class="h6-lg">Harga Bersahabat</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="abox-2">
                                        <div class="abox-2-ico grey-color">
                                            {{-- <span class="flaticon-moped"></span> --}}
                                            <i class="fa-regular fa-headphones fs-1"></i>
                                        </div>
                                        <h6 class="h6-lg">Pelayanan Profesional</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="menu-6" class="wide-70 menu-section division">
        <div class="container">
            <div class="text-center">
                <h3 class="h3-md meat-color">
                    Produk Kami
                </h3>
                <p class="p-md grey-color">
                    Kami menghadirkan pilihan produk yang beragam, terpercaya, dan sesuai dengan
                    kebutuhan Anda.
                </p>
            </div>
            <div class="row">
                @if (!empty($produk))
                    @foreach ($produk as $prod)
                        <div class="col-sm-4 col-lg-3">
                            <div class="bg-white menu-6-item">
                                <div class="menu-6-img rel">
                                    <div class="hover-overlay">
                                        <img class="img-fluid" src="{{ $prod['gambar_url'] }}" alt="menu-image" />
                                        <span class="item-code bg-tra-dark">Kode:
                                            {{ $prod['kode_produk'] }}</span>
                                        <div class="menu-img-zoom ico-25">
                                            <a href="{{ $prod['gambar_url'] }}" class="image-link">
                                                <span class="flaticon-zoom"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="menu-6-txt rel">
                                    <div class="like-ico ico-25">
                                        <a href="#">
                                            <span class="flaticon-heart"></span>
                                        </a>
                                    </div>
                                    <h5 class="h5-sm">
                                        {{ $prod['nama_produk'] }}
                                    </h5>
                                    <!-- Description -->
                                    <p class="grey-color">
                                        {{ \Illuminate\Support\Str::limit($prod['deskripsi_produk'], 25) }}
                                    </p>
                                    <div class="menu-6-price bg-meat">
                                        <h5 class="h6-xs yellow-color">
                                            {{ 'Rp ' . number_format($prod['harga_Satuan'], 0, ',', '.') }}

                                        </h5>
                                    </div>
                                    <div class="add-to-cart bg-yellow ico-10">
                                        <button type="button"
                                            class="shadow-none btn-cart-add-1 bg-yellow text-light ico-10"
                                            data-id="{{ $prod['kode_produk'] }}" data-nama="{{ $prod['nama_produk'] }}"
                                            data-harga="{{ $prod['harga_Satuan'] }}"
                                            data-stok="{{ $prod['stok_produk'] }}"
                                            data-ukuran="{{ $prod['ukuran_produk'] }}"
                                            data-gambar="{{ $prod['gambar_url'] }}">
                                            <span class="flaticon-shopping-bag"></span>
                                            {{-- Keranjang --}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Tidak Ada Produk.</p>
                @endif
            </div>
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


                            <!-- TESTIMONIAL-1 -->
                            <li class="review-1">
                                <div class="review-1-txt">

                                    <!-- Testimonial Author Avatar -->
                                    <img src="{{ asset('files/images/review-author-1.jpg') }}" alt="testimonial-avatar">

                                    <!-- Text -->
                                    <p>" Etiam sapien sem at sagittis congue augue massa varius sodales
                                        sapien undo tempus
                                        dolor
                                        egestas magna suscipit magna tempus aliquet porta sodales augue
                                        suscipit luctus
                                        neque "
                                    </p>

                                    <!-- Rating -->
                                    <div class="review-rating">
                                        <div class="stars-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>

                                    <!-- Testimonial Author -->
                                    <p class="testimonial-autor">by Sean McMarthy</p>

                                </div>
                            </li>


                            <!-- TESTIMONIAL-2 -->
                            <li class="review-1">
                                <div class="review-1-txt">

                                    <!-- Testimonial Author Avatar -->
                                    <img src="{{ asset('files/images/review-author-2.jpg') }}" alt="testimonial-avatar">

                                    <!-- Text -->
                                    <p>" At sagittis congue augue egestas egestas magna ipsum vitae
                                        purus ipsum primis in
                                        cubilia
                                        laoreet augue egestas luctus donec diam ociis nullam tempor
                                        sapien, eget orci
                                        gravida porta "
                                    </p>

                                    <!-- Rating -->
                                    <div class="review-rating">
                                        <div class="stars-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>

                                    <!-- Testimonial Author -->
                                    <p class="testimonial-autor">by Evelyn Martinez</p>

                                </div>

                            </li>


                            <!-- TESTIMONIAL-3 -->
                            <li class="review-1">
                                <div class="review-1-txt">

                                    <!-- Testimonial Author Avatar -->
                                    <img src="{{ asset('files/images/review-author-3.jpg') }}" alt="testimonial-avatar">

                                    <!-- Text -->
                                    <p>" Mauris donec ociis et magnis sapien etiam sapien sem sagittis
                                        congue augue. An orci
                                        nullam
                                        tempor sapien, eget orci gravida donec enim ipsum porta justo
                                        integer at odio velna
                                        auctor "
                                    </p>

                                    <!-- Rating -->
                                    <div class="review-rating">
                                        <div class="stars-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>

                                    <!-- Testimonial Author -->
                                    <p class="testimonial-autor">by Robert Peterson</p>

                                </div>

                            </li>
                        </ul>
                    </div>

                </div>
            </div> <!-- End row -->
        </div> <!-- End container -->
    </div> <!-- END TESTIMONIALS-1 -->

    <section id="kontak" class="py-5">
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
                                <p class="mb-0">Ruko Niaga 3 Kavling 3<br>Jl. Kalimantan Sananwetan
                                    Kota Blitar</p>
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

                <h2 class="mb-4 text-center">FAQ (Frequently Asked Questions)</h2>
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
                console.log("Jumlah tombol keranjang ketemu:", buttons.length);

                buttons.forEach(btn => {
                    btn.addEventListener("click", function(e) {
                        e.preventDefault();
                        console.log("✅ Tombol keranjang diklik!");

                        const produk = {
                            id: this.dataset.id,
                            nama: this.dataset.nama,
                            harga: parseInt(this.dataset.harga),
                            stok: parseInt(this.dataset.stok),
                            ukuran: this.dataset.ukuran,
                            gambar: this.dataset.gambar,
                            qty: 1,
                        };

                        console.log("Data produk:", produk);

                        if (!cart.find(item => item.id === produk.id)) {
                            cart.push(produk);
                            console.log("Produk baru ditambahkan ke cart:", produk);
                        } else {
                            console.log(
                                "Produk sudah ada di cart, tidak ditambahkan lagi."
                            );
                        }

                        localStorage.setItem("cart", JSON.stringify(cart));
                        updateCartUI();
                    });
                });

                function updateCartUI() {
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = cart.length;
                        console.log("Jumlah produk di cart sekarang:", cart.length);
                    }
                }

                updateCartUI();
            });
        </script>
    @endpush
@endsection
