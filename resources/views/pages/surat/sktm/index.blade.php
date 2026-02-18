@extends('layouts.app')

@section('title', 'SKTM - Surat Keterangan Tidak Mampu')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-file me-2"></i>Buat SKTM
                    <small class="text-muted fw-normal fs-6 ms-2">Surat Keterangan Tidak Mampu</small>
                </h4>
                <a href="{{ route('arsip.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-archive me-1"></i> Lihat Arsip
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">

    {{-- ============================================================
         KIRI: FORM INPUT
    ============================================================ --}}
    <div class="col-xl-5 col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bx bx-edit me-1 text-primary"></i> Data Surat
                </h6>
            </div>
            <div class="card-body" style="overflow-y: auto; max-height: calc(100vh - 220px);">

                {{-- NOMOR SURAT --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat"
                        value="{{ $nomorSurat }}" placeholder="Auto-generate">
                    <small class="text-muted">Format: 474/XXX/SKTM/BULAN/TAHUN</small>
                </div>

                <hr class="my-3">

                {{-- CARI WARGA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bx bx-search me-1 text-primary"></i>Cari Warga
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchWarga"
                            placeholder="Ketik NIK atau nama warga..."
                            autocomplete="off">
                        <div id="searchResults"
                            class="position-absolute w-100 bg-white border rounded shadow-sm"
                            style="z-index: 1000; max-height: 220px; overflow-y: auto; display: none; top: 100%;">
                        </div>
                    </div>
                    <small class="text-muted">Minimal 2 karakter. Data akan auto-fill.</small>
                </div>

                <hr class="my-3">

                {{-- DATA WARGA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK</label>
                    <input type="text" class="form-control" id="nik"
                        placeholder="16 digit NIK" maxlength="16">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama lengkap warga">
                </div>

                <div class="row">
                    <div class="col-7 mb-3">
                        <label class="form-label fw-semibold">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" placeholder="Kota lahir">
                    </div>
                    <div class="col-5 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggal_lahir" placeholder="dd F yyyy" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" placeholder="-" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Agama</label>
                        <input type="text" class="form-control" id="agama" placeholder="-" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Status Pernikahan</label>
                        <input type="text" class="form-control" id="status_nikah" placeholder="-" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" placeholder="-" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="2" placeholder="Alamat lengkap" readonly></textarea>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">RT</label>
                        <input type="text" class="form-control" id="rt" placeholder="-" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">RW</label>
                        <input type="text" class="form-control" id="rw" placeholder="-" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No. KK</label>
                    <input type="text" class="form-control" id="no_kk" placeholder="-" readonly>
                </div>

                <hr class="my-3">

                {{-- KEPERLUAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-danger">
                        <i class="bx bx-info-circle me-1"></i>Keperluan Surat <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="keperluan_select" onchange="updateKeperluan(this.value)">
                        <option value="">-- Pilih keperluan --</option>
                        <option value="Mengajukan permohonan bantuan sosial">Bantuan Sosial</option>
                        <option value="Mendaftar beasiswa pendidikan">Beasiswa Pendidikan</option>
                        <option value="Keringanan biaya pengobatan/rumah sakit">Keringanan Biaya RS</option>
                        <option value="Mengajukan permohonan keringanan biaya sekolah">Keringanan Biaya Sekolah</option>
                        <option value="lainnya">Lainnya (ketik manual)</option>
                    </select>
                    <input type="text" class="form-control mt-2 d-none" id="keperluan_manual"
                        placeholder="Ketik keperluan...">
                </div>

                {{-- TANGGAL SURAT --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tanggal Surat</label>
                    <input type="text" class="form-control" id="tanggal_surat" readonly>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary flex-fill" id="btnSimpan">
                        <i class="bx bx-save me-1"></i> Simpan Arsip
                    </button>
                    <button type="button" class="btn btn-success flex-fill" id="btnCetak"
                        onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak PDF
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="btnReset"
                        title="Reset form">
                        <i class="bx bx-refresh"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- ============================================================
         KANAN: PREVIEW SURAT
    ============================================================ --}}
    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="card-title mb-0">
                    <i class="bx bx-show me-1 text-success"></i> Preview Surat
                </h6>
                <span class="badge bg-success">Live Preview</span>
            </div>
            <div class="card-body p-0">

                {{-- AREA PREVIEW SURAT --}}
                <div id="surat-preview" style="
                    background: white;
                    padding: 40px 50px;
                    min-height: 700px;
                    font-family: 'Times New Roman', serif;
                    font-size: 12pt;
                    color: #000;
                    line-height: 1.5;
                ">

                    {{-- KOP SURAT --}}
                    <div style="display: flex; align-items: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 16px;">
                        {{-- Logo --}}
                        <div style="flex-shrink: 0; margin-right: 16px;">
                            @if($config && $config->logo)
                                <img id="p-logo" src="{{ asset($config->logo) }}"
                                    alt="Logo" style="width: 80px; height: 80px; object-fit: contain;">
                            @else
                                <div id="p-logo-placeholder"
                                    style="width: 80px; height: 80px; border: 2px dashed #ccc;
                                           display: flex; align-items: center; justify-content: center;
                                           color: #aaa; font-size: 10px; text-align: center;">
                                    Logo<br>Kelurahan
                                </div>
                            @endif
                        </div>
                        {{-- Info Kelurahan --}}
                        <div style="flex: 1; text-align: center;">
                            <div style="font-size: 11pt; font-weight: normal;">PEMERINTAH KOTA <span id="p-city">{{ strtoupper($config->city ?? 'BANDUNG') }}</span></div>
                            <div style="font-size: 11pt;">KECAMATAN <span id="p-district">{{ strtoupper($config->district ?? '-') }}</span></div>
                            <div style="font-size: 16pt; font-weight: bold; text-transform: uppercase;">
                                <span id="p-kelurahan-name">{{ $config->name ?? 'KELURAHAN' }}</span>
                            </div>
                            <div style="font-size: 9pt;">
                                @if($config && $config->address){{ $config->address }} &bull; @endif
                                Kode Pos {{ $config->pos_code ?? '' }}@if($config && $config->contact) &bull; Telp/Email: {{ $config->contact }}@endif
                            </div>
                        </div>
                    </div>

                    {{-- JUDUL SURAT --}}
                    <div style="text-align: center; margin: 16px 0 8px;">
                        <div style="font-size: 13pt; font-weight: bold; text-decoration: underline; text-transform: uppercase;">
                            Surat Keterangan Tidak Mampu
                        </div>
                        <div style="font-size: 11pt;">
                            Nomor: <span id="p-nomor-surat">{{ $nomorSurat }}</span>
                        </div>
                    </div>

                    {{-- PEMBUKA --}}
                    <div style="margin: 16px 0;">
                        <p style="margin: 4px 0;">Yang bertanda tangan di bawah ini, Lurah <b><span id="p-nama-kelurahan-isi">{{ $config->name ?? 'Kelurahan' }}</span></b>,
                        Kecamatan <b><span id="p-kecamatan-isi">{{ $config->district ?? '-' }}</span></b>,
                        Kota <b><span id="p-kota-isi">{{ $config->city ?? '-' }}</span></b>,
                        Provinsi <b><span id="p-provinsi-isi">{{ $config->province ?? '-' }}</span></b>,
                        menerangkan bahwa:</p>
                    </div>

                    {{-- DATA WARGA --}}
                    <table style="width: 100%; border-collapse: collapse; margin: 8px 0;">
                        <tr>
                            <td style="width: 35%; padding: 2px 0;">Nama Lengkap</td>
                            <td style="width: 3%;">:</td>
                            <td><b><span id="p-nama">-</span></b></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">NIK</td>
                            <td>:</td>
                            <td><span id="p-nik">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><span id="p-ttl">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Jenis Kelamin</td>
                            <td>:</td>
                            <td><span id="p-jk">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Agama</td>
                            <td>:</td>
                            <td><span id="p-agama">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Status Pernikahan</td>
                            <td>:</td>
                            <td><span id="p-status-nikah">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Pekerjaan</td>
                            <td>:</td>
                            <td><span id="p-pekerjaan">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">No. KK</td>
                            <td>:</td>
                            <td><span id="p-no-kk">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0; vertical-align: top;">Alamat</td>
                            <td style="vertical-align: top;">:</td>
                            <td><span id="p-alamat">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">RT / RW</td>
                            <td>:</td>
                            <td>RT <span id="p-rt">-</span> / RW <span id="p-rw">-</span></td>
                        </tr>
                    </table>

                    {{-- ISI SURAT --}}
                    <div style="margin: 16px 0;">
                        <p style="margin: 4px 0; text-align: justify;">
                            Adalah benar warga <b><span id="p-kelurahan-isi2">{{ $config->name ?? 'Kelurahan' }}</span></b>
                            yang tercatat sebagai warga kurang mampu / tidak mampu di lingkungan kami.
                            Surat keterangan ini dibuat untuk keperluan
                            <b><span id="p-keperluan">........................</span></b>.
                        </p>
                    </div>

                    <div style="margin: 12px 0;">
                        <p style="margin: 4px 0; text-align: justify;">
                            Demikian surat keterangan ini dibuat dengan sebenarnya, untuk dapat dipergunakan sebagaimana mestinya.
                        </p>
                    </div>

                    {{-- TTD --}}
                    <div style="display: flex; justify-content: flex-end; margin-top: 32px;">
                        <div style="text-align: center; min-width: 200px;">
                            <div>{{ $config->city ?? 'Bandung' }}, <span id="p-tanggal-surat">{{ now()->isoFormat('D MMMM Y') }}</span></div>
                            <div>Lurah <span id="p-nama-kel-ttd">{{ $config->name ?? '' }}</span></div>
                            <br><br><br><br>
                            <div style="border-bottom: 1px solid #000; width: 180px; margin: 0 auto;"></div>
                            <div style="font-size: 9pt; margin-top: 4px;">NIP. ___________________________</div>
                        </div>
                    </div>

                </div>{{-- end #surat-preview --}}
            </div>
        </div>
    </div>

</div>{{-- end row --}}

@endsection

@push('styles')
<style>
    /* =====================================================
       PRINT: Hanya tampilkan area surat, sembunyikan semua
    ===================================================== */
    @media print {
        @page {
            size: A4 portrait;
            /* margin: 0 → menghilangkan header/footer browser (URL, tanggal, judul) */
            margin: 0;
        }

        /* 1. Sembunyikan SEMUA elemen body */
        body * {
            visibility: hidden !important;
        }

        /* 2. Tampilkan HANYA #surat-preview dan anaknya */
        #surat-preview,
        #surat-preview * {
            visibility: visible !important;
        }

        /* 3. Posisikan surat-preview mengisi halaman */
        /* Padding menggantikan margin @page supaya konten tidak mepet */
        #surat-preview {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            padding: 1.5cm 2cm !important;
            margin: 0 !important;
            border: none !important;
            background: white !important;
            min-height: auto !important;
            font-size: 11pt !important;
            box-sizing: border-box !important;
        }
    }

    /* Search dropdown */
    #searchResults .search-item {
        padding: 8px 12px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
    }
    #searchResults .search-item:hover {
        background-color: #f0f7ff;
    }
    #searchResults .search-item .item-name {
        font-weight: 600;
        color: #333;
    }
    #searchResults .search-item .item-nik {
        font-size: 11px;
        color: #888;
    }

    /* Preview area */
    #surat-preview {
        border: 1px solid #e0e0e0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // SET TANGGAL SURAT DEFAULT (hari ini)
    // =============================================
    const today = new Date();
    const bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni',
                       'Juli','Agustus','September','Oktober','November','Desember'];
    const tanggalStr = `${today.getDate()} ${bulanIndo[today.getMonth()]} ${today.getFullYear()}`;
    document.getElementById('tanggal_surat').value = tanggalStr;
    document.getElementById('p-tanggal-surat').textContent = tanggalStr;

    // =============================================
    // LIVE PREVIEW BINDING HELPER
    // =============================================
    function bindPreview(inputId, previewId, transformer) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        if (!input || !preview) return;

        input.addEventListener('input', function () {
            const val = transformer ? transformer(this.value) : (this.value || '-');
            preview.textContent = val || '-';
        });
    }

    // Bind nomor surat
    bindPreview('nomor_surat', 'p-nomor-surat');

    // Keperluan live preview
    document.getElementById('keperluan_select').addEventListener('change', function() {
        const val = this.value;
        const manualInput = document.getElementById('keperluan_manual');
        if (val === 'lainnya') {
            manualInput.classList.remove('d-none');
            manualInput.focus();
        } else {
            manualInput.classList.add('d-none');
            document.getElementById('p-keperluan').textContent = val || '........................';
        }
    });

    document.getElementById('keperluan_manual').addEventListener('input', function() {
        document.getElementById('p-keperluan').textContent = this.value || '........................';
    });

    // =============================================
    // SEARCH WARGA - LIVE SEARCH
    // =============================================
    let searchTimeout;
    const searchInput   = document.getElementById('searchWarga');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const q = this.value.trim();

        if (q.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`{{ route('sktm.search_warga') }}?q=${encodeURIComponent(q)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                searchResults.innerHTML = '';

                if (!data.success || data.data.length === 0) {
                    searchResults.innerHTML = '<div class="search-item text-muted">Warga tidak ditemukan</div>';
                    searchResults.style.display = 'block';
                    return;
                }

                data.data.forEach(w => {
                    const item = document.createElement('div');
                    item.className = 'search-item';
                    item.innerHTML = `
                        <div class="item-name">${w.name}</div>
                        <div class="item-nik">NIK: ${w.nik} &bull; RT ${w.rt}/RW ${w.rw}</div>
                    `;
                    item.addEventListener('click', () => fillWarga(w));
                    searchResults.appendChild(item);
                });

                searchResults.style.display = 'block';
            })
            .catch(() => {
                searchResults.style.display = 'none';
            });
        }, 350);
    });

    // Tutup dropdown kalau klik luar
    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    // =============================================
    // FILL WARGA: auto-populate form + preview
    // =============================================
    function fillWarga(w) {
        // Tutup dropdown
        searchResults.style.display = 'none';
        searchInput.value = w.name;

        // Isi form
        setField('nik', w.nik);
        setField('nama', w.name);
        setField('tempat_lahir', w.birth_place);
        setField('tanggal_lahir', w.birth_date_fmt || formatDate(w.birth_date));
        setField('jenis_kelamin', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setField('agama', w.religious);
        setField('status_nikah', w.married_status);
        setField('pekerjaan', w.occupation);
        setField('alamat', w.address);
        setField('rt', w.rt);
        setField('rw', w.rw);
        setField('no_kk', w.no_kk);

        // Update preview
        setPreview('p-nik', w.nik);
        setPreview('p-nama', w.name);
        setPreview('p-ttl', `${w.birth_place}, ${w.birth_date_fmt || formatDate(w.birth_date)}`);
        setPreview('p-jk', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setPreview('p-agama', w.religious);
        setPreview('p-status-nikah', w.married_status);
        setPreview('p-pekerjaan', w.occupation);
        setPreview('p-alamat', w.address);
        setPreview('p-rt', w.rt);
        setPreview('p-rw', w.rw);
        setPreview('p-no-kk', w.no_kk);
    }

    function setField(id, value) {
        const el = document.getElementById(id);
        if (el) el.value = value || '';
    }

    function setPreview(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value || '-';
    }

    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        return `${d.getDate()} ${bulanIndo[d.getMonth()]} ${d.getFullYear()}`;
    }

    // =============================================
    // RESET FORM (fungsi reusable)
    // =============================================
    function resetForm() {
        ['nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin',
         'agama','status_nikah','pekerjaan','alamat','rt','rw','no_kk']
        .forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });

        searchInput.value = '';
        document.getElementById('keperluan_select').value = '';
        document.getElementById('keperluan_manual').value = '';
        document.getElementById('keperluan_manual').classList.add('d-none');

        ['p-nik','p-nama','p-ttl','p-jk','p-agama','p-status-nikah',
         'p-pekerjaan','p-alamat','p-rt','p-rw','p-no-kk']
        .forEach(id => setPreview(id, '-'));

        setPreview('p-keperluan', '........................');
    }

    document.getElementById('btnReset').addEventListener('click', function () {
        if (!confirm('Reset semua data form?')) return;
        resetForm();
    });

    // =============================================
    // SIMPAN ARSIP
    // =============================================
    document.getElementById('btnSimpan').addEventListener('click', async function () {
        const btn = this;

        const payload = {
            nomor_surat:   document.getElementById('nomor_surat').value,
            nik:           document.getElementById('nik').value,
            nama:          document.getElementById('nama').value,
            tempat_lahir:  document.getElementById('tempat_lahir').value,
            tanggal_lahir: document.getElementById('tanggal_lahir').value,
            jenis_kelamin: document.getElementById('jenis_kelamin').value,
            agama:         document.getElementById('agama').value,
            status_nikah:  document.getElementById('status_nikah').value,
            pekerjaan:     document.getElementById('pekerjaan').value,
            alamat:        document.getElementById('alamat').value,
            rt:            document.getElementById('rt').value,
            rw:            document.getElementById('rw').value,
            no_kk:         document.getElementById('no_kk').value,
            tanggal_surat: document.getElementById('tanggal_surat').value,
            keperluan:     document.getElementById('keperluan_select').value === 'lainnya'
                           ? document.getElementById('keperluan_manual').value
                           : document.getElementById('keperluan_select').value,
            _token: '{{ csrf_token() }}'
        };

        if (!payload.nik || payload.nik.length !== 16) {
            alert('NIK harus 16 digit. Pilih warga terlebih dahulu.');
            return;
        }
        if (!payload.keperluan) {
            alert('Keperluan surat wajib diisi.');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

        try {
            const res = await fetch('{{ route("sktm.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (data.success) {
                // Tampilkan notif sukses
                alert(`${data.message}\nNomor: ${data.data.nomor_surat}`);

                // Reset form setelah simpan sukses
                resetForm();

                // Generate nomor surat baru (fetch dari server)
                fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(() => {
                        // Reload halaman untuk dapat nomor surat baru
                        window.location.reload();
                    });
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan'));
            }
        } catch (e) {
            alert(' Koneksi gagal. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="bx bx-save me-1"></i> Simpan Arsip';
        }
    });

});

// Dipanggil dari select keperluan
function updateKeperluan(val) {
    // handled by event listener di atas
}
</script>
@endpush