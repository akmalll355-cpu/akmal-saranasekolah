<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';

    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'foto',
        'status',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke Umpan Balik
    public function umpanBalik()
    {
        return $this->hasMany(UmpanBalik::class, 'aspirasi_id');
    }
}