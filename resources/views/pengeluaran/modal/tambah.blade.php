<!-- Modal -->
<div class="modal fade" id="tambah_pengeluaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengeluran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="row g-3 needs-validation" action="{{ route('pengeluaran.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12 px-3 mt-2">
                        <label for="bsValidation3" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="bsValidation3" name="tanggal"
                            value="{{ date('Y-m-d') }}" placeholder="Tanggal" required>
                        <div class="invalid-feedback">
                            Masukkan Tanggal
                        </div>
                    </div>
                    <div class="col-md-12 px-3 mt-2">
                        <label for="bsValidation3" class="form-label">Nama Pengeluaran</label>
                        <input type="text" class="form-control" id="bsValidation3" name="nama_pengeluaran"
                            placeholder="Nama" required>
                        <div class="invalid-feedback">
                            Masukkan Nama Pengeluaran
                        </div>
                    </div>
                    <div class="col-md-12 px-3 mt-2">
                        <label for="bsValidation4" class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="bsValidation4" name="nominal"
                            placeholder="Masukkan Nominal" required>
                        <div class="invalid-feedback">
                            Masukkan Nominal
                        </div>
                    </div>
                    <div class="col-md-12 px-3 mt-2">
                        <label for="bsValidation5" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="bsValidation5" placeholder=" Masukkan Keterangan"
                            name="keterangan" required>
                        <div class="invalid-feedback">
                            Masukkan Keterangan
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary" name="submit2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@push('scripts')
    <script>
        $('#tambah_pengeluaran').on('shown.bs.modal', function () {
            var forms = document.querySelectorAll('#tambah_pengeluaran .needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })
    </script>
@endpush
