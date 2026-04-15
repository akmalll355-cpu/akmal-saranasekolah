<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\UmpanBalik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    // Halaman Form Aspirasi
    public function create()
    {
        $kategori = Kategori::all();
        return view('siswa.form_aspirasi', compact('kategori'));
    }

    // Simpan Aspirasi
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'siswa_id' => Auth::guard('siswa')->id(),
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Menunggu',
        ];

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $filePath = $request->file('foto')->storeAs('aspirasi', $fileName, 'public');
            $data['foto'] = $filePath;
        }

        Aspirasi::create($data);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Pengaduan berhasil dikirim! Tunggu konfirmasi dari admin.');
    }

    // Update Status (Admin)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    // Berikan Umpan Balik (Admin) - ✅ DIPERBAIKI DENGAN FOTO
    public function beriUmpanBalik(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // ✅ VALIDASI FOTO
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        
        // Simpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fileName = 'feedback_' . time() . '_' . $request->file('foto')->getClientOriginalName();
            $fotoPath = $request->file('foto')->storeAs('umpan_balik', $fileName, 'public');
        }

        UmpanBalik::create([
            'aspirasi_id' => $aspirasi->id,
            'admin_id' => Auth::guard('admin')->id(),
            'komentar' => $request->komentar,
            'foto' => $fotoPath, // ✅ SIMPAN PATH FOTO
        ]);

        return back()->with('success', 'Umpan balik berhasil dikirim dengan foto!');
    }

    // Hapus Aspirasi
    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        // Hapus foto jika ada
        if ($aspirasi->foto) {
            Storage::disk('public')->delete($aspirasi->foto);
        }

        $aspirasi->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus!');
    }
}