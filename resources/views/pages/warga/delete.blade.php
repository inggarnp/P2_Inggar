<!-- Modal Konfirmasi Hapus Warga -->
<div class="modal fade" id="deleteWargaModal" tabindex="-1" aria-labelledby="deleteWargaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteWargaModalLabel">
                    <i class="bx bx-error-circle me-2"></i>Konfirmasi Hapus Warga
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bx bx-trash text-danger" style="font-size: 3rem;"></i>
                </div>

                <p class="text-center mb-2">Apakah Anda yakin ingin menghapus data warga ini?</p>

                <div class="alert alert-light border text-center mb-3">
                    <strong class="fs-5" id="delete_warga_name">-</strong><br>
                    <small class="text-muted">NIK: <span id="delete_warga_nik" class="font-monospace">-</span></small>
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
                <button type="button" class="btn btn-danger" id="confirmDeleteWargaBtn">
                    <i class="bx bx-trash me-1"></i>
                    <span id="btnDeleteWargaText">Ya, Hapus</span>
                    <span id="btnDeleteWargaLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>