<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController; // [নতুন] এই লাইনটি যোগ করো
use Illuminate\Support\Facades\Route;

// [পরিবর্তন] ফাংশনের বদলে এখন HomeController ব্যবহার হবে
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/donors-list', [SearchController::class, 'search'])->name('donors.list');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
