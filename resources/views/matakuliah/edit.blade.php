<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Edit Mata Kuliah</title>

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
    
    <!-- Header Form -->
    <div class="bg-dark p-6 text-white flex items-center gap-4">
      <div class="p-2.5 bg-white/10 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
      </div>
      <div>
        <h1 class="text-xl font-bold tracking-wide">Form Edit Mata Kuliah</h1>
        <p class="text-xs text-gray-300 mt-0.5">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
      </div>
    </div>

    <!-- Form Body -->
    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST" class="p-6 space-y-5">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- Nama Mata Kuliah -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Nama Mata Kuliah</label>
          <input type="text" name="Nama_MK" value="{{ old('Nama_MK', $matakuliah->Nama_MK) }}" placeholder="Masukkan nama mata kuliah lengkap" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition @error('Nama_MK') border-red-500 focus:ring-red-200 @enderror" required>
          @error('Nama_MK')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Kode Mata Kuliah -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Kode Mata Kuliah</label>
          <input type="text" name="Kode_MK" value="{{ old('Kode_MK', $matakuliah->Kode_MK) }}" placeholder="Contoh: MK021" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition @error('Kode_MK') border-red-500 focus:ring-red-200 @enderror" required>
          @error('Kode_MK')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- SKS -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">SKS</label>
          <input type="number" name="SKS" value="{{ old('SKS', $matakuliah->SKS) }}" min="1" max="6" placeholder="Contoh: 3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition @error('SKS') border-red-500 focus:ring-red-200 @enderror" required>
          @error('SKS')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Jurusan ID -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Jurusan ID</label>
          <input type="text" name="Jurusan_Id" value="{{ old('Jurusan_Id', $matakuliah->Jurusan_Id) }}" placeholder="Contoh: JR001" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition @error('Jurusan_Id') border-red-500 focus:ring-red-200 @enderror" required>
          @error('Jurusan_Id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Dosen ID -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Dosen ID</label>
          <input type="text" name="Dosen_Id" value="{{ old('Dosen_Id', $matakuliah->Dosen_Id) }}" placeholder="Contoh: DSN002" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition @error('Dosen_Id') border-red-500 focus:ring-red-200 @enderror" required>
          @error('Dosen_Id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
        <a href="{{ route('matakuliah.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm flex items-center justify-center">
          Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-brand-blue text-white font-medium rounded-md hover:bg-blue-700 transition text-sm shadow-sm shadow-brand-blue/20">
          Perbarui
        </button>
      </div>

    </form>
  </div>

</body>
</html>