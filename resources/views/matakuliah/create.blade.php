<div class="w-full max-w-2xl bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.06)] overflow-hidden border border-gray-100">
    
    <!-- Header Form -->
    <div class="bg-dark p-6 text-white flex items-center gap-4">
        <div class="p-2.5 bg-white/10 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold tracking-wide">Form Tambah Mata Kuliah</h1>
            <p class="text-xs text-gray-300 mt-0.5">SIAKAD Institut Teknologi & Bisnis Sabda Setia</p>
        </div>
    </div>

    <!-- Form Body -->
    <form action="{{ route('matakuliah.store') }}" method="POST" class="p-6 space-y-5">
        @csrf

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 rounded-lg border border-red-200">
                <p class="font-semibold mb-1">Mohon periksa kembali inputan Anda:</p>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-dark mb-1">Nama Mata Kuliah</label>
                <input type="text" name="Nama_MK" value="{{ old('Nama_MK') }}" placeholder="Masukkan nama mata kuliah lengkap" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Kode Mata Kuliah</label>
                <input type="text" name="Kode_MK" value="{{ old('Kode_MK') }}" placeholder="Contoh: MK021" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-dark mb-1">SKS</label>
                <input type="number" name="SKS" value="{{ old('SKS') }}" min="1" max="6" placeholder="Contoh: 3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Jurusan ID</label>
                <input type="text" name="Jurusan_Id" value="{{ old('Jurusan_Id') }}" placeholder="Contoh: JR001" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Dosen ID</label>
                <input type="text" name="Dosen_Id" value="{{ old('Dosen_Id') }}" placeholder="Contoh: DSN002" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition" required>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
            <a href="{{ route('matakuliah.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm flex items-center justify-center">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-brand-blue text-white font-medium rounded-md hover:bg-blue-700 transition text-sm shadow-sm shadow-brand-blue/20">
                Simpan
            </button>
        </div>

    </form>
</div>