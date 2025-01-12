@extends('layouts.app')

@section('title', 'Add Data Video')
@section('header', 'Add Data Video')

@section('content')
<div class="container">
    <form action="{{ isset($video) ? route('update-video', $video->id_video) : route('store-video') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($video))
            @method('PUT')
        @endif

        <div class="my-4 space-y-1">
            <label for="idModule" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Module</label>
            <select id="idModule" name="id_module" 
                class="flex w-full max-w-xs h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" 
                required>
                <option value="" disabled {{ !isset($video) ? 'selected' : '' }}>Select a module</option>
                @foreach($modules as $module)
                    <option value="{{ $module->id_module }}" 
                        {{ isset($video) && $video->id_module == $module->id_module ? 'selected' : '' }}>
                        {{ $module->name_module }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="my-4 space-y-1">
            <label for="titleVideo" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Title Video</label>
            <input type="text" id="titleVideo" name="title_video" 
                value="{{ old('title_video', $video->title_video ?? '') }}" 
                class="flex w-full max-w-xs h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" 
                placeholder="Title Video" required>
        </div>

        <div class="my-4 space-y-1">
            <label for="linkVideo" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Link Video</label>
            <input type="text" id="linkVideo" name="link_video" 
                value="{{ old('link_video', $video->link_video ?? '') }}" 
                class="flex w-full max-w-xs h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" 
                placeholder="ID Video" required>
        </div>

        <div class="my-4 space-y-1">
            <label for="thumbnailVideo" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Thumbnail Video</label>
            <input type="file" id="thumbnailVideo" name="thumbnail_video" 
                class="flex w-full max-w-xs px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" 
                accept="image/*" onchange="previewImage(event)">
            <img id="imagePreview" src="{{ isset($video->thumbnail_video) ? asset('storage/' . $video->thumbnail_video) : '' }}" 
                alt="Image Preview" class="w-52 h-32 mt-2 object-cover rounded-lg {{ isset($video->thumbnail_video) ? '' : 'hidden' }}">
        </div>

        <div class="my-4 space-y-1">
            <label for="descriptionVideo" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description Video</label>
            <textarea id="descriptionVideo" name="description_video" rows="6" 
                class="flex w-full px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" 
                placeholder="Description Video">{{ old('description_video', $video->description_video ?? '') }}</textarea>
        </div>

        <div class="flex justify-start">
            <button type="submit" class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-gray-300 hover:bg-blue-600 sm:mt-0 sm:w-auto">Save</button>
            <a href="{{ route('data-video') }}">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:ml-3 sm:w-auto">Cancel</button>
            </a>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                imagePreview.src = reader.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('hidden');
        }
    }
</script>
@endsection