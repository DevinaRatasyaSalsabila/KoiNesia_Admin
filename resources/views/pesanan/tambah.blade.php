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
                    <li class="breadcrumb-item active" aria-current="page">KoiNesia</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pesanan Terbaru</h5>
                <button type="button" class="btn btn-sm btn-success">Tambah</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered Pesanan">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Total Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-20-02</td>
                            <td>Albert Cook</td>
                            <td>
                                Rp5.000.000
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="p-0 btn dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-warning" href="javascript:void(0);"><i
                                                class="ri-pencil-line me-1"></i> Baru</a>
                                        <a class="dropdown-item text-primary" href="javascript:void(0);"><i
                                                class="ri-pencil-line me-1"></i> Diproses</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ url('detail') }}" class="text-decoration-none text-dark">
                                    <i class="material-icons-outlined">content_paste</i>
                                </a>
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="material-icons-outlined">delete</i>
                                </a>
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="material-icons-outlined">edit</i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
