@extends('layouts.app')

@section('title', 'Surat Keterangan Domisili')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-file me-2"></i>Buat Surat Keterangan Domisili
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
                    <small class="text-muted">Format: 474/XXX/DOM/BULAN/TAHUN</small>
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
                        <input type="text" class="form-control" id="tanggal_lahir" placeholder="-" readonly>
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

                {{-- LAMA TINGGAL --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Lama Tinggal</label>
                    <input type="text" class="form-control" id="lama_tinggal"
                        placeholder="contoh: 5 tahun, sejak 2019">
                </div>

                {{-- KEPERLUAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Keperluan Surat <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="keperluan_select">
                        <option value="">-- Pilih keperluan --</option>
                        <option value="Pembuatan KTP / KK">Pembuatan KTP / KK</option>
                        <option value="Pendaftaran sekolah">Pendaftaran Sekolah</option>
                        <option value="Keperluan kerja / melamar pekerjaan">Melamar Pekerjaan</option>
                        <option value="Pembuatan rekening bank">Pembuatan Rekening Bank</option>
                        <option value="Keperluan BPJS / asuransi">BPJS / Asuransi</option>
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

                {{-- ACTION BUTTONS --}}
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary flex-fill" id="btnSimpan">
                        <i class="bx bx-save me-1"></i> Simpan Arsip
                    </button>
                    <button type="button" class="btn btn-success flex-fill" id="btnCetak"
                        onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak PDF
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="btnReset" title="Reset form">
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
                    background: white;
                    padding: 40px 50px;
                    min-height: 700px;
                    font-family: 'Times New Roman', serif;
                    font-size: 12pt;
                    color: #000;
                    line-height: 1.6;
                ">

                    {{-- KOP SURAT --}}
                    <div style="display: flex; align-items: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 16px;">
                        <div style="flex-shrink: 0; margin-right: 16px;">
                            @if($config && $config->logo)
                                <img src="{{ asset($config->logo) }}"
                                    alt="Logo" style="width: 80px; height: 80px; object-fit: contain;">
                            @else
                                <div style="width: 80px; height: 80px; border: 2px dashed #ccc;
                                            display: flex; align-items: center; justify-content: center;
                                            color: #aaa; font-size: 10px; text-align: center;">
                                    Logo<br>Kelurahan
                                </div>
                            @endif
                        </div>
                        <div style="flex: 1; text-align: center;">
                            <div style="font-size: 11pt;">PEMERINTAH KOTA {{ strtoupper($config->city ?? 'BANDUNG') }}</div>
                            <div style="font-size: 11pt;">KECAMATAN {{ strtoupper($config->district ?? '-') }}</div>
                            <div style="font-size: 16pt; font-weight: bold; text-transform: uppercase;">
                                {{ $config->name ?? 'KELURAHAN' }}
                            </div>
                            <div style="font-size: 9pt;">
                                @if($config && $config->address){{ $config->address }} &bull; @endif
                                Kode Pos {{ $config->pos_code ?? '' }}@if($config && $config->contact) &bull; Telp/Email: {{ $config->contact }}@endif
                            </div>
                        </div>
                    </div>

                    {{-- JUDUL SURAT --}}
                    <div style="text-align: center; margin: 16px 0 20px;">
                        <div style="font-size: 13pt; font-weight: bold; text-decoration: underline; text-transform: uppercase; letter-spacing: 1px;">
                            Surat Keterangan Domisili
                        </div>
                        <div style="font-size: 11pt; margin-top: 4px;">
                            Nomor: <span id="p-nomor-surat">{{ $nomorSurat }}</span>
                        </div>
                    </div>

                    {{-- PEMBUKA --}}
                    <p style="margin: 0 0 12px 0; text-align: justify;">
                        Yang bertanda tangan di bawah ini, Lurah
                        <b>{{ $config->name ?? 'Kelurahan' }}</b>,
                        Kecamatan <b>{{ $config->district ?? '-' }}</b>,
                        Kota <b>{{ $config->city ?? '-' }}</b>,
                        Provinsi <b>{{ $config->province ?? '-' }}</b>,
                        dengan ini menerangkan bahwa:
                    </p>

                    {{-- DATA WARGA --}}
                    <table style="width: 100%; border-collapse: collapse; margin: 4px 0 16px 0;">
                        <tr>
                            <td style="width: 37%; padding: 2px 0;">Nama Lengkap</td>
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
                        <tr>
                            <td style="padding: 2px 0;">Lama Tinggal</td>
                            <td>:</td>
                            <td><span id="p-lama-tinggal">-</span></td>
                        </tr>
                    </table>

                    {{-- ISI SURAT --}}
                    <p style="margin: 0 0 10px 0; text-align: justify;">
                        Adalah benar bahwa yang bersangkutan <b>berdomisili / bertempat tinggal</b>
                        di wilayah <b>{{ $config->name ?? 'Kelurahan' }}</b>,
                        Kecamatan <b>{{ $config->district ?? '-' }}</b>,
                        Kota <b>{{ $config->city ?? '-' }}</b>.
                    </p>

                    <p style="margin: 0 0 10px 0; text-align: justify;">
                        Surat keterangan ini dibuat untuk keperluan
                        <b><span id="p-keperluan">........................</span></b>
                        dan dapat dipergunakan sebagaimana mestinya.
                    </p>

                    <p style="margin: 0 0 20px 0; text-align: justify;">
                        Demikian surat keterangan ini dibuat dengan sebenar-benarnya.
                    </p>

                    {{-- TTD --}}
                    <div style="display: flex; justify-content: flex-end; margin-top: 24px;">
                        <div style="text-align: center; min-width: 220px;">
                            <div>{{ $config->city ?? 'Bandung' }}, <span id="p-tanggal-surat">{{ now()->isoFormat('D MMMM Y') }}</span></div>
                            <div style="margin-top: 4px;">Lurah {{ $config->name ?? '' }}</div>
                            <br><br><br><br>
                            <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto;"></div>
                            <div style="font-size: 9pt; margin-top: 4px;">NIP. ___________________________</div>
                        </div>
                    </div>

                </div>{{-- end #surat-preview --}}
            </div>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body * { visibility: hidden !important; }

        #surat-preview,
        #surat-preview * { visibility: visible !important; }

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

    #searchResults .search-item {
        padding: 8px 12px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
    }
    #searchResults .search-item:hover { background-color: #f0f7ff; }
    #searchResults .search-item .item-name { font-weight: 600; color: #333; }
    #searchResults .search-item .item-nik { font-size: 11px; color: #888; }

    #surat-preview { border: 1px solid #e0e0e0; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // TANGGAL SURAT DEFAULT
    // =============================================
    const bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni',
                       'Juli','Agustus','September','Oktober','November','Desember'];
    const today     = new Date();
    const tanggalStr = `${today.getDate()} ${bulanIndo[today.getMonth()]} ${today.getFullYear()}`;
    document.getElementById('tanggal_surat').value = tanggalStr;

    // =============================================
    // LIVE PREVIEW NOMOR SURAT
    // =============================================
    document.getElementById('nomor_surat').addEventListener('input', function () {
        document.getElementById('p-nomor-surat').textContent = this.value || '-';
    });

    // =============================================
    // LAMA TINGGAL LIVE PREVIEW
    // =============================================
    document.getElementById('lama_tinggal').addEventListener('input', function () {
        document.getElementById('p-lama-tinggal').textContent = this.value || '-';
    });

    // =============================================
    // KEPERLUAN LIVE PREVIEW
    // =============================================
    document.getElementById('keperluan_select').addEventListener('change', function () {
        const val = this.value;
        const manual = document.getElementById('keperluan_manual');
        if (val === 'lainnya') {
            manual.classList.remove('d-none');
            manual.focus();
        } else {
            manual.classList.add('d-none');
            document.getElementById('p-keperluan').textContent = val || '........................';
        }
    });

    document.getElementById('keperluan_manual').addEventListener('input', function () {
        document.getElementById('p-keperluan').textContent = this.value || '........................';
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

        if (q.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`{{ route('domisili.search_warga') }}?q=${encodeURIComponent(q)}`, {
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
            .catch(() => { searchResults.style.display = 'none'; });
        }, 350);
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    // =============================================
    // FILL WARGA
    // =============================================
    function fillWarga(w) {
        searchResults.style.display = 'none';
        searchInput.value = w.name;

        const setF = (id, val) => { const el = document.getElementById(id); if (el) el.value = val || ''; };
        const setP = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val || '-'; };

        setF('nik', w.nik);
        setF('nama', w.name);
        setF('tempat_lahir', w.birth_place);
        setF('tanggal_lahir', w.birth_date_fmt);
        setF('jenis_kelamin', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setF('agama', w.religious);
        setF('status_nikah', w.married_status);
        setF('pekerjaan', w.occupation);
        setF('alamat', w.address);
        setF('rt', w.rt);
        setF('rw', w.rw);
        setF('no_kk', w.no_kk);

        setP('p-nik', w.nik);
        setP('p-nama', w.name);
        setP('p-ttl', `${w.birth_place}, ${w.birth_date_fmt}`);
        setP('p-jk', w.gender === 'L' ? 'Laki-laki' : 'Perempuan');
        setP('p-agama', w.religious);
        setP('p-status-nikah', w.married_status);
        setP('p-pekerjaan', w.occupation);
        setP('p-alamat', w.address);
        setP('p-rt', w.rt);
        setP('p-rw', w.rw);
        setP('p-no-kk', w.no_kk);
    }

    // =============================================
    // RESET FORM
    // =============================================
    function resetForm() {
        ['nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin',
         'agama','status_nikah','pekerjaan','alamat','rt','rw','no_kk','lama_tinggal']
        .forEach(id => { const el = document.getElementById(id); if (el) el.value = ''; });

        searchInput.value = '';
        document.getElementById('keperluan_select').value = '';
        document.getElementById('keperluan_manual').value = '';
        document.getElementById('keperluan_manual').classList.add('d-none');

        ['p-nik','p-nama','p-ttl','p-jk','p-agama','p-status-nikah',
         'p-pekerjaan','p-alamat','p-rt','p-rw','p-no-kk','p-lama-tinggal']
        .forEach(id => { const el = document.getElementById(id); if (el) el.textContent = '-'; });

        document.getElementById('p-keperluan').textContent = '........................';
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

        const keperluanVal = document.getElementById('keperluan_select').value === 'lainnya'
            ? document.getElementById('keperluan_manual').value
            : document.getElementById('keperluan_select').value;

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
            lama_tinggal:  document.getElementById('lama_tinggal').value,
            tanggal_surat: document.getElementById('tanggal_surat').value,
            keperluan:     keperluanVal,
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
            const res = await fetch('{{ route("domisili.store") }}', {
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
                alert(` ${data.message}\nNomor: ${data.data.nomor_surat}`);
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