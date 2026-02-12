@extends('layouts.app')

@section('title', 'Dashboard Kepala Lurah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-info" role="alert">
            Selamat datang, <strong>Kepala Lurah</strong>! 
            Anda dapat melihat arsip surat dan laporan warga.
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-soft-primary rounded me-3">
                        <i class="bx bx-file avatar-title fs-24 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Total Arsip Surat</p>
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
                    <div class="avatar-md bg-soft-success rounded me-3">
                        <i class="bx bx-group avatar-title fs-24 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Total Warga</p>
                        <h3 class="text-dark mt-1 mb-0">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection