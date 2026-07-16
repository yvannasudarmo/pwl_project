<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Kartu Rencana Studi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Struktur Flexbox Sticky Footer agar senada dengan modul SIAKAD lainnya */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #f5f7fb;
            color: #0b2340;
            display: flex;
            flex-direction: column;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        }

        /* Container utama mengambil sisa ruang kosong */
        .content-grow {
            flex: 1 0 auto;
        }

        /* --- STYLING NAVBAR CLEAN LIGHT --- */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(9, 30, 63, 0.06) !important;
            padding: 12px 0;
            border-bottom: 1px solid rgba(11, 35, 64, 0.05);
        }

        .logo-wrapper {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        .brand-text {
            font-weight: 700;
            font-size: 1.1rem;
            color: #0b2340;
        }

        .nav-link {
            color: #0b2340 !important;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: #0d6efd !important;
        }

        .dropdown-menu {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .dropdown-item {
            color: #4a5568;
            font-size: 0.9rem;
        }

        .dropdown-item:hover, .dropdown-item.active {
            background-color: #f1f5f9;
            color: #0d6efd !important;
        }

        /* --- WHITE CARD BOX & TABLE CLEAN LIGHT --- */
        .info-card {
            background: #ffffff;
            border: 1px solid rgba(11, 35, 64, 0.06);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(9, 30, 63, 0.03);
        }

        .border-end-md {
            @media (min-width: 768px) {
                border-end: 1px solid #e2e8f0 !important;
            }
        }

        .table-responsive-wrapper {
            background: #ffffff;
            border: 1px solid rgba(11, 35, 64, 0.06);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(9, 30, 63, 0.03);
        }

        .table {
            color: #334155 !important;
            margin-bottom: 0;
        }

        .table thead th {
            color: #475569;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f1f5f9;
            background-color: #f8fafc;
            padding: 12px 8px;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody td {
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            padding: 14px 8px;
            font-size: 0.9rem;
        }

        .table.table-hover tbody tr:hover { 
            background-color: #f8fafc !important; 
        }

        /* --- STICKY FOOTER DARK --- */
        footer {
            flex-shrink: 0;
            background-color: #0b1724;
            color: #94a3b8;
            padding: 24px 0;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-logo-container {
            display: flex;
            align-items: center;
            height: 35px;
        }

        .footer-logo-container img {
            height: 100%;
            width: auto;
        }
    </style>
</head>

<body>

    <div class="content-grow">
        
        <!-- Navbar Utama -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                    <div class="logo-wrapper">
                        <img src="{{ asset('images/LOGO-ITBSS.png') }}" alt="Logo ITBSS" onerror="this.src='https://112005.sgp1.vultrobjects.com/sikad/gambar/Logo.gA1qr7iMLX.png'">
                    </div>
                    <span class="brand-text ms-1 d-none d-md-inline">Institut Teknologi & Bisnis Sabda Setia</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                  aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                  <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3 mt-3 mt-lg-0">
                    
                    <div class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle fw-semibold active" href="#" id="siakadMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu SIAKAD
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="siakadMenu">
                        <li><a class="dropdown-item" href="{{ route('dosen.index') }}">Dosen</a></li>
                        <li><a class="dropdown-item" href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('jurusan.index') }}">Jurusan</a></li>
                        <li><a class="dropdown-item" href="{{ route('matakuliah.index') }}">Mata Kuliah</a></li>
                        <li><a class="dropdown-item" href="{{ route('kelas.index') }}">Kelas</a></li>
                        <li><a class="dropdown-item active" href="{{ route('krs.index') }}">KRS</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </nav>

        <!-- Konten Utama Halaman -->
        <div class="container my-5">
            
            <div class="mb-4">
                <h1 class="fw-extrabold text-dark h3 mb-1">Lembar Rencana Studi</h1>
                <p class="text-muted small mb-0">Rincian pengambilan kelas akademis mahasiswa SIAKAD ITBSS</p>
            </div>

            @if(isset($krs) && $krs !== null)
                
                <!-- Ringkasan Profil Mahasiswa -->
                <div class="info-card mb-4">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6 border-end-md">
                            <small class="text-muted d-block text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">Identitas Mahasiswa</small>
                            <h5 class="fw-bold text-dark m-0 mb-1">{{ $krs->mahasiswa->Fullname ?? 'Nama Tidak Ditemukan' }}</h5>
                            <div class="text-secondary small">
                                <span class="me-3"><strong>NIM:</strong> {{ $krs->mahasiswa->kode_mahasiswa ?? $krs->mahasiswa->NIM ?? '-' }}</span>
                                @if(isset($krs->mahasiswa->NIDN) && $krs->mahasiswa->NIDN) 
                                    <span><strong>NIDN Wali:</strong> {{ $krs->mahasiswa->NIDN }}</span> 
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 ps-md-4">
                            <small class="text-muted d-block text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">Periode Rencana Studi</small>
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
                <div class="table-responsive-wrapper">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%">Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>Dosen Pengajar</th>
                                    <th class="text-center" width="15%">Jadwal</th>
                                    <th class="text-center" width="12%">Ruangan</th>
                                    <th class="text-center" width="15%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($krs->detail as $k)
                                <tr>
                                    <td class="text-center text-muted small">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border font-monospace">
                                            {{ $k->kelas->matakuliah->Kode_Mata_Kuliah ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-dark">{{ $k->kelas->matakuliah->Nama_Mata_Kuliah ?? '-' }}</span>
                                    </td>
                                    <td class="text-secondary">{{ $k->kelas->dosen->Fullname ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-2 py-1 fs-8">{{ $k->kelas->hari ?? '-' }}</span>
                                        <small class="d-block text-muted mt-1 font-monospace" style="font-size: 0.75rem;">{{ $k->kelas->jam ?? '-' }}</small>
                                    </td>
                                    <td class="text-center"><span class="text-muted fw-medium">{{ $k->kelas->ruang_kelas ?? '-' }}</span></td>
                                    <td class="text-center">
                                        @if(strtolower($k->status ?? '') == 'approved' || strtolower($k->status ?? '') == 'disetujui')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle d-block py-1.5 px-2">Disetujui</span>
                                        @elseif(strtolower($k->status ?? '') == 'pending')
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle d-block py-1.5 px-2">Pending</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle d-block py-1.5 px-2">{{ $k->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <em>Belum ada mata kuliah yang diambil di dalam KRS ini.</em>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            @else
                <!-- Tampilan Fallback jika data $krs kosong dari Controller -->
                <div class="bg-white border text-center p-5 rounded-3 shadow-sm">
                    <h5 class="fw-bold text-dark mb-2">Data Rencana Studi Kosong</h5>
                    <p class="text-muted small mb-3">Maaf, data KRS tidak ditemukan atau belum diajukan oleh mahasiswa.</p>
                    <a href="{{ route('landing') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">Kembali ke Beranda</a>
                </div>
            @endif

        </div>
    </div>

    <!-- Footer Gelap Identik -->
    <footer>
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div class="footer-logo-container mb-2 mb-sm-0">
                <img src="{{ asset('images/Logo-White.png') }}" alt="Logo ITBSS Footer">
            </div>
            <p class="mb-0 small text-white-50">
                Copyright © 2026 Institut Teknologi & Bisnis Sabda Setia - Yvanna Sudarmo
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>