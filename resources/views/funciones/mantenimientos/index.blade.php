@extends('layouts.app')
@section('content')
    @include('components.alertas')
    <div class="container-fluid">
        <div class="titulo-responsive">
            <label><a>Verificación</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.4cm;">
                <a href=""
                    class="btn btn-informe"
                    id="btn-pantcomp">
                    Informe
                </a>
                <button class="btn btn-outline-light btn-excel boton-informexcel me-2" 
                    style="color: #ED5429; border-color: #ED5429;" id="btn-responsive">
                    <i class="fa-solid fa-file-excel"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center align-middle">
                                <th scope="col" class="encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Modelo</th>
                                <th scope="col" class="encabezado">Año</th>
                                <th scope="col" class="encabezado">Estatus de mantenimiento</th>
                                <th scope="col" class="encabezado">Estatus de pago</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Teléfono</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphpx
                            @foreach ($unidades as $key => $unidad)
                                @foreach ($unidad as $unidad)
                                    <tr>
                                        <td class="text-center align-middle">{{ ++$i }}</td>
                                        <td class="text-center align-middle">{{ $unidad->placas }}</td>
                                        <td class="text-center align-middle">{{ $unidad->marca }}</td>
                                        <td class="text-center align-middle">
                                            <span title="{{ $unidad->modelo }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                {{ Str::limit($unidad->modelo,15) }} 
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">{{ $unidad->anio }}</td>
                                        <td class="text-center align-middle">
                                            @if ($unidad->status_mantenimiento == null || $unidad->status_mantenimiento == 'AGENDADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                                </span>
                                            @elseif($unidad->status_mantenimiento == 'PENDIENTE' || $unidad->status_mantenimiento == 'RECHAZADO' || $unidad->status_mantenimiento == 'CANCELADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                                </span>
                                            @elseif($unidad->status_mantenimiento == 'VENCIDO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-red-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                                                </span>   
                                            @elseif($unidad->status_mantenimiento == 'CONCLUIDO' || $unidad->status_mantenimiento == 'PAGADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center align-center">
                                            @if ($unidad->status_mantenimiento != 'PAGADO' || $unidad->estatus_pago != 2)
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-green-status" style="margin-left: 5px;">Pagado</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <span title="{{ $unidad->nombre_cliente }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                {{ Str::limit($unidad->nombre_cliente,20) }} 
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">{{ $unidad->telefono_cliente }}</td>
                                        <td class="text-center align-middle">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                                <ul class="dropdown-menu p-0">
                                                    <li><a class="dropdown-item" href="{{ route('mantenimientos/informacion',$unidad->unidad_id) }}">Informaci&oacute;n</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('funciones.mantenimientos.agendarCita')
@endsection


