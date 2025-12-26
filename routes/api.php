Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin-responses', [AdminResponseApiController::class, 'index']);
    Route::get('/admin-responses/{id}', [AdminResponseApiController::class, 'show']);

    Route::get('/facility-reports/{id}/responses', [FacilityReportResponseController::class, 'index']);
    Route::get('/aspirations/{id}/responses', [AspirationResponseController::class, 'index']);
});