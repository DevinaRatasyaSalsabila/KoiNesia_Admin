@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Pengeluaran</div>
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
            <h5 class="mb-0">Daftar Pengeluaran</h5>
            <div class="d-flex float-end gap-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_pengeluaran">
                    <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                </button>

                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#importModal">
                    <i class="ri-download-2-line"></i> Import
                </button>
            </div>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengeluaran</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_pengeluaran }}</td>
                                <td>Rp{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('pengeluaran.delete', $item->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fadeIn animated bx bx-trash text-light"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#edit_pengeluaran_{{ $item->id }}">
                                        <i class="fadeIn animated bx bx-pencil text-light"></i>
                                    </button>
                                </td>
                                @include('pengeluaran.modal.edit')
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengeluaran</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @include('pengeluaran.modal.import')
    @include('pengeluaran.modal.tambah')

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
