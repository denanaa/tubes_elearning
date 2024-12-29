@extends('layouts.app')

@section('title', 'Add Data Video')
@section('header', 'Add Data Video')

@section('content')
<div class="container">
    <form>
        <div class="my-4 space-y-1">
            <label for="editTitle" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Title Video</label>
            <input type="text" id="editTitle" name="title" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Title Video">
        </div>
        <div class="my-4 space-y-1">
            <label for="editLink" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                Link Video
            </label>
            <input type="url" id="editLink" name="link" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="https://example.com/video">
        </div>            
        <div class="my-4 space-y-1">
            <label for="editImage" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Thumbnail Video</label>
            <input type="file" id="editImage" name="image" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Thumbnail Video" accept="images/*"
    onchange="previewImage(event)">
            <img id="imagePreview" src="" alt="Image Preview" class="w-52 h-32 mt-2 object-cover rounded-lg hidden">
        </div>
        <div class="my-4 space-y-1">
            <label for="editDescription" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description Video</label>
            <textarea type="text" id="editDescription" name="description" rows ="6" class="flex w-full px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Description Video"></textarea>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-500  px-3 py-2 text-sm font-semibold text-white shadow-sm ring-gray-300 hover:bg-blue-600 sm:mt-0 sm:w-auto">Save</button>
            <a href="{{ route('data-video') }}">
            <button type="button" onclick="hideEditModal()" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:ml-3 sm:w-auto">Cancel</button>
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

