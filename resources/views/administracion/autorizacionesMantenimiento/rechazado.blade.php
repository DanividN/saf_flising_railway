@extends('layouts.app')

@php
    $cliente = 'Cliente 1';
    $vehiculo = 'Automovil';
    $tipo_poliza = 'Poliza 1';
    $responsable_activo = 'Responsable 1';
    $marca = 'Marca 1';
    $no_poliza = '123-ABC';
    $cargo = 'Cargo 1';
    $placas = 'Placas 1';
    $gps = 'GPS 1';
    $telefono = '1234567890';
    $motor = 'Motor 1';
    $idUnidad = 'ID 1';
    $aseguradora = 'Aseguradora 1';
@endphp

@section('content')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Siniestros</a></label>
        </div>
        @include('components.administracion.detalleUnidad', [
            'cliente' =>  $info_mantenimiento[0]->asignacion_unidad->cliente->nombre_cliente,
            'vehiculo' => $info_mantenimiento[0]->unidad->tipo_unidad->descripcion,
            'tipo_poliza' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->polizas->nombre_poliza : 'N/A',
            'responsable_activo' => $info_mantenimiento[0]->asignacion_unidad->responsable->nombre_responsable,
            'marca' => $info_mantenimiento[0]->unidad->marca->descripcion,
            'no_poliza' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->n_poliza : 'N/A',
            'cargo' => $info_mantenimiento[0]->asignacion_unidad->responsable->cargo,
            'placas' => $info_mantenimiento[0]->asignacion_unidad->placas,
            'gps' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->gps->nombre_gps : 'N/A',
            'telefono' => $info_mantenimiento[0]->asignacion_unidad->responsable->telefono_responsable,
            'motor' => $info_mantenimiento[0]->unidad->n_motor,
            'garantia_extendida' => isset($garantia_extendida) ? $garantia_extendida : 'N/A',
            'idUnidad' => $info_mantenimiento[0]->unidad->vehiculo_id,
            'aseguradora' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->aseguradora->nombre_aseguradora : 'N/A'
        ])
        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="cliente"><b>Agencia / Taller</b></label>
                            <input type="text" class="form-control" id="cliente" name="cliente" value="{{ $info_mantenimiento[0]->asignacion_unidad->cliente->nombre_cliente, }}" readonly>
                        </div>
                    </div>
                
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label><b>Kilometraje / Tiempo</b></label>
                            <input class="form-control" value="{{ $autorizacion[0]->citas_mantenimiento->unidad->kilometraje }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label><b>Fecha de cita</b></label>
                            <input class="form-control" value="{{ $autorizacion[0]->citas_mantenimiento->fecha_mantenimiento }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label><b>Fecha de mantenimiento</b></label>
                            <input class="form-control" value="{{ $autorizacion[0]->citas_mantenimiento->unidad->fecha_mantenimiento }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label><b>Monto con IVA</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control" value="{{ number_format($autorizacion[0]->monto_mantenimiento,2) }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label><b>Tipo de mantenimiento</b></label>
                            <input class="form-control" @if($autorizacion[0]->tipo_mantenimiento == 2) value="Correctivo" @else value="Preventivo" @endif readonly>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label><b>Nivel de autorización</b></label>
                            <input class="form-control" @if($autorizacion[0]->autorizacion == 2) value="Avanzado" @else value="Básico" @endif readonly>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-12 mt-4">
                        <div class="form-group">
                            <label><b>Cotización</b></label><br>
                            <div class="input-group mb-3">
                                <a  class="btn btn-outline-secondary" type="button" style="background: #ed5429;" id="button-addon1" href="{{url('storage/'.$autorizacion[0]->a_cotizacion)}}" download>
                                    <i class="bi bi-download" style="color:#ffffff"></i>
                                </a>
                                <input type="text" class="form-control" value="Cotización.pdf">
                            </div>
                        </div>
                    </div>
                    

                    <hr class="mt-4 mb-2">

                    <div class="mt-4">
                        <div class="form-group">
                            <label><b>Observaciones</b></label>
                            <textarea class="form-control" rows="3" disabled>{{ $autorizacion[0]->observaciones_call  }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-4 mt-4">
                    {{--  El componente regresar recibe una parametro opcional llamado params para redirigir a una ruta con parametros  --}}
                    {{-- Ejemplo:  @include('components.btn-regresar', ['link' => 'siniestros.index', 'params' => $idUnidad])  --}}
                    @include('components.btn-regresar', ['link' => 'mantenimientos/autorizacion/index'])
                    {{--  <input type="button" class="btn btn-enviar" value="Validar" data-bs-toggle="modal" data-bs-target="#staticBackdrop">  --}}
                </div>
            </div>
        </div>
    </div>
    @include('administracion.autorizacionesMantenimiento.modalAutorizar')
@endsection