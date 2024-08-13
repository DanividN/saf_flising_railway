@extends('layouts.app')

@section('admi','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Superivisión</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Lista de Unidades</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Lista Unidades</a></label>
        </div>
        <div class="card border-0 p-2">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-md-4 mt-2">
                        <b>Tipo cliente: </b><span class="text-gray">{{ $cliente->tipo_cliente }}</span><br>
                        <b>Nombre: </b><span class="text-gray">{{ $cliente->nombre_cliente }}</span><br>
                        <b>Titular del área: </b><span class="text-gray">{{ $cliente->nombre_representante }}</span><br>
                        <b>Correo: </b><span class="text-gray">{{ $cliente->correo_representante }}</span><br>
                        <b>Teléfono: </b><span class="text-gray">{{ $cliente->telefono_cliente }}</span><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-md mt-4 border-0 p-2">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" data-order='[[ 0, "desc" ]]'>
                        <thead>
                            <tr class="text-center">
                                <th style="display: none;"></th>
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Vehículo</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Responsable de supervisión</th>
                                <th scope="col" class="encabezado">Fecha</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidadesAgendadas as $key => $unidad)
                                <tr class="text-center">
                                    <td style="display: none;">{{ $unidad->updated_at }}</td>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td>{{ $unidad->unidad->tipo_unidad->descripcion }}</td>
                                    <td>{{ $unidad->asignacionUnidad->placas }}</td>
                                    <td>{{ $unidad->supervisor->name }}</td>
                                    <td>{{ $unidad->fecha_supervision }}</td>
                                    <td>
                                        <span style="display: inline-flex; align-items: center;">
                                            @if ($unidad->notificacion_citas == 'CONCLUIDA')
                                                <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">{{ $unidad->notificacion_citas }}</span>
                                            @endif

                                            @if ($unidad->notificacion_citas == 'AGENDADA')
                                                <span class="badge bg-blue-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-blue-status" style="margin-left: 5px;">{{ $unidad->notificacion_citas }}</span>
                                            @endif

                                            @if ($unidad->notificacion_citas == 'CANCELADA')
                                                <span class="badge bg-red-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">{{ $unidad->notificacion_citas }}</span>
                                            @endif
                                            
                                            @if ($unidad->notificacion_citas == 'VALIDADA')
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">{{ $unidad->notificacion_citas }}</span>
                                            @endif

                                            @if ($unidad->notificacion_citas == 'VENCIDA')
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">{{ $unidad->notificacion_citas }}</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>
    
                                            <ul class="dropdown-menu p-0">
                                                <li>
                                                    <a 
                                                        class="dropdown-item" 
                                                        href="{{ route('supervision.historial.citas', ['id_cliente' => $cliente->id_cliente, 'id_unidad' => $unidad->id_unidad]) }}"
                                                    >
                                                        Información
                                                    </a>
                                                </li>
                                                <li>
                                                    @if ($unidad->notificacion_citas != \App\Models\administracion\CitaSupervision::CANCELADA)
                                                        <a  
                                                            class="dropdown-item" 
                                                            @if ($unidad->notificacion_citas == \App\Models\administracion\CitaSupervision::CANCELADA || $unidad->notificacion_citas == \App\Models\administracion\CitaSupervision::VALIDADA)
                                                                href="{{ route('supervision.mostrar.validacion', $unidad->id_citas_supervision) }}"
                                                            @endif
                
                                                            @if ($unidad->notificacion_citas == \App\Models\administracion\CitaSupervision::AGENDADA || $unidad->notificacion_citas == \App\Models\administracion\CitaSupervision::VENCIDA  || $unidad->notificacion_citas == \App\Models\administracion\CitaSupervision::CONCLUIDA)
                                                                href="{{ route('supervision.validacion.unidad', $unidad->id_citas_supervision) }}"
                                                            @endif
                                                        >
                                                            Validación
                                                        </a>
                                                    @endif
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
    @include('administracion.garantiasFlising.modalAsignarGarantias') 
@endsection
