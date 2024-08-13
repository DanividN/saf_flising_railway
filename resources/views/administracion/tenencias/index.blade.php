@extends('layouts.app')
@section('admi','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('unidadTenencia.index')}}" class="rutas"><small>Tenencias</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Tenencia</a></label>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2 tarjeta">

            {{-- ----------- --}}
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:1cm;">
                <a href="" id="btn-pantcomp" class="btn btn-informe">Informe</a>
                <button class="btn btn-outline-light btn-excel boton-informexcel"
                    style="color: #ED5429; border-color: #ED5429"id="btn-responsive" role="button">
                </button>
            </div>
            {{--  --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Modelo</th>
                                <th scope="col" class="encabezado">Año</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $unidad)
                                <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $unidad->UltimoArrendamiento->placas ?? 'Sin asignación' }}</td>
                                    <td>{{ $unidad->marca->descripcion }}</td>
                                    <td>{{ $unidad->modelo }}</td>
                                    <td>{{ date('Y') }}</td>
                                    <td>
                                        @if ($unidad->tieneTenenciaActual())
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>&nbsp;
                                                <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                            </span>
                                        @elseif ($unidad->sinTenenciaDespuesDeMarzo())
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>&nbsp;
                                                <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                                            </span>
                                        @else
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>&nbsp;
                                                <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                            </span>
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
                                                        href="{{ route('unidadTenencia.show', $unidad) }}">Información</a>
                                                </li>
                                                @if (!$unidad->tieneTenenciaActual())
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('unidadTenencia.edit', $unidad) }}">Agregar
                                                            tenencia</a></li>
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
@endsection
