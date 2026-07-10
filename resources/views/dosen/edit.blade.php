<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Edit Data Dosen</title>

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
        <h1 class="text-xl font-bold tracking-wide">Form Edit Data Dosen</h1>
        <p class="text-xs text-gray-300 mt-0.5">Mengubah data: <span class="text-white font-medium">{{ $dosen->Fullname }}</span></p>
      </div>
    </div>

    <!-- Form Utama -->
    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST" class="p-6 space-y-5">
      @csrf
      @method('PUT') <!-- Cara ringkas Laravel untuk spoofing metode PUT -->

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- Input ID Dosen (opsional karena sudah ada di rute aksi, tetap dipertahankan jika controller Anda membutuhkannya) -->
        <input type="hidden" name="id" value="{{ $dosen->id }}">

        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Nama Lengkap</label>
          <input type="text" name="Fullname" value="{{ old('Fullname', $dosen->Fullname) }}" placeholder="Masukkan nama lengkap beserta gelar" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nomor Induk Pengajar (NIP)</label>
          <input type="text" name="NIP" value="{{ old('NIP', $dosen->NIP) }}" placeholder="Contoh: 198901..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nomor Induk Dosen Nasional (NIDN)</label>
          <input type="text" name="NIDN" value="{{ old('NIDN', $dosen->NIDN) }}" placeholder="Contoh: 110203..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Pendidikan Terakhir</label>
          <input type="text" name="Pendidikan_Terakhir" value="{{ old('Pendidikan_Terakhir', $dosen->Pendidikan_Terakhir) }}" placeholder="Contoh: S2 Magister Komputer" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Jurusan</label>
          <input type="text" name="Jurusan_Id" value="{{ old('Jurusan_Id', $dosen->Jurusan_Id) }}" placeholder="ID Jurusan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Tempat Lahir</label>
          <input type="text" name="Tempat_Lahir" value="{{ old('Tempat_Lahir', $dosen->Tempat_Lahir) }}" placeholder="Contoh: Pontianak" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Tanggal Lahir</label>
          <!-- Mengubah tipe dari text ke date agar muncul datepicker bawaan browser -->
          <input type="date" name="Tanggal_Lahir" value="{{ old('Tanggal_Lahir', $dosen->Tanggal_Lahir) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Alamat</label>
          <textarea name="Alamat" rows="3" placeholder="Masukkan alamat lengkap rumah..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>{{ old('Alamat', $dosen->Alamat) }}</textarea>
        </div>

      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
        <a href="{{ route('dosen.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm flex items-center justify-center">
          Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-brand-blue text-white font-medium rounded-md hover:bg-blue-700 transition text-sm shadow-sm shadow-brand-blue/20">
          Update Data
        </button>
      </div>

    </form>
  </div>

</body>
</html>