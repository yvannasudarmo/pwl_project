<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelas.index', [
            'kelas' => Kelas::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create', [
            'dosen' => Dosen::get(),
            'mataKuliah'=> MataKuliah::get(),
            'hari' => Kelas::ListHari(),
            'jam' => Kelas::ListJam(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        Kelas::create($data);

        return redirect()->action([KelasController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data kelas spesifik yang akan diedit beserta data pendukungnya
        return view('kelas.edit', [
            'kelas' => Kelas::findOrFail($id),
            'dosen' => Dosen::get(),
            'mataKuliah' => MataKuliah::get(),
            'hari' => Kelas::ListHari(),
            'jam' => Kelas::ListJam(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Mengabaikan token CSRF dan spoofing method (_method) dari request form
        $data = $request->except(['_token', '_method']);

        // Cari data berdasarkan ID, lalu perbarui datanya
        Kelas::findOrFail($id)->update($data);

        return redirect()->action([KelasController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kelas::find($id)->delete();

        return redirect()->action([KelasController::class, 'index']);
    }
}