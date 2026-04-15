<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ============ SISWA ============
    
    // Halaman Registrasi Siswa
    public function showRegisterSiswa()
    {
        return view('auth.register_siswa');
    }
    
    // Proses Registrasi Siswa
    public function registerSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:siswa,nis',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
            'email' => 'nullable|email|unique:siswa,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nis.unique' => 'NIS sudah terdaftar!',
            'email.unique' => 'Email sudah digunakan!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);
        
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('siswa.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
    
    // ============ ADMIN ============
    
    // Halaman Manajemen Admin
    public function manajemenAdmin()
    {
        $admin = Admin::all();
        return view('admin.manajemen_admin', compact('admin'));
    }
    
    // Tambah Admin Baru
    public function tambahAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:4|unique:admin,username',
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|unique:admin,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan!',
            'email.unique' => 'Email sudah digunakan!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);
        
        Admin::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return back()->with('success', 'Admin berhasil ditambahkan!');
    }
    
    // Hapus Admin
    public function hapusAdmin($id)
    {
        // Cek apakah admin yang mau dihapus adalah diri sendiri
        if ($id == Auth::guard('admin')->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }
        
        $admin = Admin::findOrFail($id);
        $admin->delete();
        
        return back()->with('success', 'Admin berhasil dihapus!');
    }
}