<?php

use App\Http\Controllers\visor_maps\VisorMapsController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\visor_maps')->prefix('visor')->group(function () {
    Route::get('geolocalizacion', [VisorMapsController::class, 'index'])->name('geolocalizacion');
    Route::get('getAgencias', [VisorMapsController::class, 'getAgencias'])->name('getAgencias');
    Route::get('getTalleres', [VisorMapsController::class, 'getTalleres'])->name('getTalleres');
    Route::get('getVerificentros', [VisorMapsController::class, 'getVerificentros'])->name('getVerificentros');
    Route::get('getClientes', [VisorMapsController::class, 'getClientes'])->name('getClientes');
});
