<!-- Modal Detail Warga -->
<div class="modal fade" id="showWargaModal" tabindex="-1" aria-labelledby="showWargaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showWargaModalLabel">
                    <i class="bx bx-user me-2"></i>Detail Warga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <h6 class="mb-3 text-muted border-bottom pb-2">Data Identitas</h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold">NIK</label>
                            <p id="show_nik" class="form-control-plaintext font-monospace">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. KK</label>
                            <p id="show_no_kk" class="form-control-plaintext font-monospace">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <p id="show_name" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <p id="show_gender" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tempat Lahir</label>
                            <p id="show_birth_place" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <p id="show_birth_date" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Agama</label>
                            <p id="show_religious" class="form-control-plaintext">-</p>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <h6 class="mb-3 text-muted border-bottom pb-2">Data Sosial</h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pendidikan Terakhir</label>
                            <p id="show_education" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Pernikahan</label>
                            <p id="show_married_status" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pekerjaan</label>
                            <p id="show_occupation" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Golongan Darah</label>
                            <p id="show_blood_type" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Kehidupan</label>
                            <p id="show_living_status" class="form-control-plaintext">-</p>
                        </div>

                        <h6 class="mb-3 mt-4 text-muted border-bottom pb-2">Sistem</h6>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dibuat Pada</label>
                            <p id="show_created_at" class="form-control-plaintext">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Terakhir Update</label>
                            <p id="show_updated_at" class="form-control-plaintext">-</p>
                        </div>
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