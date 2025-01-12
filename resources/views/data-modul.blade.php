@extends('layouts.app')

@section('title', 'Data Modul')
@section('header', 'Data Modul')

@section('content')
    <div class="flex items-center mb-4">
        <!-- Form Pencarian -->
        <div class="relative w-60">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none z-10">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <form action="{{ route('search-modul') }}" method="GET">
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

        <!-- Tombol Add Modul dan Download PDF -->
        <div class="ml-auto flex space-x-2">
            <a href="{{ route('create-modul') }}"
                class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Add Modul
            </a>
            <a href="{{ route('modules-pdf') }}"
                class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Download PDF
            </a>
        </div>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-[#37AFE1] text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modul Name
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $index => $modul)
                    <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $modul->category->name }}</td>
                        <td class="px-6 py-4">{{ $modul->name_module }}</td>
                        <td class="px-6 py-4">
                            <!-- Ganti dengan link untuk membuka modal Edit -->
                            <a href="javascript:void(0)"
                                onclick="showEditModal({{ $modul->id_module }}, '{{ $modul->name_module }}', {{ $modul->id_category }})"
                                class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">Edit</a>
                            <form action="{{ route('delete-modul', $modul->id_module) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">Delete</button>
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
            <h3 class="text-base font-semibold text-gray-90 mb-4">Edit Data Modul</h3>
            <p class="mb-4 text-sm text-gray-500">Update modul details here. Click 'Save' to apply changes or 'Cancel' to
                discard them..</p>

            <!-- Form Edit -->
            <form action="{{ route('update-modul', ':id') }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id" value="">

                <div class="my-4 space-y-1">
                    <label for="editCategory"
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Category</label>
                    <select id="editCategory" name="id_category"
                        class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></select>
                </div>

                <div class="my-4 space-y-1">
                    <label for="editModulName"
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Modul
                        Name</label>
                    <input type="text" id="editModulName" name="name_module"
                        class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                        placeholder="Modul Name">
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
                @csrf
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
        var categories = @json($categories);

        function showEditModal(id, name, categoryId) {
            // Menampilkan modal dan mengisi data
            document.getElementById('editId').value = id;
            document.getElementById('editModulName').value = name;

            // Menambahkan opsi kategori ke dropdown
            var categorySelect = document.getElementById('editCategory');
            categorySelect.innerHTML = ''; // Kosongkan dropdown sebelum menambah data

            categories.forEach(function(category) {
                var option = document.createElement("option");
                option.value = category.id_category;
                option.textContent = category.name;
                if (category.id_category == categoryId) {
                    option.selected = true; // Pilih kategori yang sesuai
                }
                categorySelect.appendChild(option);
            });

            // Menampilkan modal
            document.getElementById('editModal').classList.remove('hidden');

            // Update form action URL
            var formAction = "{{ route('update-modul', ':id') }}".replace(':id', id);
            document.getElementById('editForm').action = formAction;
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

        document.getElementById('search').addEventListener('keyup', function() {
            const query = this.value;

            if (query.length > 0) {
                fetch("{{ route('live-search-modul') }}?query=" + query)
                    .then(response => response.json())
                    .then(data => {
                        let results = '';
                        console.log(data);
                        if (data.length > 0) {
                            // Start from 1 for numbering
                            data.forEach((modul, index) => {
                                results += `
                            <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                                <td class="px-6 py-4">${index + 1}</td> <!-- Dynamic number -->
                                <td class="px-6 py-4">${modul.category.name}</td>
                                <td class="px-6 py-4">${modul.name_module}</td>
                                <td class="px-6 py-4">
                                    <a href="javascript:void(0)" onclick="showEditModal('${modul.id_module}', '${modul.name_module}', '${modul.id_category}')"
                                       class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">Edit</a>
                                    <form action="{{ route('delete-modul', '') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                            });
                        } else {
                            results = '<tr><td colspan="4" class="text-center p-4">No modules found</td></tr>';
                        }
                        document.querySelector('tbody').innerHTML = results;
                    })
                    .catch(error => {
                        document.querySelector('tbody').innerHTML =
                            '<tr><td colspan="4" class="text-center p-4 text-red-500">Error occurred</td></tr>';
                    });
            } else {
                // Handle when there's no query (show all modules)
                fetch("{{ route('data-modul') }}")
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const tbody = doc.querySelector('tbody').innerHTML;
                        document.querySelector('tbody').innerHTML = tbody;
                    })
                    .catch(error => {
                        document.querySelector('tbody').innerHTML =
                            '<tr><td colspan="4" class="text-center p-4 text-red-500">Error occurred</td></tr>';
                    });
            }
        });
    </script>

@endsection
