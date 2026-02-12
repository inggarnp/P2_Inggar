<!-- Modal Tambah Rukun -->
<div class="modal fade" id="addRukunModal" tabindex="-1" aria-labelledby="addRukunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRukunModalLabel">Tambah Data Rukun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addRukunForm" method="POST" action="{{ route('rukun.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Alert untuk error -->
                    <div id="addRukunError" class="alert alert-danger d-none"></div>
                    
                    <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Pilih Type</option>
                            <option value="RT">RT (Rukun Tetangga)</option>
                            <option value="RW">RW (Rukun Warga)</option>
                        </select>
                        <small class="text-muted">Pilih RT atau RW</small>
                    </div>

                    <!-- Nomor -->
                    <div class="mb-3">
                        <label for="no" class="form-label">Nomor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no" name="no" placeholder="Contoh: 001, 002, 003" required maxlength="10">
                        <small class="text-muted">Format: 001, 002, dst. Maksimal 10 karakter</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitAdd">
                        <span id="btnTextAdd">Simpan</span>
                        <span id="btnLoaderAdd" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>