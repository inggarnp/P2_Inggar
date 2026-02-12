<!-- Modal Konfirmasi Hapus User -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">
                    <i class="bx bx-error-circle me-2"></i>Konfirmasi Hapus User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bx bx-trash text-danger" style="font-size: 3rem;"></i>
                </div>
                
                <p class="text-center mb-2">Apakah Anda yakin ingin menghapus user ini?</p>
                
                <div class="alert alert-light border text-center mb-3">
                    <strong class="fs-5" id="delete_user_name">-</strong><br>
                    <small class="text-muted" id="delete_user_email">-</small>
                </div>
                
                <div class="alert alert-danger mb-0">
                    <i class="bx bx-error-circle me-1"></i>
                    <strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteUserBtn">
                    <i class="bx bx-trash me-1"></i> 
                    <span id="btnDeleteText">Ya, Hapus</span>
                    <span id="btnDeleteLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>