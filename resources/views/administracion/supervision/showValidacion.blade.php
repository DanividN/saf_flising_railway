@extends('layouts.app')

@section('admi','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Superivisión</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Validación</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid">
        <div class="titulo-responsive">
            <label><a>{{ $cita->unidad->modelo }} - {{ $cita->asignacionUnidad->placas }}</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                @include('administracion.supervision.infoUnidad')

                <div class="row">
                    <h6 class="title-orange m-0 mt-4 ">Seguimiento de la unidad</h6>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6 
                            @isset($cita->asignacionUnidad->talon_verificacion)
                                {{ $cita->asignacionUnidad->talon_verificacion ? 'text-success' : 'text-danger' }}
                            @else
                                text-danger
                            @endisset"><b>Talón de verificación</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->talon_verificacion)
                                    {{ $cita->supervision->talon_verificacion ? 'checked' : '' }}
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->engomado)
                                    {{ $cita->asignacionUnidad->engomado ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Engomado</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->engomado)
                                    {{ $cita->supervision->engomado ? 'checked' : '' }} 
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->tarjeta_circulacion)
                                    {{ $cita->asignacionUnidad->tarjeta_circulacion ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Tarjeta de circulación</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->tarjeta_circulacion)
                                    {{ $cita->supervision->tarjeta_circulacion ? 'checked' : '' }}
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->manual_usuario)
                                    {{ $cita->asignacionUnidad->manual_usuario ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Manual de usuario</b></label>
                            <input type="checkbox" class="form-check-input col-md-6"
                                @isset($cita->supervision->manual_usuario) 
                                    {{ $cita->supervision->manual_usuario ? 'checked' : '' }} 
                                @endisset 
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->poliza_seguro)
                                    {{ $cita->asignacionUnidad->poliza_seguro ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Poliza de seguro</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6"  
                                @isset($cita->supervision->poliza_seguro) 
                                    {{ $cita->supervision->poliza_seguro ? 'checked' : '' }} 
                                @endisset  
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->triangulo_seguridad)
                                    {{ $cita->asignacionUnidad->triangulo_seguridad ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Triángulos de seguridad</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->triangulo_seguridad)
                                    {{ $cita->supervision->triangulo_seguridad ? 'checked' : '' }}
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->llanta_refaccion)
                                    {{ $cita->asignacionUnidad->llanta_refaccion ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Llanta de refacción</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->llanta_refaccion)
                                    {{ $cita->supervision->llanta_refaccion ? 'checked' : '' }}
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->gato_hidraulico)
                                    {{ $cita->asignacionUnidad->gato_hidraulico ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Gato Hidráulico</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->gato_hidraulico)
                                    {{ $cita->supervision->gato_hidraulico ? 'checked' : '' }}
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->poliza_mantenimiento)
                                    {{ $cita->asignacionUnidad->poliza_mantenimiento ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Póliza de mantenimiento</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->poliza_mantenimiento)
                                    {{ $cita->supervision->poliza_mantenimiento ? 'checked' : '' }}
                                @endisset 
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->llave_repuesto)
                                    {{ $cita->asignacionUnidad->llave_repuesto ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Llave de repuesto</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->llave_repuesto)
                                    {{ $cita->supervision->llave_repuesto ? 'checked' : '' }}
                                @endisset 
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6
                                @isset($cita->asignacionUnidad->placas_check)
                                    {{ $cita->asignacionUnidad->placas_check ? 'text-success' : 'text-danger' }}
                                @else
                                    text-danger
                                @endisset"><b>Placas</b></label>
                            <input 
                                type="checkbox" 
                                class="form-check-input col-md-6" 
                                @isset($cita->supervision->placas_check)
                                    {{ $cita->supervision->placas_check ? 'checked' : '' }}
                                @endisset
                                disabled
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div>
                            <label for=""><b>Acta de entrega</b></label>
                        </div>
                        <div class="form-group d-flex">
                            @isset($cita->asignacionUnidad->a_entrega)
                                <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                    <a style='color: white;' href="{{ asset('storage/'.$cita->asignacionUnidad->a_entrega) }}" target="_blank">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </span>
                            @endisset
                            <input 
                                type="text" 
                                disabled 
                                class="input-archivo-down input-archivo" 
                                value="{{ $cita->unidad->nombre_archivo_entrega ? $cita->unidad->nombre_archivo_entrega : 'No hay archivo' }}"
                                style="font-size: 12px !important; text-align: start !important; margin-left: 2px !important;"
                            >
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="" class="col-md-6"><b>Vida útil de las llantas</b></label>
                            <select class="form-select mt-2" name="vida_util_llantas" id="vida_util_llantas" disabled>
                                <option value="" selected>-- Seleccionar --</option>
                                <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'BUENA' ? 'selected' : '' }} @endisset value="BUENA">Buena</option>
                                <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'REGULAR' ? 'selected' : '' }} @endisset value="REGULAR">Regular</option>Regular</option>
                                <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'MALA' ? 'selected' : '' }} @endisset value="MALA">Mala</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="mt-4 mb-2">

                <h6 class="title-orange m-0 mt-4">Estetica de la unidad</h6>
                <div class="row">
                    <h6 class="m-0">Vista frontal</h6>
                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                        <img 
                            src="{{ isset($cita->supervision->img_frontal) ? asset('storage/'.$cita->supervision->img_frontal) : asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}"
                            alt="menu" 
                            style="width: 100% !important; height: 100% !important;"
                        >
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Evidecias</h6>
                        @isset($cita->supervision->evidecia_vista_frontal)
                            <img 
                                src="{{ isset($cita->supervision->evidecia_vista_frontal) ? asset('storage/'.$cita->supervision->evidecia_vista_frontal) : asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 95% !important; margin-top: 5px;"
                            >
                        @else
                            <div style="width: 100%; height: 95%; background-color: #E9ECEF; margin-top: 5px; border-radius: 5px;"></div>
                        @endisset
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Observaciones</h6>
                        <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_frontal){{ $cita->supervision->obsevaciones_vista_frontal }}@endisset</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <h6 class="m-0">Vista trasera</h6>
                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                        <img 
                            src="{{ isset($cita->supervision->img_trasera) ? asset('storage/'.$cita->supervision->img_trasera) : asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}"
                            alt="menu" 
                            style="width: 100% !important; height: 100% !important;"
                        >
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Evidecias</h6>
                        @isset($cita->supervision->evidecia_vista_trasera)
                            <img 
                                src="{{ isset($cita->supervision->evidecia_vista_trasera) ? asset('storage/'.$cita->supervision->evidecia_vista_trasera) : asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 95% !important; margin-top: 5px;"
                            >
                        @else
                            <div style="width: 100%; height: 95%; background-color: #E9ECEF; margin-top: 5px; border-radius: 5px;"></div>
                        @endisset
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Observaciones</h6>
                        <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_trasera){{ $cita->supervision->obsevaciones_vista_trasera }}@endisset</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <h6 class="m-0">Vista derecha</h6>
                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                        <img 
                            src="{{ isset($cita->supervision->img_derecha) ? asset('storage/'.$cita->supervision->img_derecha) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}"
                            alt="menu" 
                            style="width: 100% !important; height: 100% !important;"
                        >
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Evidecias</h6>
                        @isset($cita->supervision->evidecia_vista_derecha)
                            <img 
                                src="{{ isset($cita->supervision->evidecia_vista_derecha) ? asset('storage/'.$cita->supervision->evidecia_vista_derecha) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 95% !important; margin-top: 5px;"
                            >
                        @else
                            <div style="width: 100%; height: 95%; background-color: #E9ECEF; margin-top: 5px; border-radius: 5px;"></div>
                        @endisset
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Observaciones</h6>
                        <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_derecha) {{ $cita->supervision->obsevaciones_vista_derecha }} @endisset</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <h6 class="m-0">Vista izquierda</h6>
                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                        <img 
                            src="{{ isset($cita->supervision->img_izquierda) ? asset('storage/'.$cita->supervision->img_izquierda) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}"
                            alt="menu" 
                            style="width: 100% !important; height: 100% !important;"
                        >
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Evidecias</h6>
                        @isset($cita->supervision->evidecia_vista_izquierda)
                            <img 
                                src="{{ isset($cita->supervision->evidecia_vista_izquierda) ? asset('storage/'.$cita->supervision->evidecia_vista_izquierda) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 95% !important; margin-top: 5px;"
                            >
                        @else
                            <div style="width: 100%; height: 95%; background-color: #E9ECEF; margin-top: 5px; border-radius: 5px;"></div>
                        @endisset
                    </div>

                    <div class="col-md-4 mt-4 " style="max-height: 600px; max-width: 600px;">
                        <h6 class="m-0">Observaciones</h6>
                        <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_izquierda) {{ $cita->supervision->obsevaciones_vista_izquierda }} @endisset</textarea>
                    </div>
                </div>

                <hr class="mt-4 mb-2">

                <div class="row mt-4">
                    <div class="col-md-2" style="border: 1px solid #adadad; border-radius: 5px;">
                        <h6 class="m-0 title-orange">Firma del cliente</h6>
                        @isset($cita->supervision->img_firma_cliente)
                            <img 
                                src="{{ asset('storage/'.$cita->supervision->img_firma_cliente) }}"
                                alt="menu" 
                                style="width: 100% !important;"
                            >
                        @endisset
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="title-orange">Observaciones del supervisor</label>
                            <textarea class="form-control" rows="5" style="width: 100% !important;" disabled>@isset($cita->supervision->observacion_supervisor){{ $cita->supervision->observacion_supervisor }}@endisset</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for=""><b>Proceso</b></label>
                            <input type="text" class="form-control" value="{{ $cita->notificacion_citas }}" disabled>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label for=""><b>Observaciones</b></label>
                            <textarea class="form-control" rows="5" disabled>{{ $cita->observacion_flising }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center gap-4 mt-4">
                    @include('components.btn-regresar', ['link' => 'supervision.historial.citas', 'params' => ['id_cliente' => $cita->cliente->id_cliente, 'id_unidad' => $cita->unidad->id_unidad]])
                </div>
            </div>
        </div>
    </div>
@endsection