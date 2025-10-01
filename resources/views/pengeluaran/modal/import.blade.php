<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="shadow-lg modal-content rounded-3">
            <div class="border-0 modal-header">
                <h5 class="text-center modal-title w-100" id="importModalLabel">
                    <i class="bi bi-cloud-arrow-up me-2"></i> Import Excel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Download Format Button -->
                <div class="mb-4 text-center">
                    <a href="{{ asset('format/FormatPengeluaran.xlsx') }}" class="btn btn-outline-primary w-100"
                        download>
                        Download Format Import
                    </a>
                </div>
                <!-- Form Upload -->
                <form action="{{ route('pengeluaran.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="form-label"><b>Pilih File Excel Untuk di Import</b>
                            <span class="text-danger" style="font-size: 0.8em; display: none;"
                                id="warning-format">Pastikan file yang di upload sesuai format!</span>
                        </label>
                        <input type="file" name="file" id="file" class="shadow-sm form-control" required
                            onmouseover="document.getElementById('warning-format').style.display = 'block';"
                            onmouseout="document.getElementById('warning-format').style.display = 'none';">
                    </div>
                    <button type="submit" class="shadow-sm btn btn-primary w-100">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
