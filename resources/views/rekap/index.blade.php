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
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Rekap</div>
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
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Rekap</h5>
            <div class="input-group" style="width: 220px;">
                <label for="tanggal" class="col-form-label me-2">Filter</label>
                <input type="date" id="tanggal" name="tanggal" value="" class="form-control form-control-sm">
                {{-- <input type="month" id="tanggal" name="tanggal" value="" class="form-control form-control-sm"> --}}
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="rekapTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data['tanggal'] }}</td>
                                <td>Rp{{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var table = $('#rekapTable').DataTable({
                    responsive: true,
                    dom: "<'row mb-3'<'col-md-6 d-flex align-items-center'B><'col-md-6 d-flex justify-content-end'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                    buttons: [{
                            extend: 'excelHtml5',
                            className: 'btn btn-success btn-sm m-1',
                            text: 'Export Excel',
                            exportOptions: {
                                rows: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger btn-sm m-1',
                            text: 'Export PDF',
                            exportOptions: {
                                rows: ':visible'
                            },
                             customize: function(doc) {
                                doc.content[1].table.widths = ['10%', '30%', '30%', '30%'];
                                doc.pageMargins = [20, 20, 20, 20];
                                doc.defaultStyle.alignment = 'justify';
                                doc.defaultStyle.fontSize = 10;
                                doc.content[1].layout = {
                                    hLineWidth: function() {
                                        return 0.5;
                                    },
                                    vLineWidth: function() {
                                        return 0.5;
                                    },
                                    hLineColor: function() {
                                        return '#cccccc';
                                    },
                                    vLineColor: function() {
                                        return '#cccccc';
                                    },
                                    paddingLeft: function() {
                                        return 6;
                                    },
                                    paddingRight: function() {
                                        return 6;
                                    },
                                };
                                doc.styles.tableHeader = {
                                    alignment: 'center',
                                    bold: true,
                                    fillColor: '#eeeeee',
                                    color: 'black',
                                    fontSize: 11
                                };
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-info btn-sm m-1',
                            text: 'Export CSV',
                            exportOptions: {
                                rows: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary btn-sm m-1',
                            text: 'Print',
                            exportOptions: {
                                rows: ':visible'
                            }
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

                // Filter berdasarkan tanggal
                const filterInput = document.getElementById("tanggal");

                filterInput.addEventListener("change", function() {
                    const selectedDate = this.value;

                    // Filter kolom tanggal (kolom ke-2 = index 1)
                    table.column(1).search(selectedDate).draw();
                });
            });
        </script>
    @endpush
@endsection
