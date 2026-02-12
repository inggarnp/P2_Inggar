@extends('layouts.app')

@section('title', 'Manajemen User | Inggar')

@section('content')
<!-- Start Content -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar User</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bx bx-plus me-1"></i> Tambah User
                </button>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Email</th>
                                <th width="20%">Nama</th>
                                <th width="15%">Jabatan</th>
                                <th width="10%">Status</th>
                                <th width="15%">Dibuat</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->userDetail->name ?? '-' }}</td>
                                <td>
                                    @php
                                    $badgeClass = match($user->jabatan->slug) {
                                    'administrator' => 'bg-primary',
                                    'kepala_lurah' => 'bg-info',
                                    'sekre_lurah' => 'bg-warning',
                                    'staff_pelayanan' => 'bg-secondary',
                                    default => 'bg-secondary'
                                    };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $user->jabatan->name }}</span>
                                </td>
                                <td>
                                    @if($user->userDetail && $user->userDetail->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-soft-info" title="Detail" data-user-id="{{ $user->id }}">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-primary btn-edit" title="Edit" data-user-id="{{ $user->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-danger btn-delete" title="Hapus" data-user-id="{{ $user->id }}" data-user-email="{{ $user->email }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bx bx-user-x fs-1"></i>
                                    <p class="mb-0">Tidak ada data user</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
@include('pages.users.create')
@include('pages.users.update')
@include('pages.users.read')
@include('pages.users.delete')

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ==================== TAMBAH USER ====================
        const addUserForm = document.getElementById('addUserForm');
        if (addUserForm) {
            addUserForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmitAdd');
                const btnText = document.getElementById('btnTextAdd');
                const btnLoader = document.getElementById('btnLoaderAdd');
                const errorDiv = document.getElementById('addUserError');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');
                errorDiv.classList.add('d-none');

                const formData = new FormData(this);

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.reload();
                    } else {
                        errorDiv.textContent = data.message || 'Terjadi kesalahan';
                        errorDiv.classList.remove('d-none');

                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    errorDiv.classList.remove('d-none');

                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }

        // ==================== SHOW USER (DETAIL) ====================
        document.querySelectorAll('.btn-soft-info').forEach(button => {
            button.addEventListener('click', async function() {
                const userId = this.dataset.userId;

                try {
                    const response = await fetch(`/users/${userId}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const data = result.data;

                        document.getElementById('show_email').textContent = data.email;
                        document.getElementById('show_jabatan').textContent = data.jabatan;
                        document.getElementById('show_name').textContent = data.name;
                        document.getElementById('show_nip').textContent = data.nip;
                        document.getElementById('show_nik').textContent = data.nik;
                        document.getElementById('show_no_hp').textContent = data.no_hp;
                        document.getElementById('show_address').textContent = data.address;
                        document.getElementById('show_birth_date').textContent = data.birth_date;
                        document.getElementById('show_status').innerHTML = data.status === 'active' ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-danger">Inactive</span>';
                        document.getElementById('show_created_at').textContent = data.created_at;
                        document.getElementById('show_updated_at').textContent = data.updated_at;

                        const modal = new bootstrap.Modal(document.getElementById('showUserModal'));
                        modal.show();
                    } else {
                        alert('User tidak ditemukan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data user');
                }
            });
        });

        // ==================== EDIT USER ====================
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', async function() {
                const userId = this.dataset.userId;

                try {
                    const response = await fetch(`/users/${userId}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const data = result.data;

                        // Isi data ke form edit
                        document.getElementById('edit_user_id').value = userId;
                        document.getElementById('edit_email').value = data.email || '';
                        document.getElementById('edit_jabatan_id').value = data.jabatan_id || '';
                        document.getElementById('edit_password').value = ''; // Password selalu kosong

                        // ISI DATA USER_DETAIL (INI YANG KURANG!)
                        document.getElementById('edit_name').value = data.name !== '-' ? data.name : '';
                        document.getElementById('edit_nip').value = data.nip !== '-' ? data.nip : '';
                        document.getElementById('edit_nik').value = data.nik !== '-' ? data.nik : '';
                        document.getElementById('edit_no_hp').value = data.no_hp !== '-' ? data.no_hp : '';
                        document.getElementById('edit_address').value = data.address !== '-' ? data.address : '';
                        document.getElementById('edit_birth_date').value = data.birth_date !== '-' ? data.birth_date : '';
                        document.getElementById('edit_status').value = data.status !== '-' ? data.status : 'active';

                        // Set action form
                        document.getElementById('editUserForm').action = `/users/${userId}`;

                        // Tampilkan modal
                        const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                        modal.show();
                    } else {
                        alert('User tidak ditemukan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data user');
                }
            });
        });

        // ==================== SUBMIT EDIT FORM ====================
        const editUserForm = document.getElementById('editUserForm');
        if (editUserForm) {
            editUserForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmitEdit');
                const btnText = document.getElementById('btnTextEdit');
                const btnLoader = document.getElementById('btnLoaderEdit');
                const errorDiv = document.getElementById('editUserError');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');
                errorDiv.classList.add('d-none');

                const formData = new FormData(this);

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.reload();
                    } else {
                        errorDiv.textContent = data.message || 'Terjadi kesalahan';
                        errorDiv.classList.remove('d-none');

                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    errorDiv.classList.remove('d-none');

                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }

        // ==================== DELETE USER (PAKAI MODAL) ====================
        let deleteUserId = null;

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const userEmail = this.dataset.userEmail;
                
                // Get user name from table
                const row = this.closest('tr');
                const userName = row.querySelector('td:nth-child(3)').textContent.trim();
                
                // Set data ke modal
                deleteUserId = userId;
                document.getElementById('delete_user_name').textContent = userName;
                document.getElementById('delete_user_email').textContent = userEmail;
                
                // Reset button state
                const btn = document.getElementById('confirmDeleteUserBtn');
                const btnText = document.getElementById('btnDeleteText');
                const btnLoader = document.getElementById('btnDeleteLoader');
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoader.classList.add('d-none');
                
                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
                modal.show();
            });
        });

        // Tombol konfirmasi hapus
        const confirmDeleteUserBtn = document.getElementById('confirmDeleteUserBtn');
        if (confirmDeleteUserBtn) {
            confirmDeleteUserBtn.addEventListener('click', async function() {
                if (!deleteUserId) return;

                const btn = this;
                const btnText = document.getElementById('btnDeleteText');
                const btnLoader = document.getElementById('btnDeleteLoader');

                // Disable button dan show loader
                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');

                try {
                    // Cek apakah CSRF token ada
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfToken) {
                        alert('CSRF token tidak ditemukan. Refresh halaman dan coba lagi.');
                        
                        // Reset button
                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                        return;
                    }

                    const response = await fetch(`/users/${deleteUserId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken.content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Tutup modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteUserModal'));
                        modal.hide();

                        // Reload halaman setelah modal tertutup
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan saat menghapus user'));
                        
                        // Reset button
                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus user. Cek console untuk detail.');
                    
                    // Reset button
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }
    });
</script>
@endpush