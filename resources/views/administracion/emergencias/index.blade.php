@extends('layouts.app')

@section('admi', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Administración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Emergencias</small></span></li>
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Emergencias</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" data-order='[[0, "desc"]]'>
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">Folio</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Fecha de registro</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emergencias as $emergencia)
                                <tr class="text-center">
                                    @php
                                        $folio = 'EM-' . str_pad($emergencia->id_asignacion_emergencia, 4, '0', STR_PAD_LEFT);
                                    @endphp
                                    <td class="text-start">{{$folio}}</td>
                                    <td>{{$emergencia->placas}}</td>
                                    <td>{{$emergencia->modelo}}</td>
                                    <td>{{$emergencia->nombre_cliente}}</td>
                                    <td>{{$emergencia->created_at}}</td>
                                    <td>
                                        @if ($emergencia->estado_emergencia === 1)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status" style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">En proceso</span>
                                            </span>
                                        @elseif($emergencia->estado_emergencia === 2)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status" style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                            </span>
                                        @else
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status" style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">Cancelado</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item" href="{{ route('emergencias.show', $emergencia->id_asignacion_emergencia) }}">Ver</a>
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
@endsection
