<div class="modal fade" id="edit_pesanan_{{ $first->kode_pesanan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pesanan {{ $first->kode_pesanan }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('pesanan.update', $first->kode_pesanan) }}" method="POST"
                class="form-edit-pesanan-1">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- Data Pembeli --}}
                    <div class="mb-3">
                        <label class="form-label">Data Pembeli</label>
                        <select class="form-select" name="id_pembeli" required>
                            @foreach ($pembeli as $pemb)
                                <option value="{{ $pemb->id_pembeli }}"
                                    {{ $first->id_pembeli == $pemb->id_pembeli ? 'selected' : '' }}>
                                    {{ $pemb->nama_pembeli }}
                                </option>
                            @endforeach
                        </select>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah_pembeli">+
                            Tambah Pembeli</a>
                    </div>

                    {{-- Produk --}}
                    <div id="produk-container-{{ $first->kode_pesanan }}">
                        @foreach ($first->produk_detail as $pd)
                            <div class="mb-2 row produk-edit-row">
                                <div class="col-md-9">
                                    <select name="produk[]" class="form-control">
                                        @foreach ($produk as $p)
                                            <option value="{{ $p->id_produk }}"
                                                data-harga="{{ $p->harga_Satuan }}"
                                                data-stok="{{ $p->stok_produk }}"
                                                {{ $pd->kode_produk == $p->kode_produk ? 'selected' : '' }}>
                                                {{ $p->nama_produk }}
                                                [Rp{{ number_format($p->harga_Satuan, 0, ',', '.') }}
                                                =>
                                                {{ $p->stok_produk }}]
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <input type="number" name="jumlah[]" class="form-control me-2"
                                        value="{{ $pd->jumlah }}" min="1">
                                    <button type="button"
                                        class="btn btn-danger btn-sm remove-produk">✖</button>
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
                        <input type="text" class="form-control nominal-edit" name="nominal"
                            value="{{ number_format($first->nominal, 0, ',', '.') }}" readonly>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('shown.bs.modal', '.modal', function() {
                const modal = $(this);
                const kodePesanan = modal.attr('id').replace('edit_pesanan_', '');
                const container = modal.find(`#produk-container-${kodePesanan}`);
                const nominalInput = modal.find('.nominal-edit');
                const addBtn = modal.find('.add-produk');

                // Reset event listener biar gak dobel
                addBtn.off('click');
                modal.off('click', '.remove-produk');
                modal.off('change keyup',
                    'select[name="produk[]"], input[name="jumlah[]"]');
                modal.off('submit', 'form');

                // 🧮 Fungsi hitung total
                function updateNominal() {
                    let total = 0;
                    container.find('.produk-edit-row').each(function() {
                        const select = $(this).find('select[name="produk[]"]');
                        const jumlah = parseFloat($(this).find(
                            'input[name="jumlah[]"]').val()) || 0;
                        const harga = parseFloat(select.find(':selected').data(
                            'harga')) || 0;
                        total += harga * jumlah;
                    });
                    nominalInput.val(total.toLocaleString('id-ID'));
                }

                // ➕ Tambah produk
                addBtn.on('click', function() {
                    const produkOptions = `
                @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga_Satuan }}" data-stok="{{ $p->stok_produk }}">
                        {{ $p->nama_produk }} [Rp{{ number_format($p->harga_Satuan, 0, ',', '.') }} => {{ $p->stok_produk }}]
                    </option>
                @endforeach
            `;
                    const newRow = `
                <div class="mb-2 row produk-edit-row">
                    <div class="col-md-9">
                        <select name="produk[]" class="form-control">${produkOptions}</select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="number" name="jumlah[]" class="form-control me-2" value="1" min="1">
                        <button type="button" class="btn btn-danger btn-sm remove-produk">✖</button>
                    </div>
                </div>
            `;
                    container.append(newRow);
                    updateNominal();
                    console.log(
                        `🟢 Produk baru ditambahkan ke pesanan ${kodePesanan}`
                    );
                });

                // ❌ Hapus produk
                modal.on('click', '.remove-produk', function() {
                    $(this).closest('.produk-edit-row').remove();
                    updateNominal();
                    console.log(
                        `🗑️ Produk dihapus dari pesanan ${kodePesanan}`);
                });

                // 🔁 Update nominal otomatis
                modal.on('change keyup',
                    'select[name="produk[]"], input[name="jumlah[]"]',
                    function() {
                        updateNominal();
                    });

                // 🚀 Submit pakai AJAX (tanpa loncat elemen)
                $('.form-edit-pesanan-1').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    const formEl = this;
                    const url = $(formEl).attr('action');
                    const formData = new FormData(formEl);

                    // Ambil produk baru dari container
                    container.find('.produk-edit-row').each(function() {
                        const produkVal = $(this).find(
                            'select[name="produk[]"]').val();
                        const jumlahVal = $(this).find(
                            'input[name="jumlah[]"]').val();
                        formData.append('produk[]', produkVal);
                        formData.append('jumlah[]', jumlahVal);
                    });

                    formData.append('_method', 'PUT');

                    console.log(`📤 Kirim data pesanan ${kodePesanan}`);
                    for (let pair of formData.entries()) {
                        console.log(pair[0] + ': ' + pair[1]);
                    }

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(
                                '✅ Pesanan berhasil diperbarui!',
                                response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: `Data Berhasil Diperbarui`,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(
                                '❌ Gagal memperbarui pesanan:',
                                xhr.responseText);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: `Data Tidak Diperbarui`,
                            });
                        }
                    });
                });

                // Update awal
                updateNominal();
            });

            // Bersihkan listener saat modal ditutup
            $(document).on('hidden.bs.modal', '.modal', function() {
                const modal = $(this);
                modal.off();
                console.log(`🔴 Modal ${modal.attr('id')} ditutup — listener dihapus`);
            });
        });
    </script>
@endpush
