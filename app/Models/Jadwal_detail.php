<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_dosen',
        'id_mahasiswa',
        'mata_kuliah',
        'ruangan',
        'hari'
    ];

    public function getMahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
