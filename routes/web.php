<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
