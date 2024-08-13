<?php

use App\Http\Controllers\administracion\SupervisionController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {
    Route::get('/supervision/index', [SupervisionController::class, 'index'])->name('supervision.index');
    Route::get('/supervision/unidades/arrendadas/{id_cliente}', [SupervisionController::class, 'unidadesArrendadas'])->name('supervision.unidades.arrendadas');
    Route::post('/supervision/agendar/cita', [SupervisionController::class, 'agendarCitaSupervision'])->name('supervision.agendar.cita');
    Route::get('/supervision/lista/unidades/{id_cliente}', [SupervisionController::class, 'listaUnidadesAgendadas'])->name('supervision.lista.unidades');
    Route::get('/supervision/historial/citas/cliente/{id_cliente}/unidad/{id_unidad}', [SupervisionController::class, 'historialCitas'])->name('supervision.historial.citas');
    Route::get('/supervision/historial/citas/{id_citas_supervision}/mostrar/validacion', [SupervisionController::class, 'mostrarValidacionUnidad'])->name('supervision.mostrar.validacion');
    Route::get('/supervision/citas/{id_citas_supervision}/validacion', [SupervisionController::class, 'validarSupervision'])->name('supervision.validacion.unidad');
    Route::patch('/supervision/citas/{id_citas_supervision}/cancelar', [SupervisionController::class, 'cancelarCita'])->name('supervision.cancelar.cita');
    Route::get('/supervision/citas/informe', [SupervisionController::class, 'informeSupervision'])->name('supervision.informe.supervision');
    Route::post('/supervision/citas/informe/resultados', [SupervisionController::class, 'resultadosInformeSupervision'])->name('supervision.informe.resultados');
    Route::get('/supervision/citas/informe/excel/cliente/{id_cliente}/status/{status}/anio/{year}/mes/{mes}', [SupervisionController::class, 'generarInformeSupervision'])->name('supervision.informe.excel');
    Route::get('/supervision/historial/citas/unidad/{id_unidad}/cliente/{id_cliente}', [SupervisionController::class, 'historialCitasUnidad'])->name('supervision.historial.citas.unidad');
});
