<!-- Modal Konfirmasi Hapus Family -->
<div class="modal fade" id="deleteFamilyModal" tabindex="-1" aria-labelledby="deleteFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteFamilyModalLabel">
                    <i class="bx bx-error-circle me-2"></i>Konfirmasi Hapus KK
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bx bx-trash text-danger" style="font-size: 3rem;"></i>
                </div>

                <p class="text-center mb-2">Apakah Anda yakin ingin menghapus KK ini?</p>

                <div class="alert alert-light border text-center mb-3">
                    <strong class="fs-6">No. KK:</strong><br>
                    <span class="font-monospace fs-5" id="delete_family_nokk">-</span><br>
                    <small class="text-muted">KK: <span id="delete_family_head">-</span></small>
                </div>

                <div class="alert alert-warning mb-2">
                    <i class="bx bx-error me-1"></i>
                    <strong>Perhatian:</strong> Semua warga dalam KK ini akan dilepas (No. KK dikosongkan).
                </div>

                <div class="alert alert-danger mb-0">
                    <i class="bx bx-error-circle me-1"></i>
                    <strong>Peringatan:</strong> Data KK yang dihapus tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteFamilyBtn">
                    <i class="bx bx-trash me-1"></i>
                    <span id="btnDeleteFamilyText">Ya, Hapus</span>
                    <span id="btnDeleteFamilyLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>