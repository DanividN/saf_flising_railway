<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administracion\garantiaFlisingController;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {

    Route::resource('garantias_flising', 'garantiaFlisingController');
    Route::get('garantia_cliente/{unidad}',[garantiaFlisingController::class,'unidadCliente'])->name('garantias.unidadCliente');
    Route::get('garantia_obtenerGarantias/{unidad}',[garantiaFlisingController::class,'obtenerGarantias'])->name('garantias.obtenerGarantias');
    Route::post('garantiasSeleccionadas',[garantiaFlisingController::class,'garantiasSeleccionadas'])->name('garantias.garantiasSeleccionadas');
});
