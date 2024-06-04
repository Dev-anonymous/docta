<?php

use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConseilAPIController;
use App\Http\Controllers\API\ConseilMedicalAPIController;
use App\Http\Controllers\API\ContactAPIController;
use App\Http\Controllers\API\DoctaAPIController;
use App\Http\Controllers\API\ForfaitAPIController;
use App\Http\Controllers\API\GoPAYController;
use App\Http\Controllers\API\SiteAPIController;
use App\Http\Controllers\API\TauxAPIController;
use App\Http\Controllers\API\ZegocloudController;
use App\Models\Conseilmedical;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::resource('contact', ContactAPIController::class);

Route::prefix('v1')->group(function () {
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

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/chat', [AppController::class, 'getchat']);
        Route::post('/chat', [AppController::class, 'postmessage']);
        Route::post('user/message/received', [AppController::class, 'received2']);
        Route::post('user/chat/received', [AppController::class, 'chatreceived']);
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // ADMIN
    Route::resource('doctas', DoctaAPIController::class);
    Route::resource('conseil', ConseilAPIController::class);
    Route::resource('forfait', ForfaitAPIController::class);
    Route::resource('taux', TauxAPIController::class);
    Route::resource('zego', ZegocloudController::class);
    Route::resource('site', SiteAPIController::class);
});
