@extends('layouts.app')

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="card shadow-md border-gray-100 border-0 p-2">

            <div class="card-header bg-white border-0 d-flex justify-content-end justify-content-md-end" style="margin-top: 0.8cm;">
                <a 
                id="btn-pantcomp"
                href="" class="btn btn-informe">
                Informe
                </a>

                <a 
                id="btn-responsive"
                href=""
                class="btn btn-informe boton-informexcel">
                </a>
            </div>

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
                            @endphp
                            @foreach ($unidades as $unidad)
                                <tr>
                                    <td class="text-center align-middle">{{ ++$i }}</td>
                                    <td class="text-center align-middle">{{ $unidad->UltimoArrendamiento->placas }}</td>
                                    <td class="text-center align-middle">{{ $unidad->marca->descripcion }}</td>
                                    <td class="text-center align-middle">{{ $unidad->modelo }}</td>
                                    <td class="text-center align-middle">{{ $unidad->anio->descripcion }}</td>
                                    <td class="text-center align-middle">
                                        @if($unidad->citas_mantenimiento == null)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                            </span>
                                        @else
                                            @if ($unidad->citas_mantenimiento->estado == 'AGENDADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                                </span>
                                            @elseif($unidad->citas_mantenimiento->estado == 'PENDIENTE' || $unidad->citas_mantenimiento->estado == 'RECHAZADO' || $unidad->citas_mantenimiento->estado == 'CANCELADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                                </span>
                                            @elseif($unidad->citas_mantenimiento->estado == 'VENCIDO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-red-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                                                </span>   
                                            @elseif($unidad->citas_mantenimiento->estado == 'CONCLUIDO' || $unidad->citas_mantenimiento->estado == 'PAGADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($unidad->citas_mantenimiento == null)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                            </span>
                                        @else
                                            @if ($unidad->citas_mantenimiento->estado == 'PAGADO')
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-green-status" style="margin-left: 5px;">Pagado</span>
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">{{ $unidad->UltimoArrendamiento->Cliente->nombre_cliente }}</td>
                                    <td class="text-center align-middle">{{ $unidad->UltimoArrendamiento->Cliente->telefono_cliente }}</td>
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item" href="{{ route('mantenimientos/show',$unidad->id_unidad) }}">Informaci&oacute;n</a></li>
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
    {{-- @include('funciones.mantenimientos.agendarCita') --}}
@endsection