<!-- Modal -->
<div class="modal fade" id="tambah_pesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="row g-3 needs-validation" action="{{ route('pesanan.add') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">Data Pembeli</label>
                        <select class="form-select" name="id_pembeli" id="pembeli" required>
                            @foreach ($pembeli as $pemb)
                                <option value="{{ $pemb->id_pembeli }}">{{ $pemb->nama_pembeli }}</option>
                            @endforeach
                        </select>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah_pembeli">+ Tambah Pembeli</a>
                    </div>

                    <div id="wrapper-produk">
                        <div class="px-3 mt-2 row produk-row">
                            <div class="col-md-9">
                                <label class="form-label">Produk</label>
                                <select class="form-select produk-select" name="produk[]" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id_produk }}" data-harga="{{ $item->harga_Satuan }}">
                                            {{ $item->nama_produk }} [{{ $item->harga_Satuan }}]
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah-produk" name="jumlah[]"
                                    placeholder="Masukkan Jumlah" required>
                                <div class="invalid-feedback">Masukkan Jumlah</div>
                            </div>
                        </div>
                    </div>

                    <div class="px-3 mt-2">
                        <button type="button" class="btn btn-sm btn-primary" id="tambah-produk">+ Tambah
                            Produk</button>
                    </div>

                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="nominal" name="nominal"
                            placeholder="Masukkan Nominal" required readonly>
                        <div class="invalid-feedback">Masukkan Nominal</div>
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
        $(document).ready(function() {

            $('.produk-select').select2({
                dropdownParent: $('#tambah_pesanan'),
                width: '100%'
            });
            
            $('#tambah-produk').click(function() {

                let RowNew = `
         <div class="px-3 mt-2 row produk-row">
            <div class="col-md-9">
                <label class="form-label">Produk</label>
                <select class="form-select produk-select" name="produk[]" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->id_produk }}" data-harga="{{ $item->harga_Satuan }}">
                            {{ $item->nama_produk }} [{{ $item->harga_Satuan }}]
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="flex-grow-1 me-2">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-control jumlah-produk" name="jumlah[]" placeholder="Masukkan Jumlah" required>
                    <div class="invalid-feedback">Masukkan Jumlah</div>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-produk" style="height:40px;margin-bottom:8px;">✖</button>
            </div>
        </div>`;

                $('#wrapper-produk').append(RowNew);
                console.log("✅ Row baru ditambahkan ke DOM");

                // Inisialisasi select2 pada select yang baru
                $('#wrapper-produk .produk-select').last().select2({
                    dropdownParent: $('#tambah_pesanan'),
                    width: '100%'
                });
            });
            // Hapus row produk
            $(document).on('click', '.remove-produk', function() {
                $(this).closest('.produk-row').remove();
                hitungNominal(); // update nominal setelah hapus
            });

            $(document).on('change', '.produk-select, .jumlah-produk', function() {
                hitungNominal();
            });

            function hitungNominal() {
                let total = 0;
                $('#wrapper-produk .produk-row').each(function() {
                    let harga = $(this).find('.produk-select option:selected').data('harga') || 0;
                    let jumlah = parseInt($(this).find('.jumlah-produk').val()) || 0;
                    total += harga * jumlah;
                });
                $('#nominal').val(total);
                console.log("Nominal updated:", total);
            }
        });
    </script>
@endpush
