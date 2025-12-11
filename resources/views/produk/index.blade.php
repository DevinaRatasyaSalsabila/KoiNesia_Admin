@extends('main')
@section('content')
    <style>
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child::before {
            content: "▶";
            background: transparent !important;
            color: #4da6ff !important;
            border: none !important;
            box-shadow: none !important;
            font-weight: bold;
            font-size: 18px;
            line-height: 18px;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child::before {
            content: "▼";
            color: #007bff !important;
        }

        table.dataTable tbody tr.child ul.dtr-details {
            background: #f8fbff;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 10px 0;
            border: 1px solid #e0ecff;
        }

        table.dataTable tbody tr.child ul.dtr-details li {
            margin-bottom: 6px;
            font-size: 14px;
            color: #333;
            display: flex;
            gap: 5px;
        }

        table.dataTable tbody tr.child ul.dtr-details li span.dtr-title {
            font-weight: 600;
            color: #007bff;
            margin-right: 5px;
        }

        table.dataTable tbody tr.child ul.dtr-details li span.dtr-title::after {
            content: ":";
            margin-left: 2px;
        }

        table.dataTable tbody tr.child ul.dtr-details li span.dtr-data {
            color: #444;
        }
    </style>

    <!-- Breadcrumb -->
    @if (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => el.remove());
        }, 5000);
    </script>

    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3 fw-bold fs-5 text-dark">Produk</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        Azza Koi Farm
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Pencarian dan Tombol Aksi -->
    {{-- <div class="row align-items-center mb-4 gy-3">
        <!-- Kolom Search -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group shadow-sm rounded-3">
                <span class="input-group-text bg-primary text-white">
                    <i class="bx bx-search"></i>
                </span>
                <input type="text" class="form-control" id="search-guru" placeholder="Cari produk berdasarkan nama..."
                    aria-label="Pencarian">
            </div>
        </div>

        <!-- Kolom Tombol -->
        <div class="col-12 col-md-6 col-lg-8 d-flex flex-wrap justify-content-md-end justify-content-center gap-2">
            <a href="{{ url('produk/tambah') }}"
                class="btn btn-warning shadow-sm rounded-3 d-flex align-items-center justify-content-center"
                data-bs-toggle="tooltip" title="Tambah Produk">
                <i class="bx bx-plus fs-5 text-light"></i>
            </a>
            <button type="button"
                class="btn btn-secondary shadow-sm rounded-3 d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#importModal" title="Import Produk">
                <i class="bi bi-download"></i>
            </button>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Produk</h5>
            <div class="gap-2 d-flex float-end">
                <a href="{{ url('produk/tambah') }}"
                    class="btn btn-success btn-sm shadow-sm rounded-3 d-flex align-items-center justify-content-center"
                    data-bs-toggle="tooltip" title="Tambah Produk">
                    <i class="bx bx-plus fs-5 text-light"></i>
                </a>
                <button type="button"
                    class="btn btn-secondary btn-sm shadow-sm rounded-3 d-flex align-items-center justify-content-center"
                    data-bs-toggle="modal" data-bs-target="#importModal" title="Import Produk">
                    <i class="bi bi-download"></i>
                </button>
            </div>
        </div>
        <!-- Daftar Produk -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel_produk" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar/Media</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $index => $item)
                            @php
                                $media = json_decode($item->gambar_produk, true);
                                $firstImage = collect($media)->first(
                                    fn($f) => Str::endsWith($f, ['.jpg', '.jpeg', '.png']),
                                );
                                $firstVideo = $firstImage
                                    ? null
                                    : collect($media)->first(fn($f) => Str::endsWith($f, ['.mp4', '.webm', '.ogg']));
                            @endphp
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td class="text-center">
                                    @if ($firstImage)
                                        <img src="{{ asset('storage/produk/final/' . $firstImage) }}" alt="Produk"
                                            style="max-height:80px; object-fit:cover;">
                                    @elseif ($firstVideo)
                                        <video style="max-height:80px;" controls>
                                            <source src="{{ asset('storage/produk/final/' . $firstVideo) }}">
                                        </video>
                                    @else
                                        <span class="text-muted">Tidak ada media</span>
                                    @endif
                                </td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->ukuran_produk }}</td>
                                <td>{{ $item->stok_produk }}</td>
                                <td>Rp{{ number_format($item->harga_Satuan, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ url('produk/detail', $item->id_produk) }}" class="btn btn-primary btn-sm"
                                        title="Detail Produk">
                                        <i class="bx bx-info-circle"></i>
                                    </a>
                                    <a href="{{ url('produk/edit', $item->id_produk) }}" class="btn btn-warning btn-sm"
                                        title="Edit Produk">
                                        <i class="bx bx-pencil text-light"></i>
                                    </a>
                                    <form action="{{ route('produk.delete', $item->id_produk) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm confirm-delete-button"
                                            title="Hapus Produk">
                                            <i class="bx bx-trash text-light"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#tabel_produk').DataTable({
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
                                columns: [0, 1, 2, 3, 4, 5]
                            },
                            customize: function(doc) {
                                doc.pageMargins = [20, 20, 20, 20];
                                doc.defaultStyle.alignment = 'center';
                                doc.content.splice(0, 0, {
                                    text: 'Data Produk',
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
            });
        </script>
    @endpush


    {{-- @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const dataProduk = @json($produk);
                const itemsPerPage = 6;
                let currentPage = 1;
                let filteredData = [...dataProduk];
                const loader = document.getElementById("loader");
                const container = document.getElementById("produk-container");

                // Fungsi tampil data
                function displayData(page, data) {
                    loader.style.display = "block";
                    container.style.opacity = "0.4";

                    setTimeout(() => {
                        loader.style.display = "none";
                        container.style.opacity = "1";

                        const start = (page - 1) * itemsPerPage;
                        const end = start + itemsPerPage;
                        const pageData = data.slice(start, end);

                        renderCards(pageData);
                    }, 400);
                }

                // Render kartu produk
                function renderCards(pageData) {
                    // container.innerHTML = "";
                    pageData.forEach(item => {
                        let gambarHTML = "";
                        if (item.gambar_produk) {
                            const media = JSON.parse(item.gambar_produk);
                            const firstImage = media.find(f => f.endsWith(".jpg") || f
                                .endsWith(".jpeg") || f
                                .endsWith(".png"));
                            const firstVideo = media.find(f => f.endsWith(".mp4") || f
                                .endsWith(".webm") || f
                                .endsWith(".ogg"));
                            if (firstImage) {
                                gambarHTML = `
                        <img src="/storage/produk/final/${firstImage}"
                             class="img-fluid rounded-3"
                             style="max-height:220px;object-fit:cover;">`;
                            } else if (firstVideo) {
                                gambarHTML = `
                        <video class="rounded-3" controls style="max-height:220px;">
                            <source src="/storage/produk/final/${firstVideo}">
                        </video>`;
                            }
                        }

                        container.innerHTML += `
            <div class="col fade-in">
                <div class="overflow-hidden border-0 shadow-sm card rounded-4 h-100">
                    <div class="row g-0 align-items-center">
                        <div class="p-3 text-center col-md-4">
                            ${gambarHTML || `<div class="text-muted">Tidak ada gambar</div>`}
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">
                                    ${item.nama_produk} Ukuran ${item.ukuran_produk}
                                </h5>
                                <span class="p-1 px-3 mb-2 shadow-sm badge bg-secondary fs-6">
                                    Stok: ${item.stok_produk}
                                </span>
                                <h6 class="fw-bold">
                                    Harga :
                                    <span class="text-primary">
                                        Rp${new Intl.NumberFormat('id-ID').format(item.harga_Satuan)}
                                    </span>
                                </h6>
                                <div class="gap-2 d-flex">
                                    <a href="/produk/detail/${item.id_produk}"
                                       class="gap-2 px-3 shadow-sm btn btn-primary btn-sm d-flex align-items-center"
                                       data-bs-toggle="tooltip" title="Detail Produk">
                                       <i class="bx bx-info-circle fs-5"></i>
                                    </a>
                                    <a href="/produk/edit/${item.id_produk}"
                                       class="px-3 shadow-sm btn btn-warning btn-sm"
                                       data-bs-toggle="tooltip" title="Edit Produk">
                                       <i class="bx bx-pencil fs-5 text-light"></i>
                                    </a>
                                    <form action="/produk/delete/${item.id_produk}" method="POST" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                       <button type="button"
                                            class="px-3 shadow-sm btn btn-danger btn-sm confirm-delete-button"
                                            data-bs-toggle="tooltip" title="Hapus Produk">
                                            <i class="bx bx-trash fs-5 text-light"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
                    });
                }

                // Pagination
                function setupPagination() {
                    const pagination = document.getElementById("pagination-controls");
                    pagination.innerHTML = "";
                    const totalPages = Math.ceil(filteredData.length / itemsPerPage);

                    for (let i = 1; i <= totalPages; i++) {
                        const btn = document.createElement("button");
                        btn.classList.add("btn", "btn-outline-primary", "mx-1", "rounded-pill");
                        btn.innerText = i;

                        if (i === currentPage) {
                            btn.classList.add("btn-primary", "text-white");
                        }

                        btn.addEventListener("click", function() {
                            currentPage = i;
                            // displayData(currentPage, filteredData);
                            // setupPagination();
                        });

                        pagination.appendChild(btn);
                    }
                }

                // Filter (search)
                document.getElementById("search-guru").addEventListener("input", function() {
                    const q = this.value.toLowerCase();
                    filteredData = dataProduk.filter(p => p.nama_produk.toLowerCase()
                        .includes(q));
                    currentPage = 1;
                    // displayData(currentPage, filteredData);
                    // setupPagination();
                });

                // Inisialisasi awal
                // displayData(currentPage, filteredData);
                // setupPagination();
            });

            $(document).on('click', '.confirm-delete-button', function(e) {
                e.preventDefault(); // biar tombol gak langsung submit

                const form = $(this).closest('form'); // cari form terdekat dari tombol yang diklik

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

        <style>
            /* Efek Hover Kartu */
            .produk-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .produk-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            /* Pagination */
            #pagination-controls .btn {
                transition: all 0.3s ease;
            }

            #pagination-controls .btn:hover {
                background-color: #0d6efd;
                color: white;
            }
        </style>
    @endpush

    @include('produk.modal.import')
@endsection --}}
@endsection
