<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/siswa/login', [AuthController::class, 'showLoginSiswa'])->name('siswa.login');
Route::post('/siswa/login', [AuthController::class, 'loginSiswa'])->name('siswa.login.post');

Route::get('/admin/login', [AuthController::class, 'showLoginAdmin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ PERBAIKAN: Ganti ['auth' => 'siswa'] menjadi 'auth:siswa'
Route::middleware('auth:siswa')->group(function () {
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswaDashboard'])->name('siswa.dashboard');
    Route::get('/siswa/aspirasi/create', [AspirasiController::class, 'create'])->name('siswa.aspirasi.create');
    Route::post('/siswa/aspirasi', [AspirasiController::class, 'store'])->name('siswa.aspirasi.store');

    Route::delete('/siswa/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('siswa.aspirasi.destroy');
});

// ✅ PERBAIKAN: Ganti ['auth' => 'admin'] menjadi 'auth:admin'
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::post('/admin/aspirasi/{id}/status', [AspirasiController::class, 'updateStatus'])->name('admin.update.status');
    Route::post('/admin/aspirasi/{id}/umpan-balik', [AspirasiController::class, 'beriUmpanBalik'])->name('admin.umpan-balik');
});
