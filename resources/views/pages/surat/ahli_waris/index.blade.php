@extends('layouts.app')

@section('title', 'Surat Ahli Waris')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-file me-2"></i>Buat Surat Ahli Waris
                </h4>
                <a href="{{ route('arsip.index', ['jenis' => 'AHLI_WARIS']) }}"
                    class="btn btn-outline-secondary btn-sm">
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
            <div class="card-body" style="overflow-y:auto; max-height:calc(100vh - 220px);">

                {{-- NOMOR SURAT --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" value="{{ $nomorSurat }}">
                    <small class="text-muted">Format: 474/XXX/AW/BULAN/TAHUN</small>
                </div>

                <hr class="my-3">

                {{-- CARI ALMARHUM --}}
                <p class="text-muted fw-semibold mb-2" style="font-size:12px;">DATA ALMARHUM / ALMARHUMAH</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bx bx-search me-1 text-danger"></i>Cari Almarhum
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchAlmarhum"
                            placeholder="Ketik NIK atau nama almarhum..." autocomplete="off">
                        <div id="searchResultsAlmarhum"
                            class="position-absolute w-100 bg-white border rounded shadow-sm"
                            style="z-index:1000; max-height:200px; overflow-y:auto; display:none; top:100%;">
                        </div>
                    </div>
                    <small class="text-muted">Hanya menampilkan warga berstatus <b>meninggal</b>.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Almarhum</label>
                    <input type="text" class="form-control" id="nama_almarhum" placeholder="Terisi otomatis" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK Almarhum</label>
                    <input type="text" class="form-control" id="nik_almarhum" placeholder="Terisi otomatis" readonly>
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

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Wafat</label>
                    <input type="text" class="form-control" id="tanggal_wafat"
                        placeholder="contoh: 10 Januari 2026">
                </div>

                <hr class="my-3">

                {{-- DAFTAR AHLI WARIS --}}
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <p class="text-muted fw-semibold mb-0" style="font-size:12px;">DAFTAR AHLI WARIS</p>
                    <button type="button" class="btn btn-sm btn-primary" id="btnTambahWaris">
                        <i class="bx bx-plus me-1"></i> Tambah
                    </button>
                </div>

                <div id="listAhliWaris">
                    {{-- Item ahli waris dirender via JS --}}
                </div>

                <div id="emptyWaris" class="text-center text-muted py-3 border rounded"
                    style="font-size:13px;">
                    <i class="bx bx-group me-1"></i> Belum ada ahli waris ditambahkan
                </div>

                <hr class="my-3">

                {{-- KEPERLUAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Keperluan Surat</label>
                    <select class="form-select" id="keperluan_select">
                        <option value="">-- Pilih keperluan --</option>
                        <option value="Pengurusan warisan">Pengurusan Warisan</option>
                        <option value="Klaim asuransi jiwa">Klaim Asuransi Jiwa</option>
                        <option value="Pengurusan rekening/aset almarhum">Pengurusan Rekening / Aset</option>
                        <option value="Pengurusan pensiun janda/duda">Pengurusan Pensiun Janda/Duda</option>
                        <option value="Keperluan administrasi lainnya">Administrasi Lainnya</option>
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

                {{-- BUTTONS --}}
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary flex-fill" id="btnSimpan">
                        <i class="bx bx-save me-1"></i> Simpan Arsip
                    </button>
                    <button type="button" class="btn btn-success flex-fill"
                        onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak PDF
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="btnReset" title="Reset">
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

                <div id="surat-preview" style="
                    background:white; padding:40px 50px; min-height:700px;
                    font-family:'Times New Roman',serif; font-size:12pt;
                    color:#000; line-height:1.6;">

                    {{-- KOP SURAT --}}
                    <div style="display:flex; align-items:center; border-bottom:3px solid #000; padding-bottom:10px; margin-bottom:16px;">
                        <div style="flex-shrink:0; margin-right:16px;">
                            @if($config && $config->logo)
                                <img src="{{ asset($config->logo) }}" alt="Logo"
                                    style="width:80px; height:80px; object-fit:contain;">
                            @else
                                <div style="width:80px; height:80px; border:2px dashed #ccc;
                                    display:flex; align-items:center; justify-content:center;
                                    color:#aaa; font-size:10px; text-align:center;">
                                    Logo<br>Kelurahan
                                </div>
                            @endif
                        </div>
                        <div style="flex:1; text-align:center;">
                            <div style="font-size:11pt;">PEMERINTAH KOTA {{ strtoupper($config->city ?? 'BANDUNG') }}</div>
                            <div style="font-size:11pt;">KECAMATAN {{ strtoupper($config->district ?? '-') }}</div>
                            <div style="font-size:16pt; font-weight:bold; text-transform:uppercase;">
                                {{ $config->name ?? 'KELURAHAN' }}
                            </div>
                            <div style="font-size:9pt;">
                                @if($config && $config->address){{ $config->address }} &bull; @endif
                                Kode Pos {{ $config->pos_code ?? '' }}@if($config && $config->contact) &bull; Telp/Email: {{ $config->contact }}@endif
                            </div>
                        </div>
                    </div>

                    {{-- JUDUL --}}
                    <div style="text-align:center; margin:16px 0 20px;">
                        <div style="font-size:13pt; font-weight:bold; text-decoration:underline; text-transform:uppercase; letter-spacing:1px;">
                            Surat Keterangan Ahli Waris
                        </div>
                        <div style="font-size:11pt; margin-top:4px;">
                            Nomor: <span id="p-nomor-surat">{{ $nomorSurat }}</span>
                        </div>
                    </div>

                    {{-- PEMBUKA --}}
                    <p style="margin:0 0 14px 0; text-align:justify;">
                        Yang bertanda tangan di bawah ini, Lurah <b>{{ $config->name ?? 'Kelurahan' }}</b>,
                        Kecamatan <b>{{ $config->district ?? '-' }}</b>,
                        Kota <b>{{ $config->city ?? '-' }}</b>,
                        Provinsi <b>{{ $config->province ?? '-' }}</b>,
                        menerangkan dengan sesungguhnya bahwa:
                    </p>

                    {{-- DATA ALMARHUM --}}
                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #ccc; padding-bottom:4px;">
                        Data Almarhum / Almarhumah
                    </div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0;">
                        <tr>
                            <td style="width:37%; padding:2px 0;">Nama Lengkap</td>
                            <td style="width:3%;">:</td>
                            <td><b><span id="p-nama-almarhum">-</span></b></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">NIK</td>
                            <td>:</td>
                            <td><span id="p-nik-almarhum">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><span id="p-ttl-almarhum">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0; vertical-align:top;">Alamat</td>
                            <td style="vertical-align:top;">:</td>
                            <td><span id="p-alamat-almarhum">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">RT / RW</td>
                            <td>:</td>
                            <td>RT <span id="p-rt">-</span> / RW <span id="p-rw">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Tanggal Wafat</td>
                            <td>:</td>
                            <td><span id="p-tanggal-wafat">-</span></td>
                        </tr>
                    </table>

                    {{-- ISI SURAT --}}
                    <p style="margin:0 0 10px 0; text-align:justify;">
                        Telah meninggal dunia dan meninggalkan ahli waris yang sah sebagai berikut:
                    </p>

                    {{-- TABEL AHLI WARIS --}}
                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #ccc; padding-bottom:4px;">
                        Daftar Ahli Waris
                    </div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0; border:1px solid #000;">
                        <thead>
                            <tr style="background:#f0f0f0;">
                                <th style="border:1px solid #000; padding:4px 8px; text-align:center; font-size:10pt; width:8%;">No</th>
                                <th style="border:1px solid #000; padding:4px 8px; font-size:10pt;">Nama Lengkap</th>
                                <th style="border:1px solid #000; padding:4px 8px; font-size:10pt;">NIK</th>
                                <th style="border:1px solid #000; padding:4px 8px; font-size:10pt;">Tempat / Tgl Lahir</th>
                                <th style="border:1px solid #000; padding:4px 8px; font-size:10pt;">Hubungan</th>
                            </tr>
                        </thead>
                        <tbody id="p-tabel-waris">
                            <tr>
                                <td colspan="5" style="border:1px solid #000; padding:6px; text-align:center; color:#aaa; font-size:10pt;">
                                    Belum ada ahli waris
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- PENUTUP --}}
                    <p style="margin:0 0 10px 0; text-align:justify;">
                        Surat keterangan ini dibuat untuk keperluan
                        <b><span id="p-keperluan">........................</span></b>
                        dan dapat dipergunakan sebagaimana mestinya.
                    </p>
                    <p style="margin:0 0 20px 0; text-align:justify;">
                        Demikian surat keterangan ahli waris ini dibuat dengan sebenar-benarnya.
                    </p>

                    {{-- TTD --}}
                    <div style="display:flex; justify-content:flex-end; margin-top:28px;">
                        <div style="text-align:center; min-width:220px;">
                            <div>{{ $config->city ?? 'Bandung' }}, <span id="p-tanggal-surat">{{ now()->isoFormat('D MMMM Y') }}</span></div>
                            <div style="margin-top:4px;">Lurah {{ $config->name ?? '' }}</div>
                            <br><br><br><br>
                            <div style="border-bottom:1px solid #000; width:200px; margin:0 auto;"></div>
                            <div style="font-size:9pt; margin-top:4px;">NIP. ___________________________</div>
                        </div>
                    </div>

                </div>{{-- end surat-preview --}}
            </div>
        </div>
    </div>

</div>

{{-- ============================================================
     MODAL TAMBAH AHLI WARIS
============================================================ --}}
<div class="modal fade" id="modalTambahWaris" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bx bx-user-plus me-2"></i>Tambah Ahli Waris
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- Search warga untuk ahli waris --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bx bx-search me-1 text-primary"></i>Cari dari Data Warga
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchWarisInput"
                            placeholder="Ketik NIK atau nama..." autocomplete="off">
                        <div id="searchResultsWaris"
                            class="position-absolute w-100 bg-white border rounded shadow-sm"
                            style="z-index:1050; max-height:180px; overflow-y:auto; display:none; top:100%;">
                        </div>
                    </div>
                    <small class="text-muted">Data akan auto-fill ke form di bawah.</small>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="w-nama" placeholder="Nama ahli waris">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="w-nik" placeholder="16 digit NIK" maxlength="16">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tempat Lahir</label>
                        <input type="text" class="form-control" id="w-tempat-lahir" placeholder="Kota lahir">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="w-tanggal-lahir" placeholder="contoh: 15 Maret 1990">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                    <select class="form-select" id="w-hubungan">
                        <option value="">-- Pilih hubungan --</option>
                        <option value="Istri">Istri</option>
                        <option value="Suami">Suami</option>
                        <option value="Anak Kandung">Anak Kandung</option>
                        <option value="Anak Angkat">Anak Angkat</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Saudara Kandung">Saudara Kandung</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnKonfirmasiWaris">
                    <i class="bx bx-check me-1"></i> Tambahkan
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
    .search-item { padding:8px 12px; cursor:pointer; border-bottom:1px solid #f0f0f0; font-size:13px; }
    .search-item:hover { background:#f0f7ff; }
    .search-item .item-name { font-weight:600; color:#333; }
    .search-item .item-nik { font-size:11px; color:#888; }
    #surat-preview { border:1px solid #e0e0e0; }

    .waris-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 10px 12px;
        margin-bottom: 8px;
        font-size: 13px;
    }
    .waris-item .waris-nama { font-weight: 600; }
    .waris-item .waris-detail { color: #666; font-size: 12px; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Tanggal default
    const bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni',
                       'Juli','Agustus','September','Oktober','November','Desember'];
    const today = new Date();
    document.getElementById('tanggal_surat').value =
        `${today.getDate()} ${bulanIndo[today.getMonth()]} ${today.getFullYear()}`;

    const setF = (id, val) => { const el = document.getElementById(id); if (el) el.value = val || ''; };
    const setP = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val || '-'; };

    // Live preview nomor surat
    document.getElementById('nomor_surat').addEventListener('input', function () {
        setP('p-nomor-surat', this.value);
    });

    // Tanggal wafat
    document.getElementById('tanggal_wafat').addEventListener('input', function () {
        setP('p-tanggal-wafat', this.value);
    });

    // Keperluan
    document.getElementById('keperluan_select').addEventListener('change', function () {
        const manual = document.getElementById('keperluan_manual');
        if (this.value === 'lainnya') {
            manual.classList.remove('d-none'); manual.focus();
        } else {
            manual.classList.add('d-none');
            setP('p-keperluan', this.value || '........................');
        }
    });
    document.getElementById('keperluan_manual').addEventListener('input', function () {
        setP('p-keperluan', this.value || '........................');
    });

    let timeoutAlmarhum;
    const searchAlmarhumEl  = document.getElementById('searchAlmarhum');
    const resultsAlmarhum   = document.getElementById('searchResultsAlmarhum');

    searchAlmarhumEl.addEventListener('input', function () {
        clearTimeout(timeoutAlmarhum);
        const q = this.value.trim();
        if (q.length < 2) { resultsAlmarhum.style.display = 'none'; return; }

        timeoutAlmarhum = setTimeout(() => {
            fetch(`{{ route('ahli_waris.search_almarhum') }}?q=${encodeURIComponent(q)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                resultsAlmarhum.innerHTML = '';
                if (!data.success || !data.data.length) {
                    resultsAlmarhum.innerHTML = '<div class="search-item text-muted">Almarhum tidak ditemukan</div>';
                    resultsAlmarhum.style.display = 'block';
                    return;
                }
                data.data.forEach(w => {
                    const item = document.createElement('div');
                    item.className = 'search-item';
                    item.innerHTML = `<div class="item-name">${w.name} <span class="badge bg-danger ms-1" style="font-size:9px;">Meninggal</span></div>
                        <div class="item-nik">NIK: ${w.nik}</div>`;
                    item.addEventListener('click', () => fillAlmarhum(w));
                    resultsAlmarhum.appendChild(item);
                });
                resultsAlmarhum.style.display = 'block';
            });
        }, 350);
    });

    function fillAlmarhum(w) {
        resultsAlmarhum.style.display = 'none';
        searchAlmarhumEl.value = w.name;
        setF('nama_almarhum', w.name);
        setF('nik_almarhum', w.nik);
        setF('tempat_lahir', w.birth_place);
        setF('tanggal_lahir', w.birth_date_fmt);
        setF('alamat', w.address);
        setF('rt', w.rt);
        setF('rw', w.rw);
        setF('no_kk', w.no_kk);

        setP('p-nama-almarhum', w.name);
        setP('p-nik-almarhum', w.nik);
        setP('p-ttl-almarhum', `${w.birth_place}, ${w.birth_date_fmt}`);
        setP('p-alamat-almarhum', w.address);
        setP('p-rt', w.rt);
        setP('p-rw', w.rw);
    }

    let timeoutWaris;
    const searchWarisEl  = document.getElementById('searchWarisInput');
    const resultsWaris   = document.getElementById('searchResultsWaris');

    searchWarisEl.addEventListener('input', function () {
        clearTimeout(timeoutWaris);
        const q = this.value.trim();
        if (q.length < 2) { resultsWaris.style.display = 'none'; return; }

        timeoutWaris = setTimeout(() => {
            fetch(`{{ route('ahli_waris.search_warga') }}?q=${encodeURIComponent(q)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                resultsWaris.innerHTML = '';
                if (!data.success || !data.data.length) {
                    resultsWaris.innerHTML = '<div class="search-item text-muted">Warga tidak ditemukan</div>';
                    resultsWaris.style.display = 'block';
                    return;
                }
                data.data.forEach(w => {
                    const item = document.createElement('div');
                    item.className = 'search-item';
                    item.innerHTML = `<div class="item-name">${w.name}</div>
                        <div class="item-nik">NIK: ${w.nik}</div>`;
                    item.addEventListener('click', () => {
                        resultsWaris.style.display = 'none';
                        searchWarisEl.value = w.name;
                        document.getElementById('w-nama').value = w.name;
                        document.getElementById('w-nik').value  = w.nik;
                        document.getElementById('w-tempat-lahir').value   = w.birth_place || '';
                        document.getElementById('w-tanggal-lahir').value  = w.birth_date_fmt || '';
                    });
                    resultsWaris.appendChild(item);
                });
                resultsWaris.style.display = 'block';
            });
        }, 350);
    });

    document.addEventListener('click', function (e) {
        if (!searchAlmarhumEl.contains(e.target) && !resultsAlmarhum.contains(e.target))
            resultsAlmarhum.style.display = 'none';
        if (!searchWarisEl.contains(e.target) && !resultsWaris.contains(e.target))
            resultsWaris.style.display = 'none';
    });

    let daftarWaris = []; 

    function renderDaftarWaris() {
        const container = document.getElementById('listAhliWaris');
        const emptyEl   = document.getElementById('emptyWaris');

        container.innerHTML = '';

        if (daftarWaris.length === 0) {
            emptyEl.style.display = 'block';
            renderPreviewWaris();
            return;
        }

        emptyEl.style.display = 'none';

        daftarWaris.forEach((w, idx) => {
            const div = document.createElement('div');
            div.className = 'waris-item d-flex align-items-start justify-content-between';
            div.innerHTML = `
                <div>
                    <div class="waris-nama">${idx + 1}. ${w.nama}</div>
                    <div class="waris-detail">NIK: ${w.nik} &bull; ${w.hubungan}</div>
                    ${w.tanggal_lahir ? `<div class="waris-detail">${w.tempat_lahir}, ${w.tanggal_lahir}</div>` : ''}
                </div>
                <button class="btn btn-sm btn-outline-danger ms-2" onclick="hapusWaris(${idx})" title="Hapus">
                    <i class="bx bx-trash"></i>
                </button>
            `;
            container.appendChild(div);
        });

        renderPreviewWaris();
    }

    function renderPreviewWaris() {
        const tbody = document.getElementById('p-tabel-waris');
        if (daftarWaris.length === 0) {
            tbody.innerHTML = `<tr>
                <td colspan="5" style="border:1px solid #000; padding:6px; text-align:center; color:#aaa; font-size:10pt;">
                    Belum ada ahli waris
                </td>
            </tr>`;
            return;
        }

        tbody.innerHTML = daftarWaris.map((w, i) => `
            <tr>
                <td style="border:1px solid #000; padding:4px 8px; text-align:center;">${i + 1}</td>
                <td style="border:1px solid #000; padding:4px 8px;">${w.nama}</td>
                <td style="border:1px solid #000; padding:4px 8px;">${w.nik}</td>
                <td style="border:1px solid #000; padding:4px 8px;">${w.tempat_lahir ? w.tempat_lahir + ', ' + w.tanggal_lahir : '-'}</td>
                <td style="border:1px solid #000; padding:4px 8px;">${w.hubungan}</td>
            </tr>
        `).join('');
    }

    window.hapusWaris = function (idx) {
        daftarWaris.splice(idx, 1);
        renderDaftarWaris();
    };

    document.getElementById('btnTambahWaris').addEventListener('click', function () {
        ['w-nama','w-nik','w-tempat-lahir','w-tanggal-lahir'].forEach(id => {
            document.getElementById(id).value = '';
        });
        document.getElementById('w-hubungan').value = '';
        document.getElementById('searchWarisInput').value = '';

        new bootstrap.Modal(document.getElementById('modalTambahWaris')).show();
    });

    document.getElementById('btnKonfirmasiWaris').addEventListener('click', function () {
        const nama     = document.getElementById('w-nama').value.trim();
        const nik      = document.getElementById('w-nik').value.trim();
        const hubungan = document.getElementById('w-hubungan').value;

        if (!nama || !nik || nik.length !== 16) {
            alert('Nama dan NIK (16 digit) wajib diisi.');
            return;
        }
        if (!hubungan) {
            alert('Pilih hubungan dengan almarhum.');
            return;
        }

        daftarWaris.push({
            nama,
            nik,
            tempat_lahir:  document.getElementById('w-tempat-lahir').value.trim(),
            tanggal_lahir: document.getElementById('w-tanggal-lahir').value.trim(),
            hubungan,
        });

        bootstrap.Modal.getInstance(document.getElementById('modalTambahWaris')).hide();
        renderDaftarWaris();
    });

    // Init render
    renderDaftarWaris();

    //reset form
    function resetForm() {
        ['nama_almarhum','nik_almarhum','tempat_lahir','tanggal_lahir',
         'alamat','rt','rw','no_kk','tanggal_wafat']
        .forEach(id => setF(id, ''));

        searchAlmarhumEl.value = '';
        document.getElementById('keperluan_select').value = '';
        document.getElementById('keperluan_manual').value = '';
        document.getElementById('keperluan_manual').classList.add('d-none');

        daftarWaris = [];
        renderDaftarWaris();

        ['p-nama-almarhum','p-nik-almarhum','p-ttl-almarhum',
         'p-alamat-almarhum','p-rt','p-rw','p-tanggal-wafat']
        .forEach(id => setP(id, '-'));

        setP('p-keperluan', '........................');
    }

    document.getElementById('btnReset').addEventListener('click', function () {
        if (!confirm('Reset semua data form?')) return;
        resetForm();
    });

    //simpan data
    document.getElementById('btnSimpan').addEventListener('click', async function () {
        const btn = this;

        const nik_almarhum = document.getElementById('nik_almarhum').value;
        if (!nik_almarhum || nik_almarhum.length !== 16) {
            alert('Pilih data almarhum terlebih dahulu.');
            return;
        }
        if (daftarWaris.length === 0) {
            alert('Minimal 1 ahli waris harus ditambahkan.');
            return;
        }

        const keperluanVal = document.getElementById('keperluan_select').value === 'lainnya'
            ? document.getElementById('keperluan_manual').value
            : document.getElementById('keperluan_select').value;

        const payload = {
            nomor_surat:    document.getElementById('nomor_surat').value,
            nama_almarhum:  document.getElementById('nama_almarhum').value,
            nik_almarhum,
            tempat_lahir:   document.getElementById('tempat_lahir').value,
            tanggal_lahir:  document.getElementById('tanggal_lahir').value,
            alamat:         document.getElementById('alamat').value,
            rt:             document.getElementById('rt').value,
            rw:             document.getElementById('rw').value,
            no_kk:          document.getElementById('no_kk').value,
            tanggal_wafat:  document.getElementById('tanggal_wafat').value,
            ahli_waris:     daftarWaris,
            keperluan:      keperluanVal,
            tanggal_surat:  document.getElementById('tanggal_surat').value,
        };

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

        try {
            const res = await fetch('{{ route("ahli_waris.store") }}', {
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
                alert(`${data.message}\nNomor: ${data.data.nomor_surat}`);
                resetForm();
                window.location.reload();
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan'));
            }
        } catch (e) {
            alert('Koneksi gagal. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="bx bx-save me-1"></i> Simpan Arsip';
        }
    });

});
</script>
@endpush