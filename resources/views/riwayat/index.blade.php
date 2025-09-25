@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Riwayat Transaksi</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
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

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Riwayat Transaksi</h5>
            <div class="input-group" style="width: 420px;">
                <label for="tanggal" class="col-form-label me-2">Dari</label>
                <input type="date" id="dari-riwayat" class="form-control form-control-sm me-4">

                <label for="tanggal" class="col-form-label me-2">Sampai</label>
                <input type="date" id="sampai-riwayat" class="form-control form-control-sm">

                <button type="button" id="resetFilter" class="btn btn-danger btn-sm ms-2">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
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
            $(document).ready(function() {
                var table = $('#riwayatTable').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });

            document.addEventListener("DOMContentLoaded", function() {
                const dariInput = document.getElementById("dari-riwayat");
                const sampaiInput = document.getElementById("sampai-riwayat");
                const riwayatBody = document.getElementById("riwayatBody");
                const resetBtn = document.getElementById("resetFilter");

                function filterTable() {
                    const dariDate = dariInput.value ? new Date(dariInput.value) : null;
                    const sampaiDate = sampaiInput.value ? new Date(sampaiInput.value) : null;

                    const rows = riwayatBody.querySelectorAll("tr");
                    let visibleCount = 0;

                    const emptyRow = document.getElementById("noDataRow");
                    if (emptyRow) emptyRow.remove();

                    rows.forEach(row => {
                        const tanggalCell = row.querySelector("td:nth-child(2)");
                        const [dd, mm, yyyy] = tanggalCell.textContent.trim().split('-');
                        const tanggal = new Date(`${yyyy}-${mm}-${dd}`);

                        let showRow = true;
                        if (dariDate && tanggal < dariDate) showRow = false;
                        if (sampaiDate && tanggal > sampaiDate) showRow = false;

                        if (showRow) {
                            row.style.display = "";
                            visibleCount++;
                        } else {
                            row.style.display = "none";
                        }
                    });

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

                // Event filter
                dariInput.addEventListener("change", filterTable);
                sampaiInput.addEventListener("change", filterTable);

                // Event reset
                resetBtn.addEventListener("click", function() {
                    dariInput.value = "";
                    sampaiInput.value = "";

                    // tampilkan semua row
                    riwayatBody.querySelectorAll("tr").forEach(row => {
                        row.style.display = "";
                    });

                    // hapus pesan kosong kalau ada
                    const emptyRow = document.getElementById("noDataRow");
                    if (emptyRow) emptyRow.remove();
                });

                filterTable();
            });
        </script>
    @endpush
@endsection
