<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KRSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $krsData = KRS::with('mahasiswa')->get();
        return view('krs.index', [
            'krs' => $krsData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::first(); 
        $dataKelas = Kelas::with(['matakuliah', 'dosen'])->get();
        $tahun_ajaran = '2026/2027';

        return view('krs.create', compact('mahasiswa', 'dataKelas', 'tahun_ajaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input array kelas_id
        $request->validate([
            'kelas_id' => 'required|array|min:1',
        ], [
            'kelas_id.required' => 'Anda harus memilih minimal 1 mata kuliah.'
        ]);

        // 2. Ambil data mahasiswa riil yang aktif mengisi
        $mahasiswa = Mahasiswa::first(); 
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Gagal menyimpan! Belum ada data mahasiswa di database.');
        }

        // Ambil NIM mahasiswa secara dinamis
        $kodeMahasiswaOtomatis = auth()->user()->nim ?? auth()->user()->kode_mahasiswa ?? $mahasiswa->NIM ?? $mahasiswa->nim; 

        // 3. Generate Waktu Otomatis
        $tahunSekarang = date('Y');
        $tahunAjaranOtomatis = $tahunSekarang . '/' . ($tahunSekarang + 1);
        $bulanSekarang = (int)date('m');
        $semesterOtomatis = ($bulanSekarang >= 7) ? 'ganjil' : 'genap';

        // 4. Hitung SKS menggunakan 'kode_kelas'
        $kelasTerpilih = Kelas::with('matakuliah')->whereIn('kode_kelas', $request->kelas_id)->get();
        $totalSksDihitung = 0;
        foreach ($kelasTerpilih as $kelas) {
            $totalSksDihitung += $kelas->matakuliah->sks ?? 0;
        }

        if ($totalSksDihitung > 24) {
            return redirect()->back()->withInput()->with('error', "Total SKS ({$totalSksDihitung}) melebihi batas 24 SKS.");
        }

        // 5. Eksekusi Penyimpanan Database
        DB::beginTransaction();
        try {
            // Simpan data master KRS
            $krsHeader = KRS::create([
                'kode_mahasiswa' => $kodeMahasiswaOtomatis,
                'tahun_ajaran'   => $tahunAjaranOtomatis,
                'semester'       => $semesterOtomatis,
                'total_sks'      => $totalSksDihitung,
            ]);

            // 6. Simpan detail kelas terpilih menggunakan Query Builder langsung ke tabel detail Anda
            foreach ($request->kelas_id as $kodeKelasItem) {
                DB::table('table_krs_detail')->insert([
                    'krs_id'     => $krsHeader->id,
                    'kode_kelas' => $kodeKelasItem,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return redirect()->action([KRSController::class, 'index'])->with('success', 'KRS Berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $krs = KRS::with(['mahasiswa', 'detail'])->findOrFail($id);
        return view('krs.show', compact('krs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KRS $krs)
    {
        return view('krs.edit', compact('krs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KRS $krs)
    {
        return redirect()->route('krs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $krs = KRS::where('id', $id)->orWhere('kode_mahasiswa', $id)->first();

        if ($krs) {
            $krs->delete();
            return redirect()->action([KRSController::class, 'index'])->with('success', 'Data KRS berhasil dihapus!');
        }

        return redirect()->action([KRSController::class, 'index'])->with('error', 'Data KRS tidak ditemukan.');
    }
}