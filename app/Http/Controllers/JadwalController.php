<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\JadwalDetail;
use Illuminate\Http\Request;
use App\Charts\JadwalLineChart;

class JadwalController extends Controller
{
    public function index()
    {
        $title = "Data Penempatan Jadwal";
        $jadwals = Jadwal::orderBy('id', 'asc')->get();
        return view('jadwals.index', compact('jadwals', 'title'));
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

        $jadwal = new Jadwal;
        $jadwal->nama_kelas = $request->nama_kelas;
        $jadwal->ruangan = $request->ruangan;
        $jadwal->nama_dosen = $request->nama_dosen;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->save();

        $jadwalId = $jadwal->id;

        for ($i = 1; $i <= $request->jml; $i++) {
            $details = new JadwalDetail;
            $details->id_dosen = $jadwalId;
            $details->id_mahasiswa = $request['id_mahasiswa' . $i];
            $details->mata_kuliah = $request['mata_kuliah' . $i];
            $details->jumlah_sks = $request['jumlah_sks' . $i];
            $details->save();
        }

        return redirect()->route('jadwals.index')->with('success', 'Jadwal has been created successfully.');
    }

    public function show(Jadwal $jadwal)
    {
        return view('jadwals.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $title = "Edit Data Jadwal";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        $detail = JadwalDetail::where('id_dosen', $jadwal->id_dosen)->orderBy('id', 'asc')->get();
        return view('jadwals.edit', compact('title', 'jadwal', 'managers','detail'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'ruangan' => 'required',
            'nama_dosen' => 'required',
            'tanggal' => 'required',
        ]);

        $jadwal->nama_kelas = $request->nama_kelas;
        $jadwal->ruangan = $request->ruangan;
        $jadwal->nama_dosen = $request->nama_dosen;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->save();

        return redirect()->route('jadwals.index')->with('success', 'Jadwal has been updated successfully.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwals.index')->with('success', 'Jadwal has been deleted successfully.');
    }

    public function chartLine()
    {
        $api = route('jadwal.chartLineAjax');

        $chart = new JadwalLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Chart Ajax";
        return view('home', compact('chart', 'title'));
    }

    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $jadwals = Jadwal::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('tanggal', $year)
            ->groupBy(\DB::raw("MONTH(tanggal)"))
            ->pluck('count');

        $chart = new JadwalLineChart;

        $chart->dataset('Jadwal Penempatan Mahasiswa Chart', 'bar', $jadwals)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return $chart->api();
    }
}
