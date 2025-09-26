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
        <!-- Kiri -->
        <div class="gap-3 col-12 col-xl-2 d-flex flex-column">
            <!-- Card 1 -->
            <div class="card rounded-4 flex-fill">
                <div class="text-center card-body d-flex flex-column align-items-center">
                    <div
                        class="mb-2 wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <h4 class="mb-0">{{ $produk->count() }}</h4>
                    <p class="mb-0">Total Produk</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card rounded-4 flex-fill">
                <div class="text-center card-body d-flex flex-column align-items-center">
                    <div
                        class="mb-2 wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
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
                <div class="py-3 card-header">
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

    <div class="mt-3 row g-3">
        <!-- Kiri -->
        <div class="gap-3 col-12 col-xl-2 d-flex flex-column">
            <!-- Card 1 -->
            <div class="card rounded-4 flex-fill">
                <div class="text-center card-body d-flex flex-column align-items-center">
                    <div
                        class="mb-2 wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <h4 class="mb-0">{{ $pesananSelesai->count() }}</h4>
                    <p class="mb-0">Produk Terjual</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card rounded-4 flex-fill">
                <div class="text-center card-body d-flex flex-column align-items-center">
                    <div
                        class="mb-2 wh-48 d-flex bg-danger text-danger bg-opacity-10 align-items-center justify-content-center rounded-circle">
                        <i class="lni lni-page-break text-danger fs-1"></i>
                    </div>
                    <div class="mb-0 d-flex justify-content-between align-items-center">
                        <p>Rp</p> {{ number_format($pendapatanPerBulan, 0, ',', '.') }}
                    </div>
                    <p class="mb-0">Pendapatan Bulan Ini</p>
                </div>
            </div>
        </div>

        <!-- Kanan -->
        <div class="col-12 col-xl-10 d-flex">
            <div class="card rounded-4 w-100 h-100">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Pesanan Terbaru</h5>
                    <hr>
                    <div class="gap-3 d-flex flex-column">
                        <!-- Pesanan 1 -->
                        @forelse ($pesananNew as $item)
                            <div class="gap-3 d-flex align-items-center">
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
                            @empty
                            <p class="text-center">Tidak ada pesanan terbaru</p>
                        @endforelse
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
