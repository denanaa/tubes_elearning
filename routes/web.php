<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/data-user', function () {
    return view('data-user');
})->name('data-user');

Route::get('/data-modul', function () {
    return view('data-modul');
})->name('data-modul');

Route::get('/data-kategori', function () {
    return view('data-kategori');
})->name('data-kategori');

Route::get('/data-video', function () {
    return view('data-video');
})->name('data-video');


Route::view('/data-user', 'data-user')->name('data-user');
Route::view('/tambah-user', 'create-user')->name('create-user');

Route::view('/data-modul', 'data-modul')->name('data-modul');
Route::view('/tambah-modul', 'create-modul')->name('create-modul');

Route::view('/data-kategori', 'data-kategori')->name('data-kategori');
Route::view('/tambah-kategori', 'create-kategori')->name('create-kategori');

Route::view('/data-video', 'data-video')->name('data-video');
Route::view('/tambah-video', 'create-video')->name('create-video');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/content', function () {
    return view('content');
});

Route::get('/video', function () {
    return  view('video');
});

Route::get('materi', function () {
    return view('materi');
});

Route::get('/content', function () {
    return view('content');
});

Route::get('/materi/{type}', [MateriController::class, 'show']);

Route::get('/video/{type}', [VideoController::class, 'show']);

require __DIR__.'/auth.php';
