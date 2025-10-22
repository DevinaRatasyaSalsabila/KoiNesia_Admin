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
        function formatUang(num) {
            num = num || 0;
            return "Rp" + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function hitungTotal(modal) {
            let total = 0;
            modal.find(".produk-edit-row").each(function () {
                let harga = parseInt($(this).find("select[name='produk[]'] option:selected").data("harga")) || 0;
                let jumlah = parseInt($(this).find("input[name='jumlah[]']").val()) || 0;
                total += harga * jumlah;
            });
            modal.find(".nominal-edit").val(formatUang(total));
        }

        // 🔹 input jumlah
        $(document).on("input", "input[name='jumlah[]']", function () {
            let row = $(this).closest(".produk-edit-row");
            let selected = row.find("select[name='produk[]'] option:selected");
            let stok = parseInt(selected.data("stok")) || 0;
            let val = parseInt($(this).val()) || 0;

            console.log("🧮 Jumlah input berubah");
            console.log("Produk dipilih:", selected.text().trim());
            console.log("Stok tersedia:", stok, "Jumlah baru:", val);

            if (!selected.val()) return;

            if (stok > 0 && val > stok) {
                alert("🚫 Jumlah melebihi stok tersedia!");
                $(this).val(stok);
                val = stok;
            } else if (stok === 0 && val < 1) {
                $(this).val(1);
            }

            let modal = $(this).closest(".modal");
            hitungTotal(modal);
        });

        // 🔹 ganti produk
        $(document).on("change", "select[name='produk[]']", function () {
            let row = $(this).closest(".produk-edit-row");
            let selected = $(this).find("option:selected");
            console.log("🆕 Produk dipilih:", selected.text().trim(), "| Value:", selected.val());
            console.log("Harga:", selected.data("harga"), "| Stok:", selected.data("stok"));

            let jumlahInput = row.find("input[name='jumlah[]']");
            let jumlah = parseInt(jumlahInput.val()) || 0;
            if (jumlah <= 0) {
                jumlah = 1;
                jumlahInput.val(jumlah);
            }

            let modal = $(this).closest(".modal");
            let selectedValues = [];

            modal.find("select[name='produk[]']").each(function () {
                let val = $(this).val();
                if (val) selectedValues.push(val);
            });

            let uniqueValues = [...new Set(selectedValues)];
            if (uniqueValues.length !== selectedValues.length) {
                alert("🚫 Produk sudah dipilih sebelumnya!");
                $(this).val("").trigger("change");
            }

            hitungTotal(modal);
        });

        // 🔹 tambah produk
        $(document).off("click", ".add-produk").on("click", ".add-produk", function () {
            let target = $($(this).data("target"));
            let newRow = `
                <div class="mb-2 row produk-edit-row">
                    <div class="col-md-9">
                        <select name="produk[]" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->kode_produk }}"
                                        data-harga="{{ $p->harga_Satuan }}"
                                        data-stok="{{ $p->stok_produk }}">
                                    {{ $p->nama_produk }}
                                    [Rp{{ number_format($p->harga_Satuan, 0, ',', '.') }} => {{ $p->stok_produk }}]
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="number" class="form-control me-2 jumlah-produk"
                            name="jumlah[]" value="1" min="1" required>
                        <button type="button" class="btn btn-danger btn-sm remove-produk">✖</button>
                    </div>
                </div>`;

            target.append(newRow);

            console.log("➕ Produk baru ditambah ke:", target.attr("id"));
            console.log("Total row produk sekarang:", target.find(".produk-edit-row").length);

            let modal = $(this).closest(".modal");
            hitungTotal(modal);
        });

        // 🔹 hapus produk
        $(document).on("click", ".remove-produk", function () {
            let modal = $(this).closest(".modal");
            console.log("❌ Produk dihapus:", $(this).closest(".produk-edit-row").find("select option:selected").text().trim());
            $(this).closest(".produk-edit-row").remove();
            hitungTotal(modal);
        });

        // 🔹 tampilkan semua produk default pas modal dibuka
        $(document).on("shown.bs.modal", ".modal", function () {
            let modal = $(this);
            console.log("📦 Modal dibuka:", modal.attr("id"));
            modal.find(".produk-edit-row").each(function (index) {
                let selected = $(this).find("select[name='produk[]'] option:selected");
                let jumlah = $(this).find("input[name='jumlah[]']").val();
                console.log(`➡️ [${index + 1}] Produk default:`, selected.text().trim(), "| Value:", selected.val(), "| Jumlah:", jumlah);
            });
            hitungTotal(modal);
        });
    </script>
@endpush




























