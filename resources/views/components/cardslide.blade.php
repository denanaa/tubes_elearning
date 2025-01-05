<a href="{{ route('video.show', ['videoId' => $video->id_video]) }}" class="block">
    <div class="card w-full sm:w-80 lg:w-96 bg-white shadow-lg rounded-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border hover:border-[#2E91C2]">
        <figure class="aspect-video">
            <img src="{{ asset('storage/' . $video->thumbnail_video) }}" alt="{{ $video->title_video }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
        </figure>
        <div class="card-body text-left p-4">
            <h2 class="text-lg font-bold text-gray-800">{{ $video->title_video }}</h2>
            <p class="text-gray-600">{{ $video->description_video }}</p>
            <p class="text-right text-blue-600">{{ $video->module->name_module }}</p>
        </div>
    </div>
</a>
