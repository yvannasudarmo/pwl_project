<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Edit Jurusan</title>

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

  <div class="w-full max-w-xl bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.06)] overflow-hidden border border-gray-100">
    
    <!-- Header Card -->
    <div class="bg-dark p-6 text-white flex items-center gap-4">
      <div class="p-2.5 bg-white/10 rounded-lg">
        <!-- Icon Edit/Pencil yang cocok untuk Update -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
      </div>
      <div>
        <h1 class="text-xl font-bold tracking-wide">Form Edit Jurusan</h1>
        <p class="text-xs text-gray-300 mt-0.5">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
      </div>
    </div>

    <!-- Form Main -->
    <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST" class="p-6 space-y-5">
      @csrf
      @method('PUT') <!-- Menggunakan direktif blade yang lebih rapi untuk spoofing method PUT -->

      <div class="space-y-4">
        
        <!-- Input Nama Jurusan -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nama Jurusan</label>
          <input type="text" name="Nama_Jurusan" value="{{ old('Nama_Jurusan', $jurusan->Nama_Jurusan) }}" placeholder="Contoh: Teknik Informatika" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
          @error('Nama_Jurusan') 
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
          @enderror
        </div>

        <!-- Input Kode Jurusan -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Kode Jurusan</label>
          <input type="text" name="Kode_Jurusan" value="{{ old('Kode_Jurusan', $jurusan->Kode_Jurusan) }}" placeholder="Contoh: TI / S1-TI" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
          @error('Kode_Jurusan') 
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
          @enderror
        </div>

      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
        <a href="{{ route('jurusan.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm flex items-center justify-center">
          Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-brand-blue text-white font-medium rounded-md hover:bg-blue-700 transition text-sm shadow-sm shadow-brand-blue/20">
          Perbarui Jurusan
        </button>
      </div>

    </form>
  </div>

</body>
</html>