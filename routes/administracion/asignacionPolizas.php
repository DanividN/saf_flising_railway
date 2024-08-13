<?php

use App\Http\Controllers\administracion\asignacionPolizaController;
use App\Http\Controllers\catalogos\polizaSeguroController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {
    Route::resource('asignacionPoliza', 'asignacionPolizaController');
    Route::get('asignacionPoliza/addSeguro/{poliza}', [asignacionPolizaController::class,'addSeguro'])->name('asignacionPoliza.addSeguro');
    Route::post('asignacionPoliza/addSeguro/store', [asignacionPolizaController::class,'storeSeguro'])->name('addSeguro.store');
    Route::get('asignacionPoliza/addSeguro/polizas/{id_aseguradora}', [polizaSeguroController::class, 'index']);
    Route::get('asignacionPoliza/información/polizas/{id_unidad}', [asignacionPolizaController::class, 'info'])->name('informacion.poliza');
    Route::get('poliza/{id_asignacion_seguros}', [asignacionPolizaController::class, 'show'])->name('showPoliza');
    Route::get('informe_poliza/{id_unidad}', [asignacionPolizaController::class, 'informePolizas'])->name('informe_poliza');
});
