<!-- Modal Edit Warga -->
<div class="modal fade" id="editWargaModal" tabindex="-1" aria-labelledby="editWargaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWargaModalLabel">
                    <i class="bx bx-edit me-2"></i>Edit Data Warga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editWargaForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_warga_id" name="warga_id">

                <div class="modal-body">
                    <div id="editWargaError" class="alert alert-danger d-none"></div>

                    <div class="row">
                        <!-- Kolom Kiri: Data Identitas -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-muted border-bottom pb-2">Data Identitas</h6>

                            <div class="mb-3">
                                <label for="edit_nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_nik" name="nik" maxlength="16" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>

                            <!-- Radio gender - diisi via JS -->
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="gender" id="edit_gender_l" value="L" required>
                                    <label class="form-check-label" for="edit_gender_l">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="gender" id="edit_gender_p" value="P">
                                    <label class="form-check-label" for="edit_gender_p">Perempuan</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_birth_place" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_birth_place" name="birth_place" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_birth_date" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="edit_birth_date" name="birth_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_religious" class="form-label">Agama</label>
                                <select class="form-select" id="edit_religious" name="religious">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <!-- No. KK -->
                            <div class="mb-3">
                                <label for="edit_no_kk" class="form-label">No. Kartu Keluarga</label>
                                <select class="form-select" id="edit_no_kk" name="no_kk">
                                    <option value="">-- Belum assign ke KK --</option>
                                    @foreach($familyList as $family)
                                        <option value="{{ $family->no_kk }}">
                                            {{ $family->no_kk }}
                                            @if($family->familyHead)
                                                — {{ $family->familyHead->name }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">
                                    <i class="bx bx-info-circle"></i>
                                    Kosongkan jika belum ada KK.
                                </small>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Data Sosial -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-muted border-bottom pb-2">Data Sosial</h6>

                            <div class="mb-3">
                                <label for="edit_education" class="form-label">Pendidikan Terakhir</label>
                                <select class="form-select" id="edit_education" name="education">
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                    <option value="SD">SD / Sederajat</option>
                                    <option value="SMP">SMP / Sederajat</option>
                                    <option value="SMA">SMA / Sederajat</option>
                                    <option value="D1">D1</option>
                                    <option value="D2">D2</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1 / D4</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_married_status" class="form-label">Status Pernikahan</label>
                                <select class="form-select" id="edit_married_status" name="married_status">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_occupation" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="edit_occupation" name="occupation">
                            </div>

                            <div class="mb-3">
                                <label for="edit_blood_type" class="form-label">Golongan Darah</label>
                                <select class="form-select" id="edit_blood_type" name="blood_type">
                                    <option value="">Pilih Golongan Darah</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_living_status" class="form-label">Status Kehidupan</label>
                                <select class="form-select" id="edit_living_status" name="living_status">
                                    <option value="hidup">Hidup</option>
                                    <option value="meninggal">Meninggal</option>
                                    <option value="pindah">Pindah</option>
                                    <option value="tidak_diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitEditWarga">
                        <span id="btnTextEditWarga"><i class="bx bx-save me-1"></i> Update</span>
                        <span id="btnLoaderEditWarga" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>