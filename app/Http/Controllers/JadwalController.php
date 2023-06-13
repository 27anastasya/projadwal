<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use App\Charts\JadwalLineChart;

class JadwalController extends Controller
{
    public function index()
    {
        $title = "Data Penempatan Jadwal";
        $jadwals = Jadwal::orderBy('id', 'asc')->get();
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
        dd($request->all());
        // $details->validate([
        //     'id' => 'required',
        // ]);

        $jadwals = [
            'nama_kelas' => $request->nama_kelas,
            'ruangan' => $request->ruangan,
            'nama_dosen' => $request->nama_dosen,
            'tanggal' => $request->tanggal,
        ];
        if ($result = Jadwal::create($jadwals)) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'id_dosen' => $request->id,
                    'id_mahasiswa' => $request['id_mahasiswa' . $i],
                    'mata_kuliah' => $request['mata_kuliah' . $i],
                    'jumlah_sks' => $request['jumlah_sks' . $i],
                ];
                JadwalDetail::create($request->post());
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

        return redirect()->route('jadwals.index')->with('success', 'Jadwal Has Been updated successfully');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwals.index')->with('success', 'Jadwal has been deleted successfully');
    }

    public function chartLine()
    {
        $api = route('jadwal.chartLineAjax');

        $chart = new JadwalLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Chart Ajax";
        return view('home', compact('chart', 'title'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $jadwals = Jadwal::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('tanggal', $year)
            ->groupBy(\DB::raw("Month(tanggal)"))
            ->pluck('count');

        $chart = new JadwalLineChart;

        $chart->dataset('New Jadwal Register Chart', 'bar', $jadwals)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return $chart->api();
    }
}
