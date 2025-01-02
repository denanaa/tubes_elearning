<?php

namespace App\Http\Controllers;
use App\Models\Video;
use App\Models\Modul;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('module')->get(); // Mengambil data video beserta relasi modul
        return view('data-video', compact('videos'));
    }

    public function create()
    {
        $modules = Modul::all();
        return view('create-video', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_module' => 'required|exists:modules,id_module',
            'title_video' => 'required|max:150',
            'link_video' => 'required|url',
            'thumbnail_video' => 'nullable|image',
            'description_video' => 'nullable',
        ]);

        $path = $request->file('thumbnail_video') 
            ? $request->file('thumbnail_video')->store('videos', 'public') 
            : null;

        Video::create([
            'id_module' => $request->id_module,
            'title_video' => $request->title_video,
            'link_video' => $request->link_video,
            'thumbnail_video' => $path,
            'description_video' => $request->description_video,
        ]);

        return redirect()->route('data-video')->with('success', 'Video added successfully.');
    }

    public function edit($id_video)
{
    $video = Video::findOrFail($id_video); // Ambil data video berdasarkan ID
    $modules = Modul::all(); // Ambil semua modul untuk dropdown
    return view('edit-video', compact('video', 'modules')); // Kirim data video dan modul ke view
}

    public function update(Request $request, $id_video)
{
    // Validasi input
    $request->validate([
        'id_module' => 'required|exists:modules,id_module', // Pastikan id_module valid
        'title_video' => 'required|max:150',
        'link_video' => 'required|url',
        'thumbnail_video' => 'nullable|image', // Jika ada file thumbnail, pastikan itu adalah gambar
        'description_video' => 'nullable', // Deskripsi video boleh kosong
    ]);

    $video = Video::findOrFail($id_video); // Ambil data video berdasarkan ID
    
    // Cek jika ada file gambar thumbnail, simpan gambar ke folder public
    if ($request->hasFile('thumbnail_video')) {
        $path = $request->file('thumbnail_video')->store('videos', 'public'); // Simpan gambar di folder 'videos'
        $video->thumbnail_video = $path; // Update field thumbnail_video dengan path baru
    }

    // Update video dengan data yang baru
    $video->update([
        'id_module' => $request->id_module, // Update id_module
        'title_video' => $request->title_video, // Update title_video
        'link_video' => $request->link_video, // Update link_video
        'description_video' => $request->description_video, // Update description_video jika ada
    ]);

    // Redirect ke halaman video dengan pesan sukses
    return redirect()->route('data-video')->with('success', 'Video updated successfully.');
}

    public function destroy($id_video)
    {
        $video = Video::findOrFail($id_video);
        $video->delete();
        return redirect()->route('data-video')->with('success', 'Video deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Ambil query dari input form
    
        if ($query) {
            $videos = Video::where('title_video', 'like', "%{$query}%")->paginate(10);
        } else {
            $videos = Video::paginate(10);
        }
    
        return view('data-video', compact('videos', 'query'));
    }
    

    public function liveSearch(Request $request)
    {
        $query = $request->input('query');
        $videos = Video::where('title_video', 'like', "%{$query}%")->get();
    
        return response()->json($videos);
    }
    
    
    public function loadAllVideos()
    {
        $videos = Video::all();
        return response()->json($videos);
    }
}