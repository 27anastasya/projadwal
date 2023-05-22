<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;

class DepartementController extends Controller
{
    public function index()
    {
        $title = "Data Departements";
        $departements = Departements::orderBy('id', 'asc')->paginate(5);
        return view('departements.index', compact(['departements', 'title']));
    }

    public function create()
    {
        $title = "Tambah data";
        $managers = User::where('position', 'manager')->get();
        return view('departements.create', compact('managers', 'title'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'manager_id' => 'required',
        ]);

        Departements::create($validatedData);

        return redirect()->route('departements.index')->with('success', 'Departement created successfully.');
    }


    public function show(Departements $departement)
    {
        return view('departements.show', compact('departements'));
    }


    public function edit(Departements $departement)
    {
        
        $title = "Edit Data departement";
        $managers = User::where('positions', 'manager')->get();
        return view('departements.edit', compact('departement', 'managers', 'title'));
    }


    public function update(Request $request, Departements $departement)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);

        $departement->fill($request->post())->save();

        return redirect()->route('departements.index')->with('success', 'Departemnt Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departements  $departements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departements $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'departements has been deleted successfully');
    }
    public function exportPdf()
    {
        $title = "Laporan Data Departement";
        $departements = Departements::orderBy('id', 'asc')->get();
        $pdf = PDF::loadview('departements.pdf', compact(['departements', 'title']));
        return $pdf->stream('laporan-departement-pdf');
    }
}