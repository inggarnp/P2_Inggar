<!-- Modal Detail Family -->
<div class="modal fade" id="showFamilyModal" tabindex="-1" aria-labelledby="showFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showFamilyModalLabel">
                    <i class="bx bx-home me-2"></i>Detail Kartu Keluarga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">No. Kartu Keluarga</label>
                        <p id="show_no_kk" class="form-control-plaintext font-monospace">-</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">RT</label>
                        <p id="show_rt" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">RW</label>
                        <p id="show_rw" class="form-control-plaintext">-</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kepala Keluarga</label>
                        <p id="show_family_head" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jumlah Anggota</label>
                        <p id="show_members_count" class="form-control-plaintext">-</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label>
                    <p id="show_address" class="form-control-plaintext">-</p>
                </div>

                <!-- Daftar Anggota -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Daftar Anggota Keluarga</label>
                    <div id="show_members_list">
                        <p class="text-muted">Memuat data...</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Dibuat Pada</label>
                        <p id="show_created_at" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Terakhir Update</label>
                        <p id="show_updated_at" class="form-control-plaintext">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>