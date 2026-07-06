<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Data Dosen</title>

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

  <div class="w-full max-w-[1200px] bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.06)] overflow-hidden border border-gray-100">
    
    <div class="bg-dark p-6 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-xl font-bold tracking-wide">Daftar Data Dosen</h1>
        <p class="text-xs text-gray-300 mt-0.5">Manajemen Data Pengajar SIAKAD ITBSS</p>
      </div>
      
        <a href="{{ action([App\Http\Controllers\DosenController::class, 'create']) }}" class="btn btn-create shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Dosen
      </a>
    </div>

    <div class="w-full overflow-x-auto">
      <table class="w-full text-left border-collapse min-w-[1000px]">
        <thead>
          <tr class="bg-gray-100 border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-600">
            <th class="px-4 py-3 text-center">No</th>
            <th class="px-4 py-3">Nama Lengkap</th>
            <th class="px-4 py-3">NIP</th>
            <th class="px-4 py-3">NIDN</th>
            <th class="px-4 py-3">Pendidikan</th>
            <th class="px-4 py-3">Jurusan</th>
            <th class="px-4 py-3">Tempat, Tgl Lahir</th>
            <th class="px-4 py-3">Alamat</th>
            <th class="px-4 py-3">Tanggal Dibuat</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
          @php $no = 1; @endphp
          @forelse ($dosen as $d)
            <tr class="hover:bg-blue-50/40 transition duration-150">
              <td class="px-4 py-3.5 text-center font-medium text-gray-500">{{ $loop->iteration }}</td>
              <td class="px-4 py-3.5 font-semibold text-dark">{{ $d->Fullname }}</td>
              <td class="px-4 py-3.5 font-mono text-xs">{{ $d->NIP }}</td>
              <td class="px-4 py-3.5 font-mono text-xs">{{ $d->NIDN }}</td>
              <td class="px-4 py-3.5"><span class="px-2 py-1 bg-gray-100 rounded text-xs text-gray-600 font-medium">{{ $d->Pendidikan_Terakhir }}</span></td>
              <td class="px-4 py-3.5 text-xs">{{ $d->Jurusan_Id }}</td>
              <td class="px-4 py-3.5">
                <span class="block text-dark">{{ $d->Tempat_Lahir }}</span>
                <span class="block text-xs text-gray-400">{{ $d->Tanggal_Lahir }}</span>
              </td>
              <td class="px-4 py-3.5 text-xs max-w-[180px] truncate" title="{{ $d->Alamat }}">{{ $d->Alamat }}</td>
              <td class="px-4 py-3.5 text-xs text-gray-400">
                {{ $d->created_at ? $d->created_at->format('d M Y') : '-' }}
              </td>
              <td class="px-4 py-3.5">
                <div class="flex items-center justify-center gap-2">
                  <a href="{{ route('dosen.update', $d->id) }}" class="px-2.5 py-1.5 border border-gray-300 text-gray-700 rounded-md text-xs font-medium hover:bg-gray-100 transition">
                    Edit
                  </a>

                  <form action="{{ route('dosen.delete', $d->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?')">
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
              <td colspan="10" class="px-4 py-8 text-center text-gray-400 italic bg-gray-50/50">
                Belum ada data dosen yang tersimpan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-right">
      <p class="text-xs text-gray-400">SIAKAD ITB Sabda Setia © 2026</p>
    </div>

  </div>

</body>
</html>