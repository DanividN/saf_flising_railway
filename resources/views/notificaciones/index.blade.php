@extends('layouts.app')
@section('inicio', 'active')

@section('content') 
<div class="notificaciones">
    <div class="row" style="margin-top:10px">
        <a href="{{url('home')}}">
            <img src="{{asset('img/notificaciones/regresar.png')}}" width="25px">
        </a>
    </div>
    <div class="row" style="margin-left:100px; margin-top:-30px; margin-bottom:30px">
        <h3 class="title-orange">Notificaciones</h3>        
    </div>
    <!-- notificaciones garantias -->
    <div class="container-fluid mt-2" style="border-radius:5px !important">
        <div class="card-header header-style" style="background-color:#ED5426 !important; ">
            <span class="ms-2" style="color: #fff">Garant&iacute;as Flising</span>
        </div>
        <div class="card-body body-style" >
            <div class="row">
                <div class="col-md-4 m-2 mt-3">
                    <div class="form-group">
                        <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_garantias.png') }}" width="40px">
                        <div class="noti-garantias">
                            <span class="text-noti">La cobertura de 99 unidades est&aacute; <br> proxima a vencer.</span>
                        </div>
                        <div style="margin-left:55px;" class="mt-1">
                            <span class="date-style">Julio 25 a las 10:15 am</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notificacion tenencias -->
    <div class="container-fluid mt-4">
        <div class="card-header header-style" style="background-color:#ED5426 !important; ">
            <span class="ms-2" style="color: #fff">Tenencia</span>
        </div>
        <div class="card-body  body-style">
            <div class="row">
                <div class="col-md-4 m-2 mt-4">
                    <div class="form-group">
                        <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_tenencia.png') }}" width="45px">
                        <div class="noti-tenencias">
                            <span class="text-noti">99 Tenencias pendientes de pago.</span>
                        </div>
                        <div style="margin-left:55px;" class="mt-3">
                            <span class="date-style">Julio 25 a las 10:15 am</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notificaciones mantenimiento -->
    <div class="container-fluid mt-4">
        <div class="card-header header-style" style="background-color:#ED5426 !important; ">
            <span class="ms-2" style="color: #fff">Mantenimiento</span>
        </div>
        <div class="card-body body-style">
            <div class="row">
                <div class="col-md-4 m-2 mt-3">
                    <div class="form-group mt-3">
                        <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_mantenimiento.png') }}" width="50px">
                        <div style="margin-left:65px; margin-top:-50px;">
                            <span class="text-noti">Tienes 99 mantenimientos <br> pendientes.</span>
                        </div class="noti-mtto">
                        <div style="margin-left:65px;" class="mt-1  date-styles">
                            <span class="date-style">Julio 25 a las 10:15 am</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notificaciones seguros -->
    <div class="container-fluid mt-4">
        <div class="card-header header-style" style="background-color:#ED5426 !important; ">
            <span class="ms-2" style="color: #fff">Seguros</span>
        </div>
        <div class="card-body body-style">
            <div class="row">
                <div class="col-md-4 m-2 mt-3">
                    <div class="form-group mt-3 ml-2">
                        <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_seguro.png') }}" width="45px">
                        <div class="noti-seguros">
                            <span class="text-noti">Hay 99 seguros pendientes <br> de pago.</span>
                        </div>
                        <div style="margin-left:65px;" class="mt-1">
                            <span class="date-style">Julio 25 a las 10:15 am</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notificaciones emergencias -->
    <div class="container mt-4">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseOne">
                    <span class="ms-2" style="color: #fff">Emergencias</span>
                </button>
                <div id="collapse1" class="accordion-collapse collapse " aria-labelledby="heading" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                        <div class="form-group mt-3">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_emergencias.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>
                                    Nueva emergencia agregada.
                                    Secretaria General de Gobierno - ABC123D
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                            <hr style="margin-top:2px; margin-bottom:10px"/>
                        </div>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_emergencias.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>
                                    Nueva emergencia agregada.
                                    Secretaria General de Gobierno - ABC123D
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                        <hr style="margin-top:2px;"/>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_emergencias.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>
                                    Nueva emergencia agregada.
                                    Secretaria General de Gobierno - ABC123D
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notificaciones supervision -->
    <div class="container mt-4">
        <div class="accordion" id="accordionExample1">
            <div class="accordion-item">
                <button style="color:#fff !important" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
                    Supervisi&oacute;n
                </button>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="supervision" data-bs-parent="#accordionExample1" >
                    <div class="accordion-body">
                        <div class="form-group mt-3">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_supervision.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>
                                    Nueva supervisi&oacute;n pendiente.
                                    Secretaria General de Gobierno - ABC123D
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                            <hr style="margin-top:2px; margin-bottom:10px"/>
                        </div>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_supervision.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>
                                    Nueva supervisi&oacute;n pendiente.
                                    Secretaria General de Gobierno - ABC123D
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                        <hr style="margin-top:2px;"/>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_supervision.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>
                                    Nueva supervisi&oacute;n pendiente.
                                    Secretaria General de Gobierno - ABC123D
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notificaciones verificacion -->
    <div class="container mt-4">
        <div class="accordion" id="accordionExample2">
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapseTres">
                    Verificaci&oacute;n
                </button>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="verificacion" data-bs-parent="#accordionExample2">
                    <div class="accordion-body">
                        <div class="form-group mt-3">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_verificacion.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>Tienes 30 verificaciones de unidad pendientes del primer semestre con terminaci&oacute;n 1 y 2</span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                            <hr style="margin-top:2px; margin-bottom:10px"/>
                        </div>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_verificacion.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>Tienes 30 verificaciones de unidad pendientes del primer semestre con terminaci&oacute;n 3 y 4</span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                        <hr style="margin-top:2px;"/>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_verificacion.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>Tienes 30 verificaciones de unidad pendientes del primer semestre con terminaci&oacute;n 5 y 6</span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                        <hr style="margin-top:2px; margin-bottom:0px"/>
                        <div class="form-group mt-4 ml-2">
                            <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_verificacion.png') }}" width="45px">
                            <div class="noti-garantias">
                                <span>Tienes 30 verificaciones de unidad pendientes del primer semestre con terminaci&oacute;n 7 y 8</span>
                            </div>
                            <div class="mt-1">
                                <span class="date-style" style="margin-left:50px !important">Julio 25 a las 10:15 am</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection