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
        <div class="card-header">
            <div class="row gy-2 align-items-center">
                <!-- Judul -->
                <div class="col-12 col-md-4 d-flex justify-content-md-start justify-content-center">
                    <h5 class="mb-0 fw-semibold text-nowrap">Riwayat Transaksi</h5>
                </div>

                <!-- Filter tanggal -->
                <div class="col-12 col-md-8">
                    <div class="flex-wrap gap-2 d-flex justify-content-md-end justify-content-center align-items-center">
                        <label for="dari-riwayat" class="mb-0 col-form-label text-nowrap">Dari</label>
                        <input type="date" id="dari-riwayat" class="form-control form-control-sm"
                            style="width: auto; min-width: 130px;">

                        <label for="sampai-riwayat" class="mb-0 col-form-label text-nowrap">Sampai</label>
                        <input type="date" id="sampai-riwayat" class="form-control form-control-sm"
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
                <table id="riwayatTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input id="btnSelectAllRiwayat" type="checkbox" class="form-check-input">
                                </div>
                            </th>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Total Pembelian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="riwayatBody">
                        @foreach ($pesanan as $item)
                            <tr>
                                <td class="text-center align-middle">
                                    <input class="form-check-input checkbox-riwayat" type="checkbox"
                                        value="{{ $item['kode_pesanan'] }}">
                                </td>
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
            document.addEventListener("DOMContentLoaded", function() {
                var table = $('#riwayatTable').DataTable({
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
                                    const checkedIndexes = $('.checkbox-riwayat:checked').closest('tr')
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
                                const dari = $('#dari-riwayat').val();
                                const sampai = $('#sampai-pesanan').val();
                                if (dari && sampai) return `Riwayat Pesanan (${dari} - ${sampai})`;
                                if (dari) return `Riwayat Pesanan (Dari ${dari})`;
                                if (sampai) return `Riwayat Pesanan (Sampai ${sampai})`;
                                return 'Riwayat Pesanan';
                            },
                            customizeData: function(data) {
                                let total = 0;
                                data.body.forEach(row => {
                                    const angka = ((row[2] || '').toString()).replace(/[^\d]/g,'');
                                    total += parseInt(angka || 0);
                                });
                                data.body.push(['', 'Total Penjualan:',
                                    `Rp${total.toLocaleString('id-ID')}`
                                ]);
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-riwayat:checked').length;
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
                                    const checkedIndexes = $('.checkbox-riwayat:checked').closest('tr')
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
                                const sampai = $('#sampai-pesanan').val();
                                if (dari && sampai) return `Data Pesanan (${dari} - ${sampai})`;
                                if (dari) return `Data Pesanan (Dari ${dari})`;
                                if (sampai) return `Data Pesanan (Sampai ${sampai})`;
                                return 'Data Pesanan';
                            },
                            customizeData: function(data) {
                                let total = 0;
                                data.body.forEach(row => {
                                    const angka = row[3].replace(/[^\d]/g, '');
                                    total += parseInt(angka || 0);
                                });
                                data.body.push(['', '', 'Total Penjualan:', 'Rp ' + total
                                    .toLocaleString('id-ID')
                                ]);
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-riwayat:checked').length;
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
                                    const checkedIndexes = $('.checkbox-riwayat:checked').closest('tr')
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
                                const dari = $('#dari-riwayat').val();
                                const sampai = $('#sampai-riwayat').val();

                                let headerText = 'Data Pesanan';
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

                                if (!table || !table.body) return;

                                let total = 0;
                                table.body.forEach((row, idx) => {
                                    if (idx === 0) return;

                                    let cell = row[2];
                                    let textValue = '';

                                    if (Array.isArray(cell)) {
                                        textValue = cell.map(c => (typeof c.text === 'string' ?
                                            c.text : c)).join(' ');
                                    } else if (typeof cell === 'object' && cell !== null) {
                                        textValue = cell.text || '';
                                    } else {
                                        textValue = cell || '';
                                    }

                                    const nominalStr = textValue.toString().replace(/[^\d]/g,
                                        '');
                                    total += parseInt(nominalStr || 0);
                                });

                                table.body.push([{
                                        text: '',
                                        border: [false, false, false, false]
                                    },
                                    {
                                        text: 'Total Penjualan:',
                                        bold: true,
                                        alignment: 'right'
                                    },
                                    {
                                        text: `Rp ${total.toLocaleString('id-ID')}`,
                                        bold: true
                                    },
                                ]);

                                doc.pageMargins = [20, 20, 20, 30];
                                doc.defaultStyle.alignment = 'center';
                                doc.styles.tableHeader.alignment = 'center';
                                table.widths = ['30%', '35%', '35%'];
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-riwayat:checked').length;
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

                $('#btnSelectAllRiwayat').on('change', function() {
                    const isChecked = this.checked;
                    $('.checkbox-riwayat:visible').prop('checked', isChecked);
                });

                $('.checkbox-riwayat').on('change', function() {
                    const allChecked =
                        $('.checkbox-riwayat:visible').length === $('.checkbox-riwayat:visible:checked').length;
                    $('#btnSelectAllRiwayat').prop('checked', allChecked);
                });

                const dariInput = document.getElementById("dari-riwayat");
                const sampaiInput = document.getElementById("sampai-riwayat");
                const resetBtn = document.getElementById("resetFilter");

                $.fn.dataTable.ext.search.push(function(settings, data) {
                    const dariDate = dariInput.value ? new Date(dariInput.value) : null;
                    const sampaiDate = sampaiInput.value ? new Date(sampaiInput.value) :
                        null;

                    const tanggalText = data[1].trim();
                    if (!tanggalText) return true;

                    const [dd, mm, yyyy] = tanggalText.split('-');
                    const tanggal = new Date(`${yyyy}-${mm}-${dd}`);

                    if (dariDate && tanggal < dariDate) return false;
                    if (sampaiDate && tanggal > sampaiDate) return false;
                    return true;
                });

                function applyFilter() {
                    table.draw();
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
