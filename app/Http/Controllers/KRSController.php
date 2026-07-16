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
    // 1. Ambil kode/NIM mahasiswa yang sedang aktif login
    // Jika belum pakai Auth, ganti "123456" dengan contoh kode mahasiswa yang ada di database Anda sementara waktu
    $kodeMahasiswaOtomatis = auth()->user()->nim ?? auth()->user()->kode_mahasiswa ?? "123456"; 

    // 2. Generate Tahun Ajaran dan Semester Otomatis
    $tahunSekarang = date('Y');
    $tahunAjaranOtomatis = $tahunSekarang . '/' . ($tahunSekarang + 1); // Hasil: "2026/2027"
    
    $bulanSekarang = (int)date('m');
    $semesterOtomatis = ($bulanSekarang >= 7) ? 'ganjil' : 'genap';

    // 3. Petakan dengan benar sesuai nama kolom database Anda ('kode_mahasiswa')
    $data = [
        'kode_mahasiswa' => $kodeMahasiswaOtomatis, // <-- WAJIB MENGGUNAKAN KEY INI
        'tahun_ajaran'   => $tahunAjaranOtomatis,
        'semester'       => $semesterOtomatis,
        'total_sks'      => 0,
    ];

    // Simpan ke database
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