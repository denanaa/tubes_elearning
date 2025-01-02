<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $modules = Modul::all(); // Ambil semua data dari tabel modul
        $videos = Video::all(); // Ambil semua data dari tabel videos
        return view('materi', compact('modules', 'videos')); // Kirim data ke view
    }

    public function showByCategory($categoryId)
    {
        $modules = Modul::where('id_category', $categoryId)->get(); // Ambil modul berdasarkan kategori yang dipilih
        $videos = Video::whereIn('id_module', $modules->pluck('id_module'))->get(); // Ambil video berdasarkan modul yang dipilih
        return view('materi', compact('modules', 'videos')); // Kirim data ke view
    }
}