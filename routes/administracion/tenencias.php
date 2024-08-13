<?php

use App\Http\Controllers\administracion\tenenciaController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {

    Route::resource('tenencias', 'tenenciaController');
    Route::get('excel_tenencia/{unidad}',[tenenciaController::class,'excel_ficha'])->name('tenencias.excel');
});
