<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';
    protected $guard = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'siswa_id');
    }
}