<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Pengganti setup.php pada aplikasi PHP asli: membuat akun admin
 * default sekali saja jika belum ada. Jalankan dengan:
 *   php artisan db:seed
 *
 * Username & password default bisa diubah lewat SEED_ADMIN_USERNAME
 * dan SEED_ADMIN_PASSWORD di file .env. Segera ganti password admin
 * setelah login pertama kali (lewat menu Kelola Pengguna).
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $username = env('SEED_ADMIN_USERNAME', 'admin');
        $password = env('SEED_ADMIN_PASSWORD', 'admin');

        User::firstOrCreate(
            ['username' => $username],
            [
                'name' => 'Administrator',
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}
