@extends('layouts.app')

@section('title', 'Dashboard Staff Pelayanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-success" role="alert">
            Selamat datang, <strong>Staff Pelayanan Umum</strong>! 
            Anda dapat melayani pembuatan surat untuk warga.
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-soft-primary rounded me-3">
                        <i class="bx bx-file-plus avatar-title fs-24 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Surat Dibuat Hari Ini</p>
                        <h3 class="text-dark mt-1 mb-0">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-soft-info rounded me-3">
                        <i class="bx bx-user-check avatar-title fs-24 text-info"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Warga Dilayani</p>
                        <h3 class="text-dark mt-1 mb-0">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection