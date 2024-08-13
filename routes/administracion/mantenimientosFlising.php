<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administracion\mantenimientosFlisingController;
use App\Http\Controllers\catalogos\municipioController;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {
    Route::get('mantenimientos/index', [mantenimientosFlisingController::class, 'index'])->name('mantenimientos/index');
    Route::get('mantenimientos/show/{unidad_id}', [mantenimientosFlisingController::class, 'create'])->name('mantenimientos/show');
    Route::get('mantenimientos/show/municipios/{id_estado}', [municipioController::class, 'index']);
    Route::get('mantenimientos/show/proveedores/{id_municipio}', [mantenimientosFlisingController::class, 'getProveedores']);
    Route::get('mantenimientos/show/direccion/{id_proveedor}', [mantenimientosFlisingController::class, 'getProveedoresDireccion']);
    Route::get('mantenimientos/show/fecha_mant/{id_unidad}', [mantenimientosFlisingController::class, 'getFechaMantenimiento']);
    Route::post('mantenimientos/show/store', [mantenimientosFlisingController::class, 'store'])->name('mantenimientos/show/store');
    Route::get('mantenimientos/show/seguimiento/{id_cita_mantenimiento}', [mantenimientosFlisingController::class, 'seguimientoMantenimiento'])->name('mantenimientos/show/seguimiento');
    Route::post('mantenimientos/show/store_seguimiento', [mantenimientosFlisingController::class, 'storeSeguimientoMantenimiento'])->name('mantenimientos/show/store_seguimiento');
    Route::get('mantenimientos/show/aceptado/{id_citas_mantenimiento}', [mantenimientosFlisingController::class,'aceptado'])->name('mantenimientos/show/aceptado');
    Route::get('mantenimientos/show/rechazado/{id_citas_mantenimiento}', [mantenimientosFlisingController::class,'rechazado'])->name('mantenimientos/show/rechazado');
    Route::get('mantenimientos/show/pendiente/{id_citas_mantenimiento}', [mantenimientosFlisingController::class,'pendiente'])->name('mantenimientos/show/pendiente');
    Route::post('mantenimientos/show/update', [mantenimientosFlisingController::class, 'update'])->name('mantenimientos/show/update');
});
