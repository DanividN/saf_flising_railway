@extends('layouts.app')

@php
    $cliente = $emergencia->nombre_cliente ?? '';
    $vehiculo = $emergencia->modelo ?? '';
    $tipo_poliza = $emergencia->nombre_poliza ?? '';
    $responsable_activo = $emergencia->nombre_responsable ?? '';
    $marca = $emergencia->marca ?? '';
    $no_poliza = $emergencia->n_poliza ?? '';
    $cargo = $emergencia->cargo ?? '';
    $placas = $emergencia->placas ?? '';
    $gps = $emergencia->nombre_gps ?? '';
    $telefono = $emergencia->telefono_responsable ?? '';
    $motor = $emergencia->n_motor ?? '';
    $idUnidad = $emergencia->vehiculo_id ?? '';
    $aseguradora = $emergencia->nombre_aseguradora ?? '';
@endphp

@section('funciones', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Funciones</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('emergenciasCall.index')}}" class="rutas"><small>Emergencias</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('emergenciasCall.info', $emergencia->id_asignacion_unidad)}}" class="rutas"><small>Información de emergencias</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Seguimiento de emergencia</small></span></li>
@endsection

@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Informacion de Unidad</a></label>
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
            'aseguradora' => $aseguradora
        ])

        <div class="card shadow-md mt-2 border-0 p-2">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Emergencia</b></label>
                                <input class="form-control" value="{{$emergencia->emergencia}}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label><b>Aseguradora</b></label>
                                <input class="form-control" value="{{$aseguradora}}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label><b>Estatus</b></label>
                                <select class="form-select combo" name="estado_emergencia" disabled >
                                    <option @if ($emergencia->estado_emergencia == 1) selected @endif>En proceso</option>
                                    <option @if ($emergencia->estado_emergencia == 2) selected @endif>Concluido</option>
                                    <option @if ($emergencia->estado_emergencia == 3) selected @endif>Cancelado</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <hr class="mt-4 mb-2">
                    @include('components.chat', ['id_asignacion_emergencia' => $emergencia->id_asignacion_emergencia])
                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-regresar', ['link' => 'emergenciasCall.index'])
                        @include('components.btn-guardar', ['text' => 'Guardar'])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
