<?php

use App\Http\Controllers\funciones\asignacionSiniestrosController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\funciones')->prefix('funciones')->group(function () {

    Route::resource('asignacionSiniestro','asignacionSiniestrosController');
    Route::get('asignacionSiniestroUnidad', [asignacionSiniestrosController::class, 'Unidades'])->name('siniestro.unidades');
    Route::get('asignacionSiniestroDetalle/{asignacioSiniestro}', [asignacionSiniestrosController::class, 'detalles'])->name('siniestro.detalle');
    Route::get('asignacionSiniestroDetalleExcell/{asignacioSiniestro}',[asignacionSiniestrosController::class,'excel_ficha'])->name('siniestro.excel');
    Route::post('siniestroMiRegistro',[asignacionSiniestrosController::class, 'miRegistro'])->name('siniestro.registro');
});
