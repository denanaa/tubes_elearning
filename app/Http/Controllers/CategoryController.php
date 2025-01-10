<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('data-kategori', compact('categories'));
    }

    public function create()
    {
        return view('create-kategori');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Jika ada file gambar, simpan gambar dan tambahkan path ke data
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        // Menyimpan data kategori ke database
        Category::create($validated);

        return redirect()->route('data-kategori')->with('success', 'Category added successfully.');
    }

    public function edit($id_category)
    {
        $category = Category::findOrFail($id_category);
        return view('edit-kategori', compact('category')); // Mengirim data category ke view
    }

    public function update(Request $request, $id_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Cari kategori berdasarkan ID
        $category = Category::findOrFail($id_category);

        // Update field nama dan deskripsi
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Jika ada gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }

            // Simpan gambar baru dan update pathnya
            $validated['image'] = $request->file('image')->store('categories', 'public');
            $category->update(['image' => $validated['image']]);
        }

        return redirect()->route('data-kategori')->with('success', 'Category updated successfully.');
    }

    public function destroy($id_category)
    {
        $category = Category::findOrFail($id_category);

        // Hapus gambar jika ada
        if ($category->image) {
            Storage::delete('public/' . $category->image);
        }

        // Hapus kategori dari database
        $category->delete();

        return redirect()->route('data-kategori')->with('success', 'Category deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $categories = Category::where('name', 'like', "%{$query}%")
                ->paginate(10);
        } else {
            $categories = Category::paginate(10);
        }

        return view('data-kategori', compact('categories', 'query'));
    }

    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $categories = Category::where('name', 'like', "%{$query}%")->get();
        } else {
            $categories = [];
        }

        return response()->json($categories);
    }

    public function loadAllCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }


    public function generatePDF()
    {
        $categories = Category::all(); // Pastikan model Category sudah benar
        $pdf = Pdf::loadView('pdf-categories', compact('categories'));
        return $pdf->download('data_categories.pdf');
    }
}
