<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk admin
     */
    public function adminDashboard()
    {
        // Pastikan hanya admin yang bisa mengakses halaman ini
        return view('dashboard'); // Ganti dengan view dashboard yang sesuai
    }
}