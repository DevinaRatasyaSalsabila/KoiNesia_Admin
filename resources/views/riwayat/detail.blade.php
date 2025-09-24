@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Detail Pesanan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Kode Pesanan</div>
                    <p class="card-text">{{ $pesanan->kode_pesanan }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Tanggal Pemesanan</div>
                    <p class="card-text">{{ $pesanan->created_at }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Nomor WhatsApp</div>
                    <p class="card-text">{{ $pembeli->no_hp }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Alamat</div>
                    <p class="card-text">{{ $pembeli->alamat }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Pesanan</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table mb-0 table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah Item</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->nama_produk }}</td>
                                <td>Rp{{ number_format($p->harga_Satuan, 0, ',', '.') }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td>Rp{{ number_format($p->nominal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="history.back()">
                        <i class="material-icons-outlined">arrow_back</i>
                    </a>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-0 card-title fw-medium">
                                {{-- Total Keseluruhan : Rp{{ number_format($totalKeseluruhan, 0, ',', '.') }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
