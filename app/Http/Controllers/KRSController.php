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
    // 1. Validasi input: pastikan ada kelas yang terpilih
    $request->validate([
        'kelas_id' => 'required|array|min:1',
    ]);

    // 2. AMBIL MAHASISWA YANG SAMA DENGAN DI HALAMAN FORM CREATE
    // Jika belum login, pastikan mengambil NIM dari database mahasiswa yang riil
    $mahasiswa = Mahasiswa::first(); 
    
    // Jika mahasiswa tidak ditemukan sama sekali di database, beri peringatan
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Gagal menyimpan! Belum ada data mahasiswa di database.');
    }

    // Ambil NIM riil dari database (misal kolomnya NIM atau kode_mahasiswa)
    $kodeMahasiswaOtomatis = auth()->user()->nim ?? auth()->user()->kode_mahasiswa ?? $mahasiswa->NIM ?? $mahasiswa->kode_mahasiswa;

    // 3. Generate Tahun Ajaran dan Semester Otomatis
    $tahunSekarang = date('Y');
    $tahunAjaranOtomatis = $tahunSekarang . '/' . ($tahunSekarang + 1);
    
    $bulanSekarang = (int)date('m');
    $semesterOtomatis = ($bulanSekarang >= 7) ? 'ganjil' : 'genap';

    // 4. Hitung Total SKS
    $kelasTerpilih = Kelas::with('matakuliah')->whereIn('id', $request->kelas_id)->get();
    $totalSksDihitung = 0;
    foreach ($kelasTerpilih as $kelas) {
        $totalSksDihitung += $kelas->matakuliah->sks ?? 0;
    }

    // 5. Simpan Data KRS
    DB::beginTransaction();
    try {
        $krsHeader = KRS::create([
            'kode_mahasiswa' => $kodeMahasiswaOtomatis, // Kolom foreign key ini harus sama dengan NIM/Kode di tabel mahasiswa
            'tahun_ajaran'   => $tahunAjaranOtomatis,
            'semester'       => $semesterOtomatis,
            'total_sks'      => $totalSksDihitung,
        ]);

        if (method_exists($krsHeader, 'kelas')) {
            $krsHeader->kelas()->attach($request->kelas_id);
        }

        DB::commit();
        return redirect()->action([KRSController::class, 'index'])->with('success', 'KRS Berhasil disimpan!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
public function show($id)
{
    // Mengambil data KRS beserta relasi mahasiswa dan detail mata kuliahnya
    $krs = \App\Models\KRS::with(['mahasiswa', 'detail'])->findOrFail($id);

    return view('KRS.show', compact('krs'));
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
public function destroy($id)
{
    // Mengamankan pencarian: cari berdasarkan 'id' tabel KRS ATAU kolom 'kode_mahasiswa'
    $krs = \App\Models\KRS::where('id', $id)
                          ->orWhere('kode_mahasiswa', $id)
                          ->first();

    if ($krs) {
        $krs->delete();
        return redirect()->action([KRSController::class, 'index'])
                         ->with('success', 'Data KRS berhasil dihapus!');
    }

    return redirect()->action([KRSController::class, 'index'])
                     ->with('error', 'Data KRS tidak ditemukan.');
}
}