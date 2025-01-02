@extends('layouts.app')

@section('title', 'Data Kategori')
@section('header', 'Data Kategori')

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
    <a href="{{ route('create-kategori') }}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 ml-4 focus:outline-none">Add Kategori</a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-[#37AFE1] text-center">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Role
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                <td class="px-6 py-4">
                    1
                </td>
                <td class="px-6 py-4">
                    John Doe
                </td>
                <td class="px-6 py-4">
                    john@example.com
                </td>
                <td class="px-6 py-4">
                    Admin
                </td>
                <td class="px-6 py-4">
                    <button type="button" onclick="showEditModal('1', 'John Doe', 'john@example.com', 'Admin')" class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">
                        Edit
                    </button>
                    <button type="button" onclick="showDeleteModal('1')"  class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                <td class="px-6 py-4">
                    1
                </td>
                <td class="px-6 py-4">
                    John Doe
                </td>
                <td class="px-6 py-4">
                    john@example.com
                </td>
                <td class="px-6 py-4">
                    Admin
                </td>
                <td class="px-6 py-4">
                    <button type="button" onclick="showEditModal('1', 'John Doe', 'john@example.com', 'Admin')" class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">
                        Edit
                    </button>
                    <button type="button" onclick="showDeleteModal('1')" class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            <tr class="odd:bg-white even:bg-gray-50 border-b text-center">
                <td class="px-6 py-4">
                    1
                </td>
                <td class="px-6 py-4">
                    John Doe
                </td>
                <td class="px-6 py-4">
                    john@example.com
                </td>
                <td class="px-6 py-4">
                    Admin
                </td>
                <td class="px-6 py-4">
                    <button type="button" onclick="showEditModal('1', 'John Doe', 'john@example.com', 'Admin')" class="bg-green-500 text-white text-xs hover:bg-green-600 font-medium me-2 px-4 py-0.5 rounded">
                        Edit
                    </button>
                    <button type="button" onclick="showDeleteModal('1')"  class="bg-red-500 text-white text-xs hover:bg-red-600 font-medium me-2 px-2.5 py-0.5 rounded">
                        Delete
                    </button>
                </td>
            </tr> 
    </tbody>
</table>
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6  w-[90%] max-w-lg border rounded-lg shadow-sm bg-card text-neutral-900">
        <h3 class="text-base font-semibold text-gray-90 mb-4">Edit Data Kategori</h3>
        <p class="mb-4 text-sm text-gray-500">Update kategori details here. Click 'Save' to apply changes or 'Cancel' to discard them..</p>
        <form>
            <input type="hidden" id="editId" name="id" value="">
            <div class="my-4 space-y-1">
                <label for="editName" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
                <input type="text" id="editName" name="name" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Nama User">
            </div>
            <div class="my-4 space-y-1">
                <label for="editEmail" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
                <input type="email" id="editEmail" name="email" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Email User">
            </div>
            <div class="my-4 space-y-1">
                <label for="editRole" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Role</label>
                <select id="editRole" name="role" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto">Save</button>
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
                <button type="button" onclick="hideDeleteModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 sm:ml-3 sm:w-auto">Delete</button>
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
