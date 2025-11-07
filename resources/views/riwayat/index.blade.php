@extends('main')
@section('content')
    <style>
        /* === Panah dropdown berwarna biru soft === */
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child::before {
            background: transparent !important;
            /* hilangkan background */
            color: #4da6ff !important;
            /* panah biru soft */
            border: none !important;
            box-shadow: none !important;
            font-weight: bold;
            font-size: 18px;
            line-height: 18px;
        }

        /* Saat baris terbuka (ikon berubah jadi -) */
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child::before {
            color: #007bff !important;
            /* biru sedikit lebih tua */
        }

        /* === Gaya isi dropdown (detail row) === */
        table.dataTable tbody tr.child ul.dtr-details {
            background: #f8fbff;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 10px 0;
            border: 1px solid #e0ecff;
        }

        /* Gaya tiap baris data di dropdown */
        table.dataTable tbody tr.child ul.dtr-details li {
            margin-bottom: 6px;
            font-size: 14px;
            color: #333;
            display: flex;
            gap: 5px;
        }

        /* Judul kolom (label) */
        table.dataTable tbody tr.child ul.dtr-details li span.dtr-title {
            font-weight: 600;
            color: #007bff;
            margin-right: 5px;
        }

        /* Tambahkan tanda ":" otomatis setelah judul */
        table.dataTable tbody tr.child ul.dtr-details li span.dtr-title::after {
            content: ":";
            margin-left: 2px;
        }

        /* Nilai data (isi kolom) */
        table.dataTable tbody tr.child ul.dtr-details li span.dtr-data {
            color: #444;
        }
    </style>
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.25rem;
        }

        @media (max-width: 768px) {
            .card-header h5 {
                text-align: center;
                width: 100%;
            }

            .card-header input[type="date"] {
                width: 100% !important;
            }

            .card-header .d-flex {
                justify-content: center !important;
            }

            .card-header button {
                width: 100%;
            }
        }
    </style>
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
        <div class="card-header">
            <div class="row gy-2 align-items-center">
                <!-- Judul -->
                <div class="col-12 col-md-4 d-flex justify-content-md-start justify-content-center">
                    <h5 class="mb-0 fw-semibold text-nowrap">Riwayat Transaksi</h5>
                </div>

                <!-- Filter tanggal -->
                <div class="col-12 col-md-8">
                    <div
                        class="d-flex flex-wrap justify-content-md-end justify-content-center align-items-center gap-2">
                        <label for="dari-riwayat" class="col-form-label mb-0 text-nowrap">Dari</label>
                        <input type="date" id="dari-riwayat" class="form-control form-control-sm"
                            style="width: auto; min-width: 130px;">

                        <label for="sampai-riwayat"
                            class="col-form-label mb-0 text-nowrap">Sampai</label>
                        <input type="date" id="sampai-riwayat" class="form-control form-control-sm"
                            style="width: auto; min-width: 130px;">

                        <button type="button" id="resetFilter" class="btn btn-danger btn-sm"
                            title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </div>
                </div>
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
                                    <a href="{{ route('riwayat.detail', $item['kode_pesanan']) }}"
                                        class="btn btn-warning">
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
        {{-- <script>
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
        </script> --}}

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                // --- Inisialisasi DataTable ---
                var table = $('#riwayatTable').DataTable({
                    responsive: true,
                    dom: "<'row mb-3'<'col-md-6 d-flex align-items-center'B><'col-md-6 d-flex justify-content-end'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                    buttons: [{
                            extend: 'excelHtml5',
                            className: 'btn btn-success btn-sm m-1',
                            text: 'Export Excel'
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger btn-sm m-1',
                            text: 'Export PDF'
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-info btn-sm m-1',
                            text: 'Export CSV'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary btn-sm m-1',
                            text: 'Print'
                        }
                    ],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            next: "Berikutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });

                // --- Elemen date range ---
                const dariInput = document.getElementById("dari-riwayat");
                const sampaiInput = document.getElementById("sampai-riwayat");
                const resetBtn = document.getElementById("resetFilter");

                // --- Custom filter berdasarkan tanggal ---
                $.fn.dataTable.ext.search.push(function(settings, data) {
                    const dariDate = dariInput.value ? new Date(dariInput.value) : null;
                    const sampaiDate = sampaiInput.value ? new Date(sampaiInput.value) :
                        null;

                    // Ambil data tanggal dari kolom ke-2 (index 1)
                    const tanggalText = data[1].trim();
                    if (!tanggalText) return true;

                    // Format: dd-mm-yyyy → ubah jadi yyyy-mm-dd
                    const [dd, mm, yyyy] = tanggalText.split('-');
                    const tanggal = new Date(`${yyyy}-${mm}-${dd}`);

                    if (dariDate && tanggal < dariDate) return false;
                    if (sampaiDate && tanggal > sampaiDate) return false;
                    return true;
                });

                // --- Jalankan filter saat tanggal berubah ---
                function applyFilter() {
                    table.draw();
                }

                dariInput.addEventListener("change", applyFilter);
                sampaiInput.addEventListener("change", applyFilter);

                // --- Tombol reset ---
                resetBtn.addEventListener("click", function() {
                    dariInput.value = "";
                    sampaiInput.value = "";
                    table.draw();
                });

            });
        </script>
    @endpush
@endsection
