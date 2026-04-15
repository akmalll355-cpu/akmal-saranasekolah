<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nis',
        'username',
        'nama',
        'kelas',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Aspirasi
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'user_id');
    }

    // Relasi ke Umpan Balik (sebagai admin)
    public function umpanBalik()
    {
        return $this->hasMany(UmpanBalik::class, 'admin_id');
    }

    // Cek apakah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Cek apakah siswa
    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
}