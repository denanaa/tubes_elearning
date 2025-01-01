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
        return view('create-kategori', compact('category')); // Use correct view name
    }

    public function update(Request $request, $id_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $category = Category::findOrFail($id_category);

        // Update category fields
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
            $category->update(['image' => $validated['image']]);
        }

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
}
