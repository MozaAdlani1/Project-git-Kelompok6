<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // MENCARI BERDASARKAN nama_lengkap SESUAI DB KAMU
        $user = User::where('nama_lengkap', $request->username)->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'Username atau Password salah!'
            ]);
        }

        $loginBerhasil = false;

        // Cek jika password disimpan sebagai teks biasa (seperti 12345)
        if ($user->password === $request->password) {
            $loginBerhasil = true;
        }

        // Cek jika password menggunakan Hash (seperti data dokter)
        if (
            !$loginBerhasil &&
            str_starts_with($user->password, '$2y$')
        ) {
            $loginBerhasil = Hash::check(
                $request->password,
                $user->password
            );
        }

        if (!$loginBerhasil) {
            return back()->withErrors([
                'login' => 'Username atau Password salah!'
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole($user->role);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function redirectByRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'dokter':
                return redirect('/dokter/dashboard');
            case 'apoteker':
                return redirect('/apoteker');
            default:
                Auth::logout();
                return redirect('/login');
        }
    }
}