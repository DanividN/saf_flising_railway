<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\configuracion\garantiaController;

Route::namespace('App\Http\Controllers\configuracion')->prefix('configuracion')->group(function () {

    Route::resource('garantias', 'garantiaController');
    Route::get('garantias_municipios/{id}',[garantiaController::class,'getMunicipios'])->name('garantias.getMunicipios');
    Route::resource('garantias_seguimiento', 'garantiaSeguimientoController');
});
