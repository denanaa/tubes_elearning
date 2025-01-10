<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Rute umum
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rute yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute User
Route::get('/data-user', [UserController::class, 'index'])->name('data-user');
Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
Route::post('/create-user', [UserController::class, 'store'])->name('store-user');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update-user');
Route::post('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
Route::get('/search-user', [UserController::class, 'search'])->name('search-user');
Route::get('/live-search-user', [UserController::class, 'liveSearch'])->name('live-search-user');
Route::get('/load-all-users', [UserController::class, 'loadAllUsers'])->name('load-all-users');
Route::get('/users/pdf', [UserController::class, 'generatePDF'])->name('users-pdf');

// Rute Modul
Route::get('/data-modul', [ModulController::class, 'index'])->name('data-modul');
Route::get('/create-modul', [ModulController::class, 'create'])->name('create-modul');
Route::post('/create-modul', [ModulController::class, 'store'])->name('store-modul');
Route::get('/edit-modul/{id_module}', [ModulController::class, 'edit'])->name('edit-modul');
Route::put('/update-modul/{id_module}', [ModulController::class, 'update'])->name('update-modul');
Route::post('/delete-modul/{id_module}', [ModulController::class, 'destroy'])->name('delete-modul');
Route::get('/search-modul', [ModulController::class, 'search'])->name('search-modul');
Route::get('/live-search-modul', [ModulController::class, 'liveSearch'])->name('live-search-modul');
Route::get('/load-all-modules', [ModulController::class, 'loadAllModules'])->name('load-all-modules');
Route::get('/modules/pdf', [ModulController::class, 'generatePDF'])->name('modules-pdf');

    Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data-kategori');
    Route::get('/create-kategori', [CategoryController::class, 'create'])->name('create-kategori');
    Route::post('/create-kategori', [CategoryController::class, 'store'])->name('store-kategori');
    Route::get('/edit-kategori/{id_category}', [CategoryController::class, 'edit'])->name('edit-kategori');
    Route::put('/update-kategori/{id_category}', [CategoryController::class, 'update'])->name('update-kategori');
    Route::post('/delete-kategori/{id_category}', [CategoryController::class, 'destroy'])->name('delete-kategori');
    Route::get('/live-search-category', [CategoryController::class, 'liveSearch'])->name('live-search-category');
    Route::get('/load-all-categories', [CategoryController::class, 'loadAllCategories'])->name('load-all-categories');
    Route::get('/categories/pdf', [CategoryController::class, 'generatePDF'])->name('categories-pdf');

    Route::get('/data-video', [VideoController::class, 'index'])->name('data-video');
    Route::get('/create-video', [VideoController::class, 'create'])->name('create-video');
    Route::post('/create-video', [VideoController::class, 'store'])->name('store-video');
    Route::get('/edit-video/{id_video}', [VideoController::class, 'edit'])->name('edit-video');
    Route::put('/update-video/{id_video}', [VideoController::class, 'update'])->name('update-video');
    Route::delete('/delete-video/{id_video}', [VideoController::class, 'destroy'])->name('delete-video');
    Route::get('/search-video', [VideoController::class, 'search'])->name('search-video');
    Route::get('/live-search-video', [VideoController::class, 'liveSearch'])->name('live-search-video');
    Route::get('/load-all-videos', [VideoController::class, 'loadAllVideos'])->name('load-all-videos');
    Route::get('/videos/pdf', [VideoController::class, 'generatePDF'])->name('videos-pdf');

// Rute Materi
Route::prefix('materi')->group(function () {
    Route::get('/', [MateriController::class, 'index'])->name('materi.index'); // Semua video
    Route::get('/search', [MateriController::class, 'search'])->name('materi.search');
    Route::get('/filter', [MateriController::class, 'filter'])->name('materi.filter'); // Filter
    Route::get('/kategori/{categoryId}', [MateriController::class, 'showByCategory'])->name('materi.kategori'); // Berdasarkan kategori
    Route::get('/{videoId}', [MateriController::class, 'show'])->name('materi.show'); // Berdasarkan ID video
});

// Rute Video
Route::prefix('video')->group(function () {
    Route::get('/', function () {
        return view('video');
    });
    Route::get('/{videoId}', [VideoController::class, 'show'])->name('video.show');
});

// Rute Content
Route::prefix('content')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('content.index');
    Route::get('/{type}', [ContentController::class, 'show'])->name('content.show');
});

// Rute Welcome
Route::prefix('welcome')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->middleware(['auth', 'verified'])->name('welcome.auth');
    Route::get('/{type}', [WelcomeController::class, 'show'])->name('welcome.show');
});

// Rute Test
Route::get('/test', function () {
    return 'Route working!';
})->name('test');

// Rute Autentikasi
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rute Dashboard
Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

// Rute Materi Berdasarkan Tipe
Route::get('/materi/{type}', [MateriController::class, 'show']);

// Rute Video Berdasarkan Tipe
Route::get('/video/{type}', [VideoController::class, 'show']);

// Rute Socialite
Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'redirect']);

require __DIR__.'/auth.php';