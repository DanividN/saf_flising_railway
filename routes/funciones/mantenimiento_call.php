<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\catalogos\municipioController;
use App\Http\Controllers\funciones\MantenimientoCallCenterController;

Route::namespace('App\Http\Controllers\funciones')->prefix('funciones')->group(function () {
    Route::get('mantenimientos/index', [MantenimientoCallCenterController::class, 'index'])->name('mantenimientos.index');
    Route::get('mantenimientos/informacion/{unidad_id}', [MantenimientoCallCenterController::class, 'infoMantenimiento'])->name('mantenimientos/informacion');
    Route::get('mantenimientos/informacion/municipios/{id_estado}', [municipioController::class, 'index']);
    Route::get('mantenimientos/informacion/proveedores/{id_municipio}', [MantenimientoCallCenterController::class, 'getProveedores']);
    Route::get('mantenimientos/informacion/direccion/{id_proveedor}', [MantenimientoCallCenterController::class, 'getProveedoresDireccion']);
    Route::get('mantenimientos/informacion/fecha_mant/{id_unidad}', [MantenimientoCallCenterController::class, 'getFechaMantenimiento']);
    Route::post('mantenimientos/informacion/store', [MantenimientoCallCenterController::class, 'storeCitaMantenimiento'])->name('mantenimientos/informacion/store');
    Route::get('mantenimientos/seguimiento/{id_cita_mantenimiento}', [MantenimientoCallCenterController::class, 'seguimientoMantenimiento'])->name('mantenimientos/seguimiento');
    Route::post('mantenimientos/seguimiento/store', [MantenimientoCallCenterController::class, 'storeSeguimientoMatenimiento'])->name('mantenimientos/seguimiento/store');
    Route::get('mantenimientos/seguimiento/rechazado/{id_citas_mantenimiento}', [MantenimientoCallCenterController::class,'rechazado'])->name('mantenimientos/seguimiento/rechazado');
    Route::get('mantenimientos/seguimiento/aceptado/{id_citas_mantenimiento}', [MantenimientoCallCenterController::class,'aceptado'])->name('mantenimientos/seguimiento/aceptado');
    Route::get('mantenimientos/seguimiento/pendiente/{id_citas_mantenimiento}', [MantenimientoCallCenterController::class,'pendiente'])->name('mantenimientos/seguimiento/pendiente');
    Route::post('mantenimientos/seguimiento/update', [MantenimientoCallCenterController::class, 'updateSeguimientoMatenimiento'])->name('mantenimientos/seguimiento/update');
    Route::post('mantenimientos/seguimiento/excel', [MantenimientoCallCenterController::class, 'informeMantenimientoExcel'])->name('mantenimientos/seguimiento/excel');
    Route::post('mantenimientos/seguimiento/store_llamada', [MantenimientoCallCenterController::class, 'storeRegistroLlamadas'])->name('mantenimientos/seguimiento/store_llamada');
});
