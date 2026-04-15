@extends('layouts.app')

@section('title', 'Dashboard Siswa - Pengaduan Sarana Sekolah')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 fw-bold text-white"><i class="bi bi-speedometer2 me-2"></i>Dashboard Siswa</h1>
                <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Baru
                </a>
            </div>
        </div>
    </div>
    
    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-white overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 opacity-75">Total Pengaduan</h6>
                            <h2 class="mb-0 fw-bold">{{ $aspirasi->count() }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $aspirasi->count() > 0 ? 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-white overflow-hidden" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 opacity-75">Menunggu</h6>
                            <h2 class="mb-0 fw-bold">{{ $aspirasi->where('status', 'Menunggu')->count() }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: {{ $aspirasi->count() > 0 ? ($aspirasi->where('status', 'Menunggu')->count() / $aspirasi->count() * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-white overflow-hidden" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 opacity-75">Selesai</h6>
                            <h2 class="mb-0 fw-bold">{{ $aspirasi->where('status', 'Selesai')->count() }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: {{ $aspirasi->count() > 0 ? ($aspirasi->where('status', 'Selesai')->count() / $aspirasi->count() * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- List Pengaduan -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-list-ul me-2"></i>Riwayat Pengaduan Saya</h4>
                </div>
                <div class="card-body">
                    @if($aspirasi->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">#</th>
                                        <th class="fw-bold">Tanggal</th>
                                        <th class="fw-bold">Kategori</th>
                                        <th class="fw-bold">Judul</th>
                                        <th class="fw-bold">Status</th>
                                        <th class="fw-bold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aspirasi as $index => $item)
                                    <tr class="hover-effect">
                                        <td class="fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <small class="text-muted d-block">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</small>
                                            <small class="text-primary">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark px-3 py-2 rounded-pill fw-normal">
                                                {{ $item->kategori->nama_kategori }}
                                            </span>
                                        </td>
                                        <td class="fw-medium">{{ Str::limit($item->judul, 40) }}</td>
                                        <td>
                                            @if($item->status == 'Menunggu')
                                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                                    <i class="bi bi-clock me-1"></i> Menunggu
                                                </span>
                                            @elseif($item->status == 'Diproses')
                                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill fw-bold">
                                                    <i class="bi bi-wrench me-1"></i> Diproses
                                                </span>
                                            @else
                                                <span class="badge bg-success px-3 py-2 rounded-pill fw-bold text-white">
                                                    <i class="bi bi-check-circle me-1"></i> Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-2" 
                                                    data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                                <i class="bi bi-eye me-1"></i> Detail
                                            </button>
                                            
                                            @if($item->status == 'Menunggu')
                                                <form action="{{ route('siswa.aspirasi.destroy', $item->id) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Yakin hapus pengaduan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 py-2 mt-2">
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- ✅ MODAL DIPINDAH KE LUAR TABLE (SOLUSI BERKEDIP) -->
                        @foreach($aspirasi as $item)
                        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title fw-bold" id="detailModalLabel{{ $item->id }}">
                                            <i class="bi bi-file-text me-2"></i>{{ $item->judul }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <h6 class="text-primary fw-bold mb-3 border-bottom pb-2"><i class="bi bi-tag me-2"></i>Informasi Pengaduan</h6>
                                                        <div class="mb-3">
                                                            <label class="fw-bold text-muted small mb-1">Kategori</label>
                                                            <p class="fs-5 fw-bold mb-0">{{ $item->kategori->nama_kategori }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="fw-bold text-muted small mb-1">Status</label>
                                                            <div class="mt-2">
                                                                @if($item->status == 'Menunggu')
                                                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                                                        <i class="bi bi-clock me-1"></i> Menunggu
                                                                    </span>
                                                                @elseif($item->status == 'Diproses')
                                                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill fw-bold">
                                                                        <i class="bi bi-wrench me-1"></i> Diproses
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-success px-3 py-2 rounded-pill fw-bold text-white">
                                                                        <i class="bi bi-check-circle me-1"></i> Selesai
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mb-4">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <h6 class="text-primary fw-bold mb-3 border-bottom pb-2"><i class="bi bi-card-text me-2"></i>Deskripsi Pengaduan</h6>
                                                        <p class="fs-5 mb-0" style="white-space: pre-line;">{{ $item->deskripsi }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @if($item->foto)
                                            <div class="col-12 mb-4">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <h6 class="text-primary fw-bold mb-3 border-bottom pb-2"><i class="bi bi-image me-2"></i>Foto Pendukung</h6>
                                                        <div class="text-center">
                                                            <img src="{{ asset('storage/' . $item->foto) }}" 
                                                                 class="img-fluid rounded shadow" 
                                                                 style="max-height: 400px; object-fit: cover;" 
                                                                 alt="Foto Pengaduan">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="col-12">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                                            <h6 class="text-primary fw-bold mb-0"><i class="bi bi-chat-square-text me-2"></i>Umpan Balik</h6>
                                                            <span class="badge bg-primary">{{ $item->umpanBalik->count() }} komentar</span>
                                                        </div>
                                                        
                                                        @if($item->umpanBalik->count() > 0)
                                                            @foreach($item->umpanBalik as $feedback)
                                                            <div class="alert alert-light border border-2 border-primary rounded-3 mb-3 p-3">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                                            <i class="bi bi-person fs-5"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="d-flex justify-content-between">
                                                                            <strong class="text-primary">{{ $feedback->admin->nama }}</strong>
                                                                            <small class="text-muted">{{ \Carbon\Carbon::parse($feedback->created_at)->format('d/m/Y H:i') }}</small>
                                                                        </div>
                                                                        <p class="mt-2 mb-0">{{ $feedback->komentar }}</p>
                                                                        
                                                                        <!-- Tampilkan foto umpan balik jika ada -->
                                                                        @if($feedback->foto)
                                                                            <div class="mt-3">
                                                                                <div class="card border-0 shadow-sm">
                                                                                    <div class="card-body">
                                                                                        <h6 class="text-muted fw-bold mb-2">Foto Hasil Perbaikan:</h6>
                                                                                        <img src="{{ asset('storage/' . $feedback->foto) }}" 
                                                                                             class="img-fluid rounded shadow" 
                                                                                             style="max-height: 300px; object-fit: cover;" 
                                                                                             alt="Foto Hasil Perbaikan">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                            <div class="text-center py-4 bg-light rounded-3">
                                                                <i class="bi bi-chat-left-text fs-1 text-muted mb-2"></i>
                                                                <p class="text-muted mb-0">Belum ada umpan balik untuk pengaduan ini</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 bg-light rounded-4">
                            <div class="mb-4">
                                <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle" 
                                     style="width: 100px; height: 100px;">
                                    <i class="bi bi-inbox fs-1 text-primary"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-2">Belum Ada Pengaduan</h3>
                            <p class="text-muted mb-4">Silakan buat pengaduan baru untuk melaporkan masalah sarana sekolah</p>
                            <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-plus-circle me-2"></i> Buat Pengaduan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
// ✅ SOLUSI 100% FIX BERKEDIP
document.addEventListener('DOMContentLoaded', function() {
    // Fix flickering dengan mengontrol modal secara manual
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const modalId = this.getAttribute('data-bs-target');
            const modalElement = document.querySelector(modalId);
            
            // Pastikan modal hanya di-load sekali
            if (!modalElement.dataset.initialized) {
                modalElement.dataset.initialized = 'true';
            }
            
            // Tampilkan modal dengan Bootstrap
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        });
    });
    
    // Reset form saat modal ditutup
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            this.querySelectorAll('form').forEach(form => form.reset());
        });
    });
});
</script>
@endsection