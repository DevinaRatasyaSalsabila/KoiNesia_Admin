@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Riwayat Transaksi</div>
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

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5>Total Penjualan :</h5>
            <h6>Rp{{ number_format($pesananSelesai, 0, ',', '.') }}</h6>
        </div>
    </div>

    <!--end breadcrumb-->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Riwayat Transaksi</h5>
            <div class="input-group" style="width: 220px;">
                <label for="tanggal" class="col-form-label me-2">Filter</label>
                <input type="date" id="tanggal-riwayat" name="tanggal" value="" class="form-control form-control-sm">
                {{-- <input type="month" id="tanggal" name="tanggal" value="" class="form-control form-control-sm"> --}}
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="riwayatTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Total Pembelian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="riwayatBody">
                        @foreach ($pesanan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['tanggal'] }}</td>
                                <td>{{ $item['nama_pembeli'] }}</td>
                                <td>Rp{{ number_format($item['total_nominal'], 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('riwayat.detail', $item['kode_pesanan']) }}" class="btn btn-warning">
                                        <i class="fadeIn animated bx bx-clipboard text-light"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                var table = $('#riwayatTable').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });

            document.addEventListener("DOMContentLoaded", function () {
                const filterInput = document.getElementById("tanggal-riwayat");
                const riwayatBody = document.getElementById("riwayatBody");

                function filterTable() {
                    const selectedDate = filterInput.value;
                    const rows = riwayatBody.querySelectorAll("tr");

                    let visibleCount = 0;

                    rows.forEach(row => {
                        const tanggalCell = row.querySelector("td:nth-child(2)");
                        const tanggal = tanggalCell.textContent.trim();

                        if (selectedDate === "" || tanggal === selectedDate) {
                            row.style.display = "";
                            visibleCount++;
                        } else {
                            row.style.display = "none";
                        }
                    });

                    const emptyRow = document.getElementById("noDataRow");
                    if (emptyRow) emptyRow.remove();

                    if (visibleCount === 0) {
                        const tr = document.createElement("tr");
                        tr.id = "noDataRow";
                        tr.innerHTML = `
                <td colspan="5" class="text-center text-muted">
                    Data tidak tersedia pada rentang ini
                </td>
            `;
                        riwayatBody.appendChild(tr);
                    }
                }

                filterTable();

                filterInput.addEventListener("change", filterTable);
            });
        </script>
    @endpush
@endsection
