<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PAYController;
use App\Http\Controllers\DoctaController;
use App\Http\Controllers\WEBController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    $r = request('r');
    if (Auth::check()) {
        $role = auth()->user()->user_role;
        if ('admin' == $role) {
            $url = route('admin.home');
        } else if ('docta' == $role) {
            $url = route('docta.home');
        } else if ('client' == $role) {
            $url = route('web.index');
        } else {
            abort(403, 'Who are you ?');
        }
        if ($r) {
            $url = urldecode($r);
        }
        return redirect($url);
    }
    return view('login');
})->name('login');

Route::post('/auth/login', [AuthController::class, 'login'])->name('web.login');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('web.signup');

#####################################################################################################################
Route::get('/pay-cb', [PAYController::class, 'pay_cb'])->name('pay.callback');
Route::middleware('visite.mdwl')->group(function () {
    Route::get('', [WEBController::class, 'index'])->name('web.index');
    Route::get('/docta/{code?}', [WEBController::class, 'index'])->name('codedocta');
    Route::get('/politique-de-confidentialite', [WEBController::class, 'politique'])->name('web.politique');
    Route::get('/mention-legale', [WEBController::class, 'mention'])->name('web.mention');
    Route::get('/termes-et-conditions', [WEBController::class, 'terme'])->name('web.terme');
    Route::get('/apptermes', [WEBController::class, 'terme00'])->name('terme00');
    Route::get('/docta-mag', [WEBController::class, 'doctamag'])->name('doctamag');
});
Route::get('/doctor', [WEBController::class, 'doctor'])->name('web.doctor');
#####################################################################################################################



Route::middleware('auth')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('web.logout');

    Route::middleware('admin.mdwl')->group(function () {
        Route::prefix('admin-dash')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('', 'index')->name('admin.home');
                Route::get('clients', 'clients')->name('admin.client');
                Route::get('docta', 'docta')->name('admin.docteur');
                Route::get('demande-profil', 'demande')->name('admin.demande');
                Route::get('conseils', 'conseils')->name('admin.conseils');
                Route::get('slides', 'slides')->name('admin.slides');
                Route::get('contact', 'contact')->name('admin.contact');
                Route::get('facturation', 'facturation')->name('admin.facturation');
                Route::get('taux', 'taux')->name('admin.taux');
                Route::get('zegocloud', 'zegocloud')->name('admin.zegocloud');
                Route::get('site', 'site')->name('admin.site');
                Route::get('log', 'log')->name('admin.log');
                Route::get('app', 'app')->name('admin.app');
                Route::get('categorie', 'categorie')->name('admin.categorie');
                Route::get('categorie-mag', 'categoriemag')->name('admin.categoriemag');
                Route::get('magazine', 'magazine')->name('admin.magazine');
            });
        });
    });

    Route::prefix('docta-dash')->group(function () {
        Route::controller(DoctaController::class)->group(function () {
            Route::get('', 'index')->name('docta.home');
        });
    });

    Route::get('magdl', [AppController::class, 'magdl'])->name('magdl');

});

Route::post('uid', [AppController::class, 'uid'])->name('web.uid');
