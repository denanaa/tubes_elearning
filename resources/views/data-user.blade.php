@extends('layouts.app')

@section('title', 'Data User')
@section('header', 'Data User')

@section('content')
<div class="flex items-center mb-4">
    <div class="relative w-60">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none z-10">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <form action="{{ route('search-user') }}" method="GET">
        <div class="relative">
            <input 
                id="search"
                type="text" 
                name="query" 
                value="{{ request('query') }}" 
                placeholder="Cari..." 
                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                autocomplete="off"
            />
            <button type="submit" class="absolute inset-y-0 end-0 px-3 text-white bg-blue-500 rounded-r-lg hover:bg-blue-600">
                Search
            </button>
        </div>
        </form>
    </div>
    <!-- Pindahkan tombol "Add User" ke paling kanan dengan menambahkan ml-auto -->
    <a href="{{ route('create-user') }}" class="ml-auto text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none mb-2">Add User</a>
</div>


<!-- Tabel User -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    <table class="w-full text-sm text-gray-500 border-collapse border border-gray-300" id="user-table">
        <thead class="bg-[#37AFE1] text-white text-center">
            <tr>
                <th class="border px-6 py-3">No</th>
                <th class="border px-6 py-3">Name</th>
                <th class="border px-6 py-3">Email</th>
                <th class="border px-6 py-3">Role</th>
                <th class="border px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr class="text-center">
                <td class="border px-6 py-4">{{ $index + 1 }}</td>
                <td class="border px-6 py-4">{{ $user->name }}</td>
                <td class="border px-6 py-4">{{ $user->email }}</td>
                <td class="border px-6 py-4">{{ $user->role }}</td>
                <td class="border px-6 py-4">
                    <button onclick="showEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" 
                            class="bg-green-500 text-white text-xs hover:bg-green-600 px-4 py-0.5 rounded">Edit</button>
                    <form action="{{ route('delete-user', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white text-xs hover:bg-red-600 px-2.5 py-0.5 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6  w-[90%] max-w-lg border rounded-lg shadow-sm bg-card text-neutral-900">
        <h3 class="text-base font-semibold text-gray-90 mb-4">Edit Data User</h3>
        <form action="{{ route('update-user', '') }}" method="POST" id="editForm">
            @csrf
            <input type="hidden" id="editId" name="id" value="">
            <div class="my-4 space-y-1">
                <label for="editName" class="text-sm font-medium">Name</label>
                <input type="text" id="editName" name="name" class="w-full h-10 px-3 py-2 text-sm bg-white border rounded-md" placeholder="Nama User">
            </div>
            <div class="my-4 space-y-1">
                <label for="editEmail" class="text-sm font-medium">Email</label>
                <input type="email" id="editEmail" name="email" class="w-full h-10 px-3 py-2 text-sm bg-white border rounded-md" placeholder="Email User">
            </div>
            <div class="my-4 space-y-1">
                <label for="editRole" class="text-sm font-medium">Role</label>
                <select id="editRole" name="role" class="w-full h-10 px-3 py-2 text-sm bg-white border rounded-md">
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditModal()" class="bg-white text-gray-900 px-3 py-2 rounded-md">Cancel</button>
                <button type="submit" class="bg-blue-400 text-white px-3 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-sm">
        <h3 class="text-base font-semibold text-gray-90 mb-4">Delete Data</h3>
        <p class="mb-4 text-sm text-gray-500">Are you sure you want to delete this data?</p>
        <form action="{{ route('delete-user', '') }}" method="POST">
            @csrf
            <input type="hidden" id="deleteId" name="id" value="">
            <div class="flex justify-end">
                <button type="button" onclick="hideDeleteModal()" class="bg-white text-gray-900 px-3 py-2 rounded-md">Cancel</button>
                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-md">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Show modal edit and populate form with data
    function showEditModal(id, name, email, role) {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        document.getElementById('editModal').classList.remove('hidden');
    }

    // Hide edit modal
    function hideEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Show delete modal
    function showDeleteModal(id) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    // Hide delete modal
    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Live search functionality
    document.getElementById('search').addEventListener('keyup', function() {
        const query = this.value;

        // Start live search only if the input length is greater than 1 character
        if (query.length > 0) {
            fetch("{{ route('live-search-user') }}?query=" + query)
                .then(response => response.json())
                .then(data => {
                    let results = '';
                    if (data.length > 0) {
                        data.forEach(user => {
                            results += `
                                <tr class="text-center">
                                    <td class="border px-6 py-4">${user.id}</td>
                                    <td class="border px-6 py-4">${user.name}</td>
                                    <td class="border px-6 py-4">${user.email}</td>
                                    <td class="border px-6 py-4">${user.role}</td>
                                    <td class="border px-6 py-4">
                                        <button onclick="showEditModal('${user.id}', '${user.name}', '${user.email}', '${user.role}')"
                                                class="bg-green-500 text-white text-xs hover:bg-green-600 px-4 py-0.5 rounded">Edit</button>
                                        <form action="{{ route('delete-user', '') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white text-xs hover:bg-red-600 px-2.5 py-0.5 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        results = '<tr><td colspan="5" class="text-center p-4">No users found</td></tr>';
                    }
                    document.querySelector('tbody').innerHTML = results;
                })
                .catch(error => {
                    document.querySelector('tbody').innerHTML = '<tr><td colspan="5" class="text-center p-4 text-red-500">Error occurred</td></tr>';
                });
        } else {
            // Show all users when search is cleared
            document.querySelector('tbody').innerHTML = `
                @foreach ($users as $index => $user)
                <tr class="text-center">
                    <td class="border px-6 py-4">{{ $index + 1 }}</td>
                    <td class="border px-6 py-4">{{ $user->name }}</td>
                    <td class="border px-6 py-4">{{ $user->email }}</td>
                    <td class="border px-6 py-4">{{ $user->role }}</td>
                    <td class="border px-6 py-4">
                        <button onclick="showEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" 
                                class="bg-green-500 text-white text-xs hover:bg-green-600 px-4 py-0.5 rounded">Edit</button>
                        <form action="{{ route('delete-user', $user->id) }}" method="POST" style="display:inline;">
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
