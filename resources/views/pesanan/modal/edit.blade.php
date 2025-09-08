 <!-- Modal -->
 <div class="modal fade" id="edit_pesanan_{{$item->id_pesanan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Pesanan {{$item->id_pesanan}}</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
           <form class="row g-3 needs-validation"
                action="{{ route('pesanan.update', $item->id_pesanan) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- Data Pembeli --}}
                    <div class="col-md-12 px-3 mt-2">
                        <label class="form-label">Data Pembeli</label>
                        <select class="form-select" name="id_pembeli" required>
                            @foreach ($pembeli as $pemb)
                                <option value="{{ $pemb->id_pembeli }}"
                                    {{ $item->id_pembeli == $pemb->id_pembeli ? 'selected' : '' }}>
                                    {{ $pemb->nama_pembeli }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Produk & Jumlah --}}
                    <div id="wrapper-produk">
                        @foreach ($item->produk_detail as $prd)
                            <div class="row px-3 mt-2">
                                <div class="col-md-9">
                                    <label class="form-label">Produk</label>
                                    <select class="form-select produk-select" name="produk[]" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach ($produk as $p)
                                            <option value="{{ $p->kode_produk }}"
                                                {{ $prd->kode_produk == $p->kode_produk ? 'selected' : '' }}>
                                                {{ $p->nama_produk }} [{{ $p->harga_Satuan }}]
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" class="form-control"
                                        name="jumlah[]"
                                        value="{{ $prd->jumlah }}" required>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Tombol tambah produk --}}
                    <div class="px-3 mt-2">
                        <button type="button" class="btn btn-sm btn-primary" id="edit-produk">+ Tambah Produk</button>
                    </div>

                    {{-- Nominal --}}
                    <div class="col-md-12 px-3 mt-2">
                        <label class="form-label">Nominal</label>
                        <input type="number" class="form-control" name="nominal"
                            value="{{ $item->nominal }}" required>
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
