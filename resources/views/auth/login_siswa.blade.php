@extends('layouts.app')

@section('title', 'Login Siswa')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle" style="font-size: 4rem; color: #667eea;"></i>
                        <h3 class="mt-3 fw-bold">Login Siswa</h3>
                        <p class="text-muted">Masuk untuk menyampaikan pengaduan</p>
                    </div>
                    
                    <form action="{{ route('siswa.login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nis" class="form-label fw-bold">NIS</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-qr-code"></i></span>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" 
                                       id="nis" name="nis" value="{{ old('nis') }}" placeholder="Masukkan NIS Anda" required>
                            </div>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Masukkan Password" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login Sekarang
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection