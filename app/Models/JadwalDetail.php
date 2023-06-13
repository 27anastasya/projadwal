<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_dosen',
        'id_mahasiswa',
        'mata_kuliah',
        'jumlah_sks'
    ];

    public function getMahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
