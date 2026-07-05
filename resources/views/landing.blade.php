<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Dashboard</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'brand-blue': '#0d6efd',
            'dark': '#0b2340',
            'bg-gray': '#f5f7fb',
          }
        }
      }
    }
  </script>

  <style>
    body {
      background-color: #f5f7fb;
      color: #0b2340;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    }
    /* Smooth Transition untuk Carousel */
    .carousel-item {
      display: none;
      transition: opacity 0.5s ease-in-out;
    }
    .carousel-item.active {
      display: block;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col m-0">

@php
  $lang = request('lang', app()->getLocale() ?? 'id');
  $trId = [
    'apply'=>'Daftar Sekarang',
    'profile'=>'Lihat Profil',
    'agenda'=>'Agenda Terdekat',
    'why'=>'Mengapa Memilih ITBSS',
    'about'=>'Tentang ITBSS',
    'registration'=>'Pendaftaran',
    'programs'=>'Program Studi',
    'pmb'=>'Penerimaan Mahasiswa Baru'
  ];
  $trEn = [
    'apply'=>'Apply Now',
    'profile'=>'View Profile',
    'agenda'=>'Upcoming Events',
    'why'=>'Why Choose ITBSS',
    'about'=>'About ITBSS',
    'registration'=>'Registration',
    'programs'=>'Study Programs',
    'pmb'=>'New Student Admission'
  ];
  $tr = $lang === 'en' ? $trEn : $trId;
  $userName = auth()->check() ? auth()->user()->name : 'Guest';
  $svgPlaceholder = "data:image/svg+xml;utf8,".rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="800"><rect width="100%" height="100%" fill="#e9eef6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9aa7b7" font-family="Arial" font-size="28">Image not available</text></svg>');
@endphp

<nav class="bg-white shadow-[0_2px_8px_rgba(9,30,63,0.06)] py-3 sticky top-0 z-50">
  <div class="max-w-[1180px] mx-auto px-4 flex items-center justify-between gap-2">
    
    <div class="flex items-center flex-shrink-0">
      <a class="flex items-center no-underline" href="{{ route('landing') }}">
        <img class src="{{ asset('images/LOGO-ITBSS.png') }}" width="56" alt="ITBSS" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        <span class="font-bold color-dark ml-2 hidden md:inline text-lg">Institut Teknologi & Bisnis Sabda Setia</span>
      </a>
    </div>

    <div class="flex items-center gap-2 flex-shrink-0">
      @php
        $urlId = request()->fullUrlWithQuery(['lang'=>'id']);
        $urlEn = request()->fullUrlWithQuery(['lang'=>'en']);
      @endphp
      <a class="rounded-full px-2.5 py-1.5 border border-[rgba(11,35,64,0.06)] bg-transparent font-semibold text-sm hover:bg-gray-100" href="{{ $urlId }}" aria-label="ID">ID</a>
      <a class="rounded-full px-2.5 py-1.5 border border-[rgba(11,35,64,0.06)] bg-transparent font-semibold text-sm hover:bg-gray-100" href="{{ $urlEn }}" aria-label="EN">EN</a>

      {{-- User Dropdown --}}
      @auth
        <div class="relative inline-block text-left dropdown-container">
          <button class="dropdown-toggle px-3 py-1.5 rounded-full border border-brand-blue text-brand-blue font-medium hover:bg-blue-50 transition text-sm flex items-center gap-1">
            {{ auth()->user()->name }}
          </button>
          <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('landing') }}">Dashboard</a>
            <hr class="my-1 border-gray-200">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
            </form>
          </div>
        </div>
      @else
        <a class="px-4 py-1.5 rounded-full border border-brand-blue text-brand-blue font-medium hover:bg-blue-50 transition text-sm" href="{{ route('login') }}">Login</a>
      @endauth

      {{-- Menu SIAKAD --}}
      <div class="relative inline-block text-left dropdown-container ml-1">
        <button class="dropdown-toggle px-3.5 py-1.5 rounded-full border border-[rgba(11,35,64,0.06)] bg-transparent font-semibold text-sm hover:bg-gray-100 transition flex items-center gap-1">
          Menu SIAKAD
        </button>
        <div class="dropdown-menu hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
          @php
            $menus = [
              ['label' => 'Mahasiswa', 'ctrl' => App\Http\Controllers\MahasiswaController::class],
              ['label' => 'Dosen', 'ctrl' => App\Http\Controllers\DosenController::class],
              ['label' => 'Jurusan', 'ctrl' => App\Http\Controllers\JurusanController::class],
              ['label' => 'Mata Kuliah', 'ctrl' => App\Http\Controllers\MatakuliahController::class],
              ['label' => 'Kelas', 'ctrl' => App\Http\Controllers\KelasController::class],
              ['label' => 'KRS', 'ctrl' => App\Http\Controllers\KRSController::class],
            ];
          @endphp
          @foreach($menus as $menu)
            @auth
              <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ action([$menu['ctrl'],'index']) }}">{{ $menu['label'] }}</a>
            @else
              <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100" href="{{ route('login', ['redirect'=>url()->current()]) }}">{{ $menu['label'] }} (Login untuk akses)</a>
            @endauth
          @endforeach
        </div>
      </div>

    </div>
  </div>
