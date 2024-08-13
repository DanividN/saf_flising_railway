<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\administracion')->prefix('administracion')->group(function () {


    Route::get('/asignacionUnidades', 'asignacionUnidadController@index')->name('asignacionUnidades.index');
    Route::get('/asignacionUnidades/{cliente}', 'asignacionUnidadController@show')->name('asignacionUnidades.show');
    Route::group(['prefix' => 'step','controller'=>'asignacionUnidadController'], function () {
        Route::get('1','step1')->name('step1');
        Route::post('1','store1')->name('store1');
        Route::get('2/{asignacionUnidade}','step2')->name('step2');
        Route::post('2/{asignacionUnidade}','store2')->name('store2');
        Route::get('3/{asignacionUnidade}','step3')->name('step3');
        Route::post('3/{asignacionUnidade}','store3')->name('store3');
        Route::get('4/{asignacionUnidade}','step4')->name('step4');
        Route::post('4/{asignacionUnidade}','store4')->name('store4');
    });
    Route::get('getResponsables/{cliente}','asignacionUnidadController@getResponsables')->name('getResponsables');
    Route::get('getTerminacionPlacas','asignacionUnidadController@getTerminacionPlacas')->name('getTerminacionPlacas');
    Route::get('getGarantias/{proveedor}','asignacionUnidadController@getGarantias')->name('getGarantias');

    Route::post('estado/{asignacionUnidade}','asignacionUnidadController@estado')->name('estado');

});
