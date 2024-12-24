<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan admin ke tabel users
        User::create([
            'name' => 'Admin Bina Bahasa',
            'email' => 'adminbinabahasa@example.com', // Ganti dengan email yang diinginkan
            'password' => Hash::make('password123'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Menetapkan role sebagai admin
        ]);
    }
}
