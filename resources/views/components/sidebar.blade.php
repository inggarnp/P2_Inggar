@php
$jabatan = session('user') ? session('user')->jabatan->slug : null;

$dashboardRoute = match($jabatan) {
'administrator' => route('dashboard.admin'),
'kepala_lurah' => route('dashboard.lurah'),
'sekre_lurah' => route('dashboard.sekre'),
'staff_pelayanan' => route('dashboard.staff'),
default => route('login')
};
@endphp

<!-- ========== App Menu Start ========== -->
<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="{{ $dashboardRoute }}" class="logo-dark">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="logo-lg" alt="logo dark">
        </a>
        <a href="{{ $dashboardRoute }}" class="logo-light">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
            <img src="{{ asset('assets/images/logo-light.png') }}" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">General</li>

            {{-- ==================== DASHBOARD ==================== --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ $dashboardRoute }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>

            {{-- ==================== ADMIN ONLY ==================== --}}
            @if($jabatan === 'administrator')

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Manajemen Users </span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('users.index') }}">Users</a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif

            {{-- ==================== ADMIN & SEKRE ==================== --}}
            @if(in_array($jabatan, ['administrator', 'sekre_lurah']))

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarSurat" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSurat">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Kelola Surat </span>
                </a>
                <div class="collapse" id="sidebarSurat">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">List Surat</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Buat Surat</a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif

            {{-- ==================== ADMIN, SEKRE & KEPALA LURAH ==================== --}}
            @if(in_array($jabatan, ['administrator', 'sekre_lurah', 'kepala_lurah']))

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarArsip" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarArsip">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:folder-with-files-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Arsip Surat </span>
                </a>
                <div class="collapse" id="sidebarArsip">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Lihat Arsip</a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif

            {{-- ==================== ADMIN, SEKRE & STAFF PELAYANAN ==================== --}}
            @if(in_array($jabatan, ['administrator', 'sekre_lurah', 'staff_pelayanan']))

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarWarga" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarWarga">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:users-group-rounded-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Manajamen Warga </span>
                </a>
                <div class="collapse" id="sidebarWarga">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('rukun.index') }}"> Rukun </a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('rukun.index') }}"> Keluarga </a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">List Warga</a>
                        </li>
                        @if(in_array($jabatan, ['administrator', 'sekre_lurah']))
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Tambah Warga</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Import Warga</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>

            @endif

            {{-- ==================== STAFF PELAYANAN ==================== --}}
            @if($jabatan === 'staff_pelayanan')

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:file-add-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Buat Surat </span>
                </a>
            </li>

            @endif

            {{-- ==================== SEMUA ROLE ==================== --}}
            <li class="menu-title mt-2">Other</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('lamaran') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Form Lamaran Kerja </span>
                </a>
            </li>

            <li class="menu-title mt-2">Support</li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:help-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Help Center </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:question-circle-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> FAQs </span>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- ========== App Menu End ========== -->