<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('admin123')
        ]);

        Admin::create([
            'username' => 'admin2',
            'nama' => 'Admin Dua',
            'email' => 'admin2@sekolah.com',
            'password' => Hash::make('admin123')
        ]);

        Siswa::create([
            'nis' => '1234567890',
            'nama' => 'Siswa Satu',
            'kelas' => 'XII RPL 1',
            'email' => 'siswa1@sekolah.com',
            'password' => Hash::make('siswa123')
        ]);

        Siswa::create([
            'nis' => '0987654321',
            'nama' => 'Siswa Dua',
            'kelas' => 'XII RPL 2',
            'email' => 'siswa2@sekolah.com',
            'password' => Hash::make('siswa123')
        ]);

        $kategori = [
            'Fasilitas Ruang Kelas',
            'Toilet/WC',
            'Perpustakaan',
            'Lab Komputer',
            'Lapangan Olahraga'
        ];

        foreach ($kategori as $item) {
            Kategori::create(['nama_kategori' => $item]);
        }
    }
}