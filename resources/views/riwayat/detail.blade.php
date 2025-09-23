{{-- lk aku nangkepe ini detail rekap ngge menampilkan riwayat pesanan di tanggal itu (semua di tanggal itu) --}}
@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Detail Riwayat Transaksi</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Azza Koi Farm
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stay at home</h5>
                    <p class="card-text">Nam libero tempore, cum soluta nobis est
                        eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                        assumenda est, omnis dolor repellendus Temporibus autem
                        quibusdam et aut officiis debitis aut rerum necessitatibus saepe.</p>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stay at home</h5>
                    <p class="card-text">Nam libero tempore, cum soluta nobis est
                        eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                        assumenda est, omnis dolor repellendus Temporibus autem
                        quibusdam et aut officiis debitis aut rerum necessitatibus saepe.</p>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stay at home</h5>
                    <p class="card-text">Nam libero tempore, cum soluta nobis est
                        eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                        assumenda est, omnis dolor repellendus Temporibus autem
                        quibusdam et aut officiis debitis aut rerum necessitatibus saepe.</p>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stay at home</h5>
                    <p class="card-text">Nam libero tempore, cum soluta nobis est
                        eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                        assumenda est, omnis dolor repellendus Temporibus autem
                        quibusdam et aut officiis debitis aut rerum necessitatibus saepe.</p>

                </div>
            </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Riwayat Transaksi</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Produk</th>
                            <th>Total Seluruh Produk</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Koi Uk-19</td>
                            <td>Rp308.000</td>
                            <td>1</td>
                            <td>Rp308.000</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Item</th>
                            <th>Total</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#example2').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush
@endsection
