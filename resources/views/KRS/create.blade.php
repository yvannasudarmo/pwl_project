<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Tambah Kelas Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f5f7fb; 
            color: #0b2340; 
            font-family: system-ui, -apple-system, sans-serif; 
        }
        .card-form { 
            background: #ffffff; 
            border: 1px solid rgba(11, 35, 64, 0.06); 
            border-radius: 12px; 
            padding: 30px; 
            box-shadow: 0 4px 12px rgba(9, 30, 63, 0.03); 
        }
        .form-label { 
            font-weight: 600; 
            font-size: 0.85rem; 
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px 14px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }
        .btn-primary { 
            background: #0d6efd; 
            border: none;
            border-radius: 50px; 
            padding: 10px 24px; 
            font-weight: 600;
            font-size: 0.9rem;
        }
        .btn-light {
            border-radius: 50px;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="py-5">

    <div class="container" style="max-width: 750px;">
        <div class="card-form">
            
            <!-- Header Form -->
            <div class="border-bottom pb-3 mb-4">
                <h4 class="fw-bold m-0">Tambah Kelas Baru</h4>
                <p class="text-muted small m-0 mt-1">Isi formulir di bawah ini untuk membuat jadwal kelas perkuliahan baru.</p>
            </div>
            
            <!-- Form Action diarahkan ke KelasController -->
            <form action="{{ action([App\Http\Controllers\KelasController::class, 'store']) }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <!-- Kode Kelas -->
                    <div class="col-md-6">
                        <label class="form-label">Kode Kelas</label>
                        <input type="text" name="kode_kelas" placeholder="Contoh: IF-A-2026" class="form-control" required>
                    </div>
                    
                    <!-- Ruangan -->
                    <div class="col-md-6">
                        <label class="form-label">Ruangan</label>
                        <input type="text" name="ruang_kelas" placeholder="Contoh: Gedung B.3.1" class="form-control" required>
                    </div>

                    <!-- Mata Kuliah -->
                    <div class="col-12">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="kode_mata_kuliah" class="form-select" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliah as $mk)
                                <option value="{{ $mk->id }}">{{ $mk->Nama_Mata_Kuliah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dosen Pengajar -->
                    <div class="col-12">
                        <label class="form-label">Dosen Pengajar</label>
                        <select name="kode_dosen" class="form-select" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}">{{ $d->Fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hari -->
                    <div class="col-md-6">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-select" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach ($hari as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jam -->
                    <div class="col-md-6">
                        <label class="form-label">Jam</label>
                        <select name="jam" class="form-select" required>
                            <option value="">-- Pilih Jam --</option>
                            @foreach ($jam as $j)
                                <option value="{{ $j }}">{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="col-md-4">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" placeholder="Contoh: 2026/2027" class="form-control" required>
                    </div>

                    <!-- Semester -->
                    <div class="col-md-4">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>

                    <!-- Jumlah Maksimal Mahasiswa -->
                    <div class="col-md-4">
                        <label class="form-label">Kuota Mahasiswa</label>
                        <input type="number" name="jumlah_max" placeholder="Maks Kapasitas" class="form-control" required>
                    </div>
                </div>

                <!-- Tombol Aksi / Submit -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <button type="reset" class="btn btn-light border text-muted">Reset</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Kelas</button>
                </div>
            </form>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>