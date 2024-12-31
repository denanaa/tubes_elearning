@extends('layouts.app')

@section('title', 'Data Video')
@section('header', 'Data Video')

@section('content')
<div class="flex items-center mb-4">
    <div class="relative">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
    </div>
    <input type="text" placeholder="Cari..." class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 ">
</div>
    <a href="{{ route('create-video') }}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 ml-4 focus:outline-none">Add Video</a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-[#37AFE1] text-center">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Name Modul
                </th>
                <th scope="col" class="px-6 py-3">
                    Title Video
                </th>
                <th scope="col" class="px-6 py-3">
                    Link Video
                </th>
                <th scope="col" class="px-6 py-3">
                    Thumbnail Video
                </th>
                <th scope="col" class="px-6 py-3">
                    Description Video
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $index => $video)
            <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                <td class="px-6 py-4">
                    {{ $index + 1 }}
                </td>
                <td class="px-6 py-4">{{ $video->module->name_module }}</td>
                <td class="px-6 py-4">
                    {{ $video->title_video }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ $video->link_video }}" class="underline text-blue-600 hover:text-blue-300">{{ $video->link_video }}</a>
                </td>
                <td class="px-6 py-4">
                    <img src="{{ asset('storage/' . $video->thumbnail_video) }}" alt="Thumbnail" class="w-24 h-16 object-cover mx-auto rounded-lg">
                </td>
                <td class="px-6 py-4 w-[30%] text-left">
                    {{ $video->description_video }}                
                </td>
                <td class="px-6 py-4">
                    <button type="button" onclick="showEditModal('{{ $video->id_video }}', '{{ $video->title_video }}', '{{ $video->link_video }}', '{{ asset('storage/' . $video->thumbnail_video) }}', '{{ $video->description_video }}')" class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">
                        Edit
                    </button>
                    <button type="button" onclick="showDeleteModal('{{ $video->id_video }}')"  class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
</div>

@foreach ($videos as $video)
<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6  w-[90%] max-w-lg border rounded-lg shadow-sm bg-card text-neutral-900">
        <h3 class="text-base font-semibold text-gray-90 mb-4">Edit Data Video</h3>
        <p class="mb-4 text-sm text-gray-500">Update video details here. Click 'Save' to apply changes or 'Cancel' to discard them..</p>
        <form action="{{ route('update-video', $video->id_video) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" name="id" value="{{ $video->id_video }}">
            
            <div class="my-4 space-y-1">
                <label for="editModul" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Modul</label>
                <select id="editModul" name="id_module" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                    {{-- <option value="" disabled {{ !isset($video) ? 'selected' : '' }}>Select a module</option>
                    @foreach($modules as $modul)
                        <option value="{{ $modul->id_module }}" 
                            {{ isset($video) && $video->id_module == $modul->id_module ? 'selected' : '' }}>
                            {{ $modul->name_module }}
                        </option>
                    @endforeach --}}
                </select>
            </div>
            <div class="my-4 space-y-1">
                <label for="editTitle" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Title Video</label>
                <input type="text" id="editTitle" name="title_video" value="{{ old('title_video', $video->title_video) }}" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Title Video">
            </div>
            <div class="my-4 space-y-1">
                <label for="editLink" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                    Link Video
                </label>
                <input type="url" id="editLink" name="link_video" value="{{ old('link_video', $video->link_video) }}" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="https://example.com/video">
            </div>            
            <div class="my-4 space-y-1">
                <label for="editImage" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Thumbnail Video</label>
                <input type="file" id="editImage" name="thumbnail_video" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Thumbnail Video" accept="images/*"
        onchange="previewImage(event)">
            <img id="imagePreview" src="" alt="Image Preview" class="w-52 h-32 mt-2 object-cover rounded-lg hidden">

            </div>
            <div class="my-4 space-y-1">
                <label for="editDescription" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description Video</label>
                <textarea type="text" id="editDescription" name="description_video" rows ="6" value="{{ old('description_video', $video->description_video) }}" class="flex w-full px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Description Video"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto">Save</button>
            </div>
        </form>
    </div>
</div>
@endforeach


@foreach ($videos as $video)
<!-- Modal Hapus -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-sm">
        <h3 class="text-base font-semibold text-gray-90 mb-4">Delete Data</h3>
        <p class="mb-4 text-sm text-gray-500">Are you sure you want to delete this data?</p>
        <form action="{{ route('delete-video', ['id_video' => $video->id_video]) }}" method="POST" >
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteId" name="id" value="{{ $video->id_video }}">
            <div class="flex justify-end ">
                <button type="button" onclick="hideDeleteModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 sm:ml-3 sm:w-auto">Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach

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

    function showEditModal(id, title, link, image, description) {
        document.getElementById('editId').value = id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editLink').value = link;
        document.getElementById('editDescription').value = description;
        const imagePreview = document.getElementById('imagePreview');
        if (image) {
            imagePreview.src = image;
            imagePreview.classList.remove('hidden');
        } else {
            imagePreview.classList.add('hidden');
        }
        document.getElementById('editModal').classList.remove('hidden');

        document.getElementById('editModal').classList.remove('hidden');
    }

    function hideEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function showDeleteModal(id) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection