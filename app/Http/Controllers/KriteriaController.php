<?php

namespace App\Http\Controllers;

use App\Http\Requests\KriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(){

        $kriteria = Kriteria::all();

        return view('kriteria.kriteria', compact('kriteria'));
    }

    public function create(){

        return view('kriteria.kriteria-create');
    }

    public function store(KriteriaRequest $request){
        Kriteria::create([
            'kode_kriteria' => $request->kode,
            'nama_kriteria' => $request->kriteria,
            'tipe_kriteria' => $request->tipe,
            'bobot_kriteria' => $request->bobot,
        ]);
        return redirect()->route('kriteria')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Kriteria $kriteria){


        return view('kriteria.kriteria-update', compact('kriteria'));
    }

    public function update(KriteriaRequest $request, Kriteria $kriteria){

        $kriteria->update([
            'kode_kriteria' => $request->kode,
            'nama_kriteria' => $request->kriteria,
            'tipe_kriteria' => $request->tipe,
            'bobot_kriteria' => $request->bobot,
        ]);

        return redirect()->route('kriteria')->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy(Kriteria $kriteria){

        $kriteria->delete();

        return redirect()->route('kriteria')->with('success', 'Kriteria berhasil dihapus');
    }
}
