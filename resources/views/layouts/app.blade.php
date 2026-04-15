<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi Pengaduan Sarana Sekolah">
    <meta name="author" content="Junior Assistant Programmer">
    <title>@yield('title', 'Pengaduan Sarana Sekolah')</title>
    
    <!-- Bootstrap 5 CSS (HILANGKAN SPASI DI URL!) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --light-color: #f8f9fa;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 56px; /* Sesuaikan dengan tinggi navbar */
        }
        
        /* FIX: Navbar positioning */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }
        
        .navbar-custom .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .navbar-custom .nav-link:hover {
            color: #667eea !important;
        }
        
        .navbar-custom .dropdown-item {
            color: #333;
        }
        
        .navbar-custom .dropdown-item:hover {
            background-color: #f0f0f0;
        }
        
        .card-custom {
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }
        
        .status-menunggu {
            background-color: #ffc107;
            color: #000;
        }
        
        .status-diproses {
            background-color: #17a2b8;
            color: #fff;
        }
        
        .status-selesai {
            background-color: #28a745;
            color: #fff;
        }
        
        .sidebar {
            background: rgba(255, 255, 255, 0.9);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 56px;
            width: 250px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            color: #555;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            background-color: #f0f0f0;
            color: #667eea;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: #667eea;
            color: white !important;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }
        
        .sidebar-header {
            border-bottom: 3px solid #667eea;
        }
        
        .content-area {
            margin-left: 250px;
            padding: 20px;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                top: 0;
                height: auto;
            }
            
            .content-area {
                margin-left: 0;
            }
            
            body {
                margin-top: 56px;
            }
        }
        
        .hero-section {
            text-align: center;
            padding: 80px 20px;
            color: white;
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero-section p {
            font-size: 1.3rem;
            margin-bottom: 40px;
        }
        
        .stats-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            color: white;
        }
        
        .stats-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .stats-card .number {
            font-size: 2rem;
            font-weight: 700;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateX(5px);
            transition: all 0.2s ease;
        }
        
        /* ✅ Tambahkan hover effect untuk rows */
        .hover-effect:hover {
            background-color: #f8f9ff !important;
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .modal-content {
            border-radius: 16px !important;
            border: none;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 16px 16px 0 0 !important;
        }
        
        /* ✅ Gradient backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        }
        
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        }
    </style>
</head>
<body>
    @include('layouts.navbar')
    
    <div class="container-fluid mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Bootstrap JS (HILANGKAN SPASI DI URL!) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>