<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Tests\Fixtures\Controllers\UserController;
use App\Http\Controllers\ClothesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-area', [UserController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Voeg middleware toe voor de clothing routes
Route::middleware('auth')->group(function () {
    Route::get('/clothes/create', [ClothesController::class, 'create'])->name('clothes.create');
    Route::post('/clothes', [ClothesController::class, 'store'])->name('clothes.store');
});

Route::get('/about-us', function() {
    return 'This page is about us';
});

require __DIR__.'/auth.php';
