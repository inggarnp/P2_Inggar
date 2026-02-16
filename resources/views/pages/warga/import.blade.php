<!-- Modal Import Warga -->
<div class="modal fade" id="importWargaModal" tabindex="-1" aria-labelledby="importWargaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importWargaModalLabel">
                    <i class="bx bx-upload me-2"></i>Import Data Warga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Panduan -->
                <div class="alert alert-info mb-3">
                    <h6 class="alert-heading"><i class="bx bx-info-circle me-1"></i>Panduan Import</h6>
                    <ul class="mb-2 ps-3">
                        <li>Format file: <strong>xlsx, xls, atau csv</strong>, maksimal 5MB</li>
                        <li>Jenis kelamin: <strong>L</strong> atau <strong>P</strong></li>
                        <li>Format tanggal: <strong>YYYY-MM-DD</strong> contoh: 1990-05-15</li>
                        <li>Status kehidupan: <strong>hidup / meninggal / pindah / tidak_diketahui</strong></li>
                    </ul>

                    <h6 class="mt-2 mb-1"><i class="bx bx-home me-1"></i>Fitur Buat KK Baru Sekalian:</h6>
                    <ul class="mb-2 ps-3">
                        <li>Isi kolom <strong>buat_kk_baru</strong> dengan <code>ya</code> untuk membuat KK baru</li>
                        <li>Jika <code>buat_kk_baru = ya</code>: kolom <strong>no_kk, rt, rw, alamat_kk</strong> wajib diisi</li>
                        <li>Warga tersebut otomatis jadi <strong>kepala keluarga</strong> KK yang baru dibuat</li>
                        <li>RT/RW diisi dengan nomor contoh: <code>001</code>, <code>002</code></li>
                        <li>Jika <code>buat_kk_baru</code> kosong dan <code>no_kk</code> diisi → assign ke KK yang sudah ada</li>
                    </ul>

                    <a href="{{ route('warga.import.template') }}" class="btn btn-sm btn-outline-info">
                        <i class="bx bx-download me-1"></i> Download Template Excel
                    </a>
                </div>

                <!-- Form Upload -->
                <div id="importFormSection">
                    <div class="mb-3">
                        <label for="importFile" class="form-label">Pilih File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="importFile" accept=".xlsx,.xls,.csv">
                        <small class="text-muted">Format: xlsx, xls, csv — Maksimal 5MB</small>
                    </div>
                </div>

                <!-- Loading -->
                <div id="importLoading" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">Sedang memproses file, mohon tunggu...</p>
                </div>

                <!-- Hasil Import -->
                <div id="importResult" class="d-none">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="card border-success">
                                <div class="card-body text-center py-2">
                                    <h3 class="text-success mb-0" id="importSuccessCount">0</h3>
                                    <small class="text-muted">Berhasil diimport</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card border-danger">
                                <div class="card-body text-center py-2">
                                    <h3 class="text-danger mb-0" id="importErrorCount">0</h3>
                                    <small class="text-muted">Gagal / Di-skip</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="importErrorDetail" class="d-none">
                        <h6 class="text-danger mb-2">
                            <i class="bx bx-error-circle me-1"></i>Detail Baris yang Gagal:
                        </h6>
                        <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-danger">
                                    <tr>
                                        <th width="8%">Baris</th>
                                        <th width="20%">NIK</th>
                                        <th width="25%">Nama</th>
                                        <th>Keterangan Error</th>
                                    </tr>
                                </thead>
                                <tbody id="importErrorTableBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCloseImport">
                    <i class="bx bx-x me-1"></i> Tutup
                </button>
                <button type="button" class="btn btn-success" id="btnSubmitImport">
                    <span id="btnTextImport"><i class="bx bx-upload me-1"></i> Mulai Import</span>
                    <span id="btnLoaderImport" class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
                <button type="button" class="btn btn-primary d-none" id="btnRefreshAfterImport"
                    onclick="window.location.reload()">
                    <i class="bx bx-refresh me-1"></i> Refresh Halaman
                </button>
            </div>
        </div>
    </div>
</div>