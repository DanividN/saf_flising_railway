@extends('layouts.app')
@section('funciones','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Funciones</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('asignacionSiniestro.index')}}" class="rutas"><small>Siniestros</small></a></span></li>
@endsection
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Siniestros</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.4cm;">
                <button class="btn btn-informe me-2" id="btn-infor-pantcomplet">
                    <strong>Informe</strong>
                </button>
                <button class="btn btn-outline-light btn-excel me-2 boton-informexcel"
                    style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive">
                </button>
                <button class="btn boton-principal boton-principal-corto me-2" data-bs-toggle="modal" id="btn-pantcomp"
                    data-bs-target="#siniestroModal" style="margin-right: .4cm;">
                    <i class="fa fa-plus" aria-hidden="true"></i> <strong>Agregar Siniestro</strong>
                </button>

                <button class="btn btn-respvagregar" id="btn-agregarResponsive" data-bs-toggle="modal"
                    data-bs-target="#siniestroModal" style="margin-right: .4cm;">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Vehiculo</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Aseguradora</th>
                                <th scope="col" class="encabezado">Tipo de póliza</th>
                                <th scope="col" class="encabezado">Siniestro</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $unidad)
                                <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $unidad->tipo_unidad->descripcion }}</td>
                                    <td>{{ $unidad->UltimoArrendamiento->placas }}</td>
                                    <td>{{ $unidad->datosAseguradora->aseguradora->nombre_aseguradora ?? '' }}</td>
                                    <td>{{ $unidad->datosAseguradora->polizas->nombre_poliza ?? '' }}</td>
                                    <td>
                                        @if ($unidad->siniestros->isNotEmpty())
                                            {{ $unidad->siniestros->first()->siniestros->nombre ?? ''}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('asignacionSiniestro.show', $unidad) }}">Información</a>
                                                </li>
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
    @include('funciones.siniestros.form')
@endsection
