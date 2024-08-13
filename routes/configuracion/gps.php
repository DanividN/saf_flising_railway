<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\catalogos\municipioController;

Route::namespace('App\Http\Controllers\configuracion')->prefix('configuracion')->group(function () {
    Route::resource('gps', 'gpsController');
    Route::get('gps/municipios/{id_estado}', [municipioController::class, 'index']);
});
