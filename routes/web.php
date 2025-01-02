<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\WelcomeController;

Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/welcome', function () {
    return view('welcome');
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

Route::get('/content/{type}', [ContentController::class, 'show']);

Route::get('/welcome/{type}', [WelcomeController::class, 'show']);

require __DIR__.'/auth.php';

Route::get('/content', [ContentController::class, 'index'])->name('content');
Route::get('/materi', [MateriController::class, 'index'])->name('materi');
Route::get('/materi/kategori/{categoryId}', [MateriController::class, 'showByCategory'])->name('materi.kategori');