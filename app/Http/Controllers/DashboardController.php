<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Halaman Utama
    public function index()
    {
        return view('welcome');
    }

    // Dashboard Siswa
    public function siswaDashboard()
    {
        $siswa = Auth::guard('siswa')->user();
        $aspirasi = $siswa->aspirasi()
            ->with(['kategori', 'umpanBalik.admin'])
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('aspirasi'));
    }

    // Dashboard Admin - ✅ FIX: DATA LOADING
    public function adminDashboard(Request $request)
    {
        // Ambil data dasar
        $aspirasi = Aspirasi::with(['siswa', 'kategori', 'umpanBalik.admin'])
            ->latest()
            ->get();
        
        // Filter tanggal
        if ($request->filled('tanggal')) {
            $aspirasi = $aspirasi->filter(function ($item) use ($request) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') == $request->tanggal;
            });
        }
        
        // Filter bulan
        if ($request->filled('bulan')) {
            $aspirasi = $aspirasi->filter(function ($item) use ($request) {
                return \Carbon\Carbon::parse($item->created_at)->format('m') == $request->bulan;
            });
        }
        
        // Filter siswa
        if ($request->filled('siswa_id')) {
            $aspirasi = $aspirasi->filter(function ($item) use ($request) {
                return $item->siswa_id == $request->siswa_id;
            });
        }
        
        // Filter kategori
        if ($request->filled('kategori_id')) {
            $aspirasi = $aspirasi->filter(function ($item) use ($request) {
                return $item->kategori_id == $request->kategori_id;
            });
        }
        
        // Filter status
        if ($request->filled('status')) {
            $aspirasi = $aspirasi->filter(function ($item) use ($request) {
                return $item->status == $request->status;
            });
        }
        
        $siswaList = Siswa::all();
        $kategoriList = Kategori::all();

        return view('admin.dashboard', compact('aspirasi', 'siswaList', 'kategoriList'));
    }
}