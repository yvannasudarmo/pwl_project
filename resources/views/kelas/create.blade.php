<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f5f7fb; 
            color: #0b2340; 
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif; 
        }
        .card-form { 
            background: #ffffff; 
            border: 1px solid rgba(11, 35, 64, 0.06); 
            border-radius: 12px; 
            padding: 28px; 
            box-shadow: 0 4px 12px rgba(9, 30, 63, 0.03); 
        }
        .form-label { 
            font-weight: 600; 
            font-size: 0.875rem; 
            color: #0b2340;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.9rem;
            padding: 8px 12px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }
        .btn-primary { 
            background: #0d6efd; 
            border: none;
            border-radius: 20px; 
            padding: 8px 24px; 
            font-weight: 500;
            font-size: 0.9rem;
        }
        .btn-primary:hover {
            background: #0b5ed7;
        }
        .btn-cancel {
            border-radius: 20px; 
            padding: 8px 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="py-5">

    <div class="container" style="max-width: 700px;">
        <div class="card-form">
            <div class="mb-4">
                <h4 class="fw-bold m-0">Tambah Kelas Baru</h4>
                <p class="text-muted small m-0 mt-1">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
            </div>
            
            <!-- Perbaikan: Route diarahkan ke KelasController -->
            <form action="{{ action([App\Http\Controllers\KelasController::class, 'store']) }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <!-- Kode Kelas -->
                    <div class="col-md-6">
                        <label class="form-label">Kode Kelas</label>
                        <input type="text" name="kode_kelas" value="{{ old('kode_kelas') }}" placeholder="Contoh: IF-2A" class="form-control" required>
                        @error('kode_kelas') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    
                    <!-- Ruangan -->
                    <div class="col-md-6">
                        <label class="form-label">Ruang Kelas</label>
                        <input type="text" name="ruang_kelas" value="{{ old('ruang_kelas') }}" placeholder="Contoh: Lab Komputer 1" class="form-control" required>
                        @error('ruang_kelas') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Mata Kuliah -->
                    <div class="col-12">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="kode_mata_kuliah" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliah as $mk)
                                <option value="{{ $mk->id }}" {{ old('kode_mata_kuliah') == $mk->id ? 'selected' : '' }}>
                                    {{ $mk->Nama_Mata_Kuliah }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_mata_kuliah') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Dosen Pengajar -->
                    <div class="col-12">
                        <label class="form-label">Dosen Pengajar</label>
                        <select name="kode_dosen" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Dosen --</option>
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}" {{ old('kode_dosen') == $d->id ? 'selected' : '' }}>
                                    {{ $d->Fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_dosen') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Hari -->
                    <div class="col-md-6">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            @foreach ($hari as $h)
                                <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                        @error('hari') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Jam -->
                    <div class="col-md-6">
                        <label class="form-label">Jam Kuliah</label>
                        <select name="jam" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jam --</option>
                            @foreach ($jam as $j)
                                <option value="{{ $j }}" {{ old('jam') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                        @error('jam') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="col-md-4">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2026/2027" class="form-control" required>
                        @error('tahun_ajaran') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Semester -->
                    <div class="col-md-4">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Semester --</option>
                            <option value="ganjil" {{ old('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="genap" {{ old('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('semester') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Jumlah Maksimal Mahasiswa -->
                    <div class="col-md-4">
                        <label class="form-label">Maksimal Mahasiswa</label>
                        <input type="number" name="jumlah_max" value="{{ old('jumlah_max') }}" placeholder="Maks Kuota" class="form-control" required>
                        @error('jumlah_max') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-t">
                    <a href="{{ action([App\Http\Controllers\KelasController::class, 'index']) }}" class="btn btn-light border btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-primary shadow-sm">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>