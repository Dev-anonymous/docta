<?php

use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\AppVersionAPIController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategorieAPIController;
use App\Http\Controllers\API\CategoriemagAPIController;
use App\Http\Controllers\API\ClientAPIController;
use App\Http\Controllers\API\ConseilAPIController;
use App\Http\Controllers\API\ConseilMedicalAPIController;
use App\Http\Controllers\API\ContactAPIController;
use App\Http\Controllers\API\DemandeadhesionAPIController;
use App\Http\Controllers\API\DoctaAPIController;
use App\Http\Controllers\API\ForfaitAPIController;
use App\Http\Controllers\API\MagazineAPIController;
use App\Http\Controllers\API\PAYController;
use App\Http\Controllers\API\PushnotificationAPIController;
use App\Http\Controllers\API\SiteAPIController;
use App\Http\Controllers\API\SlideAPIController;
use App\Http\Controllers\API\StatistiqueAPIController;
use App\Http\Controllers\API\TauxAPIController;
use App\Http\Controllers\API\ZegocloudController;
use App\Models\Conseilmedical;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::resource('contact', ContactAPIController::class);
Route::post('new-doctor', [DemandeadhesionAPIController::class, 'store'])->name('newdoctor');

Route::prefix('v1')->group(function () {
    Route::post('/applog', [AppController::class, 'error']);

    Route::get('uid', [AppController::class, 'uid']);
    Route::get('dl', [AppController::class, 'dl'])->name('dl');
    Route::get('appversion', [AppController::class, 'appversion']);

    Route::middleware('uid.mdwl')->group(function () {
        Route::get('getallmessage', [AppController::class, 'getallmessage']);
        Route::get('message', [AppController::class, 'getmessage'])->name('api.message');
        Route::post('message', [AppController::class, 'message']);
        Route::post('message/received', [AppController::class, 'received'])->name('api.received');
        Route::get('solde', [AppController::class, 'solde']);
        Route::post('/pay/init', [PAYController::class, 'init_payment'])->name('api.init.pay');
        Route::get('/pay/check', [PAYController::class, 'check_payment'])->name('api.check.pay');
        Route::post('/pay/cardpayment', [PAYController::class, 'cardpayment']);
        Route::post('/profil', [AppController::class, 'profil'])->name('api.profile');
        Route::get('/pay/pay-historique', [AppController::class, 'payhistorique']);
        Route::post('/docta', [AppController::class, 'docta'])->name('api.docta');
        Route::get('/docta', [AppController::class, 'getdocta']);
        Route::get('/doctabycode', [AppController::class, 'doctabycode']);
    });

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('doctaprofil', [AppController::class, 'doctaprofil']);
        Route::get('forfait-profil', [AppController::class, 'forfait_profil']);
        Route::post('pay/init2', [PAYController::class, 'init_payment2'])->name('api.docta.payinit');
        Route::get('pay/check2', [PAYController::class, 'check_payment'])->name('api.docta.paycheck');

        // client
        Route::get('subscribeval', [AppController::class, 'subscribeval'])->name('subscribeval');
        Route::post('/pay/init3', [PAYController::class, 'init_payment3'])->name('api.init.pay3');

        // Docta Mobile APP
        Route::middleware('docta.mdwl')->group(function () {
            Route::post('/auth/logout', [AuthController::class, 'logout']);
            Route::get('/chat', [AppController::class, 'getchat'])->name('api.docta.chat');
            Route::post('/chat', [AppController::class, 'postmessage']);
            Route::post('user/message/received', [AppController::class, 'received2'])->name('api.docta.received');
            Route::post('user/chat/received', [AppController::class, 'chatreceived'])->name('api.docta.received-2');
            Route::get('getallmessage-admin', [AppController::class, 'getallmessageadmin']);
        });
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // ADMIN
    Route::resource('doctas', DoctaAPIController::class);
    Route::resource('demandeadhesion', DemandeadhesionAPIController::class);
    Route::post('doctas/{docta}', [DoctaAPIController::class, 'update']);
    Route::resource('conseil', ConseilAPIController::class);
    Route::resource('forfait', ForfaitAPIController::class);
    Route::resource('taux', TauxAPIController::class);
    Route::resource('zego', ZegocloudController::class);
    Route::resource('site', SiteAPIController::class);
    Route::resource('appversion', AppVersionAPIController::class);
    Route::resource('clients', ClientAPIController::class);
    Route::any('stat', [StatistiqueAPIController::class, 'index'])->name('stat.index');
    Route::resource('slide', SlideAPIController::class);
    Route::post('slide/{slide}', [SlideAPIController::class, 'update']);
    Route::resource('pushnotification', PushnotificationAPIController::class);
    Route::resource('categorie', CategorieAPIController::class);
    Route::resource('categoriemag', CategoriemagAPIController::class);
    Route::resource('magazine', MagazineAPIController::class);
});
