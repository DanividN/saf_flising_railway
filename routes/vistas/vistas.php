<?php

use Illuminate\Support\Facades\Route;

//-------------------------------- Modulo de administracion --------------------------------
//Rutas de autorización de mantenimiento
// Route::get('/autorizacionesMantenimiento/index', function () {
//     return view('administracion.autorizacionesMantenimiento.index');
// })->name('autorizacionesMantenimiento.index');

// Route::get('/autorizacionesMantenimiento/show', function () {
//     return view('administracion.autorizacionesMantenimiento.show');
// })->name('autorizacionesMantenimiento.show');

// *************************************************************************************
//Rutas de emergercia
Route::get('admin/emergencias/index', function () {
    return view('administracion.emergencias.index');
})->name('admin.emergencias.index');

Route::get('/emergencias/show', function () {
    return view('administracion.emergencias.show');
})->name('admin.emergencias.show');

// *************************************************************************************
//Rutas garanatias flising
Route::get('admin/garantiasFlising/index', function () {
    return view('administracion.garantiasFlising.index');
})->name('admin.garantiasFlising.index');

Route::get('/garantiasFlising/show', function () {
    return view('administracion.garantiasFlising.show');
})->name('garantiasFlising.show');

Route::get('admin/garantiasFlising/informacion', function () {
    return view('administracion.garantiasFlising.informacion');
})->name('admin.garantiasFlising.informacion');

//Rutas garantias agencia------------------ADMIN--------------------
Route::get('admin/garantiasAgencia/index', function () {
    return view('administracion.garantiasAgencia.index');
})->name('admin.garantiasAgencia.index');

Route::get('admin/garantiasAgencia/informacion', function () {
    return view('administracion.garantiasAgencia.informacion');
})->name('admin.garantiasAgencia.informacion');

// Funciones-------------------------------------------------------
Route::get('funciones/garantiasAgencia/index', function () {
    return view('funciones.garantiasAgencia.index');
})->name('funciones.garantiasAgencia.index');

Route::get('funciones/garantiasAgencia/informacion', function () {
    return view('funciones.garantiasAgencia.informacion');
})->name('funciones.garantiasAgencia.informacion');


//-------------------------Rutas de supervisión-----------------------------------
Route::get('/supervision/index', function () {
    return view('administracion.supervision.index');
})->name('supervision.index');

Route::get('/supervision/lista/unidades', function () {
    return view('administracion.supervision.listaUnidades');
})->name('supervision.listaUnidades');

Route::get('/supervision/lista/unidades/informacion', function () {
    return view('administracion.supervision.informacion');
})->name('supervision.informacion');

Route::get('/supervision/lista/unidades/agregar/validacion', function () {
    return view('administracion.supervision.agregarValidacion');
})->name('supervision.agregarValidacion');

//Rutas de tenencia
Route::get('/tenencias/index', function () {
    return view('administracion.tenencias.index');
})->name('tenencias.index');

Route::get('/tenencias/agregar', function () {
    return view('administracion.tenencias.agregarTenencias');
})->name('tenencias.agregar');

Route::get('/tenencias/informacion', function () {
    return view('administracion.tenencias.informacion');
})->name('tenencias.informacion');

Route::get('/tenencias/show', function () {
    return view('administracion.tenencias.show');
})->name('tenencias.show');


//Rutasde seguro-GPS
Route::get('/seguroGPS/index', function () {
    return view('administracion.seguroGPS.index');
})->name('seguroGPS.index');

Route::get('/seguroGPS/informacion', function () {
    return view('administracion.seguroGPS.informacion');
})->name('seguroGPS.informacion');


Route::get('/seguroGPS/agregar', function () {
    return view('administracion.seguroGPS.agregarSeguro');
})->name('seguroGPS.agregar');


Route::get('administracion/verificaciones/index', function () {
    return view('administracion.verificaciones.index');
})->name('admin.verificacion.index');

Route::get('administracion/verificaciones/informacion', function () {
    return view('administracion.verificaciones.informacion');
})->name('admin.verificacion.informacion');

Route::get('administracion/verificaciones/informacion/show', function () {
    return view('administracion.verificaciones.show');
})->name('admin.verificacion.show');

