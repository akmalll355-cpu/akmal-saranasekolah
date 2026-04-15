@extends('layouts.app')

@section('title', 'Form Pengaduan')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Form Pengaduan Sarana Sekolah</h4>
                </div>
                <div class="card-body">
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="kategori_id" class="form-label fw-bold">Kategori Pengaduan <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold">Judul Pengaduan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul') }}" 
                                   placeholder="Contoh: AC Ruang Kelas Rusak" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-lg @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="6" 
                                      placeholder="Jelaskan secara detail masalah yang dialami..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Berikan deskripsi yang jelas dan detail agar memudahkan proses penanganan</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-bold">Foto Pendukung (Opsional)</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Unggah foto maksimal 2MB (JPEG, PNG, JPG)</small>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Informasi:</strong> Pengaduan Anda akan diproses oleh admin. 
                            Anda dapat melihat status pengaduan di halaman dashboard.
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom px-5">
                                <i class="bi bi-send-check me-2"></i>Kirim Pengaduan
                            </button>
                            <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection