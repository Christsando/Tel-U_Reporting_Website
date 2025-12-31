<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostFoundItemController;
use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminResponseApiController;
use App\Http\Controllers\FacilityReportResponseController;
use App\Http\Controllers\AspirationResponseController;
use App\Http\Controllers\LostFoundItemController;
             
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin-responses', [AdminResponseApiController::class, 'index']);
    Route::get('/admin-responses/{id}', [AdminResponseApiController::class, 'show']);

    Route::get('/facility-reports/{id}/responses', [FacilityReportResponseController::class, 'index']);
  
    Route::get('/aspirations/{id}/responses', [AspirationResponseController::class, 'index']);
    Route::get('/aspirations', [AspirationController::class, 'apiIndex']);
    Route::get('/aspirations/{id}', [AspirationController::class, 'apiShow']);
});

Route::get('/lost-found-data', [LostFoundItemController::class, 'apiIndex']);

?>