//Rutas de Mantenimiento
// Route::get('administracion/mantenimientos/index', function () {
//     return view('administracion.mantenimientos.index');
// })->name('admin.mantenimientos.index');

// Route::get('administracion/mantenimientos/informacion', function () {
//     return view('administracion.mantenimientos.informacion');
// })->name('admin.mantenimientos.informacion');

// Route::get('administracion/mantenimientos/informacion/show', function () {
//     return view('administracion.mantenimientos.show');
// })->name('admin.mantenimientos.show');

// ------------------------2 parte------------------------
// -------------------------------------------------------
//***********-------------------------------- Modulo de funciones --------------------------------*************************
//Rutas de Verificacion------------------------------------------------------------------------------------------------------
Route::get('/verificaciones/index', function () {
    return view('funciones.verificaciones.index');
})->name('verificaciones.index');

Route::get('/verificaciones/informacion', function () {
    return view('funciones.verificaciones.informacion');
})->name('verificacion.informacion');

Route::get('/verificaciones/informacion/show', function () {
    return view('funciones.verificaciones.show');
})->name('verificacion.show');

// //Rutas de Mantenimiento
// Route::get('/mantenimientos/index', function () {
//     return view('funciones.mantenimientos.index');
// })->name('mantenimientos.index');

// Route::get('/mantenimientos/informacion', function () {
//     return view('funciones.mantenimientos.informacion');
// })->name('mantenimientos.informacion');

// Route::get('/mantenimientos/informacion/show', function () {
//     return view('funciones.mantenimientos.show');
// })->name('mantenimientos.show');

//Rutas de Siniestros
Route::get('/siniestros/index', function () {
    return view('funciones.siniestros.index');
})->name('siniestros.index');

Route::get('/siniestros/agregar', function () {
    return view('funciones.siniestros.agregarSiniestro');
})->name('siniestros.agregar');

Route::get('/siniestros/informacion', function () {
    return view('funciones.siniestros.informacion');
})->name('siniestros.informacion');

//Rutas de Emergencias
Route::get('funciones/emergencias/index', function () {
    return view('funciones.emergencias.index');
})->name('funciones.emergencias.index');

Route::get('/emergencias/show', function () {
    return view('funciones.emergencias.show');
})->name('emergencias.show');

Route::get('/emergencias/informacion', function () {
    return view('funciones.emergencias.informacion');
})->name('emergencias.informacion');


// *************************************************************************************
//Rutas de Garantias flising
Route::get('funciones/garantiasFlising/index', function () {
    return view('funciones.garantiasFlising.index');
})->name('funciones.garantiasFlising.index');

Route::get('funciones/garantiasFlising/informacion', function () {
    return view('funciones.garantiasFlising.informacion');
})->name('funciones.garantiasFlising.informacion');

// ------RUTAS DE INFORMES----------------------------------------------------------------------
Route::get('informes/informeTenencias', function () {
    return view('informes.informeTenencias');
})->name('informes.informeTenencias');

Route::get('informes/informeSegurosGps', function () {
    return view('informes.informeSegurosGps');
})->name('informes.informeSegurosGps');

Route::get('informes/informeVerificaciones', function () {
    return view('informes.informeVerificaciones');
})->name('informes.informeVerificaciones');


Route::get('informes/informeSiniestros', function () {
    return view('informes.informeSiniestros');
})->name('informes.informeSiniestros');


Route::get('informes/informeSupervision', function () {
    return view('informes.informeSupervision');
})->name('informes.informeSupervision');

Route::get('informes/informeCallCenter', function () {
    return view('informes.informeCallCenter');
})->name('informes.informeCallCenter');

Route::get('informes/informeEgresos', function () {
    return view('informes.informeEgresos');
})->name('informes.informeEgresos');

Route::get('informes/informeAdministrativo', function () {
    return view('informes.informeAdministrativo');
})->name('informes.informeAdministrativo');

Route::get('informes/informeProductividad', function () {
    return view('informes.informeProductividad');
})->name('informes.informeProductividad');


Route::get('informes/informeMantenimiento', function () {
    return view('informes.informeMantenimiento');
})->name('informes.informeMantenimiento');




