<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Pengisian KRS Mahasiswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f8fafc; 
            color: #1e293b; 
            font-family: system-ui, -apple-system, sans-serif; 
        }
        .krs-card { 
            background: #ffffff; 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            padding: 30px; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); 
        }
        .info-student {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 15px;
        }
        .table th {
            background-color: #0f172a;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .table td {
            font-size: 0.9rem;
            vertical-align: middle;
        }
        .btn-action { 
            border-radius: 20px; 
            padding: 8px 24px; 
            font-weight: 500;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="py-5">

    <div class="container" style="max-width: 1000px;">
        <div class="krs-card">
            <!-- Header Halaman -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold m-0">Pengisian Kartu Rencana Studi (KRS)</h4>
                    <p class="text-muted small m-0 mt-1">Silakan pilih kelas mata kuliah yang ingin Anda ambil pada semester ini.</p>
                </div>
                <span class="badge bg-primary px-3 py-2 fs-6">Semester Ganjil</span>
            </div>

            <!-- Ringkasan Informasi Mahasiswa -->
            <div class="info-student row g-3 mb-4 mx-0">
                <div class="col-md-6">
                    <small class="text-muted d-block">Nama Mahasiswa</small>
                    <span class="fw-bold">{{ $mahasiswa->Fullname ?? 'Nama Mahasiswa' }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">NIM</small>
                    <span class="fw-bold">{{ $mahasiswa->NIM ?? '2026xxxx' }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Tahun Ajaran</small>
                    <span class="fw-bold">{{ $tahun_ajaran ?? '2026/2027' }}</span>
                </div>
            </div>
            
            <!-- Form Submit Pemilihan KRS -->
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 50px;">Pilih</th>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen Pengajar</th>
                                <th>Jadwal</th>
                                <th>Ruang</th>
                                <th style="width: 120px;">Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping data jadwal kelas yang aktif ditawarkan -->
                            @forelse ($dataKelas as $kelas)
                                <tr>
                                    <td class="text-center">
                                        <!-- Checkbox untuk memilih multi kelas -->
                                        <input type="checkbox" name="kelas_id[]" value="{{ $kelas->id }}" class="form-check-input p-2"
                                            {{ is_array(old('kelas_id')) && in_array($kelas->id, old('kelas_id')) ? 'checked' : '' }}>
                                    </td>
                                    <!-- Menyesuaikan properti kode kelas (opsional: jika di database field-nya Kode_Mata_Kuliah) -->
                                    <td class="text-center fw-bold text-secondary">
                                        {{ $kelas->matakuliah->Kode_Mata_Kuliah ?? $kelas->kode_kelas }}
                                    </td>
                                    <td>
                                        <span class="d-block fw-semibold">{{ $kelas->matakuliah->Nama_Mata_Kuliah ?? 'Mata Kuliah' }}</span>
                                        <!-- SKS diset dinamis mengikuti relasi mata kuliah -->
                                        <small class="text-muted">{{ $kelas->matakuliah->sks ?? '3' }} SKS</small> 
                                    </td>
                                    <td>{{ $kelas->dosen->Fullname ?? 'Nama Dosen' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">{{ $kelas->hari }}</span>
                                        <small class="d-block text-muted mt-1">{{ $kelas->jam }}</small>
                                    </td>
                                    <td class="text-center"><span class="text-muted">{{ $kelas->ruang_kelas }}</span></td>
                                    <td class="text-center">
                                        <span class="text-dark fw-bold">{{ $kelas->jumlah_max ?? '0' }}</span> Mhs
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        Tidak ada kelas yang ditawarkan untuk semester ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @error('kelas_id')
                    <div class="alert alert-danger mt-3 py-2 small">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('krs.index') }}" class="btn btn-light border btn-action">Kembali</a>
                    <button type="submit" class="btn bg-dark text-white btn-action shadow-sm">Simpan KRS Anda</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>