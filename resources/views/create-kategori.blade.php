@extends('layouts.app')

@section('title', 'Tambah Data Kategori')
@section('header', 'Tambah Data Kategori')

@section('content')
<div class="container">
    <h2 class="text-xl font-semibold mb-4">Tambah Data Kategori</h2>
    <form>
        <div class="mb-4">
            <label for="addName" class="block mb-1">Nama</label>
            <input type="text" id="addName" class="w-full border p-2 rounded" placeholder="Nama User">
        </div>
        <div class="mb-4">
            <label for="addEmail" class="block mb-1">Email</label>
            <input type="email" id="addEmail" class="w-full border p-2 rounded" placeholder="Email User">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        <a href="{{ route('data-user') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
    </form>
</div>
@endsection
