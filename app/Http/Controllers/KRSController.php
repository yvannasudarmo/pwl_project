<?php

namespace App\Http\Controllers;

use App\Models\krs;
use Illuminate\Http\Request;

class KRSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('krs.index', [
            'krs' => krs::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show($id)
{
    // Pastikan memanggil relasi 'mahasiswa' dan 'detail.kelas' agar datanya tidak null
    $krs = krs::with(['mahasiswa', 'detail.kelas.matakuliah', 'detail.kelas.dosen'])->find($id);
    
    // Atau jika berdasarkan ID mahasiswa:
    // $krs = Krs::with(['mahasiswa', 'detail.kelas'])->where('mahasiswa_id', $id)->first();

    return view('KRS.show', compact('krs'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(krs $krs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, krs $krs
    )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(krs $krs)
    {
        //
    }
}