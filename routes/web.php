<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LostFoundItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('lost-found', LostFoundItemController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/inbox', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/send-message/{item_id}', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/reply/{message_id}', [MessageController::class, 'reply'])->name('messages.reply');
});


require __DIR__.'/auth.php';
