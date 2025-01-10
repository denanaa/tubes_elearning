<?php

namespace App\Http\Controllers;

use App\Models\Video;
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
    $apiKey = 'AIzaSyB3IU_2Nn3rFaKaydfs9IX52D_OIBB_ke4';
    $youtubeApiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$video->link_video}&key={$apiKey}&part=snippet,contentDetails,statistics,status";

    // Tarik data dari YouTube API
    $response = Http::get($youtubeApiUrl);
    $videoData = $response->json();

    if (isset($videoData['items'][0])) {
        $youtubeVideo = $videoData['items'][0];

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

        return view('video', compact('video', 'otherVideos', 'youtubeVideo', 'channel'));
    } else {
        return abort(404, 'Video not found');
    }
}

}

