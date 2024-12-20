@extends('layouts.app')

@section('title', 'Add Data Modul')
@section('header', 'Add Data Modul')

@section('content')
<div class="container">
    <form>
        <div class="my-4 space-y-1">
            <label for="editName" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
            <input type="text" id="editName" name="name" class="flex w-full max-w-xs h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="name">
        </div>       
        <div class="my-4 space-y-1">
            <label for="editEmail" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
            <input type="email" id="editEmail" name="email" class="flex w-full max-w-xs h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" placeholder="user@gmail.com">
        </div>
        <div class="my-4 space-y-1">
            <label for="editRole" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Role</label>
            <select id="editRole" name="role" class="flex w-full max-w-xs h-10 px-3 py-2 text-sm bg-white border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-500  px-3 py-2 text-sm font-semibold text-white shadow-sm ring-gray-300 hover:bg-blue-600 sm:mt-0 sm:w-auto">Save</button>
            <a href="{{ route('data-modul') }}">
            <button type="button" onclick="hideEditModal()" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:ml-3 sm:w-auto">Cancel</button>
            </a>
        </div>
    </form>
</div>
@endsection
