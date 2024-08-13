<?php

use App\Http\Controllers\catalogos\municipioController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\funciones')->prefix('funciones/verificacion')->group(function () {
    Route::get('/', 'verificacionController@indexFunciones')->name('verificacion.indexFunciones');
    Route::get('/{unidad}', 'verificacionController@informacion')->name('verificacion.informacion');
    Route::get('/show/{cita}', 'verificacionController@show')->name('verificacion.show');
    Route::post('/store/{cita}', 'verificacionController@store')->name('verificacion.store');
    Route::post('/{unidad}', 'verificacionController@agendar')->name('verificacion.agendar');
    Route::post('miRegistro/{unidad}', 'verificacionController@miRegistro')->name('verificacion.miRegistro');
    
    
    Route::get('/municipios/{id_estado}', [municipioController::class, 'index']);
    Route::get('/verificentros/{municipio}','verificacionController@verificentros')->name('verificentros');
    Route::get('/dowload/{unidad}','verificacionController@dowload')->name('verificaciones.dowload');
});

Route::namespace('App\Http\Controllers\funciones')->prefix('administracion/verificacion')->group(function () {
    Route::get('/municipios/{id_estado}', [municipioController::class, 'index']);
    Route::get('/', 'verificacionController@indexAdministracion')->name('verificacion.indexAdministracion');
    Route::get('/verificentros/{municipio}','verificacionController@verificentros')->name('verificentros');
});

Route::get('informes/showInforme', 'App\Http\Controllers\funciones\verificacionController@showInforme')->name('verificacion.showInforme');
Route::post('informes/verificacion', 'App\Http\Controllers\funciones\verificacionController@informe')->name('verificacion.informe');
Route::get('informes/dowloadInforme', 'App\Http\Controllers\funciones\verificacionController@dowloadInforme')->name('verificacion.dowloadInforme');