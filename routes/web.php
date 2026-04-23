<?php

use App\Livewire\Master\Colors;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/components', function () {
    return view('components.flyonui-components');
})->name('components');

// Public Routes
Route::get('/master/colors', Colors::class)->name('master.colors');

// // Admin Routes (biasanya dengan middleware auth)
// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
//     // Tambahkan route admin lainnya
// });