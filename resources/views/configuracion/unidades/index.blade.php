@extends('layouts.app')
@section('configuracion','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Registro de unidades</small></a></span></li>
@endsection
@section('content')
@include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Registro de Unidades:</a></label>
        </div>

        <div class="row">
            <div class="" style="margin-bottom:-70px;">
                <button type="button" class="btn boton-regresar"></button>
                <strong style="margin-left:1px; color:#ED5429; font-size:18px;"><b>Regresar</b></strong>
            </div>
            
            <div class="d-flex justify-content-end mt-4 mb-2" style="margin-right: 0.4cm">
                <a href="{{ route('unidades.create') }}" class="btn add_agencia" id="btn-pantcomp">
                    <i class="bi bi-plus-lg"></i> Agregar unidad
                </a>
                <a href="{{ route('unidades.create') }}" class="btn add_agencia" id="btn-responsive">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>            
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                {{-- <div class="row">
                    <div class="d-flex justify-content-end mt-4 mb-2">
                        <a href="{{ route('unidades.create') }}" class="btn add_agencia"
                        id="btn-pantcomp">
                            <i class="bi bi-plus-lg"></i> Agregar unidad
                        </a>

                        <a href="{{ route('unidades.create') }}" class="btn add_agencia"
                        id="btn-responsive">
                            <i class="bi bi-plus-lg"></i>
                        </a>

                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="encabezado">No</th>
                                <th scope="col" class="encabezado">Vehículo</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Número de serie</th>
                                <th scope="col" class="encabezado">Proveedor</th>
                                <th scope="col" class="encabezado">I.D Unidad</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $unidad)
                                <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $unidad->tipo_unidad->descripcion }}</td>
                                    <td>{{ $unidad->marca->descripcion }}</td>
                                    <td>{{ $unidad->n_serie }}</td>
                                    <td>{{ $unidad->proveedor->nombre_comercial }}</td>
                                    <td>{{ $unidad->vehiculo_id }}</td>
                                    <td>{{ $unidad->estado->accion ?? 'DISPONIBLE' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                @if ((($unidad->estado->accion ?? 'DISPONIBLE')== 'VENTA' || ($unidad->estado->accion ?? 'DISPONIBLE')== 'BAJA' || ($unidad->estado->accion ?? 'DISPONIBLE')== 'OCUPADA'))
                                                    <li><a class="dropdown-item" href="{{ route('unidades.edit', $unidad) }}">Ver</a></li>
                                                    @else
                                                    <li><a class="dropdown-item" href="{{ route('unidades.edit', $unidad) }}">Ver/Editar</a></li>
                                                @endif
                                                <li><a class="dropdown-item" href="{{ route('unidades.show', $unidad) }}">Historial</a></li>
                                                @if((($unidad->estado->accion ?? 'DISPONIBLE')== 'DISPONIBLE' || ($unidad->estado->accion ?? 'DISPONIBLE')== 'BAJA') && $unidad->activo == 1 )
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#responsableModal" data-id="{{ $unidad->id_unidad }}">Estatus</a></li>
                                                @endif
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
    @include('configuracion.unidades.estatus')
@endsection
