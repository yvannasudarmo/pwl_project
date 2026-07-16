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
        $data = [
            'kode_kelas'       => $request->kode_kelas,
            'ruang_kelas'      => $request->ruang_kelas,
            'Kode_MK'          => $request->Kode_MK ?? $request->matakuliah_id ?? $request->kode_matakuliah, 
            'Dosen_Id'         => $request->Dosen_Id ?? $request->dosen_id,
            'hari'             => $request->hari,
            'jam'              => $request->jam,
            'tahun_ajaran'     => $request->tahun_ajaran,
            'semester'         => $request->semester,
            'jumlah_max'       => $request->jumlah_max,
            
            // TAMBAHKAN INI: Set default nilai 0 untuk data kelas baru
            'jumlah_mahasiswa' => 0, 
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

public function update(Request $request, $id)
    {
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
            
            // Sertakan juga di method update agar tidak hilang
            'jumlah_mahasiswa' => $request->jumlah_mahasiswa ?? 0,
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