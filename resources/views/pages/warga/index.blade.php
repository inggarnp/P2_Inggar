@extends('layouts.app')

@section('title', 'Manajemen Warga | Inggar')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Warga</h4>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importWargaModal">
                        <i class="bx bx-upload me-1"></i> Import
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWargaModal">
                        <i class="bx bx-plus me-1"></i> Tambah Warga
                    </button>
                </div>
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
                                <th width="15%">NIK</th>
                                <th width="20%">Nama</th>
                                <th width="8%">L/P</th>
                                <th width="15%">Tempat, Tgl Lahir</th>
                                <th width="12%">No. KK</th>
                                <th width="10%">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wargas as $index => $warga)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><small class="font-monospace">{{ $warga->nik }}</small></td>
                                <td>{{ $warga->name }}</td>
                                <td>
                                    @if($warga->gender === 'L')
                                        <span class="badge bg-primary">Laki-laki</span>
                                    @else
                                        <span class="badge" style="background-color:#e83e8c">Perempuan</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $warga->birth_place }},
                                    {{ $warga->birth_date ? $warga->birth_date->format('d M Y') : '-' }}
                                </td>
                                <td>
                                    @if($warga->no_kk)
                                        <small class="font-monospace">{{ $warga->no_kk }}</small>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum diassign</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($warga->living_status) {
                                            'hidup'           => 'bg-success',
                                            'meninggal'       => 'bg-dark',
                                            'pindah'          => 'bg-info',
                                            'tidak_diketahui' => 'bg-secondary',
                                            default           => 'bg-secondary',
                                        };
                                        $statusLabel = match($warga->living_status) {
                                            'hidup'           => 'Hidup',
                                            'meninggal'       => 'Meninggal',
                                            'pindah'          => 'Pindah',
                                            'tidak_diketahui' => 'Tidak Diketahui',
                                            default           => '-',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-soft-info btn-show-warga"
                                            title="Detail" data-warga-id="{{ $warga->id }}">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-primary btn-edit-warga"
                                            title="Edit" data-warga-id="{{ $warga->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-danger btn-delete-warga"
                                            title="Hapus"
                                            data-warga-id="{{ $warga->id }}"
                                            data-warga-name="{{ $warga->name }}"
                                            data-warga-nik="{{ $warga->nik }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bx bx-user-x fs-1"></i>
                                    <p class="mb-0">Tidak ada data warga</p>
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

@include('pages.warga.create')
@include('pages.warga.update')
@include('pages.warga.read')
@include('pages.warga.delete')
@include('pages.warga.import')

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ==================== TAMBAH WARGA ====================
        const addWargaForm = document.getElementById('addWargaForm');
        if (addWargaForm) {
            addWargaForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const btn       = document.getElementById('btnSubmitAddWarga');
                const btnText   = document.getElementById('btnTextAddWarga');
                const btnLoader = document.getElementById('btnLoaderAddWarga');
                const errorDiv  = document.getElementById('addWargaError');

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

        // ==================== DETAIL WARGA ====================
        document.querySelectorAll('.btn-show-warga').forEach(button => {
            button.addEventListener('click', async function () {
                const wargaId = this.dataset.wargaId;

                try {
                    const response = await fetch(`/warga/${wargaId}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const d = result.data;

                        document.getElementById('show_nik').textContent            = d.nik;
                        document.getElementById('show_no_kk').textContent          = d.no_kk;
                        document.getElementById('show_name').textContent           = d.name;
                        document.getElementById('show_gender').textContent         = d.gender === 'L' ? 'Laki-laki' : 'Perempuan';
                        document.getElementById('show_birth_place').textContent    = d.birth_place;
                        document.getElementById('show_birth_date').textContent     = d.birth_date_fmt;
                        document.getElementById('show_religious').textContent      = d.religious;
                        document.getElementById('show_education').textContent      = d.education;
                        document.getElementById('show_married_status').textContent = d.married_status;
                        document.getElementById('show_occupation').textContent     = d.occupation;
                        document.getElementById('show_blood_type').textContent     = d.blood_type;
                        document.getElementById('show_living_status').textContent  = d.living_status;
                        document.getElementById('show_created_at').textContent     = d.created_at;
                        document.getElementById('show_updated_at').textContent     = d.updated_at;

                        new bootstrap.Modal(document.getElementById('showWargaModal')).show();
                    } else {
                        alert('Data warga tidak ditemukan');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // ==================== EDIT WARGA ====================
        document.querySelectorAll('.btn-edit-warga').forEach(button => {
            button.addEventListener('click', async function () {
                const wargaId = this.dataset.wargaId;

                try {
                    const response = await fetch(`/warga/${wargaId}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    const result = await response.json();

                    if (result.success) {
                        const d = result.data;

                        document.getElementById('edit_warga_id').value      = wargaId;
                        document.getElementById('edit_nik').value            = d.nik;
                        document.getElementById('edit_name').value           = d.name;
                        document.getElementById('edit_birth_place').value    = d.birth_place;
                        document.getElementById('edit_birth_date').value     = d.birth_date;
                        document.getElementById('edit_occupation').value     = d.occupation !== '-' ? d.occupation : '';

                        document.querySelectorAll('#editWargaModal input[name="gender"]').forEach(radio => {
                            radio.checked = (radio.value === d.gender);
                        });

                        document.getElementById('edit_religious').value      = d.religious !== '-' ? d.religious : '';
                        document.getElementById('edit_education').value      = d.education !== '-' ? d.education : '';
                        document.getElementById('edit_married_status').value = d.married_status !== '-' ? d.married_status : '';
                        document.getElementById('edit_blood_type').value     = d.blood_type !== '-' ? d.blood_type : '';
                        document.getElementById('edit_living_status').value  = d.living_status !== '-' ? d.living_status : 'hidup';
                        document.getElementById('edit_no_kk').value          = d.no_kk !== '-' ? d.no_kk : '';

                        document.getElementById('editWargaForm').action = `/warga/${wargaId}`;

                        new bootstrap.Modal(document.getElementById('editWargaModal')).show();
                    } else {
                        alert('Data warga tidak ditemukan');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // Submit Edit
        const editWargaForm = document.getElementById('editWargaForm');
        if (editWargaForm) {
            editWargaForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const btn       = document.getElementById('btnSubmitEditWarga');
                const btnText   = document.getElementById('btnTextEditWarga');
                const btnLoader = document.getElementById('btnLoaderEditWarga');
                const errorDiv  = document.getElementById('editWargaError');

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

        // ==================== DELETE WARGA ====================
        let deleteWargaId = null;

        document.querySelectorAll('.btn-delete-warga').forEach(button => {
            button.addEventListener('click', function () {
                deleteWargaId = this.dataset.wargaId;

                document.getElementById('delete_warga_name').textContent = this.dataset.wargaName;
                document.getElementById('delete_warga_nik').textContent  = this.dataset.wargaNik;

                const btn       = document.getElementById('confirmDeleteWargaBtn');
                const btnText   = document.getElementById('btnDeleteWargaText');
                const btnLoader = document.getElementById('btnDeleteWargaLoader');
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoader.classList.add('d-none');

                new bootstrap.Modal(document.getElementById('deleteWargaModal')).show();
            });
        });

        const confirmDeleteWargaBtn = document.getElementById('confirmDeleteWargaBtn');
        if (confirmDeleteWargaBtn) {
            confirmDeleteWargaBtn.addEventListener('click', async function () {
                if (!deleteWargaId) return;

                const btn       = this;
                const btnText   = document.getElementById('btnDeleteWargaText');
                const btnLoader = document.getElementById('btnDeleteWargaLoader');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');

                    const response = await fetch(`/warga/${deleteWargaId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken.content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('deleteWargaModal')).hide();
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

        // ==================== IMPORT WARGA ====================
        // Reset modal setiap kali dibuka
        document.getElementById('importWargaModal').addEventListener('show.bs.modal', function () {
            document.getElementById('importFile').value            = '';
            document.getElementById('importResult').classList.add('d-none');
            document.getElementById('importLoading').classList.add('d-none');
            document.getElementById('importFormSection').classList.remove('d-none');
            document.getElementById('btnSubmitImport').classList.remove('d-none');
            document.getElementById('btnRefreshAfterImport').classList.add('d-none');
            document.getElementById('btnTextImport').classList.remove('d-none');
            document.getElementById('btnLoaderImport').classList.add('d-none');
            document.getElementById('btnSubmitImport').disabled = false;
        });

        const btnSubmitImport = document.getElementById('btnSubmitImport');
        if (btnSubmitImport) {
            btnSubmitImport.addEventListener('click', async function () {
                const fileInput = document.getElementById('importFile');

                if (!fileInput.files.length) {
                    alert('Pilih file terlebih dahulu!');
                    return;
                }

                const btn       = this;
                const btnText   = document.getElementById('btnTextImport');
                const btnLoader = document.getElementById('btnLoaderImport');

                // Tampilkan loading
                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');
                document.getElementById('importLoading').classList.remove('d-none');
                document.getElementById('importFormSection').classList.add('d-none');

                const formData = new FormData();
                formData.append('file', fileInput.files[0]);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                try {
                    const response = await fetch('{{ route("warga.import") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    const data = await response.json();

                    // Sembunyikan loading
                    document.getElementById('importLoading').classList.add('d-none');

                    if (data.success) {
                        // Tampilkan hasil
                        document.getElementById('importSuccessCount').textContent = data.success_count;
                        document.getElementById('importErrorCount').textContent   = data.error_count;
                        document.getElementById('importResult').classList.remove('d-none');

                        // Tampilkan detail error jika ada
                        if (data.errors && data.errors.length > 0) {
                            const tbody = document.getElementById('importErrorTableBody');
                            tbody.innerHTML = '';
                            data.errors.forEach(err => {
                                tbody.innerHTML += `
                                    <tr>
                                        <td class="text-center">${err.row}</td>
                                        <td class="font-monospace">${err.nik}</td>
                                        <td>${err.name}</td>
                                        <td class="text-danger">${err.message}</td>
                                    </tr>`;
                            });
                            document.getElementById('importErrorDetail').classList.remove('d-none');
                        }

                        // Sembunyikan tombol import, tampilkan tombol refresh
                        btn.classList.add('d-none');
                        document.getElementById('btnRefreshAfterImport').classList.remove('d-none');

                    } else {
                        alert('Error: ' + data.message);
                        document.getElementById('importFormSection').classList.remove('d-none');
                        btn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoader.classList.add('d-none');
                    }
                } catch (error) {
                    document.getElementById('importLoading').classList.add('d-none');
                    document.getElementById('importFormSection').classList.remove('d-none');
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