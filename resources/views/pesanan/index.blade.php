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

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.25rem;
        }

        @media (max-width: 768px) {
            .card-header .row>div {
                text-align: center;
            }

            .card-header h5 {
                width: 100%;
            }

            .card-header input[type="date"] {
                width: 100% !important;
            }

            .card-header .btn {
                flex: 1 1 auto;
            }

            .card-header .d-flex {
                justify-content: center !important;
            }
        }
    </style>

    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Pesanan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active" aria-current="page">Azza Koi Farm</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row gy-2 align-items-center">
                <!-- Kiri: Judul dan tombol pilih semua -->
                <div class="flex-wrap gap-2 col-12 col-md-5 d-flex align-items-center">
                    <h5 class="flex-shrink-0 mb-0 fw-semibold text-nowrap">Daftar Pesanan Terbaru</h5>
                    <button type="button" id="btnSelectAllPesanan" class="btn btn-secondary btn-sm">
                        <i class="bi bi-check2-circle"></i> Pilih Semua
                    </button>
                </div>

                <!-- Kanan: Filter dan Tombol Aksi -->
                <div class="col-12 col-md-7">
                    <div class="flex-wrap gap-2 d-flex justify-content-md-end align-items-center">
                        <div class="flex-wrap gap-2 d-flex align-items-center flex-grow-1 flex-md-grow-0">
                            <label for="dari-pesanan" class="mb-0 col-form-label text-nowrap">Dari</label>
                            <input type="date" id="dari-pesanan" class="form-control form-control-sm"
                                style="width: auto; min-width: 130px;">
                            <label for="sampai-pesanan" class="mb-0 col-form-label text-nowrap">Sampai</label>
                            <input type="date" id="sampai-pesanan" class="form-control form-control-sm"
                                style="width: auto; min-width: 130px;">
                        </div>

                        <div class="gap-2 d-flex align-items-center">
                            <button type="button" id="resetPesananFilter" class="btn btn-danger btn-sm"
                                title="Reset Filter">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                            <button type="button" id="btnPrintPesanan" class="btn btn-secondary btn-sm"
                                title="Cetak Daftar Pesanan">
                                <i class="bi bi-printer"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#tambah_pesanan" title="Tambah Pesanan Baru">
                                <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel_pesanan" class="table table-striped table-bordered Pesanan">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Nominal Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    @php
                        $pesananGrouped = collect($pesanan)->groupBy('kode_pesanan');
                    @endphp

                    <tbody>
                        @foreach ($pesananGrouped as $kodePesanan => $items)
                            @php
                                $first = $items->first();
                                $totalNominal = $items->sum(fn($r) => isset($r->nominal) ? (float) $r->nominal : 0);
                            @endphp
                            <tr data-id="{{ $first->kode_pesanan }}">
                                <td class="text-center align-middle">
                                    <input class="form-check-input checkbox-pesanan" type="checkbox"
                                        value="{{ $first->kode_pesanan }}">
                                </td>
                                <td class="align-middle" data-tanggal="{{ $first->pesanan_created_at }}">
                                    {{ \Carbon\Carbon::parse($first->pesanan_created_at)->format('d-m-Y') }}
                                </td>
                                <td class="align-middle">
                                    {{ $first->id_pembeli == 0 ? '-' : $first->pembeli_nama ?? '-' }}
                                </td>
                                <td class="align-middle">
                                    Rp{{ number_format($totalNominal, 0, ',', '.') }}</td>
                                <td class="align-middle">
                                    <select class="form-select update-status-select fw-bold"
                                        data-id="{{ $first->kode_pesanan }}">
                                        <option value="baru" data-color="#0d6efd"
                                            {{ ($first->status ?? '') == 'baru' ? 'selected' : '' }}>
                                            Baru</option>
                                        <option value="proses" data-color="#ffc107"
                                            {{ ($first->status ?? '') == 'proses' ? 'selected' : '' }}>
                                            Diproses</option>
                                        <option value="selesai" data-color="#198754"
                                            {{ ($first->status ?? '') == 'selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                    </select>
                                </td>
                                <td class="align-middle">
                                    <div class="flex-wrap gap-1 d-flex justify-content-center">
                                        <a href="{{ route('pesanan.detail', $first->kode_pesanan) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fadeIn animated bx bx-info-circle fs-6"></i>
                                        </a>
                                        <form action="{{ route('pesanan.delete', $first->kode_pesanan) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm confirm-delete-button">
                                                <i class="fadeIn animated bx bx-trash text-light fs-6"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit_pesanan_{{ $first->kode_pesanan }}">
                                            <i class="fadeIn animated bx bx-pencil text-light fs-6"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pesanan.modal.edit')
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Nominal Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    @include('pesanan.modal.tambah')
    @include('pesanan.modal.modalPembeli.tambahPembeli')

    @push('scripts')
        <script>
            let updateStatusUrl = "{{ route('pesanan.updateStatus', ':id') }}";

            $(document).on('focus', '.update-status-select', function() {
                $(this).data('previous', $(this).val());
            });

            $(document).on('change', '.update-status-select', function() {
                const select = $(this);
                const previous = select.data('previous'); // nilai sebelum diubah
                const value = select.val();

                // helper function untuk kirim ajax (DRY)
                function sendUpdate(statusToSend) {
                    const id = select.data('id');
                    const url = updateStatusUrl.replace(':id', id);
                    const row = select.closest('tr');

                    // disable select sementara biar ga double click
                    select.prop('disabled', true);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            status: statusToSend,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            console.log('Status updated:', res);
                            Swal.fire({
                                title: "Berhasil!",
                                text: `Status telah diubah menjadi '${statusToSend}'.`,
                                icon: "success",
                                confirmButtonText: "Oke!"
                            });

                            // kalau 'selesai', hapus row dari datatable (kalau memang mau)
                            if (statusToSend === 'selesai') {
                                let table = $("#tabel_pesanan").DataTable();
                                table.row(row).remove().draw(false);
                                alert('Riwayat pesanan telah tersimpan');
                            }

                            // update previous/data current ke nilai baru
                            select.data('previous', statusToSend);
                            select.prop('disabled', false);
                        },
                        error: function(err) {
                            console.log(err.responseJSON);
                            Swal.fire({
                                title: "Error!",
                                text: "Gagal mengubah status.",
                                icon: "error"
                            });
                            // revert ke previous karena gagal
                            select.val(previous);
                            select.prop('disabled', false);
                        }
                    });
                }

                // Konfirmasi tergantung value
                if (value === 'proses') {
                    Swal.fire({
                        title: "Yakin mengganti status menjadi 'Diproses'?",
                        text: "Pastikan pembeli sudah membayar!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            sendUpdate('proses');
                        } else {
                            select.val(previous);
                        }
                    });
                } else if (value === 'selesai') {
                    Swal.fire({
                        title: "Yakin mengganti status menjadi 'Selesai'?",
                        text: "Pastikan pesanan sudah siap diantar / diambil!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            sendUpdate('selesai');
                        } else {
                            select.val(previous);
                        }
                    });
                } else {
                    // kalau ada status lain (contoh 'baru'), kita cuma update previous
                    select.data('previous', value);
                }
            });

            $(document).on('click', '.confirm-delete-button', function(e) {
                e.preventDefault();

                const form = $(this).closest('form');

                Swal.fire({
                    title: "Yakin ingin menghapus produk?",
                    text: "Produk yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            document.querySelectorAll('.update-status-select').forEach(select => {
                const updateColor = (el) => {
                    el.classList.remove('text-warning', 'text-primary');

                    const selectedText = el.options[el.selectedIndex].text.trim();

                    if (selectedText === 'Baru') {
                        el.classList.add('text-warning');
                    } else if (selectedText === 'Diproses') {
                        el.classList.add('text-primary');
                    }
                };

                updateColor(select);

                select.addEventListener('change', () => updateColor(select));
            });
        </script>

        <script>
            $(document).ready(function() {
                const dariInput = document.getElementById('dari-pesanan');
                const sampaiInput = document.getElementById('sampai-pesanan');
                const resetBtn = document.getElementById('resetPesananFilter');
                const selectAllBtn = document.getElementById('btnSelectAllPesanan');
                const printBtn = document.getElementById('btnPrintPesanan');

                const today = new Date().toISOString().split('T')[0];
                dariInput.value = today;
                sampaiInput.value = today;

                var table = $('#tabel_pesanan').DataTable({
                    responsive: true,
                    dom: "<'row mb-3'<'col-md-6 d-flex align-items-center'B><'col-md-6 d-flex justify-content-end'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                    buttons: [{
                            extend: 'excelHtml5',
                            className: 'btn btn-success btn-sm m-1',
                            text: 'Export Excel',
                            exportOptions: {
                                columns: [1, 2, 3, 4],
                                rows: function(idx, data, node) {
                                    return $(node).find('.checkbox-pesanan').prop('checked');
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
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-pesanan:checked').length;
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
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger btn-sm m-1',
                            text: 'Export PDF',
                            exportOptions: {
                                columns: [1, 2, 3, 4],
                                rows: function(idx, data, node) {
                                    return $(node).find('.checkbox-pesanan').prop('checked');
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
                                doc.content[1].table.widths = ['25%', '25%', '25%', '25%'];
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
                                columns: [1, 2, 3, 4],
                                rows: function(idx, data, node) {
                                    return $(node).find('.checkbox-pesanan').prop('checked');
                                },
                                format: {
                                    body: function(data, row, column, node) {
                                        // kalo kolomnya dropdown status
                                        if ($(node).find('select').length) {
                                            return $(node).find('select option:selected').text().trim();
                                        }
                                        // kalo bukan, ambil text biasa
                                        return $(node).text().trim();
                                    }
                                }
                            },
                            action: function(e, dt, button, config) {
                                let checked = $('.checkbox-pesanan:checked').length;
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

                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    const dari = new Date(dariInput.value);
                    const sampai = new Date(sampaiInput.value);
                    const tanggalText = data[1]; // Kolom tanggal
                    const tanggalParts = tanggalText.split(
                        '-'); // YYYY-MM-DD atau DD-MM-YYYY
                    let tanggal;

                    if (tanggalParts[0].length === 2 && tanggalParts[2].length === 4) {
                        tanggal = new Date(
                            `${tanggalParts[2]}-${tanggalParts[1]}-${tanggalParts[0]}`);
                    } else {
                        tanggal = new Date(tanggalText);
                    }

                    return tanggal >= dari && tanggal <= sampai;
                });

                dariInput.addEventListener('change', () => table.draw());
                sampaiInput.addEventListener('change', () => table.draw());

                resetBtn.addEventListener('click', () => {
                    dariInput.value = today;
                    sampaiInput.value = today;
                    table.draw();
                });

                selectAllBtn.addEventListener('click', () => {
                    $('.checkbox-pesanan:visible').prop('checked', true);
                });

                printBtn.addEventListener('click', () => {
                    const checkedRows = $('.checkbox-pesanan:checked').closest('tr');
                    if (checkedRows.length === 0) {
                        alert('Pilih data pesanan yang ingin dicetak!');
                        return;
                    }

                    let html =
                        '<table border="1" style="width:100%;border-collapse:collapse;"><tr><th>Tanggal</th><th>Nama Pembeli</th><th>Nominal Pembelian</th><th>Status</th></tr>';
                    checkedRows.each(function() {
                        const cells = $(this).find('td');
                        html +=
                            `<tr><td>${cells.eq(1).text()}</td><td>${cells.eq(2).text()}</td><td>${cells.eq(3).text()}</td><td>${cells.eq(4).text()}</td></tr>`;
                    });
                    html += '</table>';

                    const w = window.open('', '', 'width=800,height=600');
                    w.document.write(html);
                    w.document.close();
                    w.print();
                });

                table.draw();
            });

            document.getElementById('btnPrintPesanan').addEventListener('click', function() {
                let terpilih = [];
                document.querySelectorAll('.form-check-input:checked').forEach(cb => {
                    terpilih.push(cb.closest('tr').getAttribute('data-id'));
                });

                if (terpilih.length === 0) {
                    alert('Pilih data pesanan yang ingin dicetak!');
                    return;
                }

                let url = "{{ route('pesananPrint') }}?id=" + terpilih.join(',');
                window.open(url, '_blank');
            });
        </script>
    @endpush
@endsection
