<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // KITA TAMBAHKAN CHECKING INI:
        // Jika aplikasi sedang berjalan di CLI (seperti saat proses install/deploy),
        // maka kodingan ini TIDAK AKAN DIJALANKAN.
        if (App::runningInConsole()) {
            return;
        }

        if (Schema::hasTable('users')) {
            if (!User::where('nama_lengkap', 'syarropal')->exists()) {
                User::create([
                    'nama_lengkap' => 'syarropal',
                    'username' => 'syarropal@gmail.com',
                    'role' => 'admin',
                    'password' => '12345',
                ]);
            }
        }
    }
}