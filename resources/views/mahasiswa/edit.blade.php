<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Edit Mahasiswa</title>

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
        <!-- Icon Edit User -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
      </div>
      <div>
        <h1 class="text-xl font-bold tracking-wide">Form Edit Mahasiswa</h1>
        <p class="text-xs text-gray-300 mt-0.5">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
      </div>
    </div>

    <!-- Form Action -->
    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="p-6 space-y-5">
      @csrf
      @method('PUT') <!-- Menggantikan input hidden _method manual -->

      <!-- Menampilkan Error Validasi Jika Ada -->
      @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 rounded-lg border border-red-200">
          <p class="font-semibold">Mohon periksa kembali inputan Anda:</p>
          <ul class="list-disc pl-5 mt-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- Nama Lengkap -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Nama Lengkap</label>
          <input type="text" name="Fullname" value="{{ old('Fullname', $mahasiswa->Fullname) }}" placeholder="Masukkan nama lengkap mahasiswa" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <!-- NIM -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nomor Induk Mahasiswa (NIM)</label>
          <input type="text" name="NIM" value="{{ old('NIM', $mahasiswa->NIM) }}" placeholder="Contoh: 202610..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <!-- NISN -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Nomor Induk Siswa Nasional (NISN)</label>
          <input type="text" name="NISN" value="{{ old('NISN', $mahasiswa->NISN) }}" placeholder="Contoh: 004523..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <!-- Tempat Lahir -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Tempat Lahir</label>
          <input type="text" name="Tempat_Lahir" value="{{ old('Tempat_Lahir', $mahasiswa->Tempat_Lahir) }}" placeholder="Contoh: Pontianak" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <!-- Tanggal Lahir (Diubah type ke 'date' agar memunculkan date picker) -->
        <div>
          <label class="block text-sm font-semibold text-dark mb-1">Tanggal Lahir</label>
          <input type="date" name="Tanggal_Lahir" value="{{ old('Tanggal_Lahir', $mahasiswa->Tanggal_Lahir) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
        </div>

        <!-- Alamat -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-dark mb-1">Alamat</label>
          <textarea name="Alamat" rows="3" placeholder="Masukkan alamat lengkap..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>{{ old('Alamat', $mahasiswa->Alamat) }}</textarea>
        </div>

      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
        <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm flex items-center justify-center">
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