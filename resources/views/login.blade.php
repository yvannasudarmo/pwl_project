<!doctype html>
<html lang="{{ request('lang', app()->getLocale() ?? 'id') }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ITBSS - Login</title>

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
<body class="min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-md bg-white rounded-xl shadow-[0_14px_40px_rgba(3,10,25,0.08)] overflow-hidden border border-gray-100">
    
    <div class="bg-dark p-6 text-center text-white">
      <img class="rounded-full mx-auto mb-3" src="{{ asset('images/LOGO-ITBSS.png') }}" width="64" alt="ITBSS" onerror="this.onerror=null;this.style.display='none'">
      <h1 class="text-xl font-bold tracking-wide">SIAKAD ITBSS</h1>
      <p class="text-xs text-gray-300 mt-1">Silakan masuk menggunakan akun Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="p-6 space-y-4">
      @csrf

      <div>
        <label for="email" class="block text-sm font-semibold text-dark mb-1">Email</label>
        <input 
          type="email" 
          id="email"
          name="email" 
          placeholder="nama@itbss.ac.id" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition"
          required
          value="{{ old('email') }}"
        >
      </div>

      <div>
        <label for="password" class="block text-sm font-semibold text-dark mb-1">Password</label>
        <input 
          type="password" 
          id="password"
          name="password" 
          placeholder="••••••••" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue text-sm transition"
          required
        >
      </div>

      <div class="grid grid-cols-2 gap-3 pt-2">
        <a 
          href="{{ route('landing') }}" 
          class="w-full text-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 transition text-sm flex items-center justify-center"
        >
          Batal
        </a>
        <button 
          type="submit" 
          class="w-full px-4 py-2 bg-brand-blue text-white font-medium rounded-md hover:bg-blue-700 transition text-sm"
        >
          Login
        </button>
      </div>

    </form>

    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-center">
      <p class="text-xs text-gray-400">Copyright © 2026 ITB Sabda Setia</p>
    </div>

  </div>

</body>
</html>