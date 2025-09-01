 <!-- Modal -->
 <div class="modal fade" id="edit_pengeluaran" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengeluran</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row g-3 needs-validation" novalidate>
                     <div class="col-md-12">
                         <label for="bsValidation8" class="form-label">Tanggal</label>
                         <input type="date" class="form-control" id="bsValidation8" name="tanggal_pengeluaran" required>
                         <div class="invalid-feedback">
                            Pilih Tanggal
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="bsValidation4" class="form-label">Nominal</label>
                         <input type="number" class="form-control" id="bsValidation4"
                             placeholder="Masukkan Nominal" name="nominal_pengeluaran" required>
                         <div class="invalid-feedback">
                             Masukkan Nominal
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="bsValidation5" class="form-label">Keterangan</label>
                         <input type="text" class="form-control" id="bsValidation5"
                             placeholder=" Masukkan Keterangan" name="keterangan_pengeluaran" required>
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
         $('#edit_pengeluaran').on('shown.bs.modal', function() {
             var forms = document.querySelectorAll('#edit_pengeluaran .needs-validation')
             Array.prototype.slice.call(forms)
                 .forEach(function(form) {
                     form.addEventListener('submit', function(event) {
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
