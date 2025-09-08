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

            // Init select2 untuk produk pertama
            $('.produk-select').select2({
                dropdownParent: $('#tambah_pesanan'),
                width: '100%'
            });

            // Tambah row baru
            $('#tambah-produk').click(function() {
                console.log("Tambah produk di klik ✅");

                let firstRow = $('#wrapper-produk .produk-row').first();
                let newRow = firstRow.clone();

                // Reset value
                newRow.find('select').val('');
                newRow.find('input').val('');

                $('#wrapper-produk').append(newRow);

                // Re-init select2 untuk row baru
                newRow.find('.produk-select').select2({
                    dropdownParent: $('#tambah_pesanan'),
                    width: '100%'
                });

                console.log("Row baru ditambahkan ✅");
                hitungNominal();
            });

            // Update nominal otomatis
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

            // DataTable (optional)
            $('.Pesanan').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });

        });
    </script>
@endpush
