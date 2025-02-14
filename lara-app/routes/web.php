<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|moderator'])->group(function () {
    Route::get('/', App\Http\Controllers\Admin\DashboardController::class)->name('dashboard'); // domain/admin/ | admin.dashboard
    Route::resource('categories', App\Http\Controllers\Admin\CategoriesController::class)
        ->except(['show']);
});
