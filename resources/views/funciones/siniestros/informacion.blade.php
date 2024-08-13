@extends('layouts.app')
@section('funciones','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Funciones</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('asignacionSiniestro.index')}}" class="rutas"><small>Siniestros</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Información</small></a></span></li>
@endsection
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-header bg-white border-0 d-flex justify-content-center justify-content-md-end gap-4">
            </div>
            {{-- ----------------------BOTONES------------------------------------------ --}}
            <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.4cm;">
                <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantallacomp"
                    data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                    &nbsp; &nbsp; &nbsp; Mi registro
                </a>

                <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantrespons"
                    data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                </a>
                {{-- --------------------------------------- --}}
                {{-- ------------------------------------------------------------------------------ --}}
                <a href="{{ route('siniestro.excel', $unidad) }}" class="btn btn-informe-orange boton-descargarInforme me-2"
                    id="btn-infor-pantcomplet">
                    &nbsp; &nbsp; &nbsp; &nbsp;Descargar informe
                </a>

                <button class="btn btn-outline-light btn-excel me-2 boton-informexcel"
                    style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive">
                </button>
                {{-- --------------------------------------------------------------------------------------------------- --}}
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">Folio</th>
                                <th scope="col" class="encabezado">Vehiculo</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Aseguradora</th>
                                <th scope="col" class="encabezado">Tipo de póliza</th>
                                <th scope="col" class="encabezado">Siniestro</th>
                                <th scope="col" class="encabezado">Monto deducible</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registros as $registro)
                                <tr class="text-center">
                                    <td class="text-start">{{ 'SI-' . str_pad($registro->id_asignar_siniestro, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $registro->unidad->tipo_unidad->descripcion }}</td>
                                    <td>{{ $registro->unidad->UltimoArrendamiento->placas }}</td>
                                    <td>{{ $registro->unidad->UltimoArrendamiento->Cliente->nombre_cliente }}</td>
                                    <td>{{ $registro->unidad->datosAseguradora->aseguradora->nombre_aseguradora }}</td>
                                    <td>{{ $registro->unidad->datosAseguradora->polizas->nombre_poliza }}</td>
                                    <td>{{ $registro->siniestros->nombre ?? ''}}</td>
                                    <td>${{ number_format($registro->unidad->datosAseguradora->monto_deducible_seguro,2) }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('siniestro.detalle', $registro) }}">Ver</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('funciones.siniestros.miRegistro')
@endsection
