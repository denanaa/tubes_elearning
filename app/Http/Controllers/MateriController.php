<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // Menampilkan semua video dan modul
    public function index()
    {
        $modules = Modul::all(); // Ambil semua data dari tabel modul
        $videos = Video::all(3); // Ambil semua data dari tabel videos
        return view('materi', compact('modules', 'videos')); // Kirim data ke view
    }

    // Menampilkan video berdasarkan kategori yang dipilih
    public function showByCategory($categoryId)
    {
        $modules = Modul::where('id_category', $categoryId)->get(); // Ambil modul berdasarkan kategori
        $videos = Video::whereIn('id_module', $modules->pluck('id_module'))->paginate(3); // Ambil video berdasarkan modul dalam kategori tersebut
        return view('materi', compact('modules', 'videos')); // Kirim data ke view
    }

    // Menampilkan video berdasarkan ID
    public function show($videoId)
    {
        $video = Video::findOrFail($videoId); // Ambil video berdasarkan ID
        return view('video', compact('video')); // Kirim data ke view
    }

    // Menampilkan video berdasarkan filter modul dan kategori
    public function filter(Request $request)
    {
        $moduleId = $request->input('id_module'); // Ambil ID modul dari query string
        $categoryId = $request->input('id_category'); // Ambil ID kategori dari query string

        // Ambil semua modul berdasarkan kategori yang dipilih
        $modules = Modul::where('id_category', $categoryId)->get();

        // Ambil video berdasarkan modul yang dipilih dan memastikan id_category sesuai
        $videos = Video::where('id_module', $moduleId)
                        ->where('id_category', $categoryId) // Pastikan video sesuai dengan kategori yang dipilih
                        ->get();

        return view('materi', compact('modules', 'videos')); // Kirim data ke view
    }


}
