<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Mengecek apakah tabel users sudah ada
        if (Schema::hasTable('users')) {
            // Mengecek berdasarkan nama_lengkap (identitas login kamu)
            if (!User::where('nama_lengkap', 'syarropal')->exists()) {
                User::create([
                    'nama_lengkap' => 'syarropal',
                    'username' => 'syarropal@gmail.com',
                    'role' => 'admin',
                    'password' => '12345', // Plain text agar terbaca oleh AuthController
                ]);
            }
        }
    }
}