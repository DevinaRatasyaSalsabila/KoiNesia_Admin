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
                                <td class="align-middle">{{ $first->created_at ?? '-' }}</td>
                                <td class="align-middle">{{ $first->nama_pembeli ?? ($first->id_pembeli ?? '-') }}</td>
                                <td class="align-middle">
                                    <div>Rp{{ number_format($totalNominal, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    <select class="form-select update-status-select" data-id="{{ $first->kode_pesanan }}">
                                        <option value="baru" class="fw-bold"
                                            {{ ($first->status ?? '') == 'baru' ? 'selected' : '' }}>
                                            Baru
                                        </option>
                                        <option value="proses" class="fw-bold"
                                            {{ ($first->status ?? '') == 'proses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>
                                    </select>
                                </td>

                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('pesanan.detail', $first->kode_pesanan) }}"
                                            class="text-decoration-none text-dark d-flex align-items-center">
                                            <i class="material-icons-outlined">content_paste</i>
                                        </a>

                                        <form action="{{ route('pesanan.delete', $first->kode_pesanan) }}" method="POST"
                                            class="m-0 p-0 d-flex align-items-center">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn text-dark p-0 m-0 d-flex align-items-center"
                                                onclick="return confirm('Yakin mau hapus pesanan ini?')">
                                                <i class="material-icons-outlined">delete</i>
                                            </button>
                                        </form>

                                        <button type="button" class="btn p-0 d-flex align-items-center"
                                            data-bs-toggle="modal"
                                            data-bs-target="#edit_pesanan_{{ $first->kode_pesanan }}">
                                            <i class="material-icons-outlined">edit</i>
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
                var table = $("#tabel_pesanan").DataTable({
                    lengthChange: false,
                    buttons: ["copy", "excel", "pdf", "print"],
                });

                table.buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
            });

            let updateStatusUrl = "{{ route('pesanan.updateStatus', ':id') }}";

            $(document).on('change', '.update-status-select', function() {
                let id = $(this).data('id');
                let status = $(this).val();
                let url = updateStatusUrl.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        console.log('Status updated:', res);
                    },
                    error: function(err) {
                        console.log(err.responseJSON);
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
    @endpush
@endsection
