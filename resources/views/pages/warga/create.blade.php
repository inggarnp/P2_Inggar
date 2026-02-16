<!-- Modal Tambah Warga -->
<div class="modal fade" id="addWargaModal" tabindex="-1" aria-labelledby="addWargaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWargaModalLabel">
                    <i class="bx bx-user-plus me-2"></i>Tambah Warga Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addWargaForm" method="POST" action="{{ route('warga.store') }}">
                @csrf
                <div class="modal-body">
                    <div id="addWargaError" class="alert alert-danger d-none"></div>

                    <div class="row">
                        <!-- Kolom Kiri: Data Identitas -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-muted border-bottom pb-2">Data Identitas</h6>

                            <!-- NIK -->
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                    placeholder="16 digit NIK" maxlength="16" required>
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama lengkap sesuai KTP" required>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="gender" id="gender_l" value="L" required>
                                    <label class="form-check-label" for="gender_l">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="gender" id="gender_p" value="P">
                                    <label class="form-check-label" for="gender_p">Perempuan</label>
                                </div>
                            </div>

                            <!-- Tempat Lahir -->
                            <div class="mb-3">
                                <label for="birth_place" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place"
                                    placeholder="Kota/Kabupaten tempat lahir" required>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                            </div>

                            <!-- Agama -->
                            <div class="mb-3">
                                <label for="religious" class="form-label">Agama</label>
                                <select class="form-select" id="religious" name="religious">
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
                                <label for="no_kk" class="form-label">No. Kartu Keluarga</label>
                                <select class="form-select" id="no_kk" name="no_kk">
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
                                    Kosongkan jika belum ada KK, bisa diisi nanti.
                                </small>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Data Sosial -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-muted border-bottom pb-2">Data Sosial</h6>

                            <!-- Pendidikan -->
                            <div class="mb-3">
                                <label for="education" class="form-label">Pendidikan Terakhir</label>
                                <select class="form-select" id="education" name="education">
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

                            <!-- Status Pernikahan -->
                            <div class="mb-3">
                                <label for="married_status" class="form-label">Status Pernikahan</label>
                                <select class="form-select" id="married_status" name="married_status">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>

                            <!-- Pekerjaan -->
                            <div class="mb-3">
                                <label for="occupation" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                    placeholder="Pekerjaan saat ini">
                            </div>

                            <!-- Golongan Darah -->
                            <div class="mb-3">
                                <label for="blood_type" class="form-label">Golongan Darah</label>
                                <select class="form-select" id="blood_type" name="blood_type">
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

                            <!-- Status Hidup -->
                            <div class="mb-3">
                                <label for="living_status" class="form-label">Status Kehidupan</label>
                                <select class="form-select" id="living_status" name="living_status">
                                    <option value="hidup" selected>Hidup</option>
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
                    <button type="submit" class="btn btn-primary" id="btnSubmitAddWarga">
                        <span id="btnTextAddWarga"><i class="bx bx-save me-1"></i> Simpan</span>
                        <span id="btnLoaderAddWarga" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>