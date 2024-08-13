<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\configuracion\talleresAgenciasController;

Route::namespace('App\Http\Controllers\configuracion')->prefix('configuracion')->group(function () {
    Route::get('agencias_talleres/index', [talleresAgenciasController::class, 'index'])->name('agencias_talleres/index');
    Route::get('agencias_talleres/nuevo', [talleresAgenciasController::class, 'create'])->name('agencias_talleres/nuevo');
    Route::get('agencias_talleres/agencias_talleres_municipios', [talleresAgenciasController::class, 'getMunicipios'])->name('agencias_talleres_municipios');
    Route::post('agencias_talleres/store', [talleresAgenciasController::class, 'store'])->name('agencias_talleres/store');
    Route::get('agencias_talleres/ver/{id_proveedor}', [talleresAgenciasController::class, 'show'])->name('agencias_talleres/ver');
    Route::get('agencias_talleres/editar/{id_proveedor}', [talleresAgenciasController::class, 'edit'])->name('agencias_talleres/editar');
    Route::post('agencias_talleres/update/{id_proveedor}', [talleresAgenciasController::class, 'update'])->name('agencias_talleres/update');
    Route::get('agencias_talleres/seguimiento/{id_proveedor}', [talleresAgenciasController::class, 'seguimiento'])->name('agencias_talleres/seguimiento');
    Route::post('agencias_talleres/garantiaStore', [talleresAgenciasController::class, 'storeGarantias'])->name('agencias_talleres/garantiaStore');
    Route::post('agencias_talleres/garantiaUpdate/{id_garantia_proveedor}', [talleresAgenciasController::class, 'updateGarantias'])->name('agencias_talleres/garantiaUpdate');
});
