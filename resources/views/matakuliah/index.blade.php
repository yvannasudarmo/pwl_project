<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Data Mata Kuliah</title>

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

        /* Search Bar Light Theme */
        .navbar .search-control {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #0b2340;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 0.875rem;
        }
        
        .navbar .search-control::placeholder {
            color: #94a3b8;
        }

        .btn-search {
            border-radius: 20px;
            padding: 6px 16px;
            border: 1px solid #0d6efd;
            color: #0d6efd;
            background: transparent;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-search:hover {
            background: #0d6efd;
            color: #ffffff;
        }

        /* --- BUTTON CREATION --- */
        .btn-create {
            background: #0d6efd;
            border: none;
            color: white !important;
            font-weight: 500;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-create:hover { 
            background: #0b5ed7;
            transform: translateY(-1px); 
        }

        /* --- WHITE CARD BOX & TABLE CLEAN LIGHT --- */
        .main-title {
            font-weight: 800;
            color: #0b2340;
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

        /* Action Buttons styling */
        .btn-action-edit {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #475569;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-action-edit:hover {
            border-color: #0d6efd;
            color: #0d6efd;
            background: #f0f7ff;
        }

        .btn-action-delete {
            background: #fff;
            border: 1px solid #fee2e2;
            color: #ef4444;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-action-delete:hover {
            background: #fef2f2;
            border-color: #ef4444;
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

        .table.table-hover tbody tr:hover { background-color: #f8fafc !important; }
    </style>
</head>

<body>

    <div class="content-grow">
        
        <!-- Navbar Utama -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                    <div class="logo-wrapper">
                        <!-- Menggunakan file image logo lokal yang konsisten -->
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
                    <form class="d-flex" role="search" action="#" method="get">
                      <input class="form-control search-control" name="q" type="search" placeholder="Cari mata kuliah..." aria-label="Search">
                      <button class="btn btn-search ms-2" type="submit">Search</button>
                    </form>

                    <div class="d-none d-lg-block" style="width: 1px; height: 20px; background: #e2e8f0;"></div>

                    <div class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle fw-semibold active" href="#" id="siakadMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu SIAKAD
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="siakadMenu">
                        <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\DosenController::class, 'index']) }}">Dosen</a></li>
                        <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\MahasiswaController::class, 'index']) }}">Mahasiswa</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\JurusanController::class, 'index']) }}">Jurusan</a></li>
                        <li><a class="dropdown-item active" href="{{ action([App\Http\Controllers\MatakuliahController::class, 'index']) }}">Mata Kuliah</a></li>
                        <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\KelasController::class, 'index']) }}">Kelas</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </nav>

        <!-- Konten Utama Halaman -->
        <div class="container my-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h1 class="main-title mb-1">Daftar Data Mata Kuliah</h1>
                    <p class="text-muted mb-0">Manajemen Kurikulum Kurikulum Akademik SIAKAD ITBSS</p>
                </div>
                <div>
                    <!-- Diperbaiki mengarah ke create action -->
                    <a href="{{ action([App\Http\Controllers\MataKuliahController::class, 'create']) }}" class="btn btn-create shadow-sm">
                        + Tambah Mata Kuliah
                    </a>
                </div>
            </div>

            <div class="table-responsive-wrapper">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Jurusan ID</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th class="text-center">SKS</th>
                                <th>Dosen Pengampu ID</th>
                                <th>Tanggal Dibuat</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($matakuliah as $mk)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td class="small text-muted">{{ $mk->Jurusan_Id }}</td>
                                <td><span class="badge bg-light text-dark border font-monospace">{{ $mk->Kode_MK }}</span></td>
                                <td class="fw-semibold text-dark">{{ $mk->Nama_MK }}</td>
                                <td class="text-center"><span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1.5 fs-7">{{ $mk->SKS }} SKS</span></td>
                                <td class="small text-muted">{{ $mk->Dosen_Id }}</td>
                                <td class="text-muted small">
                                    {{ $mk->created_at ? $mk->created_at->format('d M Y') : '-' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Tombol Edit Terintegrasi -->
                                        <a href="{{ route('matakuliah.update', $mk->id) }}" class="btn btn-action-edit">Edit</a>
                                        
                                        <!-- Form Delete Terintegrasi + Konfirmasi -->
                                        <form action="{{ route('matakuliah.delete', $mk->id) }}" 
                                              method="post" 
                                              class="m-0"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $mk->id }}">
                                            <button type="submit" class="btn btn-action-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted italic py-4">
                                    Belum ada data mata kuliah yang tersimpan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Sistem Terintegrasi -->
    <footer>
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div class="footer-logo-container mb-2 mb-sm-0">
                <span class="text-white fw-bold small tracking-wide">SIAKAD ITBSS</span>
            </div>
            <p class="mb-0 small text-white-50">
                Copyright © 2026 Institut Teknologi & Bisnis Sabda Setia
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>