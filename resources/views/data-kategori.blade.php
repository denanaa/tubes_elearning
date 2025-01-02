@extends('layouts.app')

@section('title', 'Data Category')
@section('header', 'Data Category')

@section('content')
    <div class="flex items-center mb-4">
        <div class="relative w-60">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none z-10">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <form action="{{ route('search-user') }}" method="GET">
                <div class="relative">
                    <input id="search" type="text" name="query" value="{{ request('query') }}" placeholder="Cari..."
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        autocomplete="off" />
                    <button type="submit"
                        class="absolute inset-y-0 end-0 px-3 text-white bg-blue-500 rounded-r-lg hover:bg-blue-600">
                        Search
                    </button>
                </div>
            </form>
        </div>
        <!-- Pindahkan tombol "Add User" ke paling kanan dengan menambahkan ml-auto -->
        <a href="{{ route('create-kategori') }}"
            class="ml-auto text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none mb-2">Add
            Kategori</a>

            <a href="{{ route('categories-pdf') }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5">
                Download PDF
            </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-[#37AFE1] text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description Category
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                class="w-16 h-16 object-cover mx-auto rounded-lg">
                        </td>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ $category->description }}</td>
                        <td class="px-6 py-4">
                            <a href="javascript:void(0)"
                                onclick="showEditModal({{ $category->id_category }}, '{{ $category->name }}', '{{ $category->description }}', '{{ $category->image }}')"
                                class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">Edit</a>
                            <form action="{{ route('delete-kategori', $category->id_category) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 w-[90%] max-w-lg border rounded-lg shadow-sm bg-card text-neutral-900">
            <h3 class="text-base font-semibold text-gray-90 mb-4">Edit Data Category</h3>
            <p class="mb-4 text-sm text-gray-500">Update category details here. Click 'Save' to apply changes or 'Cancel' to
                discard them.</p>

            <!-- Form action akan diatur dinamis oleh JavaScript -->
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan PUT karena ini adalah operasi update -->

                <input type="hidden" id="editId" name="id">
                <div class="my-4 space-y-1">
                    <label for="editImage" class="text-sm font-medium">Image Category</label>
                    <input type="file" id="editImage" name="image"
                        class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md" placeholder="Image Category"
                        accept="image/*" onchange="previewImage(event)">
                    <img id="imagePreview" src="" alt="Image Preview"
                        class="w-32 h-32 mt-2 object-cover rounded-lg hidden">
                </div>

                <div class="my-4 space-y-1">
                    <label for="editName" class="text-sm font-medium">Name Category</label>
                    <input type="text" id="editName" name="name"
                        class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md" placeholder="Name Category">
                </div>
                <div class="my-4 space-y-1">
                    <label for="editDescription" class="text-sm font-medium">Description Category</label>
                    <textarea id="editDescription" name="description" rows="6"
                        class="flex w-full px-3 py-2 text-sm bg-white border rounded-md" placeholder="Description Category"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="hideEditModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-sm">
            <h3 class="text-base font-semibold text-gray-90 mb-4">Delete Data</h3>
            <p class="mb-4 text-sm text-gray-500">Are you sure you want to delete this data?</p>
            <form>
                <input type="hidden" id="deleteId" name="id" value="">
                <div class="flex justify-end ">
                    <button type="button" onclick="hideDeleteModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 sm:ml-3 sm:w-auto">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // function previewImage(event) {
        //     const file = event.target.files[0];
        //     const reader = new FileReader();

        //     reader.onload = function(e) {
        //         document.getElementById('imagePreview').src = e.target.result;
        //         document.getElementById('imagePreview').classList.remove('hidden');
        //     }

        //     if (file) {
        //         reader.readAsDataURL(file);
        //     }
        // }

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


        function showEditModal(id, name, description, image) {
            document.getElementById('editId').value = id; // Pastikan ID yang benar dimasukkan
            document.getElementById('editName').value = name; // Nama kategori yang benar
            document.getElementById('editDescription').value = description; // Deskripsi yang benar
            const imagePreview = document.getElementById('imagePreview');
            if (image) {
                imagePreview.src = image;
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.classList.add('hidden');
            }

            // Mengatur action form untuk update
            const form = document.getElementById('editCategoryForm');
            form.action = "{{ route('update-kategori', ':id') }}".replace(':id', id);


            // Menampilkan modal
            document.getElementById('editModal').classList.remove('hidden');
        }



        // Fungsi untuk menyembunyikan modal jika batal
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


// Live search functionality for categories
document.getElementById('search').addEventListener('keyup', function() {
    const query = this.value;

    // Start live search only if the input length is greater than 1 character
    if (query.length > 0) {
        fetch("{{ route('live-search-category') }}?query=" + query)
            .then(response => response.json())
            .then(data => {
                let results = '';
                if (data.length > 0) {
                    // Start from 1 for numbering
                    data.forEach((category, index) => {
                        results += `
                            <tr class="text-center">
                                <td class="px-6 py-4">${index + 1}</td> <!-- Dynamic number -->
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage') }}/${category.image}" alt="Category Image" class="w-16 h-16 object-cover mx-auto rounded-lg">
                                </td>
                                <td class="px-6 py-4">${category.name}</td>
                                <td class="px-6 py-4">${category.description}</td>
                                <td class="px-6 py-4">
                                    <button onclick="showEditModal('${category.id_category}', '${category.name}', '${category.description}', '${category.image}')"
                                            class="bg-green-500 text-white text-xs hover:bg-green-600 px-4 py-0.5 rounded">Edit</button>
                                    <form action="{{ route('delete-kategori', '') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white text-xs hover:bg-red-600 px-2.5 py-0.5 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    results =
                        '<tr><td colspan="5" class="text-center p-4">No categories found</td></tr>';
                }
                document.querySelector('tbody').innerHTML = results;
            })
            .catch(error => {
                document.querySelector('tbody').innerHTML =
                    '<tr><td colspan="5" class="text-center p-4 text-red-500">Error occurred</td></tr>';
            });
    } else {
        // Show all categories when search is cleared
        document.querySelector('tbody').innerHTML = ` 
            @foreach ($categories as $index => $category)
            <tr class="text-center">
                <td class="px-6 py-4">{{ $loop->iteration }}</td> <!-- Keep server-side iteration when no search -->
                <td class="px-6 py-4">
                    <img src="{{ asset('storage') }}/{{ $category->image }}" alt="Category Image" class="w-16 h-16 object-cover mx-auto rounded-lg">
                </td>
                <td class="px-6 py-4">{{ $category->name }}</td>
                <td class="px-6 py-4">{{ $category->description }}</td>
                <td class="px-6 py-4">
                    <button onclick="showEditModal('{{ $category->id_category }}', '{{ $category->name }}', '{{ $category->description }}', '{{ $category->image }}')" 
                            class="bg-green-500 text-white text-xs hover:bg-green-600 px-4 py-0.5 rounded">Edit</button>
                    <form action="{{ route('delete-kategori', $category->id_category) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white text-xs hover:bg-red-600 px-2.5 py-0.5 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        `;
    }
});

    </script>
@endsection
