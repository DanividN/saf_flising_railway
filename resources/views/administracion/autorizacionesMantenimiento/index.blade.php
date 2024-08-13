@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Autorizaciones de Mantenimiento</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center"><br>
                                <th scope="col" class="text-start encabezado">Folio</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Monto</th>
                                <th scope="col" class="encabezado">Fecha de solicitud</th>
                                <th scope="col" class="encabezado">Fecha de respuesta</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Nombre</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($autorizaciones as $autorizacion)
                                <tr>
                                    <td class="text-center align-center">{{ ++$i }}</td>
                                    <td class="text-center align-center">{{ $autorizacion->citas_mantenimiento->asignacion_unidad->placas }}</td>
                                    <td class="text-center align-center">
                                        <span title="{{ $autorizacion->citas_mantenimiento->asignacion_unidad->cliente->nombre_cliente }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            {{ Str::limit($autorizacion->citas_mantenimiento->asignacion_unidad->cliente->nombre_cliente,20) }} 
                                        </span>
                                    </td>
                                    <td class="text-center align-center">${{ number_format($autorizacion->monto_mantenimiento,2) }}</td>
                                    <td class="text-center align-center">{{ $autorizacion->fecha_solicitud }}</td>
                                    <td class="text-center align-center">
                                        @if ($autorizacion->fecha_respuesta)
                                            {{ $autorizacion->fecha_solicitud }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="text-center align-center">
                                        @if ($autorizacion->status_autorizacion == 1)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                            </span>
                                        @elseif($autorizacion->status_autorizacion == 2)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Autorizado</span>
                                            </span>
                                        @else
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">Rechazado</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center align-center">
                                        @if ($autorizacion->nombre_user)
                                            {{ $autorizacion->nombre_user }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($autorizacion->status_autorizacion == 3)
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                                <ul class="dropdown-menu p-0">
                                                    <li><a class="dropdown-item" href="{{ route('mantenimientos/autorizacion/rechazado',$autorizacion->id_citas_mantenimiento) }}">Ver</a></li>
                                                </ul>
                                            </div>
                                        @elseif ($autorizacion->status_autorizacion == 2)
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                                <ul class="dropdown-menu p-0">
                                                    <li><a class="dropdown-item" href="{{ route('mantenimientos/autorizacion/autorizado',$autorizacion->id_citas_mantenimiento) }}">Ver</a></li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                                <ul class="dropdown-menu p-0">
                                                    <li><a class="dropdown-item" href="{{ route('mantenimientos/autorizacion/ver',$autorizacion->id_citas_mantenimiento) }}">Ver</a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('administracion.autorizacionesMantenimiento.modalAutorizar')
@endsection