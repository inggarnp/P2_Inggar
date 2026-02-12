@extends('layouts.app')

@section('title', 'Dashboard Sekretaris Lurah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            Selamat datang, <strong>Sekretaris Lurah</strong>! 
            Anda dapat mengelola surat dan data warga.
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-soft-warning rounded me-3">
                        <i class="bx bx-edit avatar-title fs-24 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Surat Diproses</p>
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