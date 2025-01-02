<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show($type)
    {
        return view('content', ['type' => $type]);
    }

    public function index()
    {
        $categories = Category::all(); // Ambil semua data dari tabel categories
        return view('content', compact('categories')); // Kirim data ke view
    }

}