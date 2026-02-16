<!-- Modal Edit Family -->
<div class="modal fade" id="editFamilyModal" tabindex="-1" aria-labelledby="editFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFamilyModalLabel">
                    <i class="bx bx-edit me-2"></i>Edit Kartu Keluarga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFamilyForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_family_id" name="family_id">

                <div class="modal-body">
                    <div id="editFamilyError" class="alert alert-danger d-none"></div>

                    <!-- No KK -->
                    <div class="mb-3">
                        <label for="edit_no_kk" class="form-label">No. Kartu Keluarga <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_no_kk" name="no_kk"
                            maxlength="16" required>
                    </div>

                    <div class="row">
                        <!-- RT -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_rt_id" class="form-label">RT <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_rt_id" name="rt_id" required>
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
                                <label for="edit_rw_id" class="form-label">RW <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_rw_id" name="rw_id" required>
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
                        <label for="edit_address" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_address" name="address"
                            rows="3" required></textarea>
                    </div>

                    <!-- Kepala Keluarga -->
                    <div class="mb-3">
                        <label for="edit_family_head_id" class="form-label">Kepala Keluarga</label>
                        <select class="form-select" id="edit_family_head_id" name="family_head_id">
                            <option value="">-- Pilih Kepala Keluarga --</option>
                            @foreach($wargaList as $warga)
                                <option value="{{ $warga->id }}">
                                    {{ $warga->name }} — {{ $warga->nik }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitEditFamily">
                        <span id="btnTextEditFamily"><i class="bx bx-save me-1"></i> Update</span>
                        <span id="btnLoaderEditFamily" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>