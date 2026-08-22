<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses autentikasi login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Selamat datang di SI-CUTE BNNK Malang!');
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda berhasil keluar dari sistem.');
    }

    // Menampilkan halaman profil
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    // Memproses update Email, Password, atau PIN
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // 1. Update Email
        if ($request->has('email') && $request->email != $user->email) {
            $request->validate(['email' => 'required|email|unique:users,email,' . $user->id]);
            $user->update(['email' => $request->email]);
            return back()->with('success', 'Email berhasil diperbarui!');
        }

        // 2. Update Password
        if ($request->has('new_password')) {
            $request->validate(['new_password' => 'required|min:6|confirmed']);
            $user->update(['password' => bcrypt($request->new_password)]);
            return back()->with('success', 'Kata sandi berhasil diperbarui!');
        }

        // 3. Update PIN
        if ($request->has('new_pin')) {
            $request->validate(['new_pin' => 'required|digits:6|confirmed']);
            $user->update(['pin' => bcrypt($request->new_pin)]);
            return back()->with('success', 'PIN Konfirmasi 6-Digit berhasil diperbarui!');
        }

        return back();
    }
}