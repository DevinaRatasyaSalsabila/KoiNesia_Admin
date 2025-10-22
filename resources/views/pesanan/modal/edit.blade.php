<!-- Modal -->
<div class="modal fade" id="edit_pesanan_{{ $first->kode_pesanan }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="row g-3 needs-validation" action="{{ route('pesanan.update', $first->kode_pesanan) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">Data Pembeli</label>
                        <select class="form-select" name="id_pembeli" id="pembeli" required>
                            @foreach ($pembeli as $pemb)
                                <option value="{{ $pemb->id_pembeli }}">{{ $pemb->nama_pembeli }} [{{ $pemb->no_hp }}]
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
                                                data-stok="{{ $p->stok_produk }}" {{ $pd->kode_produk == $p->kode_produk ? 'selected' : '' }}>
                                                {{ $p->nama_produk }}
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
                    <div class="px-3 mt-2">
                        <button type="button" class="btn btn-sm btn-primary" id="tambah-produk">+ Tambah
                            Produk</button>
                    </div>

                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal"
                            placeholder="Masukkan Nominal" required readonly>
                        <div class="invalid-feedback">Masukkan Nominal</div>
                    </div>
                    {{-- <div id="alert-stok" class="alert alert-warning alert-dismissible fade show d-none"
                        role="alert">
                        <span id="alert-message"></span>
                        <a href="{{ route('barang-masuk.index') }}" class="btn btn-sm btn-primary ms-2">Tambah Stok</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> --}}

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
        $(document).ready(function () {

            $('.produk-select').select2({
                dropdownParent: $('#tambah_pesanan'),
                width: '100%'
            });

            $('#tambah-produk').click(function () {
                let selectedValues = [];
                $('.produk-select').each(function () {
                    let val = $(this).val();
                    if (val) selectedValues.push(val);
                });

                let RowNew = $(`<div class="px-3 mt-2 row produk-row">
            <div class="col-md-9">
                <select class="form-select produk-select" name="produk[]" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->id_produk }}"
                                data-harga="{{ $item->harga_Satuan }}"
                                data-stok="{{ $item->stok_produk }}">
                            {{ $item->nama_produk }}
                            [Rp{{ number_format($item->harga_Satuan, 0, ',', '.') }} => {{ $item->stok_produk }}]
                        </option>
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
        </div>`);

                $('#wrapper-produk-tambah').append(RowNew);

                RowNew.find('.produk-select').select2({
                    dropdownParent: $('#tambah_pesanan'),
                    width: '100%'
                });

                selectedValues.forEach(val => {
                    RowNew.find(`option[value="${val}"]`).prop('disabled', true);
                });

                hitungNominalRupiah();
            });

            $(document).on('click', '.remove-produk', function () {
                $(this).closest('.produk-row').remove();
                hitungNominalRupiah();
            });

            $(document).on('change', '.produk-select', function () {
                let stok = $(this).find('option:selected').data('stok') || 0;

                let jumlahInput = $(this).closest('.produk-row').find('.jumlah-produk');
                jumlahInput.attr('max', stok);

                if (parseInt(jumlahInput.val()) > stok) {
                    jumlahInput.val(stok);
                }

                let selectedValues = [];
                $('.produk-select').each(function () {
                    let val = $(this).val();
                    if (val) selectedValues.push(val);
                });

                let uniqueValues = [...new Set(selectedValues)];
                if (uniqueValues.length !== selectedValues.length) {
                    alert("🚫 Tidak dapat memilih produk yang sama!");
                    $(this).val("").trigger("change");
                }

                hitungNominalRupiah();
            });

            $(document).on('input', '.jumlah-produk', function () {
                let row = $(this).closest('.produk-row');
                let stok = row.find('.produk-select option:selected').data('stok') || 0;
                let val = parseInt($(this).val()) || 0;

                // Cegah angka minus
                if (val < 1) {
                    $(this).val(1);
                    // $('#alert-message').text(`🚫 Jumlah minimal 1.`);
                    // $('#alert-stok').removeClass('d-none');
                    return;
                }

                if (val > stok) {
                    $(this).val(stok);
                    // $('#alert-message').text(`🚫 Jumlah tidak boleh melebihi stok (${stok} tersedia).`);
                    // $('#alert-stok').removeClass('d-none');
                }
                else if (stok < 5 && stok > 0) {
                    $('#alert-message').text(`⚠️ Stok produk ini menipis (${stok} tersisa).`);
                    $('#alert-stok').removeClass('d-none');
                } else {
                    $('#alert-stok').addClass('d-none');
                }

                hitungNominalRupiah();
            });

            $(document).on('input', '.jumlah-produk', function () {
                let row = $(this).closest('.produk-row');
                let stok = row.find('.produk-select option:selected').data('stok') || 0;
                let val = parseInt($(this).val()) || 0;

                if (val > stok) {
                    $(this).val(stok);
                    $('#alert-message').text(`🚫 Jumlah tidak boleh melebihi stok (${stok} tersedia).`);
                    $('#alert-stok').removeClass('d-none');
                } else if (stok < 5 && stok > 0) {
                    $('#alert-message').text(`⚠️ Stok produk ini menipis (${stok} tersisa).`);
                    $('#alert-stok').removeClass('d-none');
                } else {
                    $('#alert-stok').addClass('d-none');
                }

                hitungNominalRupiah();
            });

            function formatUang(subject) {
                rupiah = subject.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                return `Rp${rupiah}`;
            }

            function hitungNominalRupiah() {
                let total = 0;
                $('#wrapper-produk-tambah .produk-row').each(function () {
                    let harga = $(this).find('.produk-select option:selected').data('harga') || 0;
                    let jumlah = parseInt($(this).find('.jumlah-produk').val()) || 0;
                    total += harga * jumlah;
                });
                $('#nominal').val(formatUang(total));
                console.log("Nominal updated:", total);
            }
        });

        document.getElementById('formTambahPembeli').addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('pembeli.add') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        let modalPembeli = bootstrap.Modal.getInstance(document.getElementById(
                            "tambah_pembeli"));
                        modalPembeli.hide();

                        let modalPesanan = new bootstrap.Modal(document.getElementById("tambah_pesanan"));
                        modalPesanan.show();

                        let select = document.getElementById('pembeli');
                        select.insertAdjacentHTML('beforeend', `
                    <option value="${data.pembeli.id_pembeli}" selected>
                        ${data.pembeli.nama_pembeli}
                    </option>
                `);

                        this.reset();

                        alert("Pembeli berhasil ditambah!");
                    } else {
                        alert("Gagal: " + data.message);
                    }
                })
                .catch(err => console.error(err));
        });
    </script>
@endpush
