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
        // Memetakan input secara eksplisit ke kolom database 'Kode_MK' dan 'Dosen_Id'
        // Mencari alternatif input jika penamaan di HTML form Anda bervariasi
        $data = [
            'kode_kelas'   => $request->kode_kelas,
            'ruang_kelas'  => $request->ruang_kelas,
            'Kode_MK'      => $request->Kode_MK ?? $request->matakuliah_id ?? $request->kode_matakuliah, 
            'Dosen_Id'     => $request->Dosen_Id ?? $request->dosen_id,
            'hari'         => $request->hari,
            'jam'          => $request->jam,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester'     => $request->semester,
            'jumlah_max'   => $request->jumlah_max,
        ];

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
        // Pemetaan eksplisit yang sama untuk method update
        $data = [
            'kode_kelas'   => $request->kode_kelas,
            'ruang_kelas'  => $request->ruang_kelas,
            'Kode_MK'      => $request->Kode_MK ?? $request->matakuliah_id ?? $request->kode_matakuliah,
            'Dosen_Id'     => $request->Dosen_Id ?? $request->dosen_id,
            'hari'         => $request->hari,
            'jam'          => $request->jam,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester'     => $request->semester,
            'jumlah_max'   => $request->jumlah_max,

'jumlah_mahasiswa' => 0,
            ];

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