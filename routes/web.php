<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LostFoundItemController;
use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AdminResponseController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminPointsController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {return view('welcome');});
Route::get('/admin/login', function () {return view('auth.admin-login');})->name('admin.login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('reports', ReportController::class);
    Route::resource('lost-found', LostFoundItemController::class);
    Route::resource('aspirations', AspirationController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/inbox', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/send-message/{item_id}', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/reply/{message_id}', [MessageController::class, 'reply'])->name('messages.reply');
    Route::get('/points', [PointsController::class, 'index'])->name('point-shop.index');
    Route::patch('/points/{point}/exchange', [PointsController::class, 'exchange'])->name('points.exchange');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('responses', AdminResponseController::class);
    Route::resource('carousel', CarouselController::class);
    Route::resource('points', AdminPointsController::class);
    Route::patch('/points/{points}/toggle', [AdminPointsController::class, 'toggleStatus'])->name('points.toggle');
    Route::patch('/carousel/{carousel}/toggle', [CarouselController::class, 'toggleStatus'])->name('admin.carousel.toggle');
});

require __DIR__.'/auth.php';
