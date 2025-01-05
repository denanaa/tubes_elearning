<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($videoId)
    {
        $video = Video::with('module')->findOrFail($videoId); // Ambil video berdasarkan ID
        $otherVideos = Video::where('id_video', '!=', $videoId)
                            ->where('id_module', $video->id_module) // Ambil video dari modul yang sama
                            ->take(5)
                            ->get();
        
        return view('video', compact('video', 'otherVideos')); // Kirim data ke view
    }
}