<?php

use App\Http\Controllers\administracion\autorizacionMantenimientoController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {
    Route::get('mantenimientos/autorizacion/index', [autorizacionMantenimientoController::class,'index'])->name('mantenimientos/autorizacion/index');
    Route::get('mantenimientos/autorizacion/ver/{id_citas_mantenimiento}', [autorizacionMantenimientoController::class,'show'])->name('mantenimientos/autorizacion/ver');
    Route::get('mantenimientos/autorizacion/rechazado/{id_citas_mantenimiento}', [autorizacionMantenimientoController::class,'showRechazado'])->name('mantenimientos/autorizacion/rechazado');
    Route::get('mantenimientos/autorizacion/autorizado/{id_citas_mantenimiento}', [autorizacionMantenimientoController::class,'showRechazado'])->name('mantenimientos/autorizacion/autorizado');
    Route::post('mantenimientos/autorizacion/update', [autorizacionMantenimientoController::class,'update'])->name('mantenimientos/autorizacion/update');
});
