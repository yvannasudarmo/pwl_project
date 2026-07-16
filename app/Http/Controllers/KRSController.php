<?php

namespace App\Http\Controllers;

use App\Models\krs;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KRSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data KRS beserta relasi mahasiswanya
        $krsData = krs::with('mahasiswa')->get();

        return view('krs.index', [
            'krs' => $krsData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil sampel data mahasiswa pertama di database (Sesuaikan dengan sistem login jika ada)
        $mahasiswa = Mahasiswa::first(); 
        
        // Ambil kelas yang ditawarkan beserta relasi matakuliah & dosen
        $dataKelas = Kelas::with(['matakuliah', 'dosen'])->get();
        
        $tahun_ajaran = '2026/2027';

        return view('krs.create', compact('mahasiswa', 'dataKelas', 'tahun_ajaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        dd($request->all()); // <-- Tambahkan ini sementara, lalu SIMPAN file code Anda
        $data = [
            // Memetakan ke kolom database 'NIM' dari berbagai kemungkinan nama input HTML form Anda
            'NIM'          => $request->NIM ?? $request->nim ?? $request->kode_mahasiswa ?? $request->mahasiswa_id,
            
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester'     => $request->semester,
            'total_sks'    => $request->total_sks ?? 0,
        ];

        // Ganti 'KRS' dengan nama Model KRS Anda yang sebenarnya jika berbeda
        KRS::create($data); 

        return redirect()->action([KRSController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil data KRS detail secara aman beserta nested relation-nya
        $krs = krs::with(['mahasiswa', 'detail.kelas.matakuliah', 'detail.kelas.dosen'])->find($id);
        
        return view('krs.show', compact('krs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(krs $krs)
    {
        return view('krs.edit', compact('krs'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
    {
        $data = [
            'NIM'          => $request->NIM ?? $request->nim ?? $request->kode_mahasiswa ?? $request->mahasiswa_id,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester'     => $request->semester,
            'total_sks'    => $request->total_sks ?? 0,
        ];

        KRS::findOrFail($id)->update($data);

        return redirect()->action([KRSController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(krs $krs)
    {
        $krs->delete();
        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil dihapus');
    }
}