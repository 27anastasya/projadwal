<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $title = "Data Mahasiswa";
        $mahasiswas = Jadwal::orderBy('id', 'asc')->get();
        return view('mahasiswas.index', compact('mahasiswas', 'title'));
    }

    public function create()
    {
        $title = "Tambah Data Mahasiswa";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        return view('mahasiswas.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required',
            'nama_mahasiswa' => 'nullable',
        ]);

        Mahasiswa::create($validatedData);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }


    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.show', compact('mahasiswas'));
    }


    public function edit(Mahasiswa $mahasiswa)
    {

        $title = "Edit Data Mahasiswa";
        $managers = User::where('position', 'manager')->get();
        return view('mahasiswas.edit', compact('mahasiswa', 'managers', 'title'));
    }


    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
        ]);

        $mahasiswa->fill($request->post())->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Has Been updated successfully');
    }

    public function autocomplete(Request $request)
    {
        $data = Mahasiswa::select("nama_mahasiswa as value", "id")
            ->where('nama_mahasiswa', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'mahasiswa has been deleted successfully');
    }
    public function exportPdf()
    {
        $title = "Laporan Data Mahasiswa";
        $mahasiswas = Mahasiswa::orderBy('id', 'asc')->get();
        $pdf = PDF::loadview('mahasiswas.pdf', compact(['mahasiswas', 'title']));
        return $pdf->stream('laporan-mahasiswa-pdf');
    }

}
