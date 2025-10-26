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
                            <div class="mb-2 row produk-edit-row">
                                <div class="col-md-9">
                                    <select name="produk[]" class="form-control">
                                        @foreach ($produk as $p)
                                            <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga_Satuan }}"
                                                data-stok="{{ $p->stok_produk }}" {{ $pd->kode_produk == $p->kode_produk ? 'selected' : '' }}> {{ $p->nama_produk }}
                                                [Rp{{ number_format($p->harga_Satuan, 0, ',', '.') }} => {{ $p->stok_produk }}]
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <input type="number" name="jumlah[]" class="form-control me-2"
                                        value="{{ $pd->jumlah }}">
                                    <button type="button" class="btn btn-danger btn-sm remove-produk">✖</button>
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
        $(document).ready(function () {
            const kodePesanan = "{{ $first->kode_pesanan }}";
            const containerSelector = `#produk-container-${kodePesanan}`;
            const addBtnSelector = `.add-produk[data-target="${containerSelector}"]`;
            const nominalInput = $(`.modal#edit_pesanan_${kodePesanan}`).find('.nominal-edit');

            // Hitung total nominal
            function updateNominal() {
                let total = 0;
                $(containerSelector).find('.produk-edit-row').each(function () {
                    let select = $(this).find('select[name="produk[]"]');
                    let jumlah = parseFloat($(this).find('input[name="jumlah[]"]').val()) || 0;
                    let harga = parseFloat(select.find(':selected').data('harga')) || 0;
                    total += harga * jumlah;
                });
                nominalInput.val(total.toLocaleString('id-ID'));
            }

            // Tambah produk
            $(document).on('click', '.add-produk', function () {
                const target = $(this).data('target');
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

                $(target).append(newRow);
                updateNominal();
            });

            // Hapus produk
            $(document).on('click', `${containerSelector} .remove-produk`, function () {
                $(this).closest('.produk-edit-row').remove();
                updateNominal();
            });

            // Update stok limit + nominal
            $(document).on('change', `${containerSelector} select[name="produk[]"]`, function () {
                const stok = $(this).find(':selected').data('stok') || 0;
                const jumlahInput = $(this).closest('.produk-edit-row').find('input[name="jumlah[]"]');
                jumlahInput.attr('max', stok);
                if (parseInt(jumlahInput.val()) > stok) jumlahInput.val(stok);
                updateNominal();
            });

            $(document).on('keyup change', `${containerSelector} input[name="jumlah[]"]`, updateNominal);

            // Submit pakai AJAX
            $(document).on('submit', `form[action="{{ route('pesanan.update', $first->kode_pesanan) }}"]`, function (e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');
                const data = form.serialize();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data + '&_method=PUT',
                })
                    .done(() => {
                        alert('✅ Pesanan berhasil diperbarui!');
                        location.reload();
                    })
                    .fail(() => {
                        alert('❌ Gagal memperbarui pesanan.');
                    });
            });

            // Initial load
            updateNominal();
        });
    </script>
@endpush
