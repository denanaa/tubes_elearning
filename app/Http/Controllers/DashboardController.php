<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Modul;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk admin
     */
    public function adminDashboard()
    {
        // Mengambil jumlah data dari masing-masing tabel
        $totalUsers = User::count();
        $totalCategory = Category::count();
        $totalModul = Modul::count();
        $totalVideo = Video::count();

        // Mengirimkan data ke view
        return view('dashboard', compact('totalUsers', 'totalCategory', 'totalModul', 'totalVideo'));
    }
}
