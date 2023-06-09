<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $title = "Data Penempatan Jadwal";
        $jadwals = Jadwal::orderBy('id', 'asc')->paginate(5);
        return view('jadwals.index', compact(['jadwals', 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Jadwal";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        return view('jadwals.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
        ]);

        $jadwal = [
            'nama_kelas' => $request->nama_kelas,
            'ruangan' => $request->ruangan,
            'nama_dosen' => $request->nama_dosen,
            'tanggal' => $request->tanggal,
        ];
        if ($result = Jadwal::create($jadwal)) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'id_dosen' => $request->id_dosen,
                    'id_mahasiswa' => $request['id_mahasiswa' . $i],
                    'mata_kuliah' => $request['mata_kuliah' . $i],
                    'ruangan' => $request['ruangan' . $i],
                    'hari' => $request['hari' . $i],
                ];
                Jadwal::create($request->post());
            }
        }
        return redirect()->route('jadwals.index')->with('success', 'Jadwal has been created successfully.');
    }

    public function show(Jadwal $jadwal)
    {
        return view('jadwals.show', compact('Departement'));
    }

    public function edit(Jadwal $jadwal)
    {
        $title = "Edit Data Jadwal";
        $jadwal = Jadwal::where('position', '1')->orderBy('id', 'asc')->get();
        return view('jadwals.edit', compact('departement', 'title', 'managers'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);

        $jadwal->fill($request->post())->save();

        return redirect()->route('jadwals.index')->with('success', 'Departement Has Been updated successfully');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwals.index')->with('success', 'Departement has been deleted successfully');
    }
}
