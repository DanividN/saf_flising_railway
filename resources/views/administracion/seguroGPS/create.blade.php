@extends('layouts.app')

@php
    $cliente = $unidades[0]->datosAsignacion->cliente->nombre_cliente ?? '';
    $vehiculo = $unidades[0]->tipo_unidad->descripcion;
    $tipo_poliza = 'Poliza 3';
    $responsable_activo = $unidades[0]->datosAsignacion->responsable->nombre_responsable ?? '';
    $marca = $unidades[0]->marca->descripcion;
    $no_poliza = '323-ABC';
    $cargo = $unidades[0]->datosAsignacion->responsable->cargo ?? '';
    $placas = $unidades[0]->datosAsignacion->placas ?? 'No hay placas asignadas';
    $gps = 'GPS 3';
    $telefono = $unidades[0]->datosAsignacion->responsable->telefono_responsable ?? '';
    $motor = $unidades[0]->n_motor;
    $idUnidad = $unidades[0]->vehiculo_id;
    $aseguradora = 'Aseguradora 3';
@endphp

@section('admi', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Administración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('asignacionPoliza.index')}}" class="rutas"><small>Asignación seguro</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Registro de seguro</small></span></li>
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
                    <input type="text" name="id_unidad" value="{{ $unidades[0]->id_unidad }}" hidden>
                    <input type="text" value="1" name="activo" hidden>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de pago</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_pago" id="" class="form-control datepicker"
                                    placeholder="dd/mm/aaaa" required>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="monto-iva"><b>Monto con IVA</b><span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #999998;"><i
                                            class="bi bi-currency-dollar" style="color:white;"></i></span>
                                    <input type="text" name="monto_seguro" class="form-control cantidad" id="monto-iva"
                                        placeholder="Ingrese la cantidad" aria-label="Monto con IVA"
                                        aria-describedby="basic-addon" required>
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
                                        id="monto-deducible" placeholder="Ingrese la cantidad"
                                        aria-label="Monto de deducible" aria-describedby="basic-addon" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Aseguradora</b><span class="text-danger">*</span></label><br>
                                <select name="id_aseguradora" id="aseguradora" class="form-select" required>
                                    <option value="" hidden>Aseguradora</option>
                                    @foreach ($aseguradoras as $aseguradora)
                                        <option value="{{ $aseguradora->id_aseguradora }}">
                                            {{ $aseguradora->nombre_aseguradora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>No. de póliza</b><span class="text-danger">*</span></label>
                                <input type="text" name="n_poliza" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de Inicio</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_inicio" id="" class="form-control datepicker" placeholder="dd/mm/aaaa" required>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de vencimiento</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_vencimiento" id=""
                                    class="form-control datepicker" placeholder="dd/mm/aaaa" required>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Tipo de póliza</b><span class="text-danger">*</span></label><br>
                                <select name="id_poliza_seguro" id="poliza" class="form-select" required>
                                    <option value="" hidden>Pólizas</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Adicional de póliza</b><span class="text-danger">*</span></label>
                                <input type="text" name="adicional_poliza" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Evidencia</b></label><br>
                                <input type="file" name="a_evidencia" class="input-archivo-down"
                                    id="input-archivo-down" required>
                                <div class="invalid-feedback">
                                    Falta subir archivo
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Póliza</b></label><br>
                                <input type="file" name="a_poliza" class="input-archivo-down" id="input-archivo-down"
                                    required>
                                <div class="invalid-feedback">
                                    Falta subir archivo
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-2">

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>GPS</b><span class="text-danger">*</span></label><br>
                                <select name="id_gps" id="id_gps" class="form-select" required>
                                    <option value="" hidden>Gps</option>
                                    @foreach ($d_gps as $gps)
                                        <option value="{{ $gps->id_gps }}">{{ $gps->nombre_gps }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-4 mt-4">
                        {{--  El componente regresar recibe una parametro opcional llamado params para redirigir a una ruta con parametros  --}}
                        {{-- Ejemplo:  @include('components.btn-regresar', ['link' => 'siniestros.index', 'params' => $idUnidad])  --}}
                        @include('components.btn-regresar', ['link' => 'asignacionPoliza.index'])
                        {{--  El text es opcional, por default es 'Guardar'  --}}
                        @include('components.btn-guardar', [
                            'link' => 'tenencias.index',
                        ])
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src='{{asset('js/input-file.js')}}'></script>
    <script src='{{asset('js/validacionCampos.js')}}'></script>
    <script src='{{asset('js/seguroGPS/aseguradora.js')}}'></script>
@endsection
