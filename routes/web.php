<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('login', function () {
    $r = request('r');
    if (Auth::check()) {
        $url = route('admin.home');
        if ($r) {
            $url = urldecode($r);
        }
        return redirect($url);
    }
    return view('login');
})->name('login');

Route::post('/auth/login', [AuthController::class, 'login'])->name('web.login');

Route::middleware('auth')->group(function () {
    Route::middleware('admin.mdwl')->group(function () {

        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('web.logout');

        Route::prefix('admin-dash')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('', 'index')->name('admin.home');
                Route::get('clients', 'clients')->name('admin.client');
                Route::get('docta', 'docta')->name('admin.docteur');
                Route::get('conseils', 'conseils')->name('admin.conseils');
                Route::get('contact', 'contact')->name('admin.contact');
                Route::get('facturation', 'facturation')->name('admin.facturation');
                Route::get('taux', 'taux')->name('admin.taux');
            });
        });
    });
});
