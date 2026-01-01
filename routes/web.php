<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LostFoundItemController;
use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AdminResponseController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('auth.admin-login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('reports', ReportController::class);
    Route::resource('lost-found', LostFoundItemController::class);
    Route::resource('aspirations', AspirationController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('responses', AdminResponseController::class);
});

require __DIR__.'/auth.php';
