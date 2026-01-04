<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LostFoundItemController;
use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AdminResponseController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {return view('welcome');});

Route::get('/admin/login', function () {return view('auth.admin-login');})->name('admin.login');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('reports', ReportController::class);
    Route::resource('lost-found', LostFoundItemController::class);
    Route::resource('aspirations', AspirationController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/points', [ProfileController::class, 'index'])->name('point-shop.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('responses', AdminResponseController::class);
    Route::get('/carousel', [CarouselController::class, 'index'])->name('carousel.index');
    Route::get('/carousel/create', [CarouselController::class, 'create'])->name('carousel.create');
    Route::patch('/carousel/{carousel}/toggle', [CarouselController::class, 'toggleStatus'])->name('admin.carousel.toggle');
    Route::post('/carousel', [CarouselController::class, 'store'])->name('carousel.store');
    Route::put('/carousel/{carousel}', [CarouselController::class, 'update'])->name('carousel.update');
    Route::delete('/carousel/{carousel}', [CarouselController::class, 'destroy'])->name('carousel.destroy');
});

require __DIR__.'/auth.php';