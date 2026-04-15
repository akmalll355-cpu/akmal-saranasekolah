<nav class="sidebar d-md-block bg-light sidebar-dark">
    <div class="position-sticky">
        <div class="sidebar-header p-4 bg-primary text-white text-center">
            <h5 class="mb-0 fw-bold">
                @if(request()->routeIs('siswa.*'))
                    <i class="bi bi-person-circle me-2"></i>Siswa Panel
                @elseif(request()->routeIs('admin.*'))
                    <i class="bi bi-shield-lock me-2"></i>Admin Panel
                @endif
            </h5>
        </div>
        
        <ul class="nav flex-column p-3">
            @if(request()->routeIs('siswa.*'))
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active bg-primary text-white' : '' }}" 
                       href="{{ route('siswa.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('siswa.aspirasi.create') ? 'active bg-primary text-white' : '' }}" 
                       href="{{ route('siswa.aspirasi.create') }}">
                        <i class="bi bi-file-earmark-plus me-2"></i>Buat Pengaduan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('siswa.dashboard') }}">
                        <i class="bi bi-clock-history me-2"></i>Riwayat Pengaduan
                    </a>
                </li>
            @elseif(request()->routeIs('admin.*'))
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}?status=Menunggu">
                        <i class="bi bi-hourglass-split me-2"></i>Pengaduan Menunggu
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}?status=Diproses">
                        <i class="bi bi-wrench me-2"></i>Pengaduan Diproses
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}?status=Selesai">
                        <i class="bi bi-check-circle me-2"></i>Pengaduan Selesai
                    </a>
                </li>
                
                <!-- ✅ TAMBAHKAN INI DIBAWAH (SUDAH DIPASTIKAN TIDAK BERGANGGUAN) -->
                <li class="nav-item mb-2 mt-3">
                    <hr class="my-2 border-primary">
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.manajemen-admin') }}">
                        <i class="bi bi-shield-lock me-2"></i>Manajemen Admin
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.manajemen-siswa') }}">
                        <i class="bi bi-people me-2"></i>Manajemen Siswa
                    </a>
                </li>
            @endif
        </ul>
        
        <div class="p-3 mt-3 border-top">
            <small class="text-muted">Sistem Pengaduan Sarana Sekolah</small><br>
            <small class="text-muted">&copy; {{ date('Y') }} - All Rights Reserved</small>
        </div>
    </div>
</nav>