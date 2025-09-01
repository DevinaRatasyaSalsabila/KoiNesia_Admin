 <!-- Modal -->
 <div class="modal fade" id="tambah_admin" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row g-3 needs-validation" novalidate>
                     <div class="col-md-12">
                         <label for="bsValidation3" class="form-label">Nama</label>
                         <input type="text" class="form-control" id="bsValidation3"
                             placeholder="Nama" required>
                         <div class="invalid-feedback">
                             Masukkan Nama
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="bsValidation4" class="form-label">Email</label>
                         <input type="email" class="form-control" id="bsValidation4"
                             placeholder="Email" required>
                         <div class="invalid-feedback">
                             Masukkan Email
                         </div>
                     </div>
                     {{-- <div class="col-md-12">
                         <label for="bsValidation5" class="form-label">Keterangan</label>
                         <input type="text" class="form-control" id="bsValidation5"
                             placeholder="Masukkan Keterangan" required>
                         <div class="invalid-feedback">
                             Masukkan Keterangan
                         </div>
                     </div> --}}
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
         $('#tambah_admin').on('shown.bs.modal', function() {
             var forms = document.querySelectorAll('#tambah_admin .needs-validation')
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
