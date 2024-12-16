@extends('layouts.app')

@section('title', 'Data Video')
@section('header', 'Data Video')

@section('content')
<div class="flex items-center justify-between mb-4">
    <input type="text" placeholder="Cari..." class="p-2 border rounded w-[88%]">
    <a href="{{ route('create-video') }}" class="bg-blue-500 text-white px-4 py-2 ml-2 rounded hover:bg-blue-600">Tambah Data</a>
</div>
<table class="w-full bg-white shadow-md rounded border">
    <thead class="bg-[#37AFE1] text-white">
        <tr>
            <th class="py-2 px-4">No</th>
            <th class="py-2 px-4">Nama</th>
            <th class="py-2 px-4">Email</th>
            <th class="py-2 px-4">Role</th>
            <th class="py-2 px-4">Aksi</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <tr class="border-b hover:bg-gray-100">
            <td class="py-2 px-4">1</td>
            <td class="py-2 px-4">John Doe</td>
            <td class="py-2 px-4">john@example.com</td>
            <td class="py-2 px-4">Admin</td>
            <td class="py-2 px-4">
                <button 
                    onclick="showEditModal('1', 'John Doe', 'john@example.com', 'Admin')" 
                    class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                    Edit
                </button>
                <button 
                    onclick="showDeleteModal('1')" 
                    class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                    Hapus
                </button>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-[90%] max-w-lg">
        <h3 class="text-xl font-semibold mb-4">Edit Data Video</h3>
        <form>
            <input type="hidden" id="editId" name="id" value="">
            <div class="mb-4">
                <label for="editName" class="block mb-1">Nama</label>
                <input type="text" id="editName" name="name" class="w-full border p-2 rounded" placeholder="Nama User">
            </div>
            <div class="mb-4">
                <label for="editEmail" class="block mb-1">Email</label>
                <input type="email" id="editEmail" name="email" class="w-full border p-2 rounded" placeholder="Email User">
            </div>
            <div class="mb-4">
                <label for="editRole" class="block mb-1">Role</label>
                <select id="editRole" name="role" class="w-full border p-2 rounded">
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-[90%] max-w-sm">
        <h3 class="text-xl font-semibold mb-4">Hapus Data</h3>
        <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
        <form>
            <input type="hidden" id="deleteId" name="id" value="">
            <div class="flex justify-end">
                <button type="button" onclick="hideDeleteModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Batal</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showEditModal(id, name, email, role) {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
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
