@extends('layouts.app')

@section('title', 'Arsip Surat')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-archive me-2"></i>Arsip Surat
                </h4>
                {{-- Dropdown buat surat baru --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">
                        <i class="bx bx-plus me-1"></i> Buat Surat Baru
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('sktm.index') }}">
                                <i class="bx bx-file me-2 text-primary"></i>SKTM
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('domisili.index') }}">
                                <i class="bx bx-home me-2 text-success"></i>Surat Keterangan Domisili
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('akte_kematian.index') }}">
                                <i class="bx bx-x-circle me-2 text-danger"></i>Akte Kematian
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('ahli_waris.index') }}">
                                <i class="bx bx-group me-2 text-warning"></i>Surat Ahli Waris
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('pindah_keluar.index') }}">
                                <i class="bx bx-transfer me-2 text-info"></i>Surat Pindah Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- FILTER BAR --}}
            <div class="card-body border-bottom pb-3">
                <div class="row g-2 align-items-end">
                    {{-- Search nama/NIK --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold mb-1" style="font-size:12px;">
                            <i class="bx bx-search me-1"></i>Cari Nama / NIK / Nomor Surat
                        </label>
                        <input type="text" class="form-control form-control-sm" id="filterSearch"
                            placeholder="Ketik untuk mencari...">
                    </div>

                    {{-- Filter jenis surat --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold mb-1" style="font-size:12px;">
                            <i class="bx bx-filter me-1"></i>Jenis Surat
                        </label>
                        <select class="form-select form-select-sm" id="filterJenis">
                            <option value="">Semua Jenis</option>
                            <option value="SKTM">SKTM</option>
                            <option value="DOMISILI">Surat Keterangan Domisili</option>
                            <option value="AKTE_KEMATIAN">Akte Kematian</option>
                            <option value="AHLI_WARIS">Surat Ahli Waris</option>
                            <option value="PINDAH_KELUAR">Surat Pindah Keluar</option>
                        </select>
                    </div>

                    {{-- Filter bulan --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold mb-1" style="font-size:12px;">
                            <i class="bx bx-calendar me-1"></i>Bulan
                        </label>
                        <select class="form-select form-select-sm" id="filterBulan">
                            <option value="">Semua Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    {{-- Filter tahun --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold mb-1" style="font-size:12px;">Tahun</label>
                        <select class="form-select form-select-sm" id="filterTahun">
                            <option value="">Semua Tahun</option>
                            @for($y = now()->year; $y >= now()->year - 5; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Reset filter --}}
                    <div class="col-md-1">
                        <button class="btn btn-outline-secondary btn-sm w-100" id="btnResetFilter"
                            title="Reset filter">
                            <i class="bx bx-reset"></i>
                        </button>
                    </div>
                </div>

                {{-- Info jumlah hasil --}}
                <div class="mt-2">
                    <small class="text-muted">
                        Menampilkan <span id="jumlahTampil" class="fw-semibold text-dark">{{ count($logs) }}</span>
                        dari <span class="fw-semibold">{{ count($logs) }}</span> arsip
                    </small>
                </div>
            </div>

            {{-- TABEL --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tabelArsip">
                        <thead class="table-light">
                            <tr>
                                <th style="width:50px;">#</th>
                                <th>Nomor Surat</th>
                                <th>Jenis Surat</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Tanggal Dibuat</th>
                                <th style="width:80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelBody">
                            @forelse($logs as $i => $log)
                            @php
                                // Ahli Waris pakai nama_almarhum & nik_almarhum, surat lain pakai nama & nik
                                $displayNama = $log->detail['nama'] ?? $log->detail['nama_almarhum'] ?? '-';
                                $displayNik  = $log->detail['nik']  ?? $log->detail['nik_almarhum']  ?? '-';
                            @endphp
                            <tr class="arsip-row"
                                data-jenis="{{ $log->doc_type }}"
                                data-nama="{{ strtolower($displayNama) }}"
                                data-nik="{{ $displayNik }}"
                                data-nomor="{{ strtolower($log->detail['nomor_surat'] ?? '') }}"
                                data-bulan="{{ $log->created_at?->format('m') }}"
                                data-tahun="{{ $log->created_at?->format('Y') }}">
                                <td class="row-num">{{ $i + 1 }}</td>
                                <td>
                                    <code style="font-size:11px;">
                                        {{ $log->detail['nomor_surat'] ?? '-' }}
                                    </code>
                                </td>
                                <td>
                                    @php
                                        $badges = [
                                            'SKTM'         => ['bg-primary',   'Tidak Mampu'],
                                            'DOMISILI'     => ['bg-success',   'Domisili'],
                                            'AKTE_KEMATIAN'=> ['bg-danger',    'Akte Kematian'],
                                            'AHLI_WARIS'   => ['bg-warning text-dark', 'Ahli Waris'],
                                            'PINDAH_KELUAR'=> ['bg-info text-dark',    'Pindah Keluar'],
                                        ];
                                        $badge = $badges[$log->doc_type] ?? ['bg-secondary', $log->doc_type];
                                    @endphp
                                    <span class="badge {{ $badge[0] }}">{{ $badge[1] }}</span>
                                </td>
                                <td>{{ $displayNama }}</td>
                                <td style="font-size:12px;">{{ $displayNik }}</td>
                                <td style="font-size:12px;">
                                    {{ $log->created_at?->format('d M Y, H:i') }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"
                                        onclick='lihatDetail({{ json_encode($log->detail) }}, "{{ $log->doc_type }}")'
                                        title="Lihat detail">
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bx bx-folder-open" style="font-size:3rem;"></i>
                                    <div class="mt-2">Belum ada arsip surat</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Empty state saat filter tidak ketemu --}}
                    <div id="emptyFilter" class="text-center text-muted py-5 d-none">
                        <i class="bx bx-search-alt" style="font-size:3rem;"></i>
                        <div class="mt-2">Tidak ada arsip yang sesuai filter</div>
                        <button class="btn btn-sm btn-outline-secondary mt-2" id="btnResetFilter2">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ============================================================
     MODAL DETAIL
============================================================ --}}
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalTitle">
                    <i class="bx bx-file me-2"></i>Detail Surat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// =============================================
// KONFIGURASI FIELD PER JENIS SURAT
// =============================================
const suratConfig = {
    SKTM: {
        label: 'Surat Keterangan Tidak Mampu',
        sections: [
            {
                title: 'Data Surat',
                fields: [
                    ['Nomor Surat', 'nomor_surat'],
                    ['Tanggal Surat', 'tanggal_surat'],
                ]
            },
            {
                title: 'Data Pemohon',
                fields: [
                    ['Nama', 'nama'], ['NIK', 'nik'], ['No. KK', 'no_kk'],
                    ['Tempat / Tgl Lahir', null, d => `${d.tempat_lahir}, ${d.tanggal_lahir}`],
                    ['Jenis Kelamin', 'jenis_kelamin'], ['Agama', 'agama'],
                    ['Status Nikah', 'status_nikah'], ['Pekerjaan', 'pekerjaan'],
                    ['Alamat', 'alamat'],
                    ['RT / RW', null, d => `RT ${d.rt} / RW ${d.rw}`],
                ]
            },
            {
                title: 'Keperluan',
                fields: [['Keperluan', 'keperluan']]
            }
        ]
    },
    DOMISILI: {
        label: 'Surat Keterangan Domisili',
        sections: [
            {
                title: 'Data Surat',
                fields: [
                    ['Nomor Surat', 'nomor_surat'],
                    ['Tanggal Surat', 'tanggal_surat'],
                ]
            },
            {
                title: 'Data Pemohon',
                fields: [
                    ['Nama', 'nama'], ['NIK', 'nik'], ['No. KK', 'no_kk'],
                    ['Tempat / Tgl Lahir', null, d => `${d.tempat_lahir}, ${d.tanggal_lahir}`],
                    ['Jenis Kelamin', 'jenis_kelamin'], ['Agama', 'agama'],
                    ['Status Nikah', 'status_nikah'], ['Pekerjaan', 'pekerjaan'],
                    ['Alamat', 'alamat'],
                    ['RT / RW', null, d => `RT ${d.rt} / RW ${d.rw}`],
                    ['Lama Tinggal', 'lama_tinggal'],
                ]
            },
            {
                title: 'Keperluan',
                fields: [['Keperluan', 'keperluan']]
            }
        ]
    },
    AKTE_KEMATIAN: {
        label: 'Surat Keterangan Kematian',
        sections: [
            {
                title: 'Data Surat',
                fields: [
                    ['Nomor Surat', 'nomor_surat'],
                    ['Tanggal Surat', 'tanggal_surat'],
                ]
            },
            {
                title: 'Data Almarhum / Almarhumah',
                fields: [
                    ['Nama', 'nama'], ['NIK', 'nik'], ['No. KK', 'no_kk'],
                    ['Tempat / Tgl Lahir', null, d => `${d.tempat_lahir}, ${d.tanggal_lahir}`],
                    ['Jenis Kelamin', 'jenis_kelamin'], ['Umur', null, d => `${d.umur} tahun`],
                    ['Agama', 'agama'], ['Pekerjaan', 'pekerjaan'],
                    ['Alamat', 'alamat'],
                    ['RT / RW', null, d => `RT ${d.rt} / RW ${d.rw}`],
                ]
            },
            {
                title: 'Keterangan Kematian',
                fields: [
                    ['Tanggal Meninggal', 'tanggal_meninggal'],
                    ['Tempat Meninggal', 'tempat_meninggal'],
                    ['Sebab Meninggal', 'sebab_meninggal'],
                ]
            },
            {
                title: 'Data Pelapor',
                fields: [
                    ['Nama Pelapor', 'nama_pelapor'],
                    ['NIK Pelapor', 'nik_pelapor'],
                    ['Hubungan dengan Almarhum', 'hubungan_pelapor'],
                ]
            }
        ]
    },
    AHLI_WARIS: {
        label: 'Surat Ahli Waris',
        sections: [
            {
                title: 'Data Surat',
                fields: [
                    ['Nomor Surat', 'nomor_surat'],
                    ['Tanggal Surat', 'tanggal_surat'],
                ]
            },
            {
                title: 'Data Almarhum',
                fields: [
                    ['Nama Almarhum', 'nama_almarhum'],
                    ['NIK', 'nik_almarhum'],
                ]
            },
            {
                title: 'Daftar Ahli Waris',
                custom: d => {
                    if (!d.ahli_waris || !d.ahli_waris.length) return '<p class="text-muted">Tidak ada data</p>';
                    let html = '<table class="table table-sm table-bordered"><thead><tr><th>#</th><th>Nama</th><th>NIK</th><th>Hubungan</th></tr></thead><tbody>';
                    d.ahli_waris.forEach((w, i) => {
                        html += `<tr><td>${i+1}</td><td>${w.nama}</td><td>${w.nik}</td><td>${w.hubungan}</td></tr>`;
                    });
                    html += '</tbody></table>';
                    return html;
                }
            }
        ]
    },
    PINDAH_KELUAR: {
        label: 'Surat Pindah Keluar',
        sections: [
            {
                title: 'Data Surat',
                fields: [
                    ['Nomor Surat', 'nomor_surat'],
                    ['Tanggal Surat', 'tanggal_surat'],
                ]
            },
            {
                title: 'Data Pemohon',
                fields: [
                    ['Nama', 'nama'], ['NIK', 'nik'],
                    ['Alamat Asal', 'alamat_asal'],
                    ['Alamat Tujuan', 'alamat_tujuan'],
                    ['Alasan Pindah', 'alasan'],
                ]
            }
        ]
    },
};

// =============================================
// TAMPILKAN MODAL DETAIL
// =============================================
function lihatDetail(detail, docType) {
    const config = suratConfig[docType] || { label: docType, sections: [] };

    document.getElementById('detailModalTitle').innerHTML =
        `<i class="bx bx-file me-2"></i>${config.label}`;

    let html = '';
    config.sections.forEach(section => {
        html += `<p class="fw-bold text-uppercase small text-muted mb-1 mt-3
                    border-bottom pb-1">${section.title}</p>`;

        if (section.custom) {
            html += section.custom(detail);
        } else {
            html += '<table class="table table-sm table-bordered mb-0">';
            section.fields.forEach(([label, key, fn]) => {
                const val = fn ? fn(detail) : (detail[key] || '-');
                html += `<tr>
                    <td class="fw-semibold bg-light" style="width:40%">${label}</td>
                    <td>${val}</td>
                </tr>`;
            });
            html += '</table>';
        }
    });

    document.getElementById('detailContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('detailModal')).show();
}

// =============================================
// FILTER LOGIC
// =============================================
const rows        = document.querySelectorAll('.arsip-row');
const emptyFilter = document.getElementById('emptyFilter');
const jumlahEl    = document.getElementById('jumlahTampil');

function applyFilter() {
    const search = document.getElementById('filterSearch').value.toLowerCase().trim();
    const jenis  = document.getElementById('filterJenis').value;
    const bulan  = document.getElementById('filterBulan').value;
    const tahun  = document.getElementById('filterTahun').value;

    let tampil = 0;
    let nomor  = 1;

    rows.forEach(row => {
        const matchSearch = !search
            || row.dataset.nama.includes(search)
            || row.dataset.nik.includes(search)
            || row.dataset.nomor.includes(search);

        const matchJenis = !jenis || row.dataset.jenis === jenis;
        const matchBulan = !bulan || row.dataset.bulan === bulan;
        const matchTahun = !tahun || row.dataset.tahun === tahun;

        const visible = matchSearch && matchJenis && matchBulan && matchTahun;
        row.style.display = visible ? '' : 'none';

        if (visible) {
            row.querySelector('.row-num').textContent = nomor++;
            tampil++;
        }
    });

    jumlahEl.textContent = tampil;
    emptyFilter.classList.toggle('d-none', tampil > 0 || rows.length === 0);
}

// Bind semua filter
['filterSearch','filterJenis','filterBulan','filterTahun'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', applyFilter);
    document.getElementById(id)?.addEventListener('change', applyFilter);
});

// Reset filter
function resetFilter() {
    document.getElementById('filterSearch').value = '';
    document.getElementById('filterJenis').value  = '';
    document.getElementById('filterBulan').value  = '';
    document.getElementById('filterTahun').value  = '';
    applyFilter();
}

document.getElementById('btnResetFilter')?.addEventListener('click', resetFilter);
document.getElementById('btnResetFilter2')?.addEventListener('click', resetFilter);

// Cek URL param untuk filter awal (misal ?jenis=SKTM)
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('jenis')) {
    document.getElementById('filterJenis').value = urlParams.get('jenis');
    applyFilter();
}
</script>
@endpush