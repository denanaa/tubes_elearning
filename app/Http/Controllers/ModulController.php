<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{

    public function index()
{
    $moduls = Modul::with('category')->get(); // Mengambil data modul beserta kategori
    return view('data-modul', compact('moduls'));
}

    public function create()
{
    $categories = Category::all(); // Ambil semua kategori
    return view('create-modul', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name_module' => 'required|string|max:100',
        'id_category' => 'required|exists:categories,id_category', // Validasi jika id_category ada di tabel categories
    ]);

    Modul::create([
        'name_module' => $request->name_module,
        'id_category' => $request->id_category,
    ]);

    return redirect()->route('data-modul')->with('success', 'Modul berhasil ditambahkan');
}



}
