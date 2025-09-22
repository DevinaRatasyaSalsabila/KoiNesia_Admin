@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    @if (Auth::check())
        <p>udh login</p>
    @else
        <p>belum login</p>
    @endif

    <div class="row g-3">
        <!-- Kiri -->
        <div class="col-12 col-xl-2 d-flex flex-column gap-3">
            <!-- Card 1 -->
            <div class="card rounded-4 flex-fill">
                <div class="card-body d-flex flex-column align-items-center text-center">
                    <div
                        class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle mb-2">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <h4 class="mb-0">{{ $produk->count() }}</h4>
                    <p class="mb-0">Total Produk</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card rounded-4 flex-fill">
                <div class="card-body d-flex flex-column align-items-center text-center">
                    <div
                        class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle mb-2">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <h4 class="mb-0">{{ $pesanan->count() }}</h4>
                    <p class="mb-0">Total Pesanan</p>
                </div>
            </div>
        </div>

        <!-- Kanan -->
        <div class="col-12 col-xl-10 d-flex">
            <div class="card rounded-4 w-100 h-100">
                <div class="card-header py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Pendapatan Bulanan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->

    <div class="row g-3 mt-3">
        <!-- Kiri -->
        <div class="col-12 col-xl-2 d-flex flex-column gap-3">
            <!-- Card 1 -->
            <div class="card rounded-4 flex-fill">
                <div class="card-body d-flex flex-column align-items-center text-center">
                    <div
                        class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle mb-2">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <h4 class="mb-0">{{ $pesananSelesai->count() }}</h4>
                    <p class="mb-0">Produk Terjual</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card rounded-4 flex-fill">
                <div class="card-body d-flex flex-column align-items-center text-center">
                    <div
                        class="wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle mb-2">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <div class="mb-0 d-flex justify-content-between align-items-center">
                        <p>Rp</p> {{ number_format($pendapatanPerBulan, 0, ',', '.') }}
                    </div>
                    <p class="mb-0">Pendapatan Perbulan</p>
                </div>
            </div>
        </div>

        <!-- Kanan -->
        <div class="col-12 col-xl-10 d-flex">
            <div class="card rounded-4 w-100 h-100">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Pesanan Terbaru</h5>
                    <hr>
                    <div class="d-flex flex-column gap-3">
                        <!-- Pesanan 1 -->
                        @foreach ($pesananNew as $item)
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/produk/final/' . $item->gambar) }}" width="70"
                                    class="rounded-3" alt="Produk">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold">{{ $item->kode_pesanan }}</h6>
                                    <p class="mb-0">
                                        Jumlah: {{ $item->total_barang }} |
                                        Tanggal: {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-success">Rp{{ number_format($item->total_nominal, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                        <!-- Pesanan 2 -->
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
