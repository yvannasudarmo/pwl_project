<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ... (fungsi index, create, store, dll bisa dibiarkan atau dihapus jika tidak dipakai)

    // Register Handler
    public function register(Request $request)
    {
        // 1. Validasi Input (Gunakan kebiasaan Laravel Web: back dengan error)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Buat User Baru
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        // 3. Otomatis Login setelah Register (Session-based)
        Auth::login($user);

        return redirect()->route('mahasiswa.index');
    }

    // Login Handler (Session-Based untuk Web/Blade)
    public function login(Request $request)
    {
        // 1. Validasi Input Form Login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            // 2. Lakukan Autentikasi Session
            // Atribut 'remember' opsional, bisa ditambah jika ada checkbox remember me
            if (Auth::attempt($credentials, $request->has('remember'))) {
                
                // 3. Regenerasi session untuk keamanan (mencegah Session Fixation)
                $request->session()->regenerate();

                // 4. Redirect ke halaman tujuan semula (misal setelah klik dropdown SIAKAD) atau ke default mahasiswa.index
                return redirect()->intended(route('mahasiswa.index'));
            }

            // Jika gagal login, kembali ke form dengan pesan error
            return redirect()->back()->withErrors([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ])->withInput($request->only('email'));

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }
    }

    // Register Form
    public function registerView(Request $request)
    {
        return view('register');
    }

    // Login Form
    public function loginView(Request $request)
    {
        return view('login');
    }

    // Logout Handler (Sudah Benar)
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Diarahkan kembali ke login atau dashboard
    }
}