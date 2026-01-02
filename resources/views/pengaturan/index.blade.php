@extends('main')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header fw-semibold">
                Pengaturan
            </div>

            <div class="card-body">
                <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Gambar -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">QR Pembayaran</label>
                            <input type="file" name="gambar" class="form-control">

                            @if (!empty($pengaturan?->gambar))
                                <img src="{{ asset('storage/' . $pengaturan->gambar) }}" class="img-thumbnail mt-2"
                                    style="max-height: 150px;">
                            @endif
                        </div>

                        {{-- <!-- Nomor Admin -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Admin</label>
                            <input type="number" name="nomor_admin" class="form-control" placeholder="Contoh: 081234567890"
                                value="{{ $pengaturan->nomor_admin ?? '' }}">
                        </div> --}}
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
