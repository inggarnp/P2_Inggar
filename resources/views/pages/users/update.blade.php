<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id">
                
                <div class="modal-body">
                    <!-- Alert untuk error -->
                    <div id="editUserError" class="alert alert-danger d-none"></div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Informasi Login</h6>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="edit_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="edit_password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                <small class="text-muted">Minimal 6 karakter</small>
                            </div>

                            <!-- Jabatan -->
                            <div class="mb-3">
                                <label for="edit_jabatan_id" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_jabatan_id" name="jabatan_id" required>
                                    <option value="">Pilih Jabatan</option>
                                    @foreach($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="mb-3">Data Personal</h6>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>

                            <!-- NIP -->
                            <div class="mb-3">
                                <label for="edit_nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="edit_nip" name="nip">
                            </div>

                            <!-- NIK -->
                            <div class="mb-3">
                                <label for="edit_nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="edit_nik" name="nik" maxlength="16">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- No HP -->
                            <div class="mb-3">
                                <label for="edit_no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" id="edit_no_hp" name="no_hp">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="edit_birth_date" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="edit_birth_date" name="birth_date">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="edit_address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="edit_address" name="address" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitEdit">
                        <span id="btnTextEdit">Update</span>
                        <span id="btnLoaderEdit" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>