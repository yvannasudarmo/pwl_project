<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Pengisian KRS Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fb; color: #0b2340; font-family: system-ui, -apple-system, sans-serif; }
        .krs-card { background: #ffffff; border: 1px solid rgba(11, 35, 64, 0.06); border-radius: 12px; padding: 30px; box-shadow: 0 4px 12px rgba(9, 30, 63, 0.03); }
        .info-student { background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 18px; }
        .table thead th { color: #475569; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; background-color: #f8fafc; padding: 12px 8px; }
        .table tbody td { vertical-align: middle; padding: 14px 8px; font-size: 0.9rem; }
    </style>
</head>
<body>

    <div class="container my-5" style="max-width: 1000px;">
        
        <!-- Notifikasi Pesan Eror Validasi -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="krs-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h4 fw-bold m-0">Pengisian Kartu Rencana Studi (KRS)</h1>
                    <p class="text-muted small m-0 mt-1">Silakan pilih kelas mata kuliah yang ingin Anda ambil pada semester ini.</p>
                </div>
                <span class="badge bg-primary px-3 py-2 text-uppercase">Semester Ganjly</span>
            </div>

            <!-- Detail Identitas Mahasiswa -->
            <div class="info-student row g-3 mb-4 mx-0">
                <div class="col-md-6">
                    <small class="text-muted d-block text-uppercase fw-semibold" style="font-size: 0.75rem;">Nama Mahasiswa</small>
                    <span class="fw-bold text-dark">{{ $mahasiswa->Fullname ?? 'Yvanna Sudarmo' }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block text-uppercase fw-semibold" style="font-size: 0.75rem;">NIM</small>
                    <span class="fw-bold text-dark font-monospace">{{ $mahasiswa->NIM ?? '24210025' }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block text-uppercase fw-semibold" style="font-size: 0.75rem;">Tahun Ajaran</small>
                    <span class="fw-bold text-dark">{{ $tahun_ajaran ?? '2026/2027' }}</span>
                </div>
            </div>
            
            <!-- FORM PROSES PENYIMPANAN KE CONTROLLER STORE -->
            <form action="{{ action([App\Http\Controllers\KRSController::class, 'store']) }}" method="POST">
                @csrf
                
                <div class="table-responsive border rounded-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="8%" class="text-center">Pilih</th>
                                <th width="15%">Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen Pengajar</th>
                                <th class="text-center">Jadwal</th>
                                <th class="text-center">Ruang</th>
                                <th class="text-center">Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataKelas as $kelas)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="kelas_id[]" value="{{ $kelas->kode_kelas }}" 
                                           class="form-check-input p-2"
                                           {{ is_array(old('kelas_id')) && in_array($kelas->kode_kelas, old('kelas_id')) ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace">
                                        {{ $kelas->matakuliah->Kode_Mata_Kuliah ?? $kelas->kode_kelas }}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-block fw-semibold text-dark">{{ $kelas->matakuliah->Nama_Mata_Kuliah ?? 'Mata Kuliah' }}</span>
                                    <small class="text-muted">{{ $kelas->matakuliah->sks ?? '3' }} SKS</small>
                                </td>
                                <td>
                                    <span class="text-secondary fw-medium">{{ $kelas->dosen->Fullname ?? 'Nama Dosen' }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-secondary border">{{ $kelas->hari }}</span>
                                    <small class="d-block text-muted font-monospace mt-1">{{ $kelas->jam }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted small fw-medium">{{ $kelas->ruang_kelas }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-dark fw-bold">{{ $kelas->jumlah_max ?? '20' }}</span> <small class="text-muted">Mhs</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Tidak ada kelas kuliah ditawarkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @error('kelas_id')
                    <div class="text-danger small mt-2 fw-semibold">{{ $message }}</div>
                @enderror

                <!-- Tombol Navigasi Pembungkus Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ action([App\Http\Controllers\KRSController::class, 'index']) }}" class="btn btn-light border px-4">Kembali</a>
                    <button type="submit" class="btn btn-dark px-4 fw-medium">
                        Simpan KRS Anda
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>