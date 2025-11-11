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
                <div class="flex-wrap gap-2 col-12 col-md-5 d-flex align-items-center">
                    <h5 class="flex-shrink-0 mb-0 fw-semibold text-nowrap">Daftar Pesanan Terbaru</h5>
                </div>

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
                            <th class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input id="btnSelectAllPesanan" type="checkbox" class="form-check-input">
                                </div>
                            </th>
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
                                $totalNominal = $items->sum(function ($r) {
                                    return isset($r->nominal) ? (float) $r->nominal : 0;
                                });
                            @endphp
                            <tr data-id="{{ $first->kode_pesanan }}">
                                <td class="align-middle">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox-pesanan" type="checkbox"
                                            value="{{ $first->kode_pesanan }}">
                                    </div>
                                </td>
                                <td class="align-middle"
                                    data-tanggal="{{ $first->pesanan_created_at }}">
                                    {{ \Carbon\Carbon::parse($first->pesanan_created_at)->format('d-m-Y') }}
                                </td>
                                <td class="align-middle">
                                    {{ $first->id_pembeli == 0 ? '-' : $first->pembeli_nama ?? '-' }}

                                </td>
                                <td class="align-middle">
                                    <div>Rp{{ number_format($totalNominal, 0, ',', '.') }}</div>
                                </td>
                                <td>
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
                                    {{-- <div class="status-wrapper">
                                        <select class="form-select update-status-select fw-bold"
                                            data-id="{{ $first->kode_pesanan }}">
                                            <option value="baru" data-color="#0d6efd"
                                                {{ ($first->status ?? '') == 'baru' ? 'selected' : '' }}>
                                                Baru
                                            </option>
                                            <option value="proses" data-color="#ffc107" onclick="Status()"
                                                {{ ($first->status ?? '') == 'proses' ? 'selected' : '' }}>
                                                Diproses
                                            </option>
                                            <option value="selesai" data-color="#198754"
                                                {{ ($first->status ?? '') == 'selesai' ? 'selected' : '' }}>
                                                Selesai
                                            </option>
                                        </select>
                                    </div> --}}
                                </td>
                                <td class="align-middle">
                                    <div class="gap-2 d-flex align-items-center">
                                        <a href="{{ route('pesanan.detail', $first->kode_pesanan) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fadeIn animated bx bx-info-circle fs-6"></i>
                                        </a>

                                        <form
                                            action="{{ route('pesanan.delete', $first->kode_pesanan) }}"
                                            method="POST"
                                            class="p-0 m-0 d-flex align-items-center delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i
                                                    class="fadeIn animated bx bx-trash text-light fs-6"></i>
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-warning"
                                            data-bs-toggle="modal"
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
            $(document).ready(function() {
                var table = $('#tabel_pesanan').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#tabel_pesanan_wrapper .col-md-6:eq(0)');
            });

            let updateStatusUrl = "{{ route('pesanan.updateStatus', ':id') }}";

            // Simpan previous value ketika user fokus ke select (untuk revert kalau cancel)
            $(document).on('focus', '.update-status-select', function() {
                $(this).data('previous', $(this).val());
            });

            $(document).on('change', '.update-status-select', function() {
                const select = $(this);
                const previous = select.data('previous'); // nilai sebelum diubah
                const value = select.val();

                function sendUpdate(statusToSend) {
                    const id = select.data('id');
                    const url = updateStatusUrl.replace(':id', id);
                    const row = select.closest('tr');

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

                            if (statusToSend === 'selesai') {
                                let table = $("#tabel_pesanan").DataTable();
                                table.row(row).remove().draw(false);
                                alert('Riwayat pesanan telah tersimpan');
                            }

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
                            select.val(previous);
                            select.prop('disabled', false);
                        }
                    });
                }

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
                    select.data('previous', value);
                }
            });

            // $(document).on('change', '.update-status-select', function() {
            //     let id = $(this).data('id');
            //     let status = $(this).val();
            //     let url = updateStatusUrl.replace(':id', id);

            //     // simpan referensi row tabel
            //     let row = $(this).closest('tr');

            //     $.ajax({
            //         url: url,
            //         type: 'POST',
            //         data: {
            //             status: status,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(res) {
            //             console.log('Status updated:', res);

            //             if (status === 'selesai') {
            //                 // hapus row dari DataTable
            //                 let table = $("#tabel_pesanan").DataTable();
            //                 table.row(row).remove().draw(false);

            //                 // tampilkan alert bawaan JS
            //                 alert('Riwayat pesanan telah tersimpan');
            //             }
            //         },
            //         error: function(err) {
            //             console.log(err.responseJSON);
            //         }
            //     });
            // });

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
            document.addEventListener('DOMContentLoaded', function() {
                const dariInput = document.getElementById('dari-pesanan');
                const sampaiInput = document.getElementById('sampai-pesanan');
                const tabel = document.getElementById('tabel_pesanan').getElementsByTagName(
                    'tbody')[0];
                const selectAllBtn = document.getElementById('btnSelectAllPesanan');
                const printBtn = document.getElementById('btnPrintPesanan');

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
                            messageTop: function() {
                                const dari = $('#dari-pesanan').val();
                                const sampai = $('#sampai-pesanan').val();
                                if (dari && sampai) return `Data Pesanan (${dari} - ${sampai})`;
                                if (dari) return `Data Pesanan (Dari ${dari})`;
                                if (sampai) return `Data Pesanan (Sampai ${sampai})`;
                                return 'Data Pesanan';
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
                                doc.pageMargins = [20, 20, 20, 20];
                                doc.defaultStyle.alignment = 'center';
                                doc.content[1].table.widths = ['25%', '25%', '25%', '25%'];

                                const dari = $('#dari-pesanan').val();
                                const sampai = $('#sampai-pesanan').val();

                                let headerText = 'Data Pesanan';
                                if (dari && sampai) {
                                    headerText += ` (${dari} - ${sampai})`;
                                } else if (dari && !sampai) {
                                    headerText += ` (Dari ${dari})`;
                                } else if (!dari && sampai) {
                                    headerText += ` (Sampai ${sampai})`;
                                }

                                doc.content.splice(0, 0, {
                                    text: headerText,
                                    fontSize: 14,
                                    bold: true,
                                    alignment: 'center',
                                    margin: [0, 0, 0, 15]
                                });
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
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button,
                                    config);
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
                    const dari = dariInput.value ? new Date(dariInput.value) : null;
                    const sampai = sampaiInput.value ? new Date(sampaiInput.value) : null;
                    const tanggalText = data[1]; // Kolom tanggal
                    const tanggalParts = tanggalText.split('-');
                    let tanggal;

                    if (tanggalParts[0].length === 2 && tanggalParts[2].length === 4) {
                        tanggal = new Date(`${tanggalParts[2]}-${tanggalParts[1]}-${tanggalParts[0]}`);
                    } else {
                        tanggal = new Date(tanggalText);
                    }

                    if (!dari && !sampai) {
                        return true;
                    }
                    if (dari && !sampai) {
                        return tanggal >= dari;
                    }
                    if (!dari && sampai) {
                        return tanggal <= sampai;
                    }
                    return tanggal >= dari && tanggal <= sampai;
                });

                // Event ketika tanggal diganti
                dariInput.addEventListener('change', filterByDateRange);
                sampaiInput.addEventListener('change', filterByDateRange);

                // Reset ke hari ini
                resetBtn.addEventListener('click', () => {
                    dariInput.value = '';
                    sampaiInput.value = '';

                    $(dariInput).trigger('change');
                    $(sampaiInput).trigger('change');

                    table.draw();
                });

                selectAllBtn.addEventListener('change', function() {
                    const isChecked = this.checked;
                    $('.checkbox-pesanan:visible').prop('checked', isChecked);
                });

                $('.checkbox-pesanan').on('change', function() {
                    const allChecked =
                        $('.checkbox-pesanan:visible').length === $('.checkbox-pesanan:visible:checked').length;
                    $('#btnSelectAllPesanan').prop('checked', allChecked);
                });

                // Print data yang diceklis
                printBtn.addEventListener('click', () => {
                    const checkedRows = Array.from(document.querySelectorAll(
                            '.checkbox-pesanan:checked'))
                        .map(cb => cb.closest('tr'));

                    if (checkedRows.length === 0) {
                        alert('Pilih data pesanan yang ingin dicetak terlebih dahulu!');
                        return;
                    }

                    // Buat halaman print sederhana
                    const printWindow = window.open('', '', 'width=800,height=600');
                    printWindow.document.write('<html><head><title>Print Pesanan</title>');
                    printWindow.document.write(
                        '<style>table{width:100%;border-collapse:collapse;}th,td{border:1px solid #333;padding:6px;text-align:left;}</style>'
                    );
                    printWindow.document.write('</head><body>');
                    printWindow.document.write('<h3>Data Pesanan Terpilih</h3>');
                    printWindow.document.write('<table>');
                    printWindow.document.write(
                        '<tr><th>Tanggal</th><th>Nama Pembeli</th><th>Nominal Pembelian</th><th>Status</th></tr>'
                    );

                    checkedRows.forEach(row => {
                        printWindow.document.write('<tr>' +
                            '<td>' + row.cells[1].textContent + '</td>' +
                            '<td>' + row.cells[2].textContent + '</td>' +
                            '<td>' + row.cells[3].textContent + '</td>' +
                            '<td>' + row.cells[4].textContent + '</td>' +
                            '</tr>');
                    });

                    printWindow.document.write('</table></body></html>');
                    printWindow.document.close();
                    printWindow.print();
                });

                // Jalankan filter pertama kali (hari ini)
                filterByDateRange();
            });
        </script>
        <script>
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
