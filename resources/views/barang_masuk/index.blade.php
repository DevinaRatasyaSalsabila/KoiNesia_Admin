@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Barang Masuk </div>
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
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Barang Masuk</h5>
            <div class="d-flex float-end gap-2">
                <a href="{{ url('barang-masuk/tambah') }}" class="btn btn-success">
                    <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                </a>

                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#importModal">
                    <i class="bi bi-download"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->nama_produk ?? '-' }}</td>
                                <td>{{ $item->total_produk }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="text-center">
                                    <div class="gap-2 d-flex align-items-center">
                                        <form action="{{ route('barang-masuk.destroy', $item->id_pemasukan) }}"
                                            class="delete-form" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger confirm-delete-button" type="button">
                                                <i class="fadeIn animated bx bx-trash text-light"></i>
                                            </button>
                                        </form>
                                        <a href="{{ url('barang-masuk/edit', $item->id_pemasukan) }}"
                                            class="btn btn-warning">
                                            <i class="fadeIn animated bx bx-pencil text-light"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @include('barang_masuk.modal.import')
    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#example2').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });

            $(document).on('click', '.confirm-delete-button', function(e) {
                e.preventDefault(); // biar tombol gak langsung submit

                const form = $(this).closest('form'); // cari form terdekat dari tombol yang diklik

                Swal.fire({
                    title: "Yakin ingin menghapus data ini?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // submit form kalau dikonfirmasi
                    }
                });
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                });
            @endif
        </script>
    @endpush
@endsection
