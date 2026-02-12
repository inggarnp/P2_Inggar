@extends('layouts.app')

@section('title', 'Master Data Rukun | Inggar')

@section('content')
<!-- Start Content -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Master Data Rukun (RT/RW)</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRukunModal">
                    <i class="bx bx-plus me-1"></i> Tambah Rukun
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
                                <th width="10%">No</th>
                                <th width="20%">Type</th>
                                <th width="20%">Nomor</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rukuns as $index => $rukun)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($rukun->type === 'RT')
                                    <span class="badge bg-primary">RT</span>
                                    @else
                                    <span class="badge bg-success">RW</span>
                                    @endif
                                </td>
                                <td><strong>{{ $rukun->no }}</strong></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-soft-info btn-show" title="Detail" data-rukun-id="{{ $rukun->id }}">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-primary btn-edit" title="Edit" data-rukun-id="{{ $rukun->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-danger btn-delete" title="Hapus" data-rukun-id="{{ $rukun->id }}" data-rukun-name="{{ $rukun->full_name }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bx bx-folder-open fs-1"></i>
                                    <p class="mb-0">Tidak ada data rukun</p>
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
@include('pages.rukun.create')
@include('pages.rukun.read')
@include('pages.rukun.update')
@include('pages.rukun.delete')

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ==================== TAMBAH RUKUN ====================
        const addRukunForm = document.getElementById('addRukunForm');
        if (addRukunForm) {
            addRukunForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmitAdd');
                const btnText = document.getElementById('btnTextAdd');
                const btnLoader = document.getElementById('btnLoaderAdd');
                const errorDiv = document.getElementById('addRukunError');

                // Disable button dan show loader
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
                        // Berhasil - reload halaman
                        window.location.reload();
                    } else {
                        // Gagal - tampilkan error
                        errorDiv.textContent = data.message || 'Terjadi kesalahan';
                        errorDiv.classList.remove('d-none');

                        // Re-enable button
                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    errorDiv.classList.remove('d-none');

                    // Re-enable button
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }

        // ==================== RESET FORM SAAT MODAL DIBUKA ====================
        const addRukunModal = document.getElementById('addRukunModal');
        if (addRukunModal) {
            addRukunModal.addEventListener('show.bs.modal', function() {
                // Reset form
                document.getElementById('addRukunForm').reset();
                
                // Hide error
                document.getElementById('addRukunError').classList.add('d-none');
                
                // Reset button state
                const btn = document.getElementById('btnSubmitAdd');
                const btnText = document.getElementById('btnTextAdd');
                const btnLoader = document.getElementById('btnLoaderAdd');
                
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoader.classList.add('d-none');
            });
        }

        // ==================== SHOW RUKUN (DETAIL) ====================
        document.querySelectorAll('.btn-show').forEach(button => {
            button.addEventListener('click', async function() {
                const rukunId = this.dataset.rukunId;

                try {
                    const response = await fetch(`/rukun/${rukunId}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const data = result.data;

                        // Isi data ke modal
                        document.getElementById('show_type').innerHTML = data.type === 'RT' 
                            ? '<span class="badge bg-primary">RT</span>' 
                            : '<span class="badge bg-success">RW</span>';
                        document.getElementById('show_no').textContent = data.no;
                        document.getElementById('show_full_name').textContent = data.full_name;
                        document.getElementById('show_created_at').textContent = data.created_at;
                        document.getElementById('show_updated_at').textContent = data.updated_at;

                        // Tampilkan modal
                        const modal = new bootstrap.Modal(document.getElementById('showRukunModal'));
                        modal.show();
                    } else {
                        alert('Data tidak ditemukan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // ==================== EDIT RUKUN ====================
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', async function() {
                const rukunId = this.dataset.rukunId;

                try {
                    const response = await fetch(`/rukun/${rukunId}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const data = result.data;

                        // Isi data ke form edit
                        document.getElementById('edit_rukun_id').value = rukunId;
                        document.getElementById('edit_type').value = data.type || '';
                        document.getElementById('edit_no').value = data.no || '';

                        // Set action form
                        document.getElementById('editRukunForm').action = `/rukun/${rukunId}`;

                        // Tampilkan modal
                        const modal = new bootstrap.Modal(document.getElementById('editRukunModal'));
                        modal.show();
                    } else {
                        alert('Data tidak ditemukan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // ==================== SUBMIT EDIT FORM ====================
        const editRukunForm = document.getElementById('editRukunForm');
        if (editRukunForm) {
            editRukunForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmitEdit');
                const btnText = document.getElementById('btnTextEdit');
                const btnLoader = document.getElementById('btnLoaderEdit');
                const errorDiv = document.getElementById('editRukunError');

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

        // ==================== DELETE RUKUN ====================
        let deleteRukunId = null;

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const rukunName = this.dataset.rukunName;
                deleteRukunId = this.dataset.rukunId;

                // Set nama rukun di modal
                document.getElementById('delete_rukun_name').textContent = rukunName;

                // Tampilkan modal konfirmasi
                const modal = new bootstrap.Modal(document.getElementById('deleteRukunModal'));
                modal.show();
            });
        });

        // Tombol konfirmasi hapus
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', async function() {
                if (!deleteRukunId) return;

                try {
                    // Cek apakah CSRF token ada
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfToken) {
                        alert('CSRF token tidak ditemukan. Refresh halaman dan coba lagi.');
                        return;
                    }

                    const response = await fetch(`/rukun/${deleteRukunId}`, {
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
                        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteRukunModal'));
                        modal.hide();

                        // Reload halaman
                        window.location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan saat menghapus data'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data. Cek console untuk detail.');
                }
            });
        }
    });
</script>
@endpush