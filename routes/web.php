<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;

use App\Http\Controllers\Auth\SocialiteController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\VideoController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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



Route::view('/tambah-user', 'create-user')->name('create-user');


Route::get('/data-user', [UserController::class, 'index'])->name('data-user');
Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
Route::post('/create-user', [UserController::class, 'store'])->name('store-user');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update-user');
Route::post('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
Route::get('/search-user', [UserController::class, 'search'])->name('search-user');
Route::get('/live-search-user', [UserController::class, 'liveSearch'])->name('live-search-user');
Route::get('/load-all-users', [UserController::class, 'loadAllUsers'])->name('load-all-users');




Route::view('/tambah-modul', 'create-modul')->name('create-modul');

Route::get('/data-modul', [ModulController::class, 'index'])->name('data-modul');
Route::get('/create-modul', [ModulController::class, 'create'])->name('create-modul');
Route::post('/create-modul', [ModulController::class, 'store'])->name('store-modul');
Route::get('/edit-modul/{id_module}', [ModulController::class, 'edit'])->name('edit-modul');
Route::put('/update-modul/{id_module}', [ModulController::class, 'update'])->name('update-modul');
Route::post('/delete-modul/{id_module}', [ModulController::class, 'destroy'])->name('delete-modul');
Route::get('/search-modul', [ModulController::class, 'search'])->name('search-modul');
Route::get('/live-search-modul', [ModulController::class, 'liveSearch'])->name('live-search-modul');
Route::get('/load-all-modules', [ModulController::class, 'loadAllModules'])->name('load-all-modules');

// Route::post('/store-modul', [ModulController::class, 'store'])->name('store-modul');


Route::view('/tambah-kategori', 'create-kategori')->name('create-kategori');

Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data-kategori');
Route::get('/create-kategori', [CategoryController::class, 'create'])->name('create-kategori');
Route::post('/create-kategori', [CategoryController::class, 'store'])->name('store-kategori');
Route::get('/edit-kategori/{id_category}', [CategoryController::class, 'edit'])->name('edit-kategori');
Route::put('/kategori/{id_category}', [CategoryController::class, 'update'])->name('update-kategori');
Route::post('/delete-kategori/{id_category}', [CategoryController::class, 'destroy'])->name('delete-kategori');
Route::get('/live-search-category', [CategoryController::class, 'liveSearch'])->name('live-search-category');
Route::get('/load-all-categories', [CategoryController::class, 'loadAllCategories'])->name('load-all-categories');

// Route::get('/kategori/dashboard', [CategoryController::class, 'dashboard'])->name('kategori-dashboard');



// Route::view('/data-video', 'data-video')->name('data-video');
// Route::view('/tambah-video', 'create-video')->name('create-video');

Route::get('/data-video', [VideoController::class, 'index'])->name('data-video');
Route::get('/create-video', [VideoController::class, 'create'])->name('create-video');
Route::post('/create-video', [VideoController::class, 'store'])->name('store-video');
Route::get('/edit-video/{id_video}', [VideoController::class, 'edit'])->name('edit-video');
Route::put('/update-video/{id_video}', [VideoController::class, 'update'])->name('update-video');
Route::delete('/delete-video/{id_video}', [VideoController::class, 'destroy'])->name('delete-video');
Route::get('/search-video', [VideoController::class, 'search'])->name('search-video');
Route::get('/live-search-video', [VideoController::class, 'liveSearch'])->name('live-search-video');
Route::get('/load-all-videos', [VideoController::class, 'loadAllVideos'])->name('load-all-videos');

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

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/materi/{type}', [MateriController::class, 'show']);

Route::get('/video/{type}', [VideoController::class, 'show']);

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'redirect']);

require __DIR__.'/auth.php';
