<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KRSController extends Controller
{
    public function index()
    {
        $krsData = KRS::with('mahasiswa')->get();
        return view('krs.index', ['krs' => $krsData]);
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::first(); 
        $dataKelas = Kelas::with(['matakuliah', 'dosen'])->get();
        $tahun_ajaran = '2026/2027';

        return view('krs.create', compact('mahasiswa', 'dataKelas', 'tahun_ajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|array|min:1',
        ], [
            'kelas_id.required' => 'Anda harus memilih minimal 1 mata kuliah.'
        ]);

        $mahasiswa = Mahasiswa::first(); 
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Gagal menyimpan! Belum ada data mahasiswa.');
        }

        $kodeMahasiswaOtomatis = auth()->user()->nim ?? auth()->user()->kode_mahasiswa ?? $mahasiswa->NIM ?? $mahasiswa->nim; 

        $tahunSekarang = date('Y');
        $tahunAjaranOtomatis = $tahunSekarang . '/' . ($tahunSekarang + 1);
        $bulanSekarang = (int)date('m');
        $semesterOtomatis = ($bulanSekarang >= 7) ? 'ganjil' : 'genap';

        // Mengambil data kelas berdasarkan 'kode_kelas'
        $kelasTerpilih = Kelas::with('matakuliah')->whereIn('kode_kelas', $request->kelas_id)->get();
        $totalSksDihitung = 0;
        foreach ($kelasTerpilih as $kelas) {
            $totalSksDihitung += $kelas->matakuliah->sks ?? 0;
        }

        if ($totalSksDihitung > 24) {
            return redirect()->back()->withInput()->with('error', "Total SKS ({$totalSksDihitung}) melebihi batas 24 SKS.");
        }

        DB::beginTransaction();
        try {
            // Simpan data master KRS
            $krsHeader = KRS::create([
                'kode_mahasiswa' => $kodeMahasiswaOtomatis,
                'tahun_ajaran'   => $tahunAjaranOtomatis,
                'semester'       => $semesterOtomatis,
                'total_sks'      => $totalSksDihitung,
            ]);

            // CARA AMAN: Simpan detail kelas terpilih menggunakan looping manual ke tabel detail
            // Ganti 'KRSDetail' sesuai nama model tabel detail / pivot Anda
            foreach ($request->kelas_id as $kodeKelasItem) {
                \App\Models\KRSDetail::create([
                    'krs_id'     => $krsHeader->id,
                    'kode_kelas' => $kodeKelasItem
                ]);
            }

            DB::commit();
            return redirect()->action([KRSController::class, 'index'])->with('success', 'KRS Berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $krs = KRS::with(['mahasiswa', 'detail'])->findOrFail($id);
        return view('krs.show', compact('krs'));
    }

    public function edit(KRS $krs)
    {
        return view('krs.edit', compact('krs'));
    }

    public function update(Request $request, KRS $krs)
    {
        return redirect()->route('krs.index');
    }

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