</nav>

<header class="relative w-full min-h-[640px] lg:h-screen overflow-hidden flex items-center bg-[#071024] py-12 lg:py-0" role="banner" aria-label="Penerimaan">
  <img class="absolute inset-0 w-full height-full object-cover object-center z-10 opacity-60" src="{{ asset('images/Gedung-ITBSS.jpg') }}" alt="Hero" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
  <div class="absolute inset-0 z-20 bg-gradient-to-r from-[#030a19]/90 via-[#030a19]/60 to-[#030a19]/20" aria-hidden="true"></div>

  <div class="relative z-30 max-w-[1180px] mx-auto w-full px-6 grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-8 items-center">
    <div class="text-white max-w-[68ch]">
      <span class="inline-block rounded-full px-3 py-1.5 text-xs font-semibold mb-4 bg-white/10 text-white border border-white/20">
        Penerimaan Mahasiswa Baru 2026/2027 Dibuka
      </span>
      <h1 class="font-extrabold leading-[1.05] text-[2rem] sm:text-[2.8rem] lg:text-[3.4rem] drop-shadow-[0_8px_28px_rgba(0,0,0,0.45)] mb-4">
        Wujudkan Masa Depan Bersama Institut Teknologi & Bisnis Sabda Setia
      </h1>
      <p class="text-white/90 text-sm sm:text-base lg:text-lg mb-6">
        Institut Teknologi & Bisnis Sabda Setia (ITBSS) berfokus pada pendidikan terapan, kewirausahaan dan pengalaman industri. Kunjungi situs resmi untuk informasi lengkap.
      </p>

      <div class="flex flex-wrap gap-3">
        <a class="bg-brand-blue text-white px-6 py-2.5 rounded font-medium hover:bg-blue-700 transition" href="https://itbss.pmbonline.siakad.tech/register" target="_blank" rel="noopener">{{ $tr['apply'] }}</a>
        <a class="border border-white text-white px-6 py-2.5 rounded font-medium hover:bg-white/10 transition" href="https://itbss.ac.id/" target="_blank" rel="noopener">{{ $tr['profile'] }}</a>
      </div>
    </div>

    <div class="w-full">
      <div class="rounded-xl bg-white shadow-[0_14px_40px_rgba(3,10,25,0.16)] overflow-hidden">
        <div class="p-6 text-dark">
          <h5 class="text-lg font-bold mb-4">📅 {{ $tr['agenda'] }}</h5>
      </div>
    </div>
  </div>
</header>

<main class="max-w-[1180px] mx-auto px-6 w-full flex-grow">
  
  <section class="my-12">
    <h2 class="text-3xl font-extrabold text-dark mb-6">{{ $tr['registration'] }}</h2>
    <div class="relative rounded-xl overflow-hidden bg-white shadow-sm">
      <img class="w-full h-auto object-cover rounded-xl" src="{{ asset('images/Website-PMB-26-27.jpg') }}" alt="Pendaftaran" loading="lazy" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
    </div>
  </section>

  <section class="my-12">
    <h2 class="text-3xl font-extrabold text-dark mb-2">{{ $tr['programs'] }}</h2>
    <p class="text-gray-600 mb-8 max-w-4xl">Pilih program studi yang sesuai dengan minat dan potensi Anda. ITBSS menawarkan tiga program unggulan yang dirancang untuk mempersiapkan Anda dalam menghadapi tantangan industri modern.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="rounded-xl shadow-[0_8px_24px_rgba(2,6,23,0.06)] p-6 bg-white flex flex-col items-center text-center transition hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-gradient-to-b from-[#eef5ff] to-[#e3efff] mb-4">
          <img class="w-9 h-9 object-contain" src="{{ asset('images/logo-SI.png') }}" alt="STI" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>
        <h6 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Program Studi</h6>
        <h5 class="text-lg font-bold text-dark mb-2">Sistem dan Teknologi Informasi</h5>
        <p class="text-sm text-gray-500">Praktik, project, dan peluang kerja industri.</p>
      </div>

      <div class="rounded-xl shadow-[0_8px_24px_rgba(2,6,23,0.06)] p-6 bg-white flex flex-col items-center text-center transition hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-gradient-to-b from-[#eef5ff] to-[#e3efff] mb-4">
          <img class="w-9 h-9 object-contain" src="{{ asset('images/logo-bd.png') }}" alt="BD" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>
        <h6 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Program Studi</h6>
        <h5 class="text-lg font-bold text-dark mb-2">Bisnis Digital</h5>
        <p class="text-sm text-gray-500">Kurikulum modern dan dukungan startup.</p>
      </div>

      <div class="rounded-xl shadow-[0_8px_24px_rgba(2,6,23,0.06)] p-6 bg-white flex flex-col items-center text-center transition hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-gradient-to-b from-[#eef5ff] to-[#e3efff] mb-4">
          <img class="w-9 h-9 object-contain" src="{{ asset('images/logo-kwu.png') }}" alt="KWU" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>
        <h6 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Program Studi</h6>
        <h5 class="text-lg font-bold text-dark mb-2">Kewirausahaan</h5>
        <p class="text-sm text-gray-500">Pendampingan & inkubasi usaha.</p>
      </div>
    </div>

    <div class="relative rounded-xl overflow-hidden bg-white shadow-sm mt-10 group">
      <div id="facilityCarousel" class="relative w-full h-[300px] sm:h-[450px] lg:h-[550px]">
        
        <div class="carousel-item active absolute inset-0 w-full h-full">
          <img class="w-full h-full object-cover" src="{{ asset('images/Gedung-ITBSS-scaled.jpg') }}" alt="Fasilitas ITBSS 1" loading="lazy" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>
        <div class="carousel-item absolute inset-0 w-full h-full">
          <img class="w-full h-full object-cover" src="{{ asset('images/photo-1.jpg') }}" alt="Fasilitas ITBSS 2" loading="lazy" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>
        <div class="carousel-item absolute inset-0 w-full h-full">
          <img class="w-full h-full object-cover" src="{{ asset('images/photo-2.jpg') }}" alt="Fasilitas ITBSS 3" loading="lazy" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>
        <div class="carousel-item absolute inset-0 w-full h-full">
          <img class="w-full h-full object-cover" src="{{ asset('images/photo-3.jpg') }}" alt="Fasilitas ITBSS 4" loading="lazy" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        </div>

        <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 text-white rounded-full p-2.5 z-40 opacity-0 group-hover:opacity-100 transition duration-300">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 text-white rounded-full p-2.5 z-40 opacity-0 group-hover:opacity-100 transition duration-300">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
  </section>

  <section class="my-12">
    <h2 class="text-3xl font-extrabold text-dark mb-6">{{ $tr['why'] }}</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-[#f9fbfd] rounded-xl p-8 border border-gray-100">
        <h5 class="text-xl font-bold text-dark mb-4">Komitmen ITBSS</h5>
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-4">ITBSS sangat bersemangat menyambut para mahasiswa pilihan yang ingin maju dan berkembang bersama kami. Kami berkomitmen membangun komunitas intelektual muda yang akan membawa dampak positif bagi bangsa dan negara.</p>
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Dengan teknologi terbaik dan fasilitas modern di Pontianak, ITBSS siap mendukung karir dan masa depan Anda dengan kurikulum terapan yang fokus pada kesiapan kerja industri.</p>
      </div>

      <div class="bg-[#f9fbfd] rounded-xl p-8 border border-gray-100">
        <h5 class="text-xl font-bold text-dark mb-4">{{ $tr['about'] }}</h5>
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-4">Institut Teknologi & Bisnis Sabda Setia (ITBSS) membawa pembaharuan dan standar terbaik dalam pendidikan tinggi di Pontianak, Kalimantan Barat. Didirikan tahun 2021, ITBSS berfokus pada pendidikan terapan yang mengintegrasikan teori dan praktik industri.</p>
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-4">Dengan pengalaman puluhan tahun dalam mengelola pendidikan, ITBSS menawarkan akses luas untuk berbagai kesempatan karir dan mendorong inovasi serta kewirausahaan.</p>
        <p><a class="text-brand-blue font-semibold hover:underline" href="https://itbss.ac.id/" target="_blank" rel="noopener">→ Kunjungi Website Resmi ITBSS</a></p>
      </div>
    </div>
  </section>

  <section class="my-12">
    <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-brand-blue">
      <h4 class="text-lg font-bold text-dark mb-2">Lokasi Kampus</h4>
      <p><a class="text-brand-blue hover:underline text-sm sm:text-base" href="https://www.google.com/maps/place/Institut+Teknologi+%26+Bisnis+Sabda+Setia/" target="_blank" rel="noopener">Jl. Purnama II, Pontianak Selatan, Kota Pontianak, Kalimantan Barat</a></p>
    </div>
  </section>
</main>

<footer class="bg-[#0b1724] text-white py-10 mt-12 w-full">
  <div class="max-w-[1180px] mx-auto px-6 text-center">
    <img src="{{ asset('images/Logo-White.png') }}" class="brightness-0 invert max-w-[200px] mx-auto block" alt="ITBSS White Logo" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
    <p class="text-white/90 text-sm mt-4">Copyright © 2026 Institut Teknologi & Bisnis Sabda Setia - Yvanna Sudarmo</p>
  </div>
</footer>

<script>
  // --- DROPPDOWN CONTROLLER ---
  document.querySelectorAll('.dropdown-toggle').