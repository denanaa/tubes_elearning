<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Bina Bahasa',
            'email' => 'adminbinabahasa@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // Pastikan ini sesuai dengan nilai yang diizinkan
        ]);
        
    }
}
