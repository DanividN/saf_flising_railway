@extends('layouts.app')

@php
    $cliente = $asignacionPoliza->unidad->datosAsignacion->cliente->nombre_cliente ?? '';
    $vehiculo = $asignacionPoliza->unidad->tipo_unidad->descripcion;
    $tipo_poliza = $asignacionPoliza->unidad->datosAseguradora->polizas->nombre_poliza;
    $responsable_activo = $asignacionPoliza->unidad->datosAsignacion->responsable->nombre_responsable ?? '';
    $marca = $asignacionPoliza->unidad->marca->descripcion;
    $no_poliza = $asignacionPoliza->n_poliza;
    $cargo = $asignacionPoliza->unidad->datosAsignacion->responsable->cargo ?? '';
    $placas = $asignacionPoliza->unidad->datosAsignacion->placas ?? 'No hay placas asignadas';
    $gps = $asignacionPoliza->unidad->datosAseguradora->gps->nombre_gps;
    $telefono = $asignacionPoliza->unidad->datosAsignacion->responsable->telefono_responsable ?? '';
    $motor = $asignacionPoliza->unidad->n_motor;
    $idUnidad = $asignacionPoliza->unidad->vehiculo_id;
    $aseguradora = $asignacionPoliza->aseguradora->nombre_aseguradora;
@endphp

@section('admi', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Administración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('asignacionPoliza.index')}}" class="rutas"><small>Asignación seguro</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('informacion.poliza',$asignacionPoliza->id_unidad)}}" class="rutas"><small>Información de unidad</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Información de asignación</small></span></li>
@endsection

@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        @include('components.administracion.detalleUnidad', [
            'cliente' => $cliente,
            'vehiculo' => $vehiculo,
            'tipo_poliza' => $tipo_poliza,
            'responsable_activo' => $responsable_activo,
            'marca' => $marca,
            'no_poliza' => $no_poliza,
            'cargo' => $cargo,
            'placas' => $placas,
            'gps' => $gps,
            'telefono' => $telefono,
            'motor' => $motor,
            'idUnidad' => $idUnidad,
            'aseguradora' => $aseguradora,
        ])

        <div class="card shadow-md mt-2 border-0 p-2">
            <div class="card-body">
                <form action="{{ route('addSeguro.store') }}" method="post" class="needs-validation" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de pago</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_pago" class="form-control datepicker"
                                    value="{{ $asignacionPoliza->fecha_pago }}" placeholder="dd/mm/aaaa" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="monto-iva"><b>Monto con IVA</b><span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #999998;"><i
                                            class="bi bi-currency-dollar" style="color:white;"></i></span>
                                    <input type="text" name="monto_seguro" class="form-control cantidad"
                                        value="{{ $asignacionPoliza->monto_seguro }}" placeholder="Ingrese la cantidad"
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="monto-deducible"><b>Monto de deducible</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #999998;"><i
                                            class="bi bi-currency-dollar" style="color:white;"></i></span>
                                    <input type="text" name="monto_deducible_seguro" class="form-control cantidad"
                                        value="{{ $asignacionPoliza->monto_deducible_seguro }}"
                                        placeholder="Ingrese la cantidad" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Aseguradora</b><span class="text-danger">*</span></label><br>
                                <input type="text" class="form-control cantidad"
                                    value="{{ $asignacionPoliza->aseguradora->nombre_aseguradora }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>No. de póliza</b><span class="text-danger">*</span></label>
                                <input type="text" name="n_poliza" class="form-control"
                                    value="{{ $asignacionPoliza->n_poliza }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de Inicio</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_inicio" class="form-control datepicker" placeholder="dd/mm/aaaa" value="{{$asignacionPoliza->fecha_inicio}}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de vencimiento</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_vencimiento" class="form-control datepicker"
                                    placeholder="dd/mm/aaaa" value="{{ $asignacionPoliza->fecha_vencimiento }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Tipo de póliza</b><span class="text-danger">*</span></label><br>
                                <input type="text" class="form-control cantidad"
                                    value="{{ $asignacionPoliza->unidad->datosAseguradora->polizas->nombre_poliza }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Adicional de póliza</b><span class="text-danger">*</span></label>
                                <input type="text" name="adicional_poliza" class="form-control"
                                    value="{{ $asignacionPoliza->adicional_poliza }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Evidencia</b></label><br>
                                <div class="input-group">
                                    @if (isset($asignacionPoliza->a_evidencia))
                                        <a href="{{ url('storage/' . $asignacionPoliza->a_evidencia) }}" download
                                            class="input-download-link">
                                            <span class="input-group-text icono-download"><i
                                                    class="bi bi-download"></i></span>
                                        </a>
                                    @endif
                                    <input type="file" name="a_poliza" value="{{ $asignacionPoliza->a_evidencia }}"
                                        class="input-archivo-down"
                                        id="archivo-input-down{{ $asignacionPoliza->id_asignacion_seguros }}"
                                        data-id="{{ $asignacionPoliza->id_asignacion_seguros }}"
                                        placeholder="Documento de póliza" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Póliza</b></label><br>
                                <div class="input-group">
                                    @if (isset($asignacionPoliza->a_poliza))
                                        <a href="{{ url('storage/' . $asignacionPoliza->a_poliza) }}" download
                                            class="input-download-link">
                                            <span class="input-group-text icono-download"><i
                                                    class="bi bi-download"></i></span>
                                        </a>
                                    @endif
                                    <input type="file" name="a_poliza" value="{{ $asignacionPoliza->a_poliza }}"
                                        class="input-archivo-down"
                                        id="archivo-input-down{{ $asignacionPoliza->id_asignacion_seguros }}"
                                        data-id="{{ $asignacionPoliza->id_asignacion_seguros }}"
                                        placeholder="Documento de póliza" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-2">

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>GPS</b><span class="text-danger">*</span></label><br>
                                <input type="text" class="form-control cantidad"
                                    value="{{ $asignacionPoliza->unidad->datosAseguradora->gps->nombre_gps }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-regresar', ['link' => 'asignacionPoliza.index'])
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src='{{asset('js/input-file.js')}}'></script>
@endsection
