<?php

use App\Http\Controllers\pwa\PwaClienteController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\pwa')->middleware('auth')->prefix('pwa')->group(function () {
    Route::get('/clientes/index', [PwaClienteController::class, 'index'])->name('pwa.clientes');
    Route::get('/clientes/search', [PwaClienteController::class, 'searchClientes'])->name('pwa.clientes.search');
    Route::get('/clientes/unidades/{id_cliente}', [PwaClienteController::class, 'unidadesCliente'])->name('pwa.clientes.unidades');
    Route::get('/clientes/unidades/search/{id_cliente}', [PwaClienteController::class, 'unidadesClienteSearch'])->name('pwa.clientes.unidades.search');
    Route::get('/clientes/unidades/agregar-validacion/cita/{cita}', [PwaClienteController::class, 'agregarValidacionUnidad'])->name('pwa.clientes.unidades.agregar-validacion');
    Route::post('/clientes/unidades/crear-validacion/cita/{citaSupervision}', [PwaClienteController::class, 'crearValidacion'])->name('pwa.clientes.unidades.crear-validacion');
    Route::get('/clientes/unidades/mostrar/validacion/{id_citas_supervision}', [PwaClienteController::class, 'mostrarValidacionUnidad'])->name('pwa.clientes.unidades.mostrar.validacion');
    Route::get('/clientes/notificaciones', [PwaClienteController::class, 'notificacionesCitas'])->name('pwa.clientes.notificaciones');
});