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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_pesanan">
                <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel_pesanan" class="table table-striped table-bordered Pesanan">
                    <thead>
                        <tr>
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
                            <tr>
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

        {{-- <script>
            $(document).ready(function() {
                const kodePesanan = "{{ $first->kode_pesanan }}";
                const containerSelector = `#produk-container-${kodePesanan}`;
                const nominalInput = $(`.modal#edit_pesanan_${kodePesanan}`).find('.nominal-edit');

                // Fungsi hitung total nominal
                function updateNominal() {
                    let total = 0;
                    $(containerSelector).find('.produk-edit-row').each(function() {
                        let select = $(this).find('select[name="produk[]"]');
                        let jumlah = parseFloat($(this).find('input[name="jumlah[]"]').val()) || 0;
                        let harga = parseFloat(select.find(':selected').data('harga')) || 0;
                        total += harga * jumlah;
                    });
                    nominalInput.val(total.toLocaleString('id-ID'));
                }

                // Tambah produk
                $(document).on('click', `.add-produk[data-target="${containerSelector}"]`, function() {
                    const target = $(this).data('target');
                    const produkOptions = `
            @foreach ($produk as $p)
                <option value="{{ $p->id_produk }}" 
                        data-harga="{{ $p->harga_Satuan }}" 
                        data-stok="{{ $p->stok_produk }}">
                    {{ $p->nama_produk }} [Rp{{ number_format($p->harga_Satuan, 0, ',', '.') }} => {{ $p->stok_produk }}]
                </option>
            @endforeach
        `;

                    const newRow = `
            <div class="mb-2 row produk-edit-row">
                <div class="col-md-9">
                    <select name="produk[]" class="form-control">${produkOptions}</select>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <input type="number" name="jumlah[]" class="form-control me-2" value="1" min="1">
                    <button type="button" class="btn btn-danger btn-sm remove-produk">✖</button>
                </div>
            </div>
        `;

                    $(target).append(newRow);
                    updateNominal();
                });

                // 🧹 Hapus produk (FIXED)
                // Gunakan delegation global biar baris dinamis ikut ke-bind
                $(document).on('click', `${containerSelector} .remove-produk`, function() {
                    $(this).closest('.produk-edit-row').remove();
                    updateNominal();
                });

                // Update stok dan nominal saat produk diubah
                $(document).on('change', `${containerSelector} select[name="produk[]"]`, function() {
                    const stok = $(this).find(':selected').data('stok') || 0;
                    const jumlahInput = $(this).closest('.produk-edit-row').find('input[name="jumlah[]"]');
                    jumlahInput.attr('max', stok);
                    if (parseInt(jumlahInput.val()) > stok) jumlahInput.val(stok);
                    updateNominal();
                });

                // Update nominal saat jumlah berubah
                $(document).on('keyup change', `${containerSelector} input[name="jumlah[]"]`, updateNominal);

                // Submit pakai AJAX
                $(document).on('submit', `form[action="{{ route('pesanan.update', $first->kode_pesanan) }}"]`,
                    function(e) {
                        e.preventDefault();
                        const form = $(this);
                        const url = form.attr('action');
                        const data = form.serialize();

                        $.ajax({
                                url: url,
                                type: 'POST',
                                data: data + '&_method=PUT',
                            })
                            .done(() => {
                                alert('✅ Pesanan berhasil diperbarui!');
                                location.reload();
                            })
                            .fail(() => {
                                alert('❌ Gagal memperbarui pesanan.');
                            });
                    });

                // Initial load
                updateNominal();
            });
        </script> --}}
    @endpush
@endsection
