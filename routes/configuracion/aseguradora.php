<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\catalogos\municipioController;

Route::namespace('App\Http\Controllers\configuracion')->prefix('configuracion')->group(function () {
    Route::resource('aseguradoras', 'aseguradoraController');
    Route::get('aseguradoras/municipios/{id_estado}', [municipioController::class, 'index']);
    Route::get('/aseguradoras/tracking/{aseguradora}', 'aseguradoraController@tracking')->name('aseguradoras.tracking');
    Route::post('/aseguradoras/tracking',  'aseguradoraController@trackingStore')->name('tracking.store');
    Route::put('/aseguradoras/tracking/{poliza}',  'aseguradoraController@trackingUpdate')->name('aseguradoras.tracking.update');
});
