<!-- Modal Create / Edit Profil Kelurahan -->
<div class="modal fade" id="saveLurahModal" tabindex="-1" aria-labelledby="saveLurahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveLurahModalLabel">
                    <i class="bx bx-building-house me-2"></i>
                    <span id="modalTitleText">Edit Profil Kelurahan</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="saveLurahForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="saveLurahError" class="alert alert-danger d-none"></div>

                    <div class="row">
                        {{-- Logo --}}
                        <div class="col-md-3 text-center">
                            <label class="form-label d-block">Logo</label>
                            <div class="border rounded mb-2 d-flex align-items-center justify-content-center mx-auto"
                                style="width:140px; height:140px; background:#f8f9fa; overflow:hidden;">
                                <img id="modalLogoPreview" src="" alt=""
                                    style="max-width:100%; max-height:100%; object-fit:contain; display:none;">
                                <i id="modalLogoIcon" class="bx bx-image text-muted" style="font-size:3rem;"></i>
                            </div>
                            <label for="modalLogoInput" class="btn btn-sm btn-outline-secondary w-100">
                                <i class="bx bx-upload me-1"></i> Pilih Logo
                            </label>
                            <input type="file" id="modalLogoInput" name="logo"
                                accept="image/jpg,image/jpeg,image/png" class="d-none">
                            <small class="text-muted d-block mt-1">JPG/PNG, maks 2MB</small>
                            <small class="text-muted">Kosongkan jika tidak ganti</small>
                        </div>

                        {{-- Data --}}
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label">Nama Kelurahan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="modal_name" name="name"
                                    placeholder="contoh: Kelurahan Jatihandap">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="modal_province" name="province"
                                        placeholder="contoh: Jawa Barat">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="modal_city" name="city"
                                        placeholder="contoh: Kota Bandung">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="modal_district" name="district"
                                        placeholder="contoh: Mandalajati">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="modal_pos_code" name="pos_code"
                                        placeholder="40286" maxlength="10">
                                </div>
                            </div>
                            {{-- NEW: Alamat --}}
                            <div class="mb-3">
                                <label class="form-label">Alamat Kantor</label>
                                <input type="text" class="form-control" id="modal_address" name="address"
                                    placeholder="contoh: Jl. Cikadut No. 1 Bandung">
                            </div>
                            {{-- NEW: Kontak --}}
                            <div class="mb-3">
                                <label class="form-label">No. Telepon / Email</label>
                                <input type="text" class="form-control" id="modal_contact" name="contact"
                                    placeholder="contoh: (022) 1234567 / kelurahan@gmail.com">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSaveLurah">
                        <span id="btnSaveLurahText"><i class="bx bx-save me-1"></i> Simpan</span>
                        <span id="btnSaveLurahLoader" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>