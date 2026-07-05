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
    'home'=>'Home',
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
    'home'=>'Home',
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
        <img class="rounded-full" src="{{ asset('images/ITB-SS.jpg') }}" width="56" alt="ITBSS" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
        <span class="font-bold color-dark ml-2 hidden md:inline text-lg">Institut Teknologi & Bisnis Sabda Setia</span>
      </a>
    </div>

    <div class="flex-grow flex justify-center">
      <a class="text-[1.075rem] font-bold text-dark hover:text-brand-blue px-4 py-2 transition" href="{{ route('landing') }}">{{ $tr['home'] }}</a>
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
  <img class="absolute inset-0 w-full h-full object-cover object-center z-10 opacity-60" src="{{ asset('images/Gedung-ITBSS-scaled.jpg') }}" alt="Hero" onerror="this.onerror=null;this.src='{{ $svgPlaceholder }}'">
  <div class="absolute inset-0 z-20 bg-gradient-to-r from-[#030a19]/90 via-[#030a19]/60 to-[#030a19]/20" aria-hidden="true"></div>

  <div class="relative z-30 max-w-[1180px] mx-auto w-full px-6 grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-8 items-center">
    <div class="text-white max-w-[68ch]">
      <span class="inline-block rounded-full px-3 py-1.5 text-xs font-semibold mb-4 bg-white/10 text-white border border-white/20">
        Penerimaan Mahasiswa Baru 2026/2027 Dibuka
      </span>
      <h1 class="font-extrabold leading-[1.05] text-[2rem] sm