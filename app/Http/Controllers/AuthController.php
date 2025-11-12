<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔹 Tampilkan form register (khusus user biasa)
    public function showRegisterForm()
    {
        return view('auth.register-user');
    }

    // 🔹 Proses register (default = user)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // ✅ default user
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

        public function registerPenjual()
    {
        return view('auth.registerpenjual');
    }

    // 🔹 Proses register (default = user)
    public function submitRegistrasiPenjual(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'nama_toko' => 'required|string|max:150',
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'penjual',
        ]);

        Toko::create([
            'user_id'  => $user->id,
            'nama_toko' => $request->nama_toko,
            'alamat'    => $request->alamat,
            'kontak'    => $request->kontak,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 🔹 Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🔹 Proses login (cek role)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

           $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'penjual') {
            return redirect()->intended('/dashboardpenjual');
        } elseif ($user->role === 'user') {
            return redirect()->intended('/home');
        }elseif ($user->role === 'admin') {
            return redirect()->intended('/dashboard-admin');
        } else {
            Auth::logout(); // jika role tidak valid
            return redirect('/login')->withErrors([
                'message' => 'Role tidak dikenali. Silakan hubungi admin.',
            ]);
        }
    }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
