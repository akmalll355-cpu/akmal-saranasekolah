<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ... kode sebelumnya ...

    // ✅ HALAMAN BUAT AKUN SISWA
    public function createSiswa()
    {
        return view('admin.siswa.create');
    }

    // ✅ PROSES SIMPAN AKUN SISWA
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswa,nis',
            'kelas' => 'required|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.siswa.list')
            ->with('success', 'Akun siswa berhasil dibuat!');
    }

    // ✅ DAFTAR SEMUA SISWA
    public function listSiswa()
    {
        $siswaList = Siswa::all();
        return view('admin.siswa.list', compact('siswaList'));
    }
    
}