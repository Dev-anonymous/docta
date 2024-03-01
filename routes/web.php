<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('login', function () {
    return view('login');
})->name('login');

// Route::middleware('auth')->group(function () {
Route::prefix('admin-dash')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('', 'index')->name('admin.home');
        Route::get('clients', 'clients')->name('admin.client');
        Route::get('docta', 'docta')->name('admin.docteur');
        Route::get('conseils', 'conseils')->name('admin.conseils');
    });
});
// });
