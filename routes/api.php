<?php

use App\Http\Controllers\LostFoundItemController;
use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;

Route::get('/lost-found-data', [LostFoundItemController::class, 'apiIndex']);

Route::get('/aspirations', [AspirationController::class, 'apiIndex']);
Route::get('/aspirations/{id}', [AspirationController::class, 'apiShow']);