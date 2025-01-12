<?php

namespace App\Http\Controllers;
use App\Models\Video;
use App\Models\Modul;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    public function show($videoId)
{
    $video = Video::with('module')->findOrFail($videoId); // Ambil video berdasarkan ID
    $otherVideos = Video::where('id_video', '!=', $videoId)
                        ->where('id_module', $video->id_module) // Ambil video dari modul yang sama
                        ->take(5)
                        ->get();

    // Ganti dengan API Key Anda
    $apiKey = config('services.youtube.key');
    $youtubeApiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$video->link_video}&key={$apiKey}&part=snippet,contentDetails,statistics,status";

    // Tarik data dari YouTube API
    $response = Http::get($youtubeApiUrl);
    $videoData = $response->json();

    if (isset($videoData['items'][0])) {
        $youtubeVideo = $videoData['items'][0]; // Data video dari YouTube API

        // Ambil channelId dari video
        $channelId = $youtubeVideo['snippet']['channelId'];

        // Tarik data channel dari YouTube API
        $channelApiUrl = "https://www.googleapis.com/youtube/v3/channels?id={$channelId}&key={$apiKey}&part=snippet";
        $channelResponse = Http::get($channelApiUrl);
        $channelData = $channelResponse->json();

        if (isset($channelData['items'][0])) {
            $channel = $channelData['items'][0]; // Data channel
        } else {
            $channel = null; // Fallback jika data channel tidak ditemukan
        }

        // Kirim data ke view
        return view('video', compact('video', 'otherVideos', 'youtubeVideo', 'channel'));
    } else {
        return abort(404, 'Video not found');
    }
}


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
            'link_video' => 'required|string',
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
        'link_video' => 'required|string',
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
            $videos = Video::with('modules')
                           ->where('title_video', 'like', "%{$query}%")
                           ->paginate(10);

        } else {
            $videos = Video::paginate(10);
        }
    
        return view('data-video', compact('videos', 'query'));
    }
    

    public function liveSearch(Request $request)
    {
        $query = $request->input('query');
        $videos = Video::with('module')
                   ->where('title_video', 'like', "%{$query}%")
                   ->orWhereHas('module', function ($q) use ($query) {
                   $q->where('name_module', 'like', "%{$query}%");
                   })
                   ->get();
        return response()->json($videos);
    }
    
    
    public function loadAllVideos()
    {
        $videos = Video::with('module')
                        ->where('title_video', 'like', "%{$query}%") // Pencarian berdasarkan judul video
                        ->orWhereHas('module', function ($q) use ($query) { // Pencarian berdasarkan judul modul
                        $q->where('name_module', 'like', "%{$query}%");
    })
    ->get();    
        return response()->json($videos);
    }

    public function generatePDF()
{
    $videos = Video::with('module')->get(); // Pastikan relasi 'module' sudah diatur di model Video
    $pdf = Pdf::loadView('pdf-videos', compact('videos'));
    return $pdf->download('data_videos.pdf');
}
}