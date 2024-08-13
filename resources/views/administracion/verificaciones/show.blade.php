@extends('layouts.app')

@php
    $cliente = 'Cliente 3';
    $vehiculo = 'Automovil';
    $tipo_poliza = 'Poliza 3';
    $responsable_activo = 'Responsable 3';
    $marca = 'Marca 3';
    $no_poliza = '323-ABC';
    $cargo = 'Cargo 3';
    $placas = 'Placas 3';
    $gps = 'GPS 3';
    $telefono = '3234567890';
    $motor = 'Motor 3';
    $idUnidad = 'ID 3';
    $aseguradora = 'Aseguradora 3';
@endphp

@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
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

        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Holograma</b><span class="text-danger">*</span></label>
                                <select class="menu">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="1">Holograma 1</option>
                                    <option value="2">Holograma 2</option>
                                    <option value="3">Holograma 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Periodo de verificación</b></label>
                                <input type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de verificación</b><span class="text-danger">*</span></label>
                                <input type="" class="datepicker form-control" placeholder="mm/dd/aaaa">
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Año en curso</b></label>
                                <input type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="montoVerificacion"><b>Monto de verificación</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control cantidad" id="montoVerificacion">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Evidencia</b></label>
                                <input type="file" class="input-archivo">
                            </div>
                        </div>

                        <hr class="mt-4 mb-2">

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Multa</b><span class="text-danger">*</span></label>
                                <select class="menu">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="1">Sí</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="montoMulta"><b>Monto multa</b><span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control cantidad" id="montoMulta">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Comprobante multa</b></label>
                                <input type="file" class="input-archivo">
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Estatus</b><span class="text-danger">*</span></label>
                                <select class="menu">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="2">Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for=""><b>Observaciones</b></label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-4 mt-4">
                        {{--  El componente regresar recibe una parametro opcional llamado params para redirigir a una ruta con parametros  --}}
                        {{-- Ejemplo:  @include('components.btn-regresar', ['link' => 'siniestros.index', 'params' => $idUnidad])  --}}

                        @include('components.btn-regresar', ['link' => 'tenencias.informacion'])

                        {{--  El text es opcional, por default es 'Guardar'  --}}
                        @include('components.btn-guardar', [
                            'link' => 'tenencias.index',
                        ])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
