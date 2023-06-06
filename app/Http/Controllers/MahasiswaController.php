<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Mahasiswa::select("nama_mahasiswa as value", "id")
            ->where('nama_mahasiswa', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return response()->json($mahasiswa);
    }
}
