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
        // Simpan data master KRS ke table_krs
        $krsHeader = KRS::create([
            'kode_mahasiswa' => $kodeMahasiswaOtomatis,
            'tahun_ajaran'   => $tahunAjaranOtomatis,
            'semester'       => $semesterOtomatis,
            'total_sks'      => $totalSksDihitung,
        ]);

        // 6. SOLUSI UTAMA: Simpan detail kelas terpilih menggunakan Query Builder langsung ke tabel detail Anda
        // Silakan ganti 'table_krs_detail' di bawah dengan nama TABEL DETAIL/PIVOT KRS Anda yang sebenarnya di database mysql
        foreach ($request->kelas_id as $kodeKelasItem) {
            DB::table('table_krs_detail')->insert([
                'krs_id'     => $krsHeader->id, // mengambil ID dari table_krs yang baru terbuat
                'kode_kelas' => $kodeKelasItem,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::commit();
        return redirect()->action([KRSController::class, 'index'])->with('success', 'KRS Berhasil disimpan!');

    } catch (\Exception $e) {
        DB::rollBack();
        
        // JIKA MENEMUKAN EROR, TAMPILKAN ERORNYA KE LAYAR AGAR KITA TAHU PRESIF MASALAHNYA
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
    }
}