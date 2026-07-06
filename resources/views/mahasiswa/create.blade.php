<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Tambah Mahasiswa</title>

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
<body class="min-h-screen flex items-center justify-center p-6">

  <div class="w-full max-w-2xl bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.06)] overflow-hidden border border-gray-100">
    
    <div class="bg-dark p-6 text-white flex items-center gap-4">
      <div class="p-2.5 bg-white/10 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
      </div>
      <div>
        <h1 class="text-xl font-bold tracking-wide">Form Tambah Mahasiswa</h1>
        <p class="text-xs text-gray-300 mt-0.5">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
      </div>
    </div>

    <form action="{{ route('mahasiswa.index') }}" method="POST" class="p-6 space-y-5">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Nama Lengkap</label>
          <input type="text" name="Fullname" placeholder="Masukkan nama lengkap mahasiswa" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nomor Induk Mahasiswa (NIM)</label>
          <input type="text" name="NIM" placeholder="Contoh: 202610..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nomor Induk Siswa Nasional (NISN)</label>
          <input type="text" name="NISN" placeholder="Contoh: 004523..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Tempat Lahir</label>
          <input type="text" name="Tempat_Lahir" placeholder="Contoh: Pontianak" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Tanggal Lahir</label>
          <input type="date" name="Tanggal_Lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Alamat</label>
          <textarea name="Alamat" rows="3" placeholder="Masukkan alamat lengkap tempat tinggal sekarang..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required></textarea>
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

</body>
</html>