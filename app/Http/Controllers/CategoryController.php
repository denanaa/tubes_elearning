<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

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

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('data-kategori')->with('success', 'Category added successfully.');
    }

    public function edit($id_category)
    {
        $category = Category::findOrFail($id_category);
        return view('create-kategori', compact('category'));
    }

    public function update(Request $request, $id_category)
    {


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $category = Category::findOrFail($id_category);
        // $category->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        // ]);

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('data-kategori')->with('success', 'Category updated successfully.');
    }

    public function destroy($id_category)
    {
        $category = Category::findOrFail($id_category);
        if ($category->image) {
            Storage::delete('public/' . $category->image);
        }
        $category->delete();

        return redirect()->route('data-kategori')->with('success', 'Category deleted successfully.');
    }


}
