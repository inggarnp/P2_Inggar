@extends('layouts.app')

@section('title', 'Surat Pindah Keluar')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-transfer me-2"></i>Buat Surat Pindah Keluar
                </h4>
                <a href="{{ route('arsip.index', ['jenis' => 'PINDAH_KELUAR']) }}"
                    class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-archive me-1"></i> Lihat Arsip
                </a>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-warning d-flex align-items-center mb-3">
    <i class="bx bx-error-circle me-2 fs-5"></i>
    <div>
        <strong>Perhatian!</strong> Setelah surat ini disimpan, status warga yang bersangkutan akan
        otomatis berubah menjadi <strong>Pindah</strong> di data warga.
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
            <div class="card-body" style="overflow-y:auto; max-height:calc(100vh - 260px);">

                <input type="hidden" id="warga_id">

                {{-- NOMOR SURAT --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" value="{{ $nomorSurat }}">
                    <small class="text-muted">Format: 474/XXX/PK/BULAN/TAHUN</small>
                </div>

                <hr class="my-3">

                {{-- CARI WARGA --}}
                <p class="text-muted fw-semibold mb-2" style="font-size:12px;">DATA WARGA</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bx bx-search me-1 text-primary"></i>Cari Warga
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="searchWarga"
                            placeholder="Ketik NIK atau nama warga..." autocomplete="off">
                        <div id="searchResults"
                            class="position-absolute w-100 bg-white border rounded shadow-sm"
                            style="z-index:1000; max-height:200px; overflow-y:auto; display:none; top:100%;">
                        </div>
                    </div>
                    <small class="text-muted">Hanya menampilkan warga berstatus <b>hidup</b>.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="Terisi otomatis" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" placeholder="Terisi otomatis" readonly>
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
                        <label class="form-label fw-semibold">Agama</label>
                        <input type="text" class="form-control" id="agama" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Status Nikah</label>
                        <input type="text" class="form-control" id="status_nikah" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Asal</label>
                    <textarea class="form-control" id="alamat_asal" rows="2" readonly></textarea>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">RT</label>
                        <input type="text" class="form-control" id="rt" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">RW</label>
                        <input type="text" class="form-control" id="rw" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No. KK</label>
                    <input type="text" class="form-control" id="no_kk" readonly>
                </div>

                <hr class="my-3">

                {{-- DATA TUJUAN --}}
                <p class="text-muted fw-semibold mb-2" style="font-size:12px;">TUJUAN KEPINDAHAN</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Alamat Tujuan <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="alamat_tujuan" rows="2"
                        placeholder="Jl. Contoh No. 1 RT 002/003"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelurahan Tujuan</label>
                    <input type="text" class="form-control" id="kelurahan_tujuan"
                        placeholder="contoh: Kelurahan Sukajadi">
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Kecamatan Tujuan</label>
                        <input type="text" class="form-control" id="kecamatan_tujuan"
                            placeholder="contoh: Sukajadi">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Kota Tujuan</label>
                        <input type="text" class="form-control" id="kota_tujuan"
                            placeholder="contoh: Kota Bandung">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Alasan Pindah <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="alasan_select">
                        <option value="">-- Pilih alasan --</option>
                        <option value="Pekerjaan / mutasi kerja">Pekerjaan / Mutasi Kerja</option>
                        <option value="Mengikuti suami / istri">Mengikuti Suami / Istri</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Keamanan">Keamanan</option>
                        <option value="Lainnya">Lainnya (ketik manual)</option>
                    </select>
                    <input type="text" class="form-control mt-2 d-none" id="alasan_manual"
                        placeholder="Ketik alasan pindah...">
                </div>

                {{-- TANGGAL SURAT --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tanggal Surat</label>
                    <input type="text" class="form-control" id="tanggal_surat" readonly>
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-warning flex-fill text-dark" id="btnSimpan">
                        <i class="bx bx-save me-1"></i> Simpan & Ubah Status
                    </button>
                    <button type="button" class="btn btn-success flex-fill"
                        onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak PDF
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="btnReset" title="Reset">
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
                            Surat Keterangan Pindah
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
                        menerangkan bahwa:
                    </p>

                    {{-- DATA WARGA --}}
                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #ccc; padding-bottom:4px;">
                        Data Penduduk
                    </div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0;">
                        <tr>
                            <td style="width:37%; padding:2px 0;">Nama Lengkap</td>
                            <td style="width:3%;">:</td>
                            <td><b><span id="p-nama">-</span></b></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">NIK</td>
                            <td>:</td>
                            <td><span id="p-nik">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><span id="p-ttl">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Jenis Kelamin</td>
                            <td>:</td>
                            <td><span id="p-jk">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Agama</td>
                            <td>:</td>
                            <td><span id="p-agama">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Status Pernikahan</td>
                            <td>:</td>
                            <td><span id="p-status-nikah">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Pekerjaan</td>
                            <td>:</td>
                            <td><span id="p-pekerjaan">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">No. KK</td>
                            <td>:</td>
                            <td><span id="p-no-kk">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0; vertical-align:top;">Alamat Asal</td>
                            <td style="vertical-align:top;">:</td>
                            <td><span id="p-alamat-asal">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">RT / RW</td>
                            <td>:</td>
                            <td>RT <span id="p-rt">-</span> / RW <span id="p-rw">-</span></td>
                        </tr>
                    </table>

                    {{-- DATA TUJUAN --}}
                    <div style="margin-bottom:6px; font-weight:bold; font-size:10pt; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #ccc; padding-bottom:4px;">
                        Tujuan Kepindahan
                    </div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0 16px 0;">
                        <tr>
                            <td style="width:37%; padding:2px 0; vertical-align:top;">Alamat Tujuan</td>
                            <td style="width:3%; vertical-align:top;">:</td>
                            <td><span id="p-alamat-tujuan">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Kelurahan</td>
                            <td>:</td>
                            <td><span id="p-kelurahan-tujuan">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Kecamatan</td>
                            <td>:</td>
                            <td><span id="p-kecamatan-tujuan">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Kota / Kabupaten</td>
                            <td>:</td>
                            <td><span id="p-kota-tujuan">-</span></td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">Alasan Pindah</td>
                            <td>:</td>
                            <td><span id="p-alasan">-</span></td>
                        </tr>
                    </table>

                    {{-- PENUTUP --}}
                    <p style="margin:0 0 10px 0; text-align:justify;">
                        Demikian surat keterangan pindah ini dibuat dengan sebenar-benarnya
                        untuk dapat dipergunakan sebagaimana mestinya.
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

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

{{-- Modal Konfirmasi Simpan Pindah Keluar --}}
<div class="modal fade" id="konfirmasiSimpanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">
                    <i class="bx bx-error-circle me-2"></i>Konfirmasi Perubahan Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bx bx-transfer text-warning" style="font-size:3rem;"></i>
                </div>
                <p class="text-center mb-3">Apakah Anda yakin ingin menyimpan surat ini?</p>
                <div class="alert alert-light border text-center mb-3">
                    <strong>Nama Warga:</strong><br>
                    <span class="fs-6 fw-bold" id="konfirmasi_nama_warga">-</span>
                </div>
                <div class="alert alert-warning mb-0">
                    <i class="bx bx-error me-1"></i>
                    <strong>Perhatian:</strong> Status warga akan otomatis berubah menjadi
                    <strong>Pindah</strong> dan tidak dapat dibatalkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-warning text-dark" id="btnKonfirmasiSimpan">
                    <i class="bx bx-save me-1"></i>
                    <span id="btnKonfirmasiText">Ya, Simpan</span>
                    <span id="btnKonfirmasiLoader" class="spinner-border spinner-border-sm d-none"></span>
                </button>
            </div>
        </div>
    </div>
</div>

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
            background: white !important; font-size: 11pt !important;
            box-sizing: border-box !important;
        }
    }
    .search-item { padding:8px 12px; cursor:pointer; border-bottom:1px solid #f0f0f0; font-size:13px; }
    .search-item:hover { background:#fff8e1; }
    .search-item .item-name { font-weight:600; color:#333; }
    .search-item .item-nik { font-size:11px; color:#888; }
    #surat-preview { border:1px solid #e0e0e0; }
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

    // Live preview nomor surat
    document.getElementById('nomor_surat').addEventListener('input', function () {
        setP('p-nomor-surat', this.value);
    });

    // Live preview tujuan
    ['alamat_tujuan','kelurahan_tujuan','kecamatan_tujuan','kota_tujuan'].forEach(id => {
        const previewId = 'p-' + id.replace(/_/g, '-');
        document.getElementById(id)?.addEventListener('input', function () {
            setP(previewId, this.value);
        });
    });

    // Alasan pindah
    document.getElementById('alasan_select').addEventListener('change', function () {
        const manual = document.getElementById('alasan_manual');
        if (this.value === 'Lainnya') {
            manual.classList.remove('d-none'); manual.focus();
        } else {
            manual.classList.add('d-none');
            setP('p-alasan', this.value);
        }
    });
    document.getElementById('alasan_manual').addEventListener('input', function () {
        setP('p-alasan', this.value);
    });

    // =============================================
    // SEARCH WARGA
    // =============================================
    let searchTimeout;
    const searchInput   = document.getElementById('searchWarga');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const q = this.value.trim();
        if (q.length < 2) { searchResults.style.display = 'none'; return; }

        searchTimeout = setTimeout(() => {
            fetch(`{{ route('pindah_keluar.search_warga') }}?q=${encodeURIComponent(q)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (!data.success || !data.data.length) {
                    searchResults.innerHTML = '<div class="search-item text-muted">Warga tidak ditemukan</div>';
                    searchResults.style.display = 'block';
                    return;
                }
                data.data.forEach(w => {
                    const item = document.createElement('div');
                    item.className = 'search-item';
                    item.innerHTML = `<div class="item-name">${w.name}</div>
                        <div class="item-nik">NIK: ${w.nik} &bull; RT ${w.rt}/RW ${w.rw}</div>`;
                    item.addEventListener('click', () => fillWarga(w));
                    searchResults.appendChild(item);
                });
                searchResults.style.display = 'block';
            });
        }, 350);
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target))
            searchResults.style.display = 'none';
    });

    function fillWarga(w) {
        searchResults.style.display = 'none';
        searchInput.value = w.name;
        document.getElementById('warga_id').value = w.id;

        setF('nik', w.nik);
        setF('nama', w.name);
        setF('tempat_lahir', w.birth_place);
        setF('tanggal_lahir', w.birth_date_fmt);
        setF('jenis_kelamin', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setF('agama', w.religious);
        setF('status_nikah', w.married_status);
        setF('pekerjaan', w.occupation);
        setF('alamat_asal', w.address);
        setF('rt', w.rt);
        setF('rw', w.rw);
        setF('no_kk', w.no_kk);

        setP('p-nama', w.name);
        setP('p-nik', w.nik);
        setP('p-ttl', `${w.birth_place}, ${w.birth_date_fmt}`);
        setP('p-jk', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setP('p-agama', w.religious);
        setP('p-status-nikah', w.married_status);
        setP('p-pekerjaan', w.occupation);
        setP('p-alamat-asal', w.address);
        setP('p-rt', w.rt);
        setP('p-rw', w.rw);
        setP('p-no-kk', w.no_kk);
    }

    // =============================================
    // RESET
    // =============================================
    function resetForm() {
        ['warga_id','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin',
         'agama','status_nikah','pekerjaan','alamat_asal','rt','rw','no_kk',
         'alamat_tujuan','kelurahan_tujuan','kecamatan_tujuan','kota_tujuan']
        .forEach(id => setF(id, ''));

        searchInput.value = '';
        document.getElementById('alasan_select').value = '';
        document.getElementById('alasan_manual').value = '';
        document.getElementById('alasan_manual').classList.add('d-none');

        ['p-nama','p-nik','p-ttl','p-jk','p-agama','p-status-nikah','p-pekerjaan',
         'p-alamat-asal','p-rt','p-rw','p-no-kk','p-alamat-tujuan',
         'p-kelurahan-tujuan','p-kecamatan-tujuan','p-kota-tujuan','p-alasan']
        .forEach(id => setP(id, '-'));
    }

    document.getElementById('btnReset').addEventListener('click', function () {
        if (!confirm('Reset semua data form?')) return;
        resetForm();
    });

    // =============================================
    // SIMPAN
    // =============================================
    document.getElementById('btnSimpan').addEventListener('click', async function () {
        const btn = this;
        const wargaId = document.getElementById('warga_id').value;
        const nama    = document.getElementById('nama').value;

        if (!wargaId) {
            alert('Pilih warga terlebih dahulu menggunakan kolom pencarian.');
            return;
        }

        const alasanVal = document.getElementById('alasan_select').value === 'Lainnya'
            ? document.getElementById('alasan_manual').value
            : document.getElementById('alasan_select').value;

        if (!document.getElementById('alamat_tujuan').value) {
            alert('Alamat tujuan wajib diisi.');
            return;
        }
        if (!alasanVal) {
            alert('Alasan pindah wajib diisi.');
            return;
        }

        // Tampilkan modal konfirmasi Bootstrap
        document.getElementById('konfirmasi_nama_warga').textContent = nama;
        const konfirmasiModal = new bootstrap.Modal(document.getElementById('konfirmasiSimpanModal'));
        konfirmasiModal.show();

        window._pendingPayload = {
            nomor_surat:       document.getElementById('nomor_surat').value,
            warga_id:          wargaId,
            nik:               document.getElementById('nik').value,
            nama,
            tempat_lahir:      document.getElementById('tempat_lahir').value,
            tanggal_lahir:     document.getElementById('tanggal_lahir').value,
            jenis_kelamin:     document.getElementById('jenis_kelamin').value,
            agama:             document.getElementById('agama').value,
            status_nikah:      document.getElementById('status_nikah').value,
            pekerjaan:         document.getElementById('pekerjaan').value,
            no_kk:             document.getElementById('no_kk').value,
            alamat_asal:       document.getElementById('alamat_asal').value,
            rt:                document.getElementById('rt').value,
            rw:                document.getElementById('rw').value,
            alamat_tujuan:     document.getElementById('alamat_tujuan').value,
            kelurahan_tujuan:  document.getElementById('kelurahan_tujuan').value,
            kecamatan_tujuan:  document.getElementById('kecamatan_tujuan').value,
            kota_tujuan:       document.getElementById('kota_tujuan').value,
            alasan_pindah:     alasanVal,
            tanggal_surat:     document.getElementById('tanggal_surat').value,
        };

        // One-time listener dari tombol konfirmasi modal
        const btnKonfirmasi = document.getElementById('btnKonfirmasiSimpan');
        const newBtn = btnKonfirmasi.cloneNode(true);
        btnKonfirmasi.parentNode.replaceChild(newBtn, btnKonfirmasi);

        newBtn.addEventListener('click', async function () {
            const payload = window._pendingPayload;
            const modal   = bootstrap.Modal.getInstance(document.getElementById('konfirmasiSimpanModal'));

            newBtn.disabled = true;
            document.getElementById('btnKonfirmasiText').classList.add('d-none');
            document.getElementById('btnKonfirmasiLoader').classList.remove('d-none');

            try {
                const res = await fetch('{{ route("pindah_keluar.store") }}', {
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
                    alert(`${data.message}`);
                    resetForm();
                    window.location.reload();
                } else {
                    alert('Gagal: ' + (data.message || 'Terjadi kesalahan'));
                }
            } catch (e) {
                alert('Koneksi gagal. Silakan coba lagi.');
            } finally {
                newBtn.disabled = false;
                document.getElementById('btnKonfirmasiText').classList.remove('d-none');
                document.getElementById('btnKonfirmasiLoader').classList.add('d-none');
            }
        });

        btn.disabled = false;
        btn.innerHTML = '<i class="bx bx-save me-1"></i> Simpan & Ubah Status';
    });

});
</script>
@endpush