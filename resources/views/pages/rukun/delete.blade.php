<!-- Modal Konfirmasi Hapus Rukun -->
<div class="modal fade" id="deleteRukunModal" tabindex="-1" aria-labelledby="deleteRukunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteRukunModalLabel">Konfirmasi Hapus Data Rukun</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data rukun ini?</p>
                <p class="fw-bold fs-5" id="delete_rukun_name">-</p>
                <p class="text-danger mb-0">
                    <i class="bx bx-error-circle me-1"></i>
                    Data yang dihapus tidak dapat dikembalikan!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="bx bx-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>