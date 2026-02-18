@extends('layouts.app')

@section('title', 'Surat Akte Kematian')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-file me-2"></i>Buat Surat Akte Kematian
                </h4>
                <a href="{{ route('arsip.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-archive me-1"></i> Lihat Arsip
                </a>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
    <i class="bx bx-error-circle me-2 fs-5"></i>
    <div>
        <strong>Perhatian!</strong> Setelah surat ini disimpan, status warga yang bersangkutan akan
        otomatis berubah menjadi <strong>Meninggal</strong> di data warga. Pastikan data sudah benar sebelum menyimpan.
    </div>
</div>

<div class="row g-3">
    <div class="col-xl-5 col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bx bx-edit me-1 text-primary"></i> Data Surat
                </h6>
            </div>
            <div class="card-body" style="overflow-y: auto; max-height: calc(100vh - 260px);">

                <input type="hidden" id="warga_id">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" value="{{ $nomorSurat }}">
                    <small class="text-muted">Format: 474/XXX/AK/BULAN/TAHUN</small>
                </div>

                <hr class="my-3">

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bx bx-search me-1 text-primary"></i>Cari Almarhum/Almarhumah
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchWarga"
                            placeholder="Ketik NIK atau nama warga..." autocomplete="off">
                        <div id="searchResults" class="position-absolute w-100 bg-white border rounded shadow-sm"
                            style="z-index:1000; max-height:220px; overflow-y:auto; display:none; top:100%;"></div>
                    </div>
                    <small class="text-muted">Hanya menampilkan warga dengan status <b>hidup</b>.</small>
                </div>

                <hr class="my-3">
                <p class="text-muted fw-semibold mb-2" style="font-size:12px;">DATA ALMARHUM/ALMARHUMAH</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="16 digit NIK" maxlength="16">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama lengkap">
                </div>
                <div class="row">
                    <div class="col-7 mb-3">
                        <label class="form-label fw-semibold">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" readonly>
                    </div>
                    <div class="col-5 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggal_lahir" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Umur</label>
                        <input type="text" class="form-control" id="umur" placeholder="-" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Agama</label>
                        <input type="text" class="form-control" id="agama" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="2" readonly></textarea>
                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label class="form-label fw-semibold">RT</label>
                        <input type="text" class="form-control" id="rt" readonly>
                    </div>
                    <div class="col-4 mb-3">
                        <label class="form-label fw-semibold">RW</label>
                        <input type="text" class="form-control" id="rw" readonly>
                    </div>
                    <div class="col-4 mb-3">
                        <label class="form-label fw-semibold">No. KK</label>
                        <input type="text" class="form-control" id="no_kk" readonly>
                    </div>
                </div>

                <hr class="my-3">
                <p class="text-muted fw-semibold mb-2" style="font-size:12px;">DATA KEMATIAN</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Meninggal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tanggal_meninggal" placeholder="contoh: 15 Februari 2026">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tempat Meninggal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tempat_meninggal" placeholder="contoh: RS Hasan Sadikin Bandung">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sebab Meninggal <span class="text-danger">*</span></label>
                    <select class="form-select" id="sebab_select">
                        <option value="">-- Pilih sebab meninggal --</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Kecelakaan">Kecelakaan</option>
                        <option value="Usia lanjut">Usia Lanjut</option>
                        <option value="lainnya">Lainnya (ketik manual)</option>
                    </select>
                    <input type="text" class="form-control mt-2 d-none" id="sebab_manual" placeholder="Ketik sebab meninggal...">
                </div>

                <hr class="my-3">
                <p class="text-muted fw-semibold mb-2" style="font-size:12px;">DATA PELAPOR</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bx bx-search me-1 text-warning"></i>Cari Pelapor <span class="text-danger">*</span>
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchPelapor"
                            placeholder="Ketik NIK atau nama pelapor..." autocomplete="off">
                        <div id="searchResultsPelapor" class="position-absolute w-100 bg-white border rounded shadow-sm"
                            style="z-index:1001; max-height:200px; overflow-y:auto; display:none; top:100%;"></div>
                    </div>
                    <small class="text-muted">Data diambil dari data warga.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Pelapor</label>
                    <input type="text" class="form-control" id="nama_pelapor" placeholder="Terisi otomatis" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK Pelapor</label>
                    <input type="text" class="form-control" id="nik_pelapor" placeholder="Terisi otomatis" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                    <select class="form-select" id="hubungan_pelapor">
                        <option value="">-- Pilih hubungan --</option>
                        <option value="Suami">Suami</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Saudara Kandung">Saudara Kandung</option>
                        <option value="Kerabat">Kerabat</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Tanggal Surat</label>
                    <input type="text" class="form-control" id="tanggal_surat" readonly>
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-danger flex-fill" id="btnSimpan">
                        <i class="bx bx-save me-1"></i> Simpan & Ubah Status
                    </button>
                    <button type="button" class="btn btn-success flex-fill" onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak PDF
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="btnReset" title="Reset">
                        <i class="bx bx-refresh"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="card-title mb-0">
                    <i class="bx bx-show me-1 text-success"></i> Preview Surat
                </h6>
                <span class="badge bg-success">Live Preview</span>
            </div>
            <div class="card-body p-0">
                <div id="surat-preview" style="background:white; padding:40px 50px; min-height:700px;
                    font-family:'Times New Roman',serif; font-size:12pt; color:#000; line-height:1.6;">

                    <div style="display:flex; align-items:center; border-bottom:3px solid #000; padding-bottom:10px; margin-bottom:16px;">
                        <div style="flex-shrink:0; margin-right:16px;">
                            @if($config && $config->logo)
                                <img src="{{ asset($config->logo) }}" alt="Logo" style="width:80px; height:80px; object-fit:contain;">
                            @else
                                <div style="width:80px; height:80px; border:2px dashed #ccc; display:flex; align-items:center; justify-content:center; color:#aaa; font-size:10px; text-align:center;">Logo<br>Kelurahan</div>
                            @endif
                        </div>
                        <div style="flex:1; text-align:center;">
                            <div style="font-size:11pt;">PEMERINTAH KOTA {{ strtoupper($config->city ?? 'BANDUNG') }}</div>
                            <div style="font-size:11pt;">KECAMATAN {{ strtoupper($config->district ?? '-') }}</div>
                            <div style="font-size:16pt; font-weight:bold; text-transform:uppercase;">{{ $config->name ?? 'KELURAHAN' }}</div>
                            <div style="font-size:9pt;">
                                @if($config && $config->address){{ $config->address }} &bull; @endif
                                Kode Pos {{ $config->pos_code ?? '' }}@if($config && $config->contact) &bull; Telp/Email: {{ $config->contact }}@endif
                            </div>
                        </div>
                    </div>

                    <div style="text-align:center; margin:16px 0 20px;">
                        <div style="font-size:13pt; font-weight:bold; text-decoration:underline; text-transform:uppercase; letter-spacing:1px;">Surat Keterangan Kematian</div>
                        <div style="font-size:11pt; margin-top:4px;">Nomor: <span id="p-nomor-surat">{{ $nomorSurat }}</span></div>
                    </div>

                    <p style="margin:0 0 14px 0; text-align:justify;">
                        Yang bertanda tangan di bawah ini, Lurah <b>{{ $config->name ?? 'Kelurahan' }}</b>,
                        Kecamatan <b>{{ $config->district ?? '-' }}</b>, Kota <b>{{ $config->city ?? '-' }}</b>,
                        Provinsi <b>{{ $config->province ?? '-' }}</b>, menerangkan bahwa telah meninggal dunia
                        seseorang dengan keterangan sebagai berikut:
                    </p>

                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; border-bottom:1px solid #ccc; padding-bottom:4px;">Data Almarhum / Almarhumah</div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0;">
                        <tr><td style="width:37%; padding:2px 0;">Nama Lengkap</td><td style="width:3%;">:</td><td><b><span id="p-nama">-</span></b></td></tr>
                        <tr><td style="padding:2px 0;">NIK</td><td>:</td><td><span id="p-nik">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Tempat / Tanggal Lahir</td><td>:</td><td><span id="p-ttl">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Jenis Kelamin</td><td>:</td><td><span id="p-jk">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Umur</td><td>:</td><td><span id="p-umur">-</span> tahun</td></tr>
                        <tr><td style="padding:2px 0;">Agama</td><td>:</td><td><span id="p-agama">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Pekerjaan</td><td>:</td><td><span id="p-pekerjaan">-</span></td></tr>
                        <tr><td style="padding:2px 0;">No. KK</td><td>:</td><td><span id="p-no-kk">-</span></td></tr>
                        <tr><td style="padding:2px 0; vertical-align:top;">Alamat</td><td style="vertical-align:top;">:</td><td><span id="p-alamat">-</span></td></tr>
                        <tr><td style="padding:2px 0;">RT / RW</td><td>:</td><td>RT <span id="p-rt">-</span> / RW <span id="p-rw">-</span></td></tr>
                    </table>

                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; border-bottom:1px solid #ccc; padding-bottom:4px;">Keterangan Kematian</div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0;">
                        <tr><td style="width:37%; padding:2px 0;">Tanggal Meninggal</td><td style="width:3%;">:</td><td><span id="p-tanggal-meninggal">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Tempat Meninggal</td><td>:</td><td><span id="p-tempat-meninggal">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Sebab Meninggal</td><td>:</td><td><span id="p-sebab-meninggal">-</span></td></tr>
                    </table>

                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; border-bottom:1px solid #ccc; padding-bottom:4px;">Data Pelapor</div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0;">
                        <tr><td style="width:37%; padding:2px 0;">Nama Pelapor</td><td style="width:3%;">:</td><td><span id="p-nama-pelapor">-</span></td></tr>
                        <tr><td style="padding:2px 0;">Hubungan dengan Almarhum</td><td>:</td><td><span id="p-hubungan-pelapor">-</span></td></tr>
                    </table>

                    <p style="margin:0 0 10px 0; text-align:justify;">Demikian surat keterangan kematian ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

                    <div style="display:flex; justify-content:flex-end; margin-top:28px;">
                        <div style="text-align:center; min-width:220px;">
                            <div>{{ $config->city ?? 'Bandung' }}, <span id="p-tanggal-surat">{{ now()->isoFormat('D MMMM Y') }}</span></div>
                            <div style="margin-top:4px;">Lurah {{ $config->name ?? '' }}</div>
                            <br><br><br><br>
                            <div style="border-bottom:1px solid #000; width:200px; margin:0 auto;"></div>
                            <div style="font-size:9pt; margin-top:4px;">NIP. ___________________________</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Simpan --}}
<div class="modal fade" id="konfirmasiSimpanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bx bx-error-circle me-2"></i>Konfirmasi Perubahan Status
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bx bx-error-circle text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="text-center mb-2">Apakah Anda yakin ingin menyimpan surat ini?</p>
                <div class="alert alert-light border text-center mb-3">
                    <strong>Almarhum / Almarhumah:</strong><br>
                    <span class="fs-6 fw-bold" id="konfirmasi_nama">-</span>
                </div>
                <div class="alert alert-warning mb-2">
                    <i class="bx bx-error me-1"></i>
                    <strong>Perhatian:</strong> Status warga akan berubah menjadi <strong>Meninggal</strong>.
                </div>
                <div class="alert alert-danger mb-0">
                    <i class="bx bx-error-circle me-1"></i>
                    <strong>Peringatan:</strong> Perubahan status tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnKonfirmasiSimpan">
                    <i class="bx bx-save me-1"></i>
                    <span id="btnKonfirmasiText">Ya, Simpan</span>
                    <span id="btnKonfirmasiLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @media print {
        @page { size: A4 portrait; margin: 0; }
        body * { visibility: hidden !important; }
        #surat-preview, #surat-preview * { visibility: visible !important; }
        #surat-preview {
            position: fixed !important; top: 0 !important; left: 0 !important;
            width: 100% !important; padding: 1.5cm 2cm !important;
            margin: 0 !important; border: none !important;
            background: white !important; min-height: auto !important;
            font-size: 11pt !important; box-sizing: border-box !important;
        }
    }
    .search-item { padding: 8px 12px; cursor: pointer; border-bottom: 1px solid #f0f0f0; font-size: 13px; }
    #searchResults .search-item:hover { background-color: #fff3f3; }
    #searchResultsPelapor .search-item:hover { background-color: #fffbf0; }
    .search-item .item-name { font-weight: 600; color: #333; }
    .search-item .item-nik { font-size: 11px; color: #888; }
    #surat-preview { border: 1px solid #e0e0e0; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni',
                       'Juli','Agustus','September','Oktober','November','Desember'];
    const today = new Date();
    document.getElementById('tanggal_surat').value =
        `${today.getDate()} ${bulanIndo[today.getMonth()]} ${today.getFullYear()}`;

    const setF = (id, val) => { const el = document.getElementById(id); if (el) el.value = val || ''; };
    const setP = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val || '-'; };

    document.getElementById('nomor_surat').addEventListener('input', function () { setP('p-nomor-surat', this.value); });
    document.getElementById('tanggal_meninggal').addEventListener('input', function () { setP('p-tanggal-meninggal', this.value); });
    document.getElementById('tempat_meninggal').addEventListener('input', function () { setP('p-tempat-meninggal', this.value); });

    document.getElementById('sebab_select').addEventListener('change', function () {
        const manual = document.getElementById('sebab_manual');
        if (this.value === 'lainnya') { manual.classList.remove('d-none'); manual.focus(); }
        else { manual.classList.add('d-none'); setP('p-sebab-meninggal', this.value); }
    });
    document.getElementById('sebab_manual').addEventListener('input', function () { setP('p-sebab-meninggal', this.value); });
    document.getElementById('hubungan_pelapor').addEventListener('change', function () { setP('p-hubungan-pelapor', this.value); });

    // =============================================
    // SEARCH WARGA (almarhum)
    // =============================================
    let searchTimeout;
    const searchInput   = document.getElementById('searchWarga');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const q = this.value.trim();
        if (q.length < 2) { searchResults.style.display = 'none'; return; }
        searchTimeout = setTimeout(() => {
            fetch(`{{ route('akte_kematian.search_warga') }}?q=${encodeURIComponent(q)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (!data.success || data.data.length === 0) {
                    searchResults.innerHTML = '<div class="search-item text-muted">Warga tidak ditemukan</div>';
                    searchResults.style.display = 'block'; return;
                }
                data.data.forEach(w => {
                    const item = document.createElement('div');
                    item.className = 'search-item';
                    item.innerHTML = `<div class="item-name">${w.name}</div><div class="item-nik">NIK: ${w.nik} &bull; RT ${w.rt}/RW ${w.rw}</div>`;
                    item.addEventListener('click', () => fillWarga(w));
                    searchResults.appendChild(item);
                });
                searchResults.style.display = 'block';
            })
            .catch(() => { searchResults.style.display = 'none'; });
        }, 350);
    });

    // =============================================
    // SEARCH PELAPOR — dideklarasikan SEBELUM click listener
    // =============================================
    let searchTimeoutPelapor;
    const searchPelapor        = document.getElementById('searchPelapor');
    const searchResultsPelapor = document.getElementById('searchResultsPelapor');

    searchPelapor.addEventListener('input', function () {
        clearTimeout(searchTimeoutPelapor);
        const q = this.value.trim();
        if (q.length < 2) { searchResultsPelapor.style.display = 'none'; return; }
        searchTimeoutPelapor = setTimeout(() => {
            fetch(`{{ route('akte_kematian.search_warga') }}?q=${encodeURIComponent(q)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                searchResultsPelapor.innerHTML = '';
                if (!data.success || data.data.length === 0) {
                    searchResultsPelapor.innerHTML = '<div class="search-item text-muted">Warga tidak ditemukan</div>';
                    searchResultsPelapor.style.display = 'block'; return;
                }
                data.data.forEach(w => {
                    const item = document.createElement('div');
                    item.className = 'search-item';
                    item.innerHTML = `<div class="item-name">${w.name}</div><div class="item-nik">NIK: ${w.nik} &bull; RT ${w.rt}/RW ${w.rw}</div>`;
                    item.addEventListener('click', () => fillPelapor(w));
                    searchResultsPelapor.appendChild(item);
                });
                searchResultsPelapor.style.display = 'block';
            })
            .catch(() => { searchResultsPelapor.style.display = 'none'; });
        }, 350);
    });

    // Click luar — SETELAH kedua variabel dideklarasikan, tidak akan error
    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target))
            searchResults.style.display = 'none';
        if (!searchPelapor.contains(e.target) && !searchResultsPelapor.contains(e.target))
            searchResultsPelapor.style.display = 'none';
    });

    function fillPelapor(w) {
        searchResultsPelapor.style.display = 'none';
        searchPelapor.value = w.name;
        setF('nama_pelapor', w.name);
        setF('nik_pelapor', w.nik);
        setP('p-nama-pelapor', w.name);
    }

    function fillWarga(w) {
        searchResults.style.display = 'none';
        searchInput.value = w.name;
        document.getElementById('warga_id').value = w.id;
        setF('nik', w.nik); setF('nama', w.name);
        setF('tempat_lahir', w.birth_place); setF('tanggal_lahir', w.birth_date_fmt);
        setF('jenis_kelamin', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setF('agama', w.religious); setF('pekerjaan', w.occupation);
        setF('alamat', w.address); setF('rt', w.rt); setF('rw', w.rw);
        setF('no_kk', w.no_kk);
        setF('umur', w.age !== '-' ? `${w.age} tahun` : '-');

        setP('p-nik', w.nik); setP('p-nama', w.name);
        setP('p-ttl', `${w.birth_place}, ${w.birth_date_fmt}`);
        setP('p-jk', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setP('p-umur', w.age !== '-' ? w.age : '-');
        setP('p-agama', w.religious); setP('p-pekerjaan', w.occupation);
        setP('p-alamat', w.address); setP('p-rt', w.rt); setP('p-rw', w.rw);
        setP('p-no-kk', w.no_kk);
    }

    function resetForm() {
        ['warga_id','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin',
         'agama','pekerjaan','alamat','rt','rw','no_kk','umur',
         'tanggal_meninggal','tempat_meninggal','nama_pelapor','nik_pelapor']
        .forEach(id => setF(id, ''));
        searchInput.value = ''; searchPelapor.value = '';
        document.getElementById('sebab_select').value = '';
        document.getElementById('sebab_manual').value = '';
        document.getElementById('sebab_manual').classList.add('d-none');
        document.getElementById('hubungan_pelapor').value = '';
        ['p-nik','p-nama','p-ttl','p-jk','p-umur','p-agama','p-pekerjaan',
         'p-alamat','p-rt','p-rw','p-no-kk','p-tanggal-meninggal',
         'p-tempat-meninggal','p-sebab-meninggal','p-nama-pelapor','p-hubungan-pelapor']
        .forEach(id => setP(id, '-'));
    }

    document.getElementById('btnReset').addEventListener('click', function () {
        if (!confirm('Reset semua data form?')) return;
        resetForm();
    });

    // =============================================
    // SIMPAN — validasi dulu, lalu buka modal
    // =============================================
    document.getElementById('btnSimpan').addEventListener('click', function () {
        const wargaId = document.getElementById('warga_id').value;
        const nik     = document.getElementById('nik').value;
        const nama    = document.getElementById('nama').value;

        if (!wargaId || !nik || nik.length !== 16) {
            alert('Pilih warga terlebih dahulu menggunakan kolom pencarian.'); return;
        }
        const sebabVal = document.getElementById('sebab_select').value === 'lainnya'
            ? document.getElementById('sebab_manual').value
            : document.getElementById('sebab_select').value;

        if (!document.getElementById('tanggal_meninggal').value ||
            !document.getElementById('tempat_meninggal').value || !sebabVal) {
            alert('Lengkapi data kematian: tanggal, tempat, dan sebab meninggal.'); return;
        }
        if (!document.getElementById('nama_pelapor').value ||
            !document.getElementById('hubungan_pelapor').value) {
            alert('Lengkapi data pelapor: nama dan hubungan dengan almarhum.'); return;
        }

        // Buka modal konfirmasi
        document.getElementById('konfirmasi_nama').textContent = nama;
        new bootstrap.Modal(document.getElementById('konfirmasiSimpanModal')).show();
    });

    // Tombol Ya Simpan di modal
    document.getElementById('btnKonfirmasiSimpan').addEventListener('click', async function () {
        const btn   = this;
        const modal = bootstrap.Modal.getInstance(document.getElementById('konfirmasiSimpanModal'));

        const sebabVal = document.getElementById('sebab_select').value === 'lainnya'
            ? document.getElementById('sebab_manual').value
            : document.getElementById('sebab_select').value;

        const payload = {
            nomor_surat:       document.getElementById('nomor_surat').value,
            warga_id:          document.getElementById('warga_id').value,
            nik:               document.getElementById('nik').value,
            nama:              document.getElementById('nama').value,
            tempat_lahir:      document.getElementById('tempat_lahir').value,
            tanggal_lahir:     document.getElementById('tanggal_lahir').value,
            jenis_kelamin:     document.getElementById('jenis_kelamin').value,
            agama:             document.getElementById('agama').value,
            pekerjaan:         document.getElementById('pekerjaan').value,
            alamat:            document.getElementById('alamat').value,
            rt:                document.getElementById('rt').value,
            rw:                document.getElementById('rw').value,
            no_kk:             document.getElementById('no_kk').value,
            umur:              document.getElementById('umur').value,
            tanggal_meninggal: document.getElementById('tanggal_meninggal').value,
            tempat_meninggal:  document.getElementById('tempat_meninggal').value,
            sebab_meninggal:   sebabVal,
            nama_pelapor:      document.getElementById('nama_pelapor').value,
            nik_pelapor:       document.getElementById('nik_pelapor').value,
            hubungan_pelapor:  document.getElementById('hubungan_pelapor').value,
            tanggal_surat:     document.getElementById('tanggal_surat').value,
        };

        btn.disabled = true;
        document.getElementById('btnKonfirmasiText').classList.add('d-none');
        document.getElementById('btnKonfirmasiLoader').classList.remove('d-none');

        try {
            const res = await fetch('{{ route("akte_kematian.store") }}', {
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
                modal.hide();
                alert(` ${data.message}`);
                resetForm();
                window.location.reload();
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan'));
            }
        } catch (e) {
            alert(' Koneksi gagal. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            document.getElementById('btnKonfirmasiText').classList.remove('d-none');
            document.getElementById('btnKonfirmasiLoader').classList.add('d-none');
        }
    });

});
</script>
@endpush