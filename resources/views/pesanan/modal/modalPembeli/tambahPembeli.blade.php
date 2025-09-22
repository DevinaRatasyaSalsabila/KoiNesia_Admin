<div class="modal fade" id="tambah_pembeli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembeli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahPembeli" class="row g-3 needs-validation">
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
