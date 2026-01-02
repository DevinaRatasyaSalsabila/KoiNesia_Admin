@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @php
        $tampilAlert = !$pengaturan || empty($pengaturan->gambar);
    @endphp

    @if ($tampilAlert)
        <div class="alert alert-warning alert-dismissible fade show">
            <div>
                {{-- <span class="material-icons-outlined">
                    info 
                </span> --}}
                 Isi pengaturan gambar QR pembayaran terlebih dahulu
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="row g-3">
        <!-- Statistik -->
        <div class="row g-3">
            <!-- Card 1 - Total Produk -->
            <div class="col-12 col-sm-6 col-lg-3">
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

            <!-- Card 2 - Pendapatan Bulan Ini -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-success bg-opacity-10 text-success align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-dollar fs-1"></i>
                        </div>
                        <h4 class="mb-0">Rp{{ number_format($pendapatanPerBulan, 0, ',', '.') }}</h4>
                        <p class="mb-0">Pendapatan Bulan Ini</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 - Item Terjual -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-info bg-opacity-10 text-info align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-bar-chart fs-1"></i>
                        </div>
                        <h4 class="mb-0">{{ $pesananSelesai }}</h4>
                        <p class="mb-0">Item Terjual</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 - Total Pesanan -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card rounded-4 shadow-sm text-center">
                    <div class="card-body py-3">
                        <div
                            class="mb-2 wh-48 d-flex bg-warning bg-opacity-10 text-warning align-items-center justify-content-center rounded-circle mx-auto">
                            <i class="lni lni-cart-full fs-1"></i>
                        </div>
                        <h4 class="mb-0">{{ $pesanan->count() }}</h4>
                        <p class="mb-0">Total Pesanan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik dan Pesanan -->
        <div class="row g-3 mt-1">
            <!-- Chart -->
            <div class="col-12 col-lg-6">
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

            <!-- Pesanan Terbaru -->
            <div class="col-12 col-lg-6">
                <div class="card rounded-4 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Pesanan Terbaru</h5>
                        <hr>
                        <div class="d-flex flex-column gap-3">
                            @forelse ($pesananNew as $item)
                                <div class="d-flex align-items-center gap-3 flex-wrap">
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
        </div>
    </div><!-- end row -->

    @push('scripts')
        <script>
            window.chartData = {
                penjualan: @json($penjualanData),
                pengeluaran: @json($PengeluaranData),
            };
        </script>
    @endpush
@endsection
