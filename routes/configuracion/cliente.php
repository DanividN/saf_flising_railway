<?php

use App\Http\Controllers\configuracion\clienteController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\configuracion')->prefix('configuracion')->group(function () {

    Route::resource('clientes', 'clienteController');
    Route::get('clientesver/{cliente}',[clienteController::class, 'lectura'])->name('clientes.ver');
    Route::get('clientes_municipios', [clienteController::class, 'getMunicipios'])->name('clientes.municipio');
    Route::resource('responsables','clienteResponsableController');
});
