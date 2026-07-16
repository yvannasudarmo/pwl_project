<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Kartu Rencana Studi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f8fafc; 
            color: #1e293b; 
            font-family: system-ui, -apple-system, sans-serif; 
        }
        .navbar {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05);
        }
        .info-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <!-- Navbar SIAKAD -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light border-bottom sticky-top py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="{{ route('landing') }}">
                        <img src="{{ asset('images/LOGO-ITBSS.png') }}" alt="Logo ITBSS" onerror="this.src='https://112005.sgp1.vultrobjects.com/sikad/gambar/Logo.gA1qr7iMLX.png'">
                <span>SIAKAD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">
                            Menu Akademik
                        </a>
                        <ul class="dropdown-menu shadow-sm border-0 mt-2">
                            <li><a class="dropdown-item" href="{{ route('dosen.index') }}">Data Dosen</a></li>
                            <li><a class="dropdown-item" href="{{ route('mahasiswa.index') }}">Data Mahasiswa</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('jurusan.index') }}">Data Jurusan</a></li>
                            <li><a class="dropdown-item" href="{{ route('matakuliah.index') }}">Mata Kuliah</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Pengaman Logika: Hanya render data jika objek $krs tidak null -->
        @if(isset($krs) && $krs !== null)
            
            <!-- Ringkasan Profil Mahasiswa -->
            <div class="info-card mb-4">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 border-end-md">
                        <small class="text-muted d-block text-uppercase fw-semibold tracking-wider mb-1" style="font-size: 0.75rem;">Identitas Mahasiswa</small>
                        <h5 class="fw-bold text-dark m-0 mb-1">{{ $krs->mahasiswa->Fullname ?? 'Nama Tidak Ditemukan' }}</h5>
                        <div class="text-secondary small">
                            <span class="me-3"><strong>NIM:</strong> {{ $krs->mahasiswa->NIM ?? '-' }}</span>
                            @if(isset($krs->mahasiswa->NIDN) && $krs->mahasiswa->NIDN) 
                                <span><strong>NIDN Wali:</strong> {{ $krs->mahasiswa->NIDN }}</span> 
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 ps-md-4">
                        <small class="text-muted d-block text-uppercase fw-semibold tracking-wider mb-1" style="font-size: 0.75rem;">Periode Rencana Studi</small>
                        <div class="row g-2 text-secondary small">
                            <div class="col-6"><strong>Tahun Ajaran:</strong> {{ $krs->tahun_ajaran ?? '-' }}</div>
                            <div class="col-6"><strong>Semester:</strong> <span class="text-capitalize">{{ $krs->semester ?? '-' }}</span></div>
                            <div class="col-12 mt-2">
                                <strong>Total Beban:</strong> 
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 ms-1">
                                    {{ $krs->total_sks ?? 0 }} SKS
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Lembar KRS Mata Kuliah -->
            <div class="bg-white border rounded-3 overflow-hidden shadow-sm">
                <div class="p-3 bg-light border-bottom">
                    <h6 class="fw-bold text-secondary m-0">Daftar Mata Kuliah yang Diambil</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th style="width: 150px;">Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Dosen Pengajar</th>
                                <th class="text-center" style="width: 180px;">Jadwal</th>
                                <th class="text-center" style="width: 120px;">Ruangan</th>
                                <th class="text-center" style="width: 140px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($krs->detail as $k)
                            <tr>
                                <td class="text-center text-muted small">{{ $loop->iteration }}</td>
                                <td class="fw-bold text-secondary">{{ $k->kelas->matakuliah->Kode_Mata_Kuliah ?? '-' }}</td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $k->kelas->matakuliah->Nama_Mata_Kuliah ?? '-' }}</span>
                                </td>
                                <td>{{ $k->kelas->dosen->Fullname ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">{{ $k->kelas->hari ?? '-' }}</span>
                                    <small class="d-block text-muted mt-1">{{ $k->kelas->jam ?? '-' }}</small>
                                </td>
                                <td class="text-center"><span class="text-muted">{{ $k->kelas->ruang_kelas ?? '-' }}</span></td>
                                <td class="text-center">
                                    @if(strtolower($k->status ?? '') == 'approved' || strtolower($k->status ?? '') == 'disetujui')
                                        <span class="badge bg-success-subtle text-success px-3 py-1.5 w-100">Disetujui</span>
                                    @elseif(strtolower($k->status ?? '') == 'pending')
                                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1.5 w-100">Pending</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger px-3 py-1.5 w-100">{{ $k->status ?? 'Unknown' }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada mata kuliah yang diambil di dalam KRS ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <!-- Tampilan Fallback jika data $krs benar-benar kosong dari Controller -->
            <div class="alert alert-warning text-center p-5 rounded-3 border">
                <h5 class="fw-bold text-warning-emphasis">Data Rencana Studi Kosong</h5>
                <p class="text-muted mb-0">Maaf, data KRS tidak ditemukan atau belum diajukan oleh mahasiswa.</p>
                <a href="{{ route('landing') }}" class="btn btn-secondary btn-sm mt-3">Kembali ke Beranda</a>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>