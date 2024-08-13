<?php

use App\Http\Controllers\configuracion\unidadController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\configuracion')->prefix('configuracion')->group(function () {
   Route::resource('unidades','unidadController');
   Route::get('unidades_proveedor', [unidadController::class, 'getProveedores'])->name('unidades.proveedor');
   Route::put('unidades_estatus/{unidade}',[unidadController::class,'estatus'])->name('unidades.estatus');
});
