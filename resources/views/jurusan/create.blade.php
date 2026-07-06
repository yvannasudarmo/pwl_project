<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Tambah Jurusan</title>

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
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-lg bg-dark flex items-center justify-center text-white font-black text-sm tracking-tighter">
            IT
          </div>
          <span class="font-bold text-dark text-base tracking-wide hidden sm:block">SIAKAD ITBSS</span>
        </div>

        <div class="flex space-x-1 sm:space-x-4">
          <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium text-gray-500 hover:text-dark transition">
            Mahasiswa
          </a>

          <a href="{{ route('dosen.index') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium text-gray-500 hover:text-dark transition">
            Dosen
          </a>

          <a href="#" class="inline-flex items-center px-3 pt-1 border-b-2 border-brand-blue text-sm font-bold text-brand-blue">
            Jurusan
          </a>
        </div>

        <div class="flex items-center">
          <div class="flex items-center gap-2 pl-3 border-l border-gray-200">
            <div class="w-8 h-8 rounded-full bg-brand-blue/10 flex items-center justify-center text-brand-blue font-semibold text-xs">
              AD
            </div>
            <span class="text-xs font-semibold text-gray-600 hidden md:block">Admin</span>
          </div>
        </div>

      </div>
    </div>
  </nav>

  <main class="flex-1 flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.06)] overflow-hidden border border-gray-100">
      
      <div class="bg-dark p-6 text-white flex items-center gap-4">
        <div class="p-2.5 bg-white/10 rounded-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
        </div>
        <div>
          <h1 class="text-xl font-bold tracking-wide">Form Tambah Jurusan</h1>
          <p class="text-xs text-gray-300 mt-0.5">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
        </div>
      </div>

      <form action="{{ route('jurusan.index') }}" method="POST" class="p-6 space-y-5">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-dark mb-1">Nama Jurusan</label>
            <input type="text" name="Nama_Jurusan" placeholder="Contoh: Teknik Informatika / Manajemen Bisnis" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-dark mb-1">Kode Jurusan</label>
            <input type="text" name="Kode_Jurusan" placeholder="Contoh: IF, MB, TI" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
          </div>

        </div>

        <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
          <button type="reset" class="px-5 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm">
            Clear
          </button>
          <button type="submit" class="px-6 py-2 bg-brand-blue text-white font-medium rounded-md hover:bg-blue-700 transition text-sm shadow-sm shadow-brand-blue/20">
            Add
          </button>
        </div>

      </form>
    </div>

  </main>

</body>
</html>