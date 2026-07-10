<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Data Jurusan</title>

  <!-- Tailwind CSS -->
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
<body class="min-h-screen p-6 flex justify-center items-start">

  <!-- Container Utama -->
  <div class="w-full max-w-[1000px] bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.06)] overflow-hidden border border-gray-100">
    
    <!-- Header Page -->
    <div class="bg-dark p-6 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-xl font-bold tracking-wide">Daftar Jurusan / Program Studi</h1>
        <p class="text-xs text-gray-300 mt-0.5">Manajemen Program Pendidikan SIAKAD ITBSS</p>
      </div>
      
      <!-- Tombol Create -->
      <!-- Catatan: Ganti ke rute 'jurusan.add' atau 'jurusan.create' jika ada rute khusus form -->
      <a href="{{ route('jurusan.index') }}" class="inline-flex items-center gap-2 bg-brand-blue hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-md transition shadow-sm shadow-brand-blue/20 self-start sm:self-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Jurusan
      </a>
    </div>

    <!-- Container Tabel (Responsive Scroll) -->
    <div class="w-full overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-600">
            <th class="px-6 py-3 text-center w-20">No</th>
            <th class="px-6 py-3">Nama Jurusan</th>
            <th class="px-6 py-3">Kode Jurusan</th>
            <th class="px-6 py-3">Tanggal Dibuat</th>
            <th class="px-6 py-3 text-center w-40">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
          @forelse ($jurusan as $j)
            <tr class="hover:bg-blue-50/40 transition duration-150">
              <td class="px-6 py-4 text-center font-medium text-gray-500">{{ $loop->iteration }}</td>
              <td class="px-6 py-4 font-semibold text-dark">{{ $j->Nama_Jurusan }}</td>
              <td class="px-6 py-4">
                <span class="px-2.5 py-1 bg-blue-50 text-brand-blue rounded font-mono text-xs font-medium border border-blue-100">
                  {{ $j->Kode_Jurusan }}
                </span>
              </td>
              <td class="px-6 py-4 text-xs text-gray-400">
                <span class="block text-gray-600">{{ $j->created_at ? $j->created_at->format('d M Y') : '-' }}</span>
                <span class="block text-[10px] text-gray-400">Updated: {{ $j->updated_at ? $j->updated_at->format('d/m/Y') : '-' }}</span>
              </td>
              <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                  <!-- Tombol Edit -->
                  <a href="{{ route('jurusan.update', $j->id) }}" class="px-2.5 py-1.5 border border-gray-300 text-gray-700 rounded-md text-xs font-medium hover:bg-gray-100 transition">
                    Edit
                  </a>

                  <!-- Form Delete -->
                  <form action="{{ route('jurusan.delete', $j->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-2.5 py-1.5 bg-red-50 text-red-600 rounded-md text-xs font-medium hover:bg-red-100 transition">
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic bg-gray-50/50">
                Belum ada data jurusan yang tersedia.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Page -->
    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-right">
      <p class="text-xs text-gray-400">SIAKAD ITB Sabda Setia © 2026</p>
    </div>

  </div>

</body>
</html>