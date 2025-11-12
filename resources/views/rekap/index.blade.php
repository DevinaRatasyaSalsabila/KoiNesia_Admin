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
        <div class="card-header">
            <div class="row gy-2 align-items-center">
                <!-- Judul -->
                <div class="col-12 col-md-4 d-flex justify-content-md-start justify-content-center">
                    <h5 class="mb-0 fw-semibold text-nowrap">Rekap</h5>
                </div>

                <!-- Filter tanggal -->
                <div class="col-12 col-md-8">
                    <div class="flex-wrap gap-2 d-flex justify-content-md-end justify-content-center align-items-center">
                        <label for="dari-rekap" class="mb-0 col-form-label text-nowrap">Dari</label>
                        <input type="date" id="dari-rekap" class="form-control form-control-sm"
                            style="width: auto; min-width: 130px;">

                        <label for="sampai-rekap" class="mb-0 col-form-label text-nowrap">Sampai</label>
                        <input type="date" id="sampai-rekap" class="form-control form-control-sm"
                            style="width: auto; min-width: 130px;">

                        <button type="button" id="resetFilter" class="btn btn-danger btn-sm" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="rekapTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input id="btnSelectAllRekap" type="checkbox" class="form-check-input">
                                </div>
                            </th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $data)
                            <tr>
                                <td class="text-center align-middle">
                                    <input class="form-check-input checkbox-rekap" type="checkbox"
                                        value="{{ $data['tanggal'] }}">
                                </td>
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
                                columns: [1, 2, 3],
                                rows: function(idx, data, node) {
                                    const checkedIndexes = $('.checkbox-rekap:checked').closest('tr')
                                        .map(function() {
                                            return table.row(this).index();
                                        }).get();
                                    return checkedIndexes.includes(idx);
                                },
                                format: {
                                    body: function(data, row, column, node) {
                                        if ($(node).find('select').length) {
                                            return $(node).find('select option:selected').text().trim();
                                        }
                                        return $(node).text().trim();
                                    }
                                }
                            },
                            messageTop: function() {
                                const dari = $('#dari-rekap').val();
                                const sampai = $('#sampai-rekap').val();
                                if (dari && sampai) return `Rekap (${dari} - ${sampai})`;
                                if (dari) return `Rekap (Dari ${dari})`;
                                if (sampai) return `Rekap (Sampai ${sampai})`;
                                return 'Rekap';
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-rekap:checked').length;
                                if (checked === 0) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Pilih setidaknya 1 data untuk di-export!',
                                    });
                                    return;
                                }
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button,
                                    config);
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-info text-light btn-sm m-1',
                            text: 'Export CSV',
                            exportOptions: {
                                columns: [1, 2, 3],
                                rows: function(idx, data, node) {
                                    const checkedIndexes = $('.checkbox-rekap:checked').closest('tr')
                                        .map(function() {
                                            return table.row(this).index();
                                        }).get();
                                    return checkedIndexes.includes(idx);
                                },
                                format: {
                                    body: function(data, row, column, node) {
                                        if ($(node).find('select').length) {
                                            return $(node).find('select option:selected').text().trim();
                                        }
                                        return $(node).text().trim();
                                    }
                                }
                            },
                            messageTop: function() {
                                const dari = $('#dari-pesanan').val();
                                const sampai = $('#sampai-rekap').val();
                                if (dari && sampai) return `Rekap (${dari} - ${sampai})`;
                                if (dari) return `Rekap (Dari ${dari})`;
                                if (sampai) return `Rekap (Sampai ${sampai})`;
                                return 'Rekap';
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-rekap:checked').length;
                                if (checked === 0) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Pilih setidaknya 1 data untuk di-export!',
                                    });
                                    return;
                                }
                                $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button,
                                    config);
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger btn-sm m-1',
                            text: 'Export PDF',
                            exportOptions: {
                                columns: [1, 2, 3],
                                rows: function(idx, data, node) {
                                    const checkedIndexes = $('.checkbox-rekap:checked').closest('tr')
                                        .map(function() {
                                            return table.row(this).index();
                                        }).get();
                                    return checkedIndexes.includes(idx);
                                },
                                format: {
                                    body: function(data, row, column, node) {
                                        if ($(node).find('select').length) {
                                            return $(node).find('select option:selected').text().trim();
                                        }
                                        return $(node).text().trim();
                                    }
                                }
                            },
                            customize: function(doc) {
                                const dari = $('#dari-rekap').val();
                                const sampai = $('#sampai-rekap').val();

                                let headerText = 'Rekap';
                                if (dari && sampai) headerText += ` (${dari} - ${sampai})`;
                                else if (dari) headerText += ` (Dari ${dari})`;
                                else if (sampai) headerText += ` (Sampai ${sampai})`;

                                doc.content.unshift({
                                    text: headerText,
                                    fontSize: 14,
                                    bold: true,
                                    alignment: 'center',
                                    margin: [0, 0, 0, 15],
                                });

                                let table = null;
                                for (let i = 0; i < doc.content.length; i++) {
                                    if (doc.content[i].table) {
                                        table = doc.content[i].table;
                                        break;
                                    }
                                }

                                doc.pageMargins = [20, 20, 20, 30];
                                doc.defaultStyle.alignment = 'center';
                                doc.styles.tableHeader.alignment = 'center';
                                table.widths = ['30%', '35%', '35%'];
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-rekap:checked').length;
                                if (checked === 0) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Pilih setidaknya 1 data untuk di-export!',
                                    });
                                    return;
                                }
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button,
                                    config);
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary text-light btn-sm m-1',
                            text: 'Print',
                            exportOptions: {
                                columns: [1, 2, 3]
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

                $('#btnSelectAllRekap').on('change', function() {
                    const isChecked = this.checked;
                    $('.checkbox-rekap:visible').prop('checked', isChecked);
                });

                $('.checkbox-rekap').on('change', function() {
                    const allChecked =
                        $('.checkbox-rekap:visible').length === $('.checkbox-rekap:visible:checked').length;
                    $('#btnSelectAllRekap').prop('checked', allChecked);
                });

                const dariInput = document.getElementById("dari-rekap");
                const sampaiInput = document.getElementById("sampai-rekap");
                const resetBtn = document.getElementById("resetFilter");

                $.fn.dataTable.ext.search.push(function(settings, data) {
                    const dariVal = dariInput.value;
                    const sampaiVal = sampaiInput.value;

                    function toYMDInt(txt) {
                        if (!txt) return null;
                        txt = txt.trim();

                        if (txt.indexOf(' ') !== -1) txt = txt.split(' ')[0];

                        if (/^\d{4}-\d{2}-\d{2}$/.test(txt)) {
                            const [y, m, d] = txt.split('-');
                            return parseInt(y + (m.padStart(2, '0')) + (d.padStart(2, '0')), 10);
                        }

                        if (/^\d{2}-\d{2}-\d{4}$/.test(txt)) {
                            const [d, m, y] = txt.split('-');
                            return parseInt(y + (m.padStart(2, '0')) + (d.padStart(2, '0')), 10);
                        }

                        const tryParts = txt.match(/\d{4}-\d{2}-\d{2}/);
                        if (tryParts) {
                            const [y, m, d] = tryParts[0].split('-');
                            return parseInt(y + (m.padStart(2, '0')) + (d.padStart(2, '0')), 10);
                        }

                        return null;
                    }

                    const dariInt = toYMDInt(dariVal);
                    const sampaiInt = toYMDInt(sampaiVal);

                    const tanggalText = (data[1] || '').toString().trim();
                    if (!tanggalText) return true;

                    const rowInt = toYMDInt(tanggalText);
                    if (!rowInt) return true;

                    if (dariInt && rowInt < dariInt) return false;
                    if (sampaiInt && rowInt > sampaiInt) return false;
                    return true;
                });

                function applyFilter() {
                    table.draw();
                    $('#btnSelectAllRekap').prop('checked', false);
                    $('.checkbox-rekap').prop('checked', false);
                }

                dariInput.addEventListener("change", applyFilter);
                sampaiInput.addEventListener("change",
                    applyFilter);

                resetBtn.addEventListener("click", function() {
                    dariInput.value = "";
                    sampaiInput.value = "";
                    table.draw();
                });
            });
        </script>
    @endpush
@endsection
