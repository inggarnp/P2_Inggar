<!-- Modal Tambah Family -->
<div class="modal fade" id="addFamilyModal" tabindex="-1" aria-labelledby="addFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFamilyModalLabel">
                    <i class="bx bx-home-plus me-2"></i>Tambah Kartu Keluarga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addFamilyForm" method="POST" action="{{ route('family.store') }}">
                @csrf
                <div class="modal-body">
                    <div id="addFamilyError" class="alert alert-danger d-none"></div>

                    <!-- No KK -->
                    <div class="mb-3">
                        <label for="no_kk" class="form-label">No. Kartu Keluarga <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk"
                            placeholder="16 digit No. KK" maxlength="16" required>
                    </div>

                    <div class="row">
                        <!-- RT -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rt_id" class="form-label">RT <span class="text-danger">*</span></label>
                                <select class="form-select" id="rt_id" name="rt_id" required>
                                    <option value="">Pilih RT</option>
                                    @foreach($rtList as $rt)
                                        <option value="{{ $rt->id }}">RT {{ $rt->no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- RW -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rw_id" class="form-label">RW <span class="text-danger">*</span></label>
                                <select class="form-select" id="rw_id" name="rw_id" required>
                                    <option value="">Pilih RW</option>
                                    @foreach($rwList as $rw)
                                        <option value="{{ $rw->id }}">RW {{ $rw->no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address"
                            rows="3" placeholder="Alamat lengkap" required></textarea>
                    </div>

                    <!-- Kepala Keluarga -->
                    <div class="mb-3">
                        <label for="family_head_id" class="form-label">Kepala Keluarga</label>
                        <select class="form-select" id="family_head_id" name="family_head_id">
                            <option value="">-- Pilih Kepala Keluarga (opsional) --</option>
                            @foreach($wargaList as $warga)
                                <option value="{{ $warga->id }}">
                                    {{ $warga->name }} — {{ $warga->nik }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">
                            <i class="bx bx-info-circle"></i>
                            Bisa diisi nanti setelah warga sudah terdaftar.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitAddFamily">
                        <span id="btnTextAddFamily"><i class="bx bx-save me-1"></i> Simpan</span>
                        <span id="btnLoaderAddFamily" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>