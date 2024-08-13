@extends('layouts.app')

@section('admi','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Superivisión</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Lista de Unidades</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Historial</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>{{ $citas[0]->unidad->marca->descripcion }} {{ $citas[0]->unidad->modelo }}-{{ $citas[0]->asignacionUnidad->placas }}</a></label>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="d-flex justify-content-end align-items-center" style="margin-left: .4cm; margin-top:0.8cm;">
                <a href="{{ route('supervision.historial.citas.unidad', ['id_unidad' => $citas[0]->id_unidad, 'id_cliente' => $citas[0]->id_cliente]) }}" class="btn btn-informe-orange boton-descargarInforme me-2" id="btn-infor-pantcomplet">
                    &nbsp; &nbsp; &nbsp; Descargar informe
                </a>

                <a href="{{ route('supervision.historial.citas.unidad', ['id_unidad' => $citas[0]->id_unidad, 'id_cliente' => $citas[0]->id_cliente]) }}" type="button" class="btn btn-outline-light btn-excel  boton-descargarInforme me-2" data-bs-toggle="modal" data-bs-target="#agendarCita" id="btn-infor-responsive" style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive">
                </a>

            <a href="{{ route('supervision.agregarValidacion') }}" 
               class="btn boton-principal" 
               id="btn-pantcomp"
               style="margin-right: .4cm;">
               <i class="plus-icon fa fa-plus"></i>
               Agregar validación
            </a>

            <a href="{{ route('supervision.agregarValidacion') }}" 
                class="btn btn-informe" 
                id="btn-responsive"
                style="margin-right: .4cm;">
                <i class="plus-icon fa fa-plus"></i>
            </a>
        
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" data-order='[[ 0, "desc" ]]'>
                        <thead>
                            <tr class="text-center">
                                <th style="display: none;"></th>
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Vehiculo</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Responsable supervisión</th>
                                <th scope="col" class="encabezado">Fecha</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $key => $cita)
                                <tr class="text-center">
                                    <td style="display: none;">{{ $cita->created_at }}</td>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td>{{ $cita->unidad->tipo_unidad->descripcion }}</td>
                                    <td>{{ $cita->asignacionUnidad->placas }}</td>
                                    <td>{{ $cita->cliente->nombre_cliente }}</td>
                                    <td>{{ $cita->supervisor->name }}</td>
                                    <td>{{ $cita->fecha_supervision }}</td>
                                    <td>
                                        @if ($cita->notificacion_citas == 'VENCIDA')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">Vencida</span>
                                            </span>
                                        @endif

                                        @if ($cita->notificacion_citas == 'CANCELADA')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">Cancelada</span>
                                            </span>
                                        @endif

                                        @if ($cita->notificacion_citas == 'AGENDADA')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-blue-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-blue-status" style="margin-left: 5px;">Agendada</span>
                                            </span>
                                        @endif

                                        @if ($cita->notificacion_citas == 'CONCLUIDA')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Concluida</span>
                                            </span>
                                        @endif

                                        @if ($cita->notificacion_citas == 'VALIDADA')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">Validada</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                @if ($cita->notificacion_citas == 'CANCELADA' || $cita->notificacion_citas == 'VALIDADA')
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('supervision.mostrar.validacion', $cita->id_citas_supervision) }}">
                                                            Ver
                                                        </a>
                                                    </li>
                                                @endif

                                                @if ($cita->notificacion_citas == 'AGENDADA' || $cita->notificacion_citas == 'VENCIDA' || $cita->notificacion_citas == 'CONCLUIDA')
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('supervision.validacion.unidad', $cita->id_citas_supervision) }}">
                                                            Validar
                                                        </a>
                                                    </li>
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
