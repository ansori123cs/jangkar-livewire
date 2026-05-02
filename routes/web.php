<?php

use App\Livewire\Master\Colors;
use App\Livewire\Auth\Signin;
use App\Livewire\Auth\RoleManagement;
use App\Livewire\Auth\UserManagement;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/components', function () {
    return view('components.flyonui-components');
})->name('components');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/sign-in', Signin::class)->name('auth.login');
});

Route::get('/role-management', RoleManagement::class)->name('role.management');
Route::get('/users', UserManagement::class)->name('users');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/master/colors', Colors::class)->name('master.colors');
});

// // Admin Routes (biasanya dengan middleware auth)
// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
//     // Tambahkan route admin lainnya
// });