@extends('layouts.app')

@section('title', 'Pengaduan Sarana Sekolah')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1>Pengaduan Sarana Sekolah</h1>
        <p class="lead">Sampaikan aspirasi dan pengaduan sarana sekolah dengan mudah dan cepat</p>
        
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('siswa.login') }}" class="btn btn-primary-custom btn-lg px-5">
                <i class="bi bi-person-circle me-2"></i>Login Siswa
            </a>
            <a href="{{ route('admin.login') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-shield-lock me-2"></i>Login Admin
            </a>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2 class="text-white fw-bold">Kenapa Menggunakan Aplikasi Ini?</h2>
            <p class="text-white-50">Solusi cepat untuk pengaduan sarana sekolah</p>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="stats-card">
                <i class="bi bi-chat-square-text"></i>
                <h4>Mudah Digunakan</h4>
                <p>Interface yang user-friendly dan mudah dipahami</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <i class="bi bi-lightning"></i>
                <h4>Cepat & Efisien</h4>
                <p>Proses pengaduan yang cepat tanpa ribet</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <i class="bi bi-check-circle"></i>
                <h4>Termonitor</h4>
                <p>Status pengaduan dapat dipantau secara real-time</p>
            </div>
        </div>
    </div>
</div>
@endsection