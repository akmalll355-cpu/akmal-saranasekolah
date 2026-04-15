<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-building me-2"></i>Pengaduan Sarana Sekolah
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if(!Auth::guard('siswa')->check() && !Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('siswa.login') }}">
                            <i class="bi bi-person-circle me-1"></i>Login Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.login') }}">
                            <i class="bi bi-shield-lock me-1"></i>Login Admin
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::guard('siswa')->check())
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::guard('siswa')->user()->nama }}
                            @elseif(Auth::guard('admin')->check())
                                <i class="bi bi-shield-lock me-1"></i>{{ Auth::guard('admin')->user()->nama }}
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::guard('siswa')->check())
                                <li><a class="dropdown-item" href="{{ route('siswa.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a></li>
                            @elseif(Auth::guard('admin')->check())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger p-0 w-100 text-start">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>