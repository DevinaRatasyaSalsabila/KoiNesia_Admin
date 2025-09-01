@extends('main')
@section('content')
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }
    </style>

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pesanan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">KoiNesia</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pesanan Terbaru</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_pesanan">
                <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered Pesanan">
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
                            <td>Rp5.000.000</td>
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
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#edit_pesanan">
                                    <i class="material-icons-outlined">edit</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Total Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @include('admin.modal.tambah')
    @include('pesanan.modal.edit')
    @include('pesanan.modal.tambah')
    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $("#example2").DataTable({
                    lengthChange: false,
                    buttons: ["copy", "excel", "pdf", "print"],
                });

                table.buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
            });
        </script>
    @endpush
@endsection
