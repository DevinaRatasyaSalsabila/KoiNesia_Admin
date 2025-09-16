<div class="modal fade" id="tambah_pembeli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembeli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahPembeli" class="row g-3 needs-validation" onsubmit="return false;">
                @csrf
                <div class="modal-body">
                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control" name="nama_pembeli"
                            placeholder="Masukkan Nama Pembeli" required>
                        <div class="invalid-feedback">Masukkan Nama Pembeli</div>
                    </div>
                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">NO. Handphone</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="Masukkan No. HP"
                            required>
                        <div class="invalid-feedback">Masukkan NO. Handphone Pembeli</div>
                    </div>
                    <div class="px-3 mt-2 col-md-12">
                        <label class="form-label">Alamat Pembeli</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" name="submit2">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('formTambahPembeli').addEventListener('submit', function(e) {
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
