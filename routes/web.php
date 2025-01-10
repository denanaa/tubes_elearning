<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\WelcomeController;
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

// Rute Materi
Route::prefix('materi')->group(function () {
    Route::get('/', [MateriController::class, 'index'])->name('materi.index'); // Semua video
    Route::get('/materi/search', [MateriController::class, 'search'])->name('materi.search');
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

// Tambahkan rute autentikasi
require __DIR__.'/auth.php';
