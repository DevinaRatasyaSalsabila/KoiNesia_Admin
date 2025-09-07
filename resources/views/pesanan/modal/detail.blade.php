@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Pesanan</div>
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
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Tanggal Pemesanan</div>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Nomor WhatsApp</div>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-bolder">Alamat</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
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
                            <tr>
                                <td>1</td>
                                <td>Albert</td>
                                <td>Rp5.000.000</td>
                                <td>1</td>
                                <td>Rp5.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="history.back()">
                            <i class="material-icons-outlined">arrow_back</i>
                        </a>
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-0 card-title fw-medium">
                                    Total Keseluruhan : Rp5.000.000
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
