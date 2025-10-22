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
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pesanan Terbaru</h5>
            <div class="d-flex float-end gap-2">
                <div class="input-group" style="width: 420px;">
                    <label for="tanggal" class="col-form-label me-2">Dari</label>
                    <input type="date" id="dari-pesanan" class="form-control form-control-sm me-4">

                    <label for="tanggal" class="col-form-label me-2">Sampai</label>
                    <input type="date" id="sampai-pesanan" class="form-control form-control-sm">

                    <button type="button" id="resetPesananFilter" class="btn btn-danger btn-sm ms-2">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
                <!-- Tombol print dan pilih semua -->
                <button type="button" id="btnPrintPesanan" class="btn btn-secondary btn-sm">
                    <i class="bi bi-printer"></i>
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_pesanan">
                    <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                </button>
                <button type="button" id="btnSelectAllPesanan" class="btn btn-secondary btn-sm">
                    Pilih Semua
                </button>
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
                                <td class="align-middle">{{ $first->pesanan_created_at ?? '-' }}</td>
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
                                            {{ ($first->status ?? '') == 'baru' ? 'selected' : '' }}>Baru</option>
                                        <option value="proses" data-color="#ffc107"
                                            {{ ($first->status ?? '') == 'proses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" data-color="#198754"
                                            {{ ($first->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
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

                                        <form action="{{ route('pesanan.delete', $first->kode_pesanan) }}" method="POST"
                                            class="p-0 m-0 d-flex align-items-center delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fadeIn animated bx bx-trash text-light fs-6"></i>
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
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
                const tabel = document.getElementById('tabel_pesanan').getElementsByTagName('tbody')[0];
                const selectAllBtn = document.getElementById('btnSelectAllPesanan');
                const printBtn = document.getElementById('btnPrintPesanan');
                const resetBtn = document.getElementById('resetPesananFilter');

                // 🗓️ Set default tanggal hari ini
                const today = new Date().toISOString().split('T')[0];
                dariInput.value = today;
                sampaiInput.value = today;

                // Fungsi filter berdasarkan range tanggal
                function filterByDateRange() {
                    const dari = new Date(dariInput.value);
                    const sampai = new Date(sampaiInput.value);

                    Array.from(tabel.rows).forEach(row => {
                        const tanggalText = row.cells[1].textContent.trim();
                        const tanggal = new Date(tanggalText);

                        if (tanggal >= dari && tanggal <= sampai) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }

                // Event ketika tanggal diganti
                dariInput.addEventListener('change', filterByDateRange);
                sampaiInput.addEventListener('change', filterByDateRange);

                // Reset ke hari ini
                resetBtn.addEventListener('click', () => {
                    dariInput.value = today;
                    sampaiInput.value = today;
                    filterByDateRange();
                });

                // Pilih semua
                selectAllBtn.addEventListener('click', () => {
                    const checkboxes = document.querySelectorAll('.checkbox-pesanan');
                    checkboxes.forEach(cb => {
                        if (cb.closest('tr').style.display !== 'none') {
                            cb.checked = true;
                        }
                    });
                });

                // Print data yang diceklis
                printBtn.addEventListener('click', () => {
                    const checkedRows = Array.from(document.querySelectorAll('.checkbox-pesanan:checked'))
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
