<?php

use App\Http\Controllers\funciones\emergenciasCallController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\funciones')->prefix('funciones')->group(function () {
    Route::resource('emergenciasCall','emergenciasCallController');
    Route::get('emergencias/{id_emergencia}', [emergenciasCallController::class, 'info'])->name('emergenciasCall.info');
    Route::post('emergencias/llamada', [emergenciasCallController::class, 'llamadaStore'])->name('emergencias.llamada');
    Route::get('clientes/{id_cliente}', [emergenciasCallController::class, 'unidadesAsignadas']);
    Route::get('responsable/{id_unidad}', [emergenciasCallController::class, 'responsableAsignado']);
    Route::get('informe_emergencias/{emergencia}', [emergenciasCallController::class, 'informeEmergencias'])->name('informe_emergencias');
});
