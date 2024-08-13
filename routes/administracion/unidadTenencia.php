<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {

    Route::resource('unidadTenencia', 'unidadesTenenciaController');
});
