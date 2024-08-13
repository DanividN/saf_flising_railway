<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\funciones\garantiaCallCenterController;

Route::namespace('App\Http\Controllers\funciones')->prefix('funciones')->group(function () {

    Route::resource('garantias_callCenter', 'garantiaCallCenterController');
    Route::post('garantias_callCenter/altaRegistroAtencion', [garantiaCallCenterController::class,'altaRegistroAtencion'])->name('altaRegistroAtencion');
    // Route::get('garantias_municipios/{id}',[garantiaController::class,'getMunicipios'])->name('garantias.getMunicipios');
});
