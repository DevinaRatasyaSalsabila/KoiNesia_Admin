@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row g-3">
        <!-- Sidebar Kiri (Statistik) -->
        <div class="row g-3">
            <!-- Card 1 - Produk -->
            <div class="col-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-primary bg-opacity-10 text-primary align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-package fs-1"></i>
                        </div>
                        <h4 class="mb-0">{{ $produk->count() }}</h4>
                        <p class="mb-0">Total Produk</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 - Pesanan -->
            <div class="col-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-success bg-opacity-10 text-success align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-cart-full fs-1"></i>
                        </div>
                        <h4 class="mb-0"> Rp{{ number_format($pendapatanPerBulan, 0, ',', '.') }}</h4>
                        <p class="mb-0">Pendapatan Bulan Ini</p>
                    </div>
                </div>
            </div>
            <!-- Card 1 - Produk -->
            <div class="col-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-primary bg-opacity-10 text-primary align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-package fs-1"></i>
                        </div>
                        <h4 class="mb-0">{{ $pesananSelesai->count() }}</h4>
                        <p class="mb-0">Produk Terjual</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 - Pesanan -->
            <div class="col-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-success bg-opacity-10 text-success align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-cart-full fs-1"></i>
                        </div>
                        <h4 class="mb-0">{{ $pesanan->count() }}</h4>
                        <p class="mb-0">Total Pesanan</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Konten Kanan (Chart) -->
        <div class="col-6 col-xl-6">
            <div class="card rounded-4 shadow-sm h-100">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Pendapatan Bulanan</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container1" style="height: 350px;">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-6">
            <div class="card rounded-4 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Pesanan Terbaru</h5>
                    <hr>
                    <div class="d-flex flex-column gap-3">
                        @forelse ($pesananNew as $item)
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/produk/final/' . $item->gambar) }}" width="70"
                                    class="rounded-3 shadow-sm" alt="Produk">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold">{{ $item->kode_pesanan }}</h6>
                                    <p class="mb-0 text-muted small">
                                        Jumlah: {{ $item->total_barang }} |
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-success fw-bold">
                                        Rp{{ number_format($item->total_nominal, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Tidak ada pesanan terbaru</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->
{{--
    <div class="mt-3 row g-3">
        <!-- Kiri -->
        <div class="col-3 col-xl-3 d-flex flex-column gap-3">
            <!-- Card 1 - Produk Terjual -->
            <div class="card rounded-4 shadow-sm flex-fill">
                <div class="card-body text-center d-flex flex-column align-items-center">
                    <div
                        class="mb-2 wh-48 d-flex bg-primary bg-opacity-10 text-primary align-items-center justify-content-center rounded-circle">
                        <i class="lni lni-tag fs-1"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $pesananSelesai->count() }}</h4>
                    <p class="mb-0">Produk Terjual</p>
                </div>
            </div>

            <!-- Card 2 - Pendapatan Bulan Ini -->
            <div class="card rounded-4 shadow-sm flex-fill">
                <div class="card-body text-center d-flex flex-column align-items-center">
                    <div
                        class="mb-2 wh-48 d-flex bg-success bg-opacity-10 text-success align-items-center justify-content-center rounded-circle">
                        <i class="lni lni-dollar fs-1"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-success">
                        Rp{{ number_format($pendapatanPerBulan, 0, ',', '.') }}
                    </h5>
                    <p class="mb-0">Pendapatan Bulan Ini</p>
                </div>
            </div>
        </div>

        <!-- Kanan - Pesanan Terbaru -->
        <div class="col-12 col-xl-9">
            <div class="card rounded-4 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Pesanan Terbaru</h5>
                    <hr>
                    <div class="d-flex flex-column gap-3">
                        @forelse ($pesananNew as $item)
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/produk/final/' . $item->gambar) }}" width="70"
                                    class="rounded-3 shadow-sm" alt="Produk">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold">{{ $item->kode_pesanan }}</h6>
                                    <p class="mb-0 text-muted small">
                                        Jumlah: {{ $item->total_barang }} |
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-success fw-bold">
                                        Rp{{ number_format($item->total_nominal, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Tidak ada pesanan terbaru</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row --> --}}

    @push('scripts')
        <script>
            window.chartData = {
                penjualan: @json($penjualanData),
                pengeluaran: @json($PengeluaranData),
            };
        </script>
    @endpush
@endsection
