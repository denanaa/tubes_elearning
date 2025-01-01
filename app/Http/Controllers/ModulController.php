<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        $modules = Modul::with('category')->get(); // Mengambil data modul beserta kategori
        $categories = Category::all(); // Ambil semua kategori
        return view('data-modul', compact('modules', 'categories'));
    }

    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('create-modul', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_module' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id_category',
        ]);

        Modul::create([
            'name_module' => $validated['name_module'],
            'id_category' => $validated['id_category'], // Perbaiki pemanggilan input
        ]);

        return redirect()->route('data-modul')->with('success', 'Modul berhasil ditambahkan');
    }

    public function edit($id_module)
    {
        $modul = Modul::findOrFail($id_module); // Ambil data modul berdasarkan ID
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('edit-modul', compact('modul', 'categories')); // Kembalikan tampilan edit-modul
    }

    public function update(Request $request, $id_module)
    {
        $request->validate([
            'name_module' => 'required|max:255',
            'id_category' => 'required|exists:categories,id_category',
        ]);

        $modul = Modul::findOrFail($id_module);
        $modul->update([
            'name_module' => $request->name_module,
            'id_category' => $request->id_category,
        ]);

        return redirect()->route('data-modul')->with('success', 'Modul berhasil diperbarui!');
    }

    public function destroy($id_module)
    {
        $modul = Modul::findOrFail($id_module);
        $modul->delete();

        return redirect()->route('data-modul')->with('success', 'Modul berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Ambil query dari input form

        if ($query) {
            $modules = Modul::where('name_module', 'like', "%{$query}%")
                            ->paginate(10);
        } else {
            $modules = Modul::paginate(10);
        }

        return view('data-modul', compact('modules', 'query'));
    }

    public function liveSearch(Request $request)
    {
        $query = $request->input('query');
        $modules = Modul::where('name_module', 'like', "%{$query}%")
                        ->with('category') // Pastikan mengambil kategori
                        ->get();
    
        return response()->json($modules);
    }
    

    public function loadAllModules()
    {
        $modules = Modul::all();
        return response()->json($modules);
    }
}
