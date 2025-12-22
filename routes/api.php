<?php

use App\Http\Controllers\LostFoundItemController;


Route::get('/lost-found-data', [LostFoundItemController::class, 'apiIndex']);

?>