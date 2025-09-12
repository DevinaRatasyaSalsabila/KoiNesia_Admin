<div class="modal fade" id="edit_pesanan_{{ $first->kode_pesanan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pesanan {{ $first->kode_pesanan }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('pesanan.update', $first->kode_pesanan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- Data Pembeli --}}
                    <div class="mb-3">
                        <label class="form-label">Data Pembeli</label>
                        <select class="form-select" name="id_pembeli" required>
                            @foreach ($pembeli as $pemb)
                                <option value="{{ $pemb->id_pembeli }}" {{ $first->id_pembeli == $pemb->id_pembeli ? 'selected' : '' }}>
                                    {{ $pemb->nama_pembeli }}
                                </option>
                            @endforeach
                        </select>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah_pembeli">+ Tambah Pembeli</a>
                    </div>

                    <div id="produk-container-{{ $first->kode_pesanan }}">
                        @foreach ($first->produk_detail as $pd)
                            <div class="row mb-2 produk-row">
                                <div class="col-md-9">
                                    <select name="produk[]" class="form-control">
                                        @foreach ($produk as $p)
                                            <option value="{{ $p->kode_produk }}" {{ $p->kode_produk == $pd->kode_produk ? 'selected' : '' }}>
                                                {{ $p->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="jumlah[]" class="form-control" value="{{ $pd->jumlah }}">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-primary btn-sm add-produk"
                        data-target="#produk-container-{{ $first->kode_pesanan }}">
                        + Tambah Produk
                    </button>

                    {{-- Nominal --}}
                    <div class="mt-3">
                        <label class="form-label">Nominal</label>
                        <input type="number" class="form-control" name="nominal" value="{{ $first->nominal }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('pesanan.modal.modalPembeli.tambahPembeli')

@push('scripts')
    <script>
        $(document).on("click", ".add-produk", function () {
            let target = $($(this).data("target"));
            let newRow = `
                    <div class="row mb-2 produk-row">
                        <div class="col-md-9">
                            <select name="produk[]" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Produk --</option>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="col-md-3 d-flex align-items-end">
                            <div class="flex-grow-1 me-2">
                                <input type="number" class="form-control jumlah-produk" name="jumlah[]" placeholder="Masukkan Jumlah" required>
                                <div class="invalid-feedback">Masukkan Jumlah</div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-produk" style="height:40px;">✖</button>
                        </div>
                    </div>
                `;
            target.append(newRow);
        });
    </script>
@endpush
