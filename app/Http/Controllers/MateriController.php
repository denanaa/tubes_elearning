<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
// materi controller
class MateriController extends Controller
{
    // Menampilkan semua video dan modul
    public function index()
    {
        $modules = Modul::all(); // Ambil semua data dari tabel modul
        $videos = Video::all(3); // Ambil semua data dari tabel videos
        return view('materi', compact('modules', 'videos')); // Kirim data ke view
    }

    // Menampilkan video berdasarkan ID
    public function show($videoId)
    {
        $video = Video::findOrFail($videoId); // Ambil video berdasarkan ID
        return view('video', compact('video')); // Kirim data ke view
    }

     // Menampilkan video berdasarkan kategori yang dipilih
    public function showByCategory($categoryId)
    {
        $modules = Modul::where('id_category', $categoryId)->get(); // Ambil modul berdasarkan kategori
        $videos = Video::whereIn('id_module', $modules->pluck('id_module'))->paginate(3); // Ambil video berdasarkan modul dalam kategori tersebut
        return view('materi', compact('modules', 'videos', 'categoryId')); // Kirim data ke view
    }

    // Menampilkan video berdasarkan filter modul dan kategori
    public function filter(Request $request)
    {
        $moduleId = $request->input('id_module');
        $categoryId = $request->input('id_category');
    
        if (!$categoryId) {
            return response()->json(['error' => 'Invalid category ID'], 400);
        }

        // Query dengan modul jika dipilih
        $videosQuery = Video::whereHas('module', function ($query) use ($categoryId) {
            $query->where('id_category', $categoryId);
        });

        if ($moduleId) {
            $videosQuery->where('id_module', $moduleId);
        }

        // Pagination
        $videos = $videosQuery->paginate(3);

    
       // Map data untuk respons JSON
        $videos->getCollection()->transform(function ($video) {
            return [
                'id_video' => $video->id_video,
                'title_video' => $video->title_video,
                'description_video' => $video->description_video,
                'thumbnail_video' => $video->thumbnail_video,
                'module_name' => $video->module->name_module,
            ];
        });
    
        if ($videos->isEmpty()) {
            return response()->json([], 200);
        }
    
        return response()->json($videos, 200);
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $categoryId = $request->input('id_category', null);
        $moduleId = $request->input('id_module', null);

        $videosQuery = Video::with('module')
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->whereHas('module', function ($query) use ($categoryId) {
                    $query->where('id_category', $categoryId);
                });
            })
            ->when($moduleId, function ($q) use ($moduleId) {
                $q->where('id_module', $moduleId);
            })
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('title_video', 'LIKE', "%$query%")
                            ->orWhere('description_video', 'LIKE', "%$query%");
                });
            });

        // Pagination
        $videos = $videosQuery->paginate(3); // Paginate 3 items per page

        // Format data untuk respons JSON
        $formattedVideos = $videos->map(function ($video) {
            return [
                'id_video' => $video->id_video,
                'title_video' => $video->title_video,
                'description_video' => $video->description_video,
                'thumbnail_video' => $video->thumbnail_video,
                'module_name' => $video->module->name_module ?? 'Unknown Module',
            ];
        });

        $pagination = [
            'current_page' => $videos->currentPage(),
            'last_page' => $videos->lastPage(),
            'next_page_url' => $videos->nextPageUrl(),
            'prev_page_url' => $videos->previousPageUrl(),
        ];

        return response()->json([
            'videos' => $formattedVideos,
            'pagination' => $pagination,  // Mengirimkan informasi pagination
        ]);
    }



    

}
