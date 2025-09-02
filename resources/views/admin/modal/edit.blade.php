 <!-- Modal -->
 <div class="modal fade" id="edit_admin_{{ $adm->id_user }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form class="row g-3 needs-validation" action="{{ route('admin.update', $adm->id_user) }}" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="modal-body">
                     <div class="col-md-12 px-2 mt-2">
                         <label for="bsValidation3" class="form-label">Nama</label>
                         <input type="text" class="form-control" id="bsValidation3" value="{{ $adm->nama }}"
                             name="nama" placeholder="Nama" required>
                         <div class="invalid-feedback">
                             Masukkan Nama
                         </div>
                     </div>
                     <div class="col-md-12 px-2 mt-2">
                         <label for="bsValidation4" class="form-label">Email</label>
                         <input type="email" class="form-control" name="email" value="{{ $adm->email }}"
                             id="bsValidation4" placeholder="Email" required>
                         <div class="invalid-feedback">
                             Masukkan Email
                         </div>
                     </div>
                     <div class="col-md-12 px-2 mt-2">
                         <label for="inputChoosePassword" class="form-label">Kata Sandi</label>
                         <div class="input-group" id="password_hide{{$adm->id_user}}">
                             <input type="password" name="password" class="form-control" id="bsValidation4"
                                 placeholder="Password" required>
                             <a href="javascript:;" class="input-group-text bg-transparent"><i
                                     class="bi bi-eye-slash-fill"></i></a>
                         </div>
                     </div>
                     <div class="col-md-12 px-2 mt-2">
                         <label for="bsValidation4" class="form-label">Role</label>
                         <input type="text" name="role" class="form-control" id="bsValidation4"
                             placeholder="Password" required value="Admin" readonly>
                         <div class="invalid-feedback">
                             Masukkan Role
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
         $('#edit_admin_{{ $adm->id_user }}').on('shown.bs.modal', function() {
             var forms = document.querySelectorAll('#edit_admin_{{ $adm->id_user }} .needs-validation')
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

        $(document).ready(function() {
            $("#password_hide{{ $adm->id_user }} a").on('click', function(event) {
                event.preventDefault();
                if ($('#password_hide{{ $adm->id_user }} input').attr("type") == "text") {
                    $('#password_hide{{ $adm->id_user }} input').attr('type', 'password');
                    $('#password_hide{{ $adm->id_user }} i').addClass("bi-eye-slash-fill");
                    $('#password_hide{{ $adm->id_user }} i').removeClass("bi-eye-fill");
                } else if ($('#password_hide{{ $adm->id_user }} input').attr("type") == "password") {
                    $('#password_hide{{ $adm->id_user }} input').attr('type', 'text');
                    $('#password_hide{{ $adm->id_user }} i').removeClass("bi-eye-slash-fill");
                    $('#password_hide{{ $adm->id_user }} i').addClass("bi-eye-fill");
                }
            });
        });
    </script>
 @endpush
