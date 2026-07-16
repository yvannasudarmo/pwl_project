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
        $request->validate([
            'kelas_id' => 'required|array|min:1',
        ], [
            'kelas_id.required' => 'Anda harus memilih minimal satu mata kuliah!',
        ]);

        // Simpan Logika KRS Baru (Contoh sederhana implementasi Anda)
        $mahasiswa = Mahasiswa::first();
        
        $krs = krs::create([
            'mahasiswa_id' => $mahasiswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester'     => 'ganjil',
            'total_sks'    => 0, // Nanti dihitung dinamis dari total sks kelas terpilih
            'status_krs'   => 'pending'
        ]);

        foreach ($request->kelas_id as $id) {
            // Asumsi Anda memiliki tabel detail KRS / krs_details
            // $krs->detail()->create(['kelas_id' => $id, 'status' => 'pending']);
        }

        return redirect()->route('krs.index')->with('success', 'KRS berhasil disimpan!');
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
    public function update(Request $request, krs $krs)
    {
        // Logika Update
        return redirect()->route('krs.index');
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