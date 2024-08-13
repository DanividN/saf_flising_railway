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
                <form id="form-agregar-validacion-supervision" action="{{ route('supervision.cancelar.cita', $cita->id_citas_supervision) }}" novalidate class="needs-validation" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    @include('administracion.supervision.infoUnidad')

                    @include('administracion.supervision.seguimientoUnidad')

                    <hr class="mt-4 mb-2">

                    <h6 class="title-orange m-0 mt-4">Estetica de la unidad</h6>
                    <div class="row">
                        <h6 class="m-0">Vista frontal</h6>
                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                            <img 
                                src="{{ isset($cita->supervision->img_frontal) ? asset('storage/'.$cita->supervision->img_frontal) : asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 100% !important;"
                            >
                        </div>

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
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

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
                            <h6 class="m-0">Observaciones</h6>
                            <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_frontal){{ $cita->supervision->obsevaciones_vista_frontal }}@endisset</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <h6 class="m-0">Vista trasera</h6>
                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                            <img 
                                src="{{ isset($cita->supervision->img_trasera) ? asset('storage/'.$cita->supervision->img_trasera) : asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 100% !important;"
                            >
                        </div>

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
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

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
                            <h6 class="m-0">Observaciones</h6>
                            <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_trasera){{ $cita->supervision->obsevaciones_vista_trasera }}@endisset</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <h6 class="m-0">Vista derecha</h6>
                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                            <img 
                                src="{{ isset($cita->supervision->img_derecha) ? asset('storage/'.$cita->supervision->img_derecha) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 100% !important;"
                            >
                        </div>

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
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

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
                            <h6 class="m-0">Observaciones</h6>
                            <textarea class="form-control" rows="3" disabled style="width: 100% !important; height: 95% !important; margin-top: 5px;">@isset($cita->supervision->obsevaciones_vista_derecha) {{ $cita->supervision->obsevaciones_vista_derecha }} @endisset</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <h6 class="m-0">Vista izquierda</h6>
                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px; border: 1px solid #adadad; border-radius: 5px;">
                            <img 
                                src="{{ isset($cita->supervision->img_izquierda) ? asset('storage/'.$cita->supervision->img_izquierda) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}"
                                alt="menu" 
                                style="width: 100% !important; height: 100% !important;"
                            >
                        </div>

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
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

                        <div class="col-md-4 mt-4" style="max-height: 600px; max-width: 600px;">
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
                                <textarea class="form-control" rows="5" disabled style="width: 100% !important;" disabled>@isset($cita->supervision->observacion_supervisor){{ $cita->supervision->observacion_supervisor }}@endisset</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Proceso:<span class="text-danger">*</span> <span class="text-green-status">{{ $cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CONCLUIDA ? 'Concluida' : '' }}</span></b></label>
                                <select class="form-control font-bold" name="notificacion_citas" required>
                                    <option value="" selected >-- Seleccionar --</option>
                                    <option value="{{ \App\Models\administracion\CitaSupervision::CANCELADA }}">Cancelada</option>
                                    <option value="{{ \App\Models\administracion\CitaSupervision::VALIDADA }}">Validada</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for=""><b>Observaciones</b><span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="5" name="observacion_flising" id="observaciones_flising" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-regresar', ['link' => 'supervision.historial.citas', 'params' => ['id_cliente' => $cita->cliente->id_cliente, 'id_unidad' => $cita->unidad->id_unidad]])
                        @include('components.btn-guardar', ['id' => 'btn-agregar-validacion-supervision', 'text' => 'Guardar'])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/agregarValudacionSupervision.js') }}"></script>
@endsection