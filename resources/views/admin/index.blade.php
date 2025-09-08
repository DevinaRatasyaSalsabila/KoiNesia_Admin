@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Daftar Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        KoiNesia
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Admin</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_admin">
                <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $adm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $adm->nama }}</td>
                                <td>{{ $adm->email }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.delete', $adm->id_user) }}" method="POST"
                                        onsubmit="return confirm('Yakin mau hapus admin ini? 😥')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fadeIn animated bx bx-trash text-light"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-warning d-inline" data-bs-toggle="modal"
                                        data-bs-target="#edit_admin_{{ $adm->id_user }}">
                                        <i class="fadeIn animated bx bx-pencil text-light"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('admin.modal.edit')
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @include('admin.modal.tambah')

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
        </script>
    @endpush
@endsection
