<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kelas',
        'ruangan',
        'nama_dosen',
        'tanggal'
    ];

    public function detail()
    {
        return $this->hasMany(JadwalDetail::class, 'id_dosen', 'id_dosen');
    }

    // public function getManager()
    // {
    //     return $this->belongsTo(User::class, 'ketua', 'id');
    // }
}
