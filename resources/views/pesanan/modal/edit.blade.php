 <!-- Modal -->
 <div class="modal fade" id="edit_pesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Pesanan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form class="row g-3 needs-validation" action={{ route('pesanan.add') }} method="POST">
                 @csrf
                 <div class="modal-body">
                     <div class="col-md-12 px-3 mt-2">
                         <label class="form-label">Data Pembeli</label>
                         <select class="form-select produk-select" name="pembeli_id" required>
                             <option value="">Pilih Produk</option>
                             <option value="1">Bottomwear</option>
                             <option value="2">Casual Tshirt</option>
                             <option value="3">
                                <a data-bs-toggle="modal" data-bs-target="#tambah_admin">anggap ini buat nambah pembeli</a>
                             </option>
                         </select>
                     </div>
                     <div id="wrapper-produk">
                         <div class="row px-3 mt-2">
                             <div class="col-md-9">
                                 <label class="form-label">Produk</label>
                                 <select class="form-select produk-select" name="produk[]" required>
                                     <option value="">Pilih Produk</option>
                                     <option value="1">Bottomwear</option>
                                     <option value="2">Casual Tshirt</option>
                                     <option value="3">Electronic</option>
                                 </select>
                             </div>
                             <div class="col-md-3">
                                 <label class="form-label">Jumlah</label>
                                 <input type="number" class="form-control" name="jumlah[]"
                                     placeholder="Masukkan Jumlah" required>
                                 <div class="invalid-feedback">Masukkan Jumlah</div>
                             </div>
                         </div>
                     </div>

                     <div class="px-3 mt-2">
                         <button type="button" class="btn btn-sm btn-primary" id="edit-produk">+ Tambah
                             Produk</button>
                     </div>
                     <div class="col-md-12 px-3 mt-2">
                         <label for="bsValidation4" class="form-label">Nominal</label>
                         <input type="number" class="form-control" id="bsValidation4" name="nominal"
                             placeholder="Masukkan Nominal" required>
                         <div class="invalid-feedback">
                             Masukkan Nominal
                         </div>
                     </div>
                     {{-- <div class="col-md-12 px-3 mt-2">
                         <label for="bsValidation5" class="form-label">Keterangan</label>
                         <input type="text" class="form-control" name="keterangan" id="bsValidation5"
                             placeholder=" Masukkan Keterangan" required>
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
         $(document).ready(function() {
             $('.produk-select').select2({
                 dropdownParent: $('#edit_pesanan'),
                 width: '100%'
             });

             $('#edit-produk').click(function() {
                 let newRow = `
                    <div class="row px-3 mt-2">
                        <div class="col-md-9">
                            <select class="form-select produk-select" name="produk[]" required>
                                <option value="">Pilih Produk</option>
                                <option value="1">Bottomwear</option>
                                <option value="2">Casual Tshirt</option>
                                <option value="3">Electronic</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="jumlah[]" placeholder="Masukkan Jumlah" required>
                            <div class="invalid-feedback">Masukkan Jumlah</div>
                        </div>
                    </div>`;

                 $('#wrapper-produk').append(newRow);

                 $('#wrapper-produk .produk-select').last().select2({
                     dropdownParent: $('#edit_pesanan'),
                     width: '100%'
                 });
             });
         });
     </script>
 @endpush
