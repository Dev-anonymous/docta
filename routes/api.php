<?php

use App\Http\Controllers\API\AppController;
use Illuminate\Support\Facades\Route;


Route::get('uid', [AppController::class, 'uid']);

Route::middleware('uid.mdwl')->group(function () {
    Route::get('message', [AppController::class, 'getmessage']);
    Route::post('message', [AppController::class, 'message']);
    Route::post('message/received', [AppController::class, 'received']);
});
