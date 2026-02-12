<!-- Modal Edit Rukun -->
<div class="modal fade" id="editRukunModal" tabindex="-1" aria-labelledby="editRukunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRukunModalLabel">Edit Data Rukun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editRukunForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_rukun_id" name="rukun_id">
                
                <div class="modal-body">
                    <!-- Alert untuk error -->
                    <div id="editRukunError" class="alert alert-danger d-none"></div>
                    
                    <!-- Type -->
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_type" name="type" required>
                            <option value="">Pilih Type</option>
                            <option value="RT">RT (Rukun Tetangga)</option>
                            <option value="RW">RW (Rukun Warga)</option>
                        </select>
                        <small class="text-muted">Pilih RT atau RW</small>
                    </div>

                    <!-- Nomor -->
                    <div class="mb-3">
                        <label for="edit_no" class="form-label">Nomor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_no" name="no" placeholder="Contoh: 001, 002, 003" required maxlength="10">
                        <small class="text-muted">Format: 001, 002, dst. Maksimal 10 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitEdit">
                        <span id="btnTextEdit">Update</span>
                        <span id="btnLoaderEdit" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>