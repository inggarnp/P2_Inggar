@extends('layouts.app')

@section('title', 'Profil Kelurahan')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-11">

        @if($config)
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    <i class="bx bx-building-house me-2"></i>Profil Kelurahan
                </h4>
                <button type="button" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#saveLurahModal"
                    id="btnEditProfil">
                    <i class="bx bx-edit me-1"></i> Edit Profil
                </button>
            </div>

            <div class="card-body p-4">

                <div id="alertBox" class="d-none mb-4"></div>

                <div class="row align-items-start">

                    {{-- Logo --}}
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        @if($config->logo)
                            <img id="logoDisplay"
                                src="{{ asset($config->logo) }}"
                                alt="Logo Kelurahan"
                                class="rounded border"
                                style="width:180px; height:180px; object-fit:contain; background:#f8f9fa; padding:8px;">
                        @else
                            <div id="logoDisplay"
                                class="rounded border d-flex align-items-center justify-content-center mx-auto"
                                style="width:180px; height:180px; background:#f8f9fa;">
                                <i class="bx bx-image text-muted" style="font-size:4rem;"></i>
                            </div>
                        @endif
                        <p class="text-muted mt-2 mb-0" style="font-size:12px;">Logo Kelurahan</p>
                    </div>

                    {{-- Info --}}
                    <div class="col-md-9">
                        <h3 class="fw-bold mb-1">{{ $config->name }}</h3>
                        <p class="text-muted mb-4">
                            <i class="bx bx-map me-1"></i>
                            Kec. {{ $config->district }}, {{ $config->city }}, {{ $config->province }}
                        </p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="p-3 rounded" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-map-pin me-1"></i>Provinsi
                                    </small>
                                    <span class="fw-semibold">{{ $config->province }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-buildings me-1"></i>Kota/Kabupaten
                                    </small>
                                    <span class="fw-semibold">{{ $config->city }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-map me-1"></i>Kecamatan
                                    </small>
                                    <span class="fw-semibold">{{ $config->district }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-mail-send me-1"></i>Kode Pos
                                    </small>
                                    <span class="fw-semibold">{{ $config->pos_code }}</span>
                                </div>
                            </div>
                            {{-- NEW: Alamat --}}
                            @if($config->address)
                            <div class="col-sm-6">
                                <div class="p-3 rounded" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-home me-1"></i>Alamat Kantor
                                    </small>
                                    <span class="fw-semibold">{{ $config->address }}</span>
                                </div>
                            </div>
                            @endif
                            {{-- NEW: Kontak --}}
                            @if($config->contact)
                            <div class="col-sm-6">
                                <div class="p-3 rounded" style="background:#f8f9fa;">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-phone me-1"></i>Telepon / Email
                                    </small>
                                    <span class="fw-semibold">{{ $config->contact }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bx bx-building-house text-muted" style="font-size:5rem;"></i>
                <h5 class="mt-3 mb-2">Profil Kelurahan Belum Diisi</h5>
                <p class="text-muted mb-4">
                    Silakan isi profil kelurahan terlebih dahulu.
                </p>
                <button type="button" class="btn btn-primary btn-lg"
                    data-bs-toggle="modal" data-bs-target="#saveLurahModal">
                    <i class="bx bx-plus me-1"></i> Isi Profil Sekarang
                </button>
            </div>
        </div>
        @endif

    </div>
</div>

@include('pages.lurah_config.save')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    @if($config)
    document.getElementById('btnEditProfil').addEventListener('click', function () {
        document.getElementById('modal_name').value     = @json($config->name);
        document.getElementById('modal_province').value = @json($config->province);
        document.getElementById('modal_city').value     = @json($config->city);
        document.getElementById('modal_district').value = @json($config->district);
        document.getElementById('modal_pos_code').value = @json($config->pos_code);
        // NEW: populate address & contact
        document.getElementById('modal_address').value  = @json($config->address ?? '');
        document.getElementById('modal_contact').value  = @json($config->contact ?? '');

        const preview = document.getElementById('modalLogoPreview');
        const icon    = document.getElementById('modalLogoIcon');
        @if($config->logo)
            preview.src = '{{ asset($config->logo) }}';
            preview.style.display = 'block';
            icon.style.display    = 'none';
        @else
            preview.style.display = 'none';
            icon.style.display    = 'block';
        @endif

        document.getElementById('modalLogoInput').value = '';
        document.getElementById('saveLurahError').classList.add('d-none');
        document.getElementById('modalTitleText').textContent = 'Edit Profil Kelurahan';
    });
    @else
    document.getElementById('modalTitleText').textContent = 'Isi Profil Kelurahan';
    @endif

    document.getElementById('modalLogoInput').addEventListener('change', function () {
        const file    = this.files[0];
        if (!file) return;
        const reader  = new FileReader();
        const preview = document.getElementById('modalLogoPreview');
        const icon    = document.getElementById('modalLogoIcon');
        reader.onload = e => {
            preview.src           = e.target.result;
            preview.style.display = 'block';
            icon.style.display    = 'none';
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('saveLurahForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn       = document.getElementById('btnSaveLurah');
        const btnText   = document.getElementById('btnSaveLurahText');
        const btnLoader = document.getElementById('btnSaveLurahLoader');
        const errorDiv  = document.getElementById('saveLurahError');

        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoader.classList.remove('d-none');
        errorDiv.classList.add('d-none');

        try {
            const response = await fetch('{{ route("lurah_config.save") }}', {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await response.json();

            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('saveLurahModal')).hide();
                setTimeout(() => window.location.reload(), 300);
            } else {
                errorDiv.textContent = data.message || 'Terjadi kesalahan';
                errorDiv.classList.remove('d-none');
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoader.classList.add('d-none');
            }
        } catch (err) {
            errorDiv.textContent = 'Terjadi kesalahan koneksi.';
            errorDiv.classList.remove('d-none');
            btn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoader.classList.add('d-none');
        }
    });

});
</script>
@endpush