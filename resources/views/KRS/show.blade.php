<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Detail KRS Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f5f7fb; 
            color: #0b2340; 
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif; 
        }
        .navbar {
            background: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            border-bottom: 1px solid rgba(11, 35, 64, 0.05);
        }
        .krs-container {
            background: #ffffff;
            border: 1px solid rgba(11, 35, 64, 0.06);
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 12px rgba(9, 30, 63, 0.03);
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .meta-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .meta-value {
            font-size: 1rem;
            font-weight: 600;
            color: #0b2340;
        }
        .table {
            margin-top: 1.5rem;
            vertical-align: middle;
        }
        .table th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 12px 16px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table td {
            padding: 14px 16px;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .badge-status {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="{{ route('landing') }}">
                <img src="https://112005.sgp1.vultrobjects.com/sikad/gambar/Logo.gA1qr7iMLX.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=YGIP9T9E1N7J9K1U7NIC%2F20260514%2Fsgp1%2Fs3%2Faws4_request&X-Amz-Date=20260514T203745Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&x-id=GetObject&X-Amz-Signature=97c43795bdcaa209764f375d74ba8e93da28661f2c79cdeba4bb0f4b9ea321f6" alt="Logo" style="width:36px; height:36px;">
                <span>SIAKAD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu shadow-sm">
                            <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\DosenController::class, 'index']) }}">Dosen</a></li>
                            <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\MahasiswaController::class, 'index']) }}">Mahasiswa</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\JurusanController::class, 'index']) }}">Jurusan</a></li>
                            <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\MatakuliahController::class, 'index']) }}">Mata Kuliah</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="krs-container">
            
            <!-- Dokumen Header -->
            <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-uppercase tracking-wide">Kartu Rencana Studi (KRS)</h3>
                    <p class="text-muted small m-0 mt-1">Institut Teknologi & Bisnis Sabda Setia</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                        Total: {{ $krs->total_sks }} SKS
                    </span>
                </div>
            </div>

            <!-- Metadata KRS / Identitas -->
            <div class="row g-4">
                <div class="col-sm-6 col-md-4">
                    <div class="meta-label">Nama Mahasiswa</div>
                    <div class="meta-value">{{ $krs->mahasiswa->Fullname }}</div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="meta-label">NIM</div>
                    <div class="meta-value">{{ $krs->mahasiswa->NIM }}</div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="meta-label">Tahun Ajaran</div>
                    <div class="meta-value">{{ $krs->tahun_ajaran }}</div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="meta-label">Semester</div>
                    <div class="meta-value text-capitalize">{{ $krs->semester }}</div>
                </div>
                <div class="col-sm-6 col-md-8">
                    <div class="meta-label">Dosen Wali / NIDN</div>
                    <div class="meta-value">{{ $krs->mahasiswa->DosenWali ?? 'Belum Ditentukan' }} {{ $krs->mahasiswa->NIDN ? '('.$krs->mahasiswa->NIDN.')' : '' }}</div>
                </div>
            </div>

            <!-- Tabel Detail KRS -->
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="text-center">No</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen Pengajar</th>
                            <th>Jadwal</th>
                            <th class="text-center">Ruangan</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($krs->detail as $index => $k)
                        <tr>
                            <td class="text-center text-muted fw-medium">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $k->kelas->matakuliah->Nama_Mata_Kuliah }}</div>
                                <div class="text-muted small">{{ $k->kelas->matakuliah->Kode_Mata_Kuliah }}</div>
                            </td>
                            <td>{{ $k->kelas->dosen->Fullname }}</td>
                            <td>
                                <span class="d-block fw-medium text-capitalize">{{ $k->kelas->hari }}</span>
                                <span class="text-muted small">{{ $k->kelas->jam }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">{{ $k->kelas->ruang_kelas }}</span>
                            </td>
                            <td class="text-center">
                                @if(strtolower($k->status) == 'disetujui' || strlower($k->status) == 'approved')
                                    <span class="badge-status bg-success-subtle text-success">Disetujui</span>
                                @else
                                    <span class="badge-status bg-warning-subtle text-warning">{{ $k->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada mata kuliah yang diambil untuk KRS ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>