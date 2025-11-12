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
            <div class="gap-2 d-flex float-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#tambah_pengeluaran">
                    <i class="fadeIn animated bx bx-add-to-queue text-light"></i>
                </button>

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
                            <th>Nama Pengeluaran</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_pengeluaran }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>Rp{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('pengeluaran.delete', $item->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger confirm-delete-button">
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
                            <th>Keterangan</th>
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
            $('#example2').DataTable({
                responsive: true,
                dom: "<'row mb-3'<'col-md-6 d-flex align-items-center'B><'col-md-6 d-flex justify-content-end'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-success btn-sm m-1',
                        text: 'Export Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger btn-sm m-1',
                        text: 'Export PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3],
                        },
                        customize: function(doc) {
                            doc.pageMargins = [20, 20, 20, 20];
                            doc.defaultStyle.alignment = 'center';
                            doc.content[1].table.widths = ['10%', '30%', '36%', '24%'];
                            doc.content.splice(0, 0, {
                                text: 'Data Pengeluaran',
                                fontSize: 14,
                                bold: true,
                                alignment: 'center',
                                margin: [0, 0, 0, 15]
                            });
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-info text-light btn-sm m-1',
                        text: 'Export CSV'
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
        </script>
        <script>
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
