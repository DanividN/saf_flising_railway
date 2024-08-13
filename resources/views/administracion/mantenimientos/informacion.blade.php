@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
    <script src="{{asset('js/agendarCita.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
@endsection
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-header bg-white border-0 d-flex justify-content-end me-2" style="margin-top:0.8cm;">
                {{-- <a href="#" class="btn btn-informe-orange mx-auto mx-md-0" data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                    <i class="fas fa-phone"></i> Mi registro
                </a> --}}
                {{-- ------------------------------------------------------------------------------ --}}
                <a href="" class="btn btn-informe-orange boton-descargarInforme me-2"
                    id="btn-infor-pantcomplet">
                    &nbsp; &nbsp; &nbsp; Descargar informe
                </a>
                <a href="" class="btn btn-informe-orange boton2 boton-descargarInforme me-2" id="btn-infor-responsive">
                </a>
                {{-- ---------------------------------------------------------------------- --}}
                <button type="button" class="btn boton-principal" data-bs-toggle="modal"
                    id="btn-agregarcitpantComp" data-bs-target="#agendarMantenimiento">
                    <i class="fas fa-plus"></i> Agendar cita
                </button>
                <button type="button" class="btn btn-informe" id="btn-agregarResponsive" data-bs-toggle="modal"
                    data-bs-target="#agendarMantenimiento">
                    <i class="fas fa-plus"></i>
                </button>
                {{-- ------------------------------------------------------------------ --}}
            </div>
            {{-- ------- --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado fecha_p">Fecha de mantenimiento</th>
                                <th scope="col" class="encabezado">Monto con IVA</th>
                                <th scope="col" class="encabezado">Nivel de autorizaci&oacute;n</th>
                                <th scope="col" class="encabezado">Agencia o Taller</th>
                                <th scope="col" class="encabezado">Cotizaci&oacute;n</th>
                                <th scope="col" class="encabezado">Factura</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($mantenimientos as $mantenimiento)
                                <tr>
                                    <td class="text-center align-middle">{{ ++$i }}</td>
                                    <td class="text-center align-middle">{{ $mantenimiento->asignacion_unidad->placas }}</td>
                                    <td class="text-center align-middle">{{ $mantenimiento->unidad->marca->descripcion }}</td>
                                    <td class="text-center align-middle">
                                        <span title="{{ $mantenimiento->asignacion_unidad->cliente->nombre_cliente }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            {{ Str::limit($mantenimiento->asignacion_unidad->cliente->nombre_cliente,25) }} 
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">{{ $mantenimiento->unidad->fecha_mantenimiento }}</td>
                                    <td class="text-center align-middle">
                                        @if ($mantenimiento->seguimiento_mantenimiento == null)
                                            N/A
                                        @else
                                            ${{ number_format($mantenimiento->seguimiento_mantenimiento->monto_mantenimiento,2) }}
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($mantenimiento->seguimiento_mantenimiento == null)
                                            N/A
                                        @else
                                            @if ($mantenimiento->seguimiento_mantenimiento->autorizacion == 1)
                                                B&aacute;sico
                                            @else
                                                Avanzado
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <span title="{{ $mantenimiento->proveedor->nombre_comercial }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            {{ Str::limit($mantenimiento->proveedor->nombre_comercial,25) }} 
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($mantenimiento->seguimiento_mantenimiento == null)
                                            N/A
                                        @else
                                            <a href="{{url('storage/'.$mantenimiento->seguimiento_mantenimiento->a_cotizacion)}}" target="__blank">
                                                <i class="bi bi-file-pdf-fill"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($mantenimiento->seguimiento_mantenimiento == null)
                                            N/A
                                        @else
                                            @if ($mantenimiento->seguimiento_mantenimiento->a_factura)
                                                <a href="{{url('storage/'.$mantenimiento->seguimiento_mantenimiento->a_factura)}}" target="__blank">
                                                    <i class="bi bi-file-pdf-fill"></i>
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($mantenimiento->estado == 'PENDIENTE')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'AGENDADO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-agendado status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-agendado-status" style="margin-left: 5px;">Agendado</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'PAGADO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Pagado</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'VENCIDO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'RECHAZADO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">Rechazado</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'AUTORIZADO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Autorizado</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'CONCLUIDO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                            </span>
                                        @elseif($mantenimiento->estado == 'CANCELADO')
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-gray-status status"
                                                    style="border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-gray-status" style="margin-left: 5px;">Cancelado</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            @if ($mantenimiento->estado == 'CANCELADO')
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                            @else
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                                <ul class="dropdown-menu p-0">
                                                    @if ($mantenimiento->seguimiento_mantenimiento)
                                                        @if ($mantenimiento->seguimiento_mantenimiento->status_autorizacion == 3)
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/show/rechazado',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @elseif($mantenimiento->seguimiento_mantenimiento->status_autorizacion == 2)
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/show/aceptado',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @elseif($mantenimiento->seguimiento_mantenimiento->status_autorizacion == 1)
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/show/pendiente',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @elseif($mantenimiento->estado == 'CONCLUIDO' || $mantenimiento->estado == 'PAGADO')
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/show/aceptado',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @endif
                                                    @else
                                                        <li><a class="dropdown-item" href="{{ route('mantenimientos/show/seguimiento',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <a href="{{url('administracion/mantenimientos/index')}}" class="btn btn-regresar mt-2">Regresar</a> --}}
    </div>
    @include('administracion.mantenimientos.agendarCita')
@endsection
