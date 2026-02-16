@extends('layouts.app')

@section('title', 'Manajemen Keluarga | Inggar')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Kartu Keluarga</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFamilyModal">
                    <i class="bx bx-plus me-1"></i> Tambah KK
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
                                <th width="20%">No. KK</th>
                                <th width="20%">Kepala Keluarga</th>
                                <th width="8%">RT</th>
                                <th width="8%">RW</th>
                                <th width="22%">Alamat</th>
                                <th width="7%">Anggota</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($families as $index => $family)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><small class="font-monospace">{{ $family->no_kk }}</small></td>
                                <td>
                                    @if($family->familyHead)
                                        {{ $family->familyHead->name }}
                                    @else
                                        <span class="badge bg-warning text-dark">Belum diset</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        RT {{ $family->rt ? $family->rt->no : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        RW {{ $family->rw ? $family->rw->no : '-' }}
                                    </span>
                                </td>
                                <td><small>{{ Str::limit($family->address, 40) }}</small></td>
                                <td class="text-center">
                                    <span class="badge bg-primary">
                                        {{ $family->members->count() }} orang
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-soft-info btn-show-family"
                                            title="Detail" data-family-id="{{ $family->id }}">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-primary btn-edit-family"
                                            title="Edit" data-family-id="{{ $family->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-danger btn-delete-family"
                                            title="Hapus"
                                            data-family-id="{{ $family->id }}"
                                            data-family-nokk="{{ $family->no_kk }}"
                                            data-family-head="{{ $family->familyHead ? $family->familyHead->name : 'Belum diset' }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bx bx-home-x fs-1"></i>
                                    <p class="mb-0">Tidak ada data kartu keluarga</p>
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

@include('pages.family.create')
@include('pages.family.update')
@include('pages.family.read')
@include('pages.family.delete')

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ==================== TAMBAH FAMILY ====================
        const addFamilyForm = document.getElementById('addFamilyForm');
        if (addFamilyForm) {
            addFamilyForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const btn       = document.getElementById('btnSubmitAddFamily');
                const btnText   = document.getElementById('btnTextAddFamily');
                const btnLoader = document.getElementById('btnLoaderAddFamily');
                const errorDiv  = document.getElementById('addFamilyError');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');
                errorDiv.classList.add('d-none');

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
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
                    errorDiv.textContent = 'Terjadi kesalahan koneksi.';
                    errorDiv.classList.remove('d-none');
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }

        // ==================== DETAIL FAMILY ====================
        document.querySelectorAll('.btn-show-family').forEach(button => {
            button.addEventListener('click', async function () {
                const familyId = this.dataset.familyId;

                try {
                    const response = await fetch(`/family/${familyId}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const d = result.data;

                        document.getElementById('show_no_kk').textContent        = d.no_kk;
                        document.getElementById('show_rt').textContent           = 'RT ' + d.rt_no;
                        document.getElementById('show_rw').textContent           = 'RW ' + d.rw_no;
                        document.getElementById('show_address').textContent      = d.address;
                        document.getElementById('show_family_head').textContent  = d.family_head_name;
                        document.getElementById('show_members_count').textContent= d.members_count + ' orang';
                        document.getElementById('show_created_at').textContent   = d.created_at;
                        document.getElementById('show_updated_at').textContent   = d.updated_at;

                        // Render daftar anggota
                        const membersList = document.getElementById('show_members_list');
                        if (d.members.length > 0) {
                            let html = '<ul class="list-group list-group-flush">';
                            d.members.forEach(m => {
                                html += `
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>${m.name}</span>
                                        <small class="text-muted font-monospace">${m.nik}</small>
                                    </li>`;
                            });
                            html += '</ul>';
                            membersList.innerHTML = html;
                        } else {
                            membersList.innerHTML = '<p class="text-muted fst-italic">Belum ada anggota</p>';
                        }

                        new bootstrap.Modal(document.getElementById('showFamilyModal')).show();
                    } else {
                        alert('Data tidak ditemukan');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // ==================== EDIT FAMILY ====================
        document.querySelectorAll('.btn-edit-family').forEach(button => {
            button.addEventListener('click', async function () {
                const familyId = this.dataset.familyId;

                try {
                    const response = await fetch(`/family/${familyId}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const d = result.data;

                        document.getElementById('edit_family_id').value  = familyId;
                        document.getElementById('edit_no_kk').value      = d.no_kk;
                        document.getElementById('edit_rt_id').value      = d.rt_id;
                        document.getElementById('edit_rw_id').value      = d.rw_id;
                        document.getElementById('edit_address').value    = d.address;

                        // Rebuild dropdown kepala keluarga dari available_heads
                        // (sudah exclude yang jadi kepala KK lain, tapi include kepala KK ini sendiri)
                        const headSelect = document.getElementById('edit_family_head_id');
                        headSelect.innerHTML = '<option value="">-- Pilih Kepala Keluarga --</option>';
                        d.available_heads.forEach(w => {
                            const opt = document.createElement('option');
                            opt.value = w.id;
                            opt.textContent = `${w.name} — ${w.nik}`;
                            if (w.id == d.family_head_id) opt.selected = true;
                            headSelect.appendChild(opt);
                        });

                        document.getElementById('editFamilyForm').action = `/family/${familyId}`;

                        new bootstrap.Modal(document.getElementById('editFamilyModal')).show();
                    } else {
                        alert('Data tidak ditemukan');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // Submit Edit
        const editFamilyForm = document.getElementById('editFamilyForm');
        if (editFamilyForm) {
            editFamilyForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const btn       = document.getElementById('btnSubmitEditFamily');
                const btnText   = document.getElementById('btnTextEditFamily');
                const btnLoader = document.getElementById('btnLoaderEditFamily');
                const errorDiv  = document.getElementById('editFamilyError');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');
                errorDiv.classList.add('d-none');

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
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
                    errorDiv.textContent = 'Terjadi kesalahan koneksi.';
                    errorDiv.classList.remove('d-none');
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }

        // ==================== DELETE FAMILY ====================
        let deleteFamilyId = null;

        document.querySelectorAll('.btn-delete-family').forEach(button => {
            button.addEventListener('click', function () {
                deleteFamilyId = this.dataset.familyId;

                document.getElementById('delete_family_nokk').textContent = this.dataset.familyNokk;
                document.getElementById('delete_family_head').textContent = this.dataset.familyHead;

                const btn       = document.getElementById('confirmDeleteFamilyBtn');
                const btnText   = document.getElementById('btnDeleteFamilyText');
                const btnLoader = document.getElementById('btnDeleteFamilyLoader');
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoader.classList.add('d-none');

                new bootstrap.Modal(document.getElementById('deleteFamilyModal')).show();
            });
        });

        const confirmDeleteFamilyBtn = document.getElementById('confirmDeleteFamilyBtn');
        if (confirmDeleteFamilyBtn) {
            confirmDeleteFamilyBtn.addEventListener('click', async function () {
                if (!deleteFamilyId) return;

                const btn       = this;
                const btnText   = document.getElementById('btnDeleteFamilyText');
                const btnLoader = document.getElementById('btnDeleteFamilyLoader');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');

                    const response = await fetch(`/family/${deleteFamilyId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken.content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('deleteFamilyModal')).hide();
                        setTimeout(() => window.location.reload(), 300);
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan koneksi.');
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoader.classList.add('d-none');
                }
            });
        }
    });
</script>
@endpush