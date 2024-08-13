@extends('layouts.app')

@section('configuracion', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Configuración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Aseguradoras</small></span></li>
@endsection


@section('content')
@include('components.alertas')
<div class="container-fluid mt-5">

    <div class="titulo-responsive">
        <label><a>Registro de Aseguradoras:</a></label>
    </div>

    <div class="card">
    <div class="d-flex justify-content-end mt-3 mb-0 me-3">
        <a class="btn btn-primary boton-principal text-white" href="{{route('aseguradoras.create')}}"
        id="btn-pantcomp">
            <i class="bi bi-plus-lg"></i> <strong>Agregar aseguradora</strong>
        </a>
        <a class="btn btn-informe" href="{{route('aseguradoras.create')}}"
        id="btn-responsive">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="encabezado">No.</th>
                            <th class="encabezado">Nombre</th>
                            <th class="encabezado">Razón Social</th>
                            <th class="encabezado">RFC</th>
                            <th class="encabezado">Fecha de registro</th>
                            <th class="encabezado">Teléfono</th>
                            <th class="encabezado">Municipio</th>
                            <th class="encabezado">Acción</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($aseguradoras as $aseguradora)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$aseguradora->nombre_aseguradora}}</td>
                            <td>{{$aseguradora->razon_aseguradora}}</td>
                            <td>{{$aseguradora->rfc_aseguradora}}</td>
                            <td>{{ $aseguradora->created_at->format('m/d/Y') }}</td>
                            <td>{{$aseguradora->telefono_aseguradora}}</td>
                            <td>{{$aseguradora->municipio->nombre_municipio}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                    </a>
                                    <ul class="dropdown-menu p-0">
                                        <li><a class="dropdown-item" href="{{ route('aseguradoras.show',$aseguradora->id_aseguradora) }}">Ver/Editar</a>
                                        <li><a class="dropdown-item" href="{{ route('aseguradoras.tracking',$aseguradora->id_aseguradora) }}">Seguimiento</a>
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
@endsection
