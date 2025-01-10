<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>BinaBahasa</title>
</head>
<body>
    <section class="p-10 bg-gradient-to-b from-[#37AFE1] -mb-20">
        <div class="flex items-center pl-10">
            <!-- tombol button back -->
            <button onclick="history.back()" class="btn bg-transparent hover:bg-white  px-6 py-3 rounded-full shadow-lg transition-all duration-300 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
              </svg>
              Back
            </button>
        </div>

        <!-- video youtube -->
        <iframe class="w-full aspect-video ... p-10" src="https://www.youtube.com/embed/{{ $youtubeVideo['id'] }}"></iframe>

        <!-- judul video -->
        <h1 class="text-4xl font-bold break-words pl-14">{{ $youtubeVideo['snippet']['title'] }}</h1>
        
        <!-- form desc -->
        <div class="flex flex-col lg:flex-row">
            <div class="p-10 w-full">
                <div class="hero bg-white min-h-32 rounded-lg">
                    <div class="hero-content flex-col lg:flex-row">
                        <div class="text-left">
                            <h1 class="text-4xl font-bold">Deskripsi</h1>
                            <p class="py-6">
                            {{ $youtubeVideo['snippet']['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- social media -->
            <div class="py-8 w-full lg:w-1/3">
                <div class="card w-full max-w-sm bg-white shadow-md p-4 mt-1">
                    <h3 class="text-lg font-semibold mb-2">Pengunggah Konten</h3>
                    <div class="flex items-center gap-2 mb-4 bg-gray-100 p-5 rounded-lg">
                    <div class="avatar">
                        <img 
                            src="{{ $channel['snippet']['thumbnails']['default']['url'] }}" 
                            alt="{{ $channel['snippet']['title'] }}" 
                            class="w-10 h-10 rounded-full"
                        >
                    </div>
                        <p class="font-medium">{{ $youtubeVideo['snippet']['channelTitle'] }}</p>
                            <a href="https://www.youtube.com/channel/{{ $youtubeVideo['snippet']['channelId'] }}" target="_blank" rel="noopener noreferrer" class="text-sm text-blue-500 hover:underline">
                                Kunjungi Channel
                            </a>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-semibold mb-2 mt-2">Topik Terkait</h3>
                    <div class="flex gap-2 mb-4">
                        <button class="btn btn-square btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </button>
                          
                        <button class="btn btn-square btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </button>
                          
                        <button class="btn btn-square btn-neutral">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"/>
                            </svg>
                        </button>
                        <button class="btn btn-square bg-pink-500 hover:bg-pink-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.333 3.608 1.308.975.975 1.246 2.242 1.308 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.246-3.608 1.308-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.333-3.608-1.308-.975-.975-1.246-2.242-1.308-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.062-1.366.333-2.633 1.308-3.608.975-.975 2.242-1.246 3.608-1.308 1.265-.058 1.645-.07 4.849-.07zm0-2.163c-3.259 0-3.67.014-4.947.072-1.317.059-2.781.351-3.83 1.4-1.049 1.049-1.341 2.513-1.4 3.83-.058 1.277-.072 1.688-.072 4.947s.014 3.67.072 4.947c.059 1.317.351 2.781 1.4 3.83 1.049 1.049 2.513 1.341 3.83 1.4 1.277.058 1.688.072 4.947.072s3.67-.014 4.947-.072c1.317-.059 2.781-.351 3.83-1.4 1.049-1.049 1.341-2.513 1.4-3.83.058-1.277.072-1.688.072-4.947s-.014-3.67-.072-4.947c-.059-1.317-.351-2.781-1.4-3.83-1.049-1.049-2.513-1.341-3.83-1.4-1.277-.058-1.688-.072-4.947-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.207 0-4-1.793-4-4s1.793-4 4-4 4 1.793 4 4-1.793 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.441s.645 1.441 1.441 1.441 1.441-.645 1.441-1.441-.645-1.441-1.441-1.441z" />
                            </svg>
                        </button>
                        <button class="btn btn-square btn-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                          </button>
                    </div>
                      
                    <a href="https://www.youtube.com/watch?v={{ $youtubeVideo['id'] }}" target="_blank" rel="noopener noreferrer" class="btn bg-blue-600 hover:bg-blue-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>Unduh</span>
                    </a>
                    
                </div>
            </div>
        </div>

<!-- Section for other videos -->
<section class="p-10 bg-white">
        <h2 class="text-3xl font-bold mb-6">Video Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($otherVideos as $otherVideo)
                <div class="card w-full bg-gray-100 shadow-lg rounded-lg overflow-hidden">
                    <a href="{{ route('video.show', ['videoId' => $otherVideo->id_video]) }}">
                        <img src="{{ asset('storage/' . $otherVideo->thumbnail_video) }}" alt="{{ $otherVideo->title_video }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $otherVideo->title_video }}</h3>
                            <p class="text-gray-600">{{ Str::limit($otherVideo->description_video, 100) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    </section>

</body>
</html>