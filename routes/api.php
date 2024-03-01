<?php

use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctaAPIController;
use App\Http\Controllers\API\GoPAYController;
use Illuminate\Support\Facades\Route;


Route::get('uid', [AppController::class, 'uid']);

Route::middleware('uid.mdwl')->group(function () {
    Route::get('message', [AppController::class, 'getmessage']);
    Route::post('message', [AppController::class, 'message']);
    Route::post('message/received', [AppController::class, 'received']);
    Route::get('solde', [AppController::class, 'solde']);
    Route::post('/pay/init', [GoPAYController::class, 'init_payment']);
    Route::get('/pay/check', [GoPAYController::class, 'check_payment']);
    Route::post('/profil', [AppController::class, 'profil']);
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/chat', [AppController::class, 'getchat']);
    Route::post('/chat', [AppController::class, 'postmessage']);
    Route::post('user/message/received', [AppController::class, 'received2']);
    Route::post('user/chat/received', [AppController::class, 'chatreceived']);
});

Route::resource('doctas', DoctaAPIController::class);
