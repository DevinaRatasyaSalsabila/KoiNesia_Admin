{{-- @extends('main')
@section('content') --}}
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
                            <div class="menu-6-item bg-white">
                                <div class="menu-6-img rel">
                                    <div class="hover-overlay">
                                        <img class="img-fluid" src="{{ $prod['gambar_url'] }}"
                                            alt="menu-image" />
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
                                            class="btn-cart-add-1 shadow-none bg-yellow text-light ico-10"
                                            data-id="{{ $prod['kode_produk'] }}"
                                            data-nama="{{ $prod['nama_produk'] }}"
                                            data-harga="{{ $prod['harga_Satuan'] }}"
                                            data-gambar="{{ $prod['gambar_url'] }}">
                                            <span class="flaticon-shopping-bag"></span>
                                            Keranjang
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
{{-- @endsection --}}
