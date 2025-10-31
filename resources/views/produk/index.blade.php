@extends('main')
@section('content')
    <!-- Breadcrumb -->
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
    <div class="row align-items-center mb-4">
        <div class="col-md-4">
            <div class="input-group shadow-sm rounded-3">
                <span class="input-group-text bg-primary text-white"><i class="bx bx-search"></i></span>
                <input type="text" class="form-control" id="search-guru" placeholder="Cari produk berdasarkan nama..."
                    aria-label="Pencarian">
            </div>
        </div>
        <div class="col-md-8 d-flex justify-content-end gap-2">
            <a href="{{ url('produk/tambah') }}" class="btn btn-warning shadow-sm rounded-3" data-bs-toggle="tooltip"
                title="Tambah Produk">
                <i class="bx bx-plus fs-5 text-light"></i>
            </a>
            <button type="button" class="btn btn-secondary shadow-sm rounded-3" data-bs-toggle="modal"
                data-bs-target="#importModal" title="Import Produk">
                <i class="bi bi-download"></i>
            </button>
        </div>
    </div>

    <!-- Loader -->
    <div id="loader" class="text-center my-5" style="display:none;">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2 text-muted">Memuat data produk...</p>
    </div>

    <!-- Daftar Produk -->
    <div class="row row-cols-1 row-cols-md-3 g-4" id="produk-container">
        @foreach ($produk as $item)
            @php
                $media = json_decode($item->gambar_produk, true);
            @endphp
            <div class="col">
                <div class="card shadow-sm border-0 rounded-4 produk-card h-100">
                    <div class="text-center p-3 bg-light rounded-top-4">
                        @if (!empty($media))
                            @php
                                $firstImage = collect($media)->first(
                                    fn($f) => Str::endsWith($f, ['.jpg', '.jpeg', '.png']),
                                );
                                $firstVideo = $firstImage
                                    ? null
                                    : collect($media)->first(fn($f) => Str::endsWith($f, ['.mp4', '.webm', '.ogg']));
                            @endphp
                            @if ($firstImage)
                                <img src="{{ asset('storage/produk/final/' . $firstImage) }}" class="img-fluid rounded-3"
                                    style="max-height:220px; object-fit:cover;">
                            @elseif ($firstVideo)
                                <video class="rounded-3" controls style="max-height:220px;">
                                    <source src="{{ asset('storage/produk/final/' . $firstVideo) }}">
                                </video>
                            @endif
                        @endif
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-dark">{{ $item->nama_produk }}</h5>
                        <p class="text-muted mb-1">Ukuran: {{ $item->ukuran_produk }}</p>
                        <span class="badge bg-secondary mb-2">Stok: {{ $item->stok_produk }}</span>
                        <h6 class="fw-bold mb-3">
                            <span class="text-primary">Rp{{ number_format($item->harga_Satuan, 0, ',', '.') }}</span>
                        </h6>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ url('produk/detail', $item->id_produk) }}"
                                class="btn btn-primary btn-sm rounded-3 shadow-sm" title="Detail Produk">
                                <i class="bx bx-info-circle"></i>
                            </a>
                            <a href="{{ url('produk/edit', $item->id_produk) }}"
                                class="btn btn-warning btn-sm rounded-3 shadow-sm" title="Edit Produk">
                                <i class="bx bx-pencil text-light"></i>
                            </a>
                            <form action="{{ route('produk.delete', $item->id_produk) }}" method="POST"
                                class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="btn btn-danger btn-sm rounded-3 shadow-sm confirm-delete-button"
                                    title="Hapus Produk">
                                    <i class="bx bx-trash text-light"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4" id="pagination-controls"></div>

    @push('scripts')
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
                    container.innerHTML = "";
                    pageData.forEach(item => {
                        let gambarHTML = "";
                        if (item.gambar_produk) {
                            const media = JSON.parse(item.gambar_produk);
                            const firstImage = media.find(f => f.endsWith(".jpg") || f.endsWith(".jpeg") || f
                                .endsWith(".png"));
                            const firstVideo = media.find(f => f.endsWith(".mp4") || f.endsWith(".webm") || f
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
                            displayData(currentPage, filteredData);
                            setupPagination();
                        });

                        pagination.appendChild(btn);
                    }
                }

                // Filter (search)
                document.getElementById("search-guru").addEventListener("input", function() {
                    const q = this.value.toLowerCase();
                    filteredData = dataProduk.filter(p => p.nama_produk.toLowerCase().includes(q));
                    currentPage = 1;
                    displayData(currentPage, filteredData);
                    setupPagination();
                });

                // Inisialisasi awal
                displayData(currentPage, filteredData);
                setupPagination();
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
@endsection
