@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Produk</div>
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

<div class="d-flex justify-content-end">
    <a href="{{ url('produk/tambah') }}"
       class="px-3 my-2 shadow-sm btn btn-warning btn-sm"
       data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Produk">
        <i class="bx bx-plus fs-5 text-light"></i>
    </a>
</div>

    <div class="mb-3 row row-cols-1 row-cols-md-3 g-4">
        @foreach ($produk as $item)
            @php
                $media = json_decode($item->gambar_produk, true);
            @endphp
            <div class="col">
                <div class="overflow-hidden border-0 shadow-sm card rounded-4 h-100">
                    <div class="row g-0 align-items-center">
                        <div class="p-3 text-center col-md-4">
                            @if (!empty($media))
                                @php
                                    $firstImage = collect($media)->first(function ($file) {
                                        return Str::endsWith($file, ['.jpg', '.jpeg', '.png']);
                                    });
                                    $firstVideo = null;
                                    if (!$firstImage) {
                                        $firstVideo = collect($media)->first(function ($file) {
                                            return Str::endsWith($file, ['.mp4', '.webm', '.ogg']);
                                        });
                                    }
                                @endphp

                                @if ($firstImage)
                                    <img src="{{ asset('storage/produk/final/' . $firstImage) }}"
                                        class="img-fluid rounded-3" style="max-height:280px;object-fit:cover;">
                                @elseif ($firstVideo)
                                   <div class="video-container">
                                    <video class="video-preview" controls>
                                        <source src="{{ asset('storage/produk/final/' . $firstVideo) }}">
                                        Browser anda tidak mendukung pemutaran video 😭
                                    </video>
                                </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">{{ $item->nama_produk }} Ukuran
                                    {{ $item->ukuran_produk }}</h5>
                                <span class="p-1 px-3 mb-2 shadow-sm badge bg-secondary fs-6">
                                    Stok: {{ $item->stok_produk }}
                                </span>
                                <h6 class="fw-bold">
                                    Harga :
                                    <span class="text-primary">
                                        Rp{{ number_format($item->harga_Satuan, 0, ',', '.') }}
                                    </span>
                                </h6>
                                <div class="gap-2 d-flex">
                                    <a href="{{ url('produk/detail', $item->id_produk) }}"
                                        class="gap-2 px-3 shadow-sm btn btn-primary btn-sm d-flex align-items-center"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Produk">
                                        <i class="bx bx-info-circle fs-5"></i>
                                    </a>
                                    <a href="{{ url('produk/edit', $item->id_produk) }}"
                                        class="px-3 shadow-sm btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Produk">
                                        <i class="bx bx-pencil fs-5 text-light"></i>
                                    </a>
                                    <form action="{{ route('produk.delete', $item->id_produk) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 shadow-sm btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Produk">
                                            <i class="bx bx-trash fs-5 text-light"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
