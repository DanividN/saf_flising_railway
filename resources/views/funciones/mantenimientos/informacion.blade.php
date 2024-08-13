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
    <div class="container-fluid">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div> 
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-header bg-white border-0 d-flex justify-content-end justify-content-md-end gap-4" style="margin-top:0.8cm;">
            
                <a href="#" class="btn btn-informe-orange mx-auto mx-md-0 boton-telefono" id="btn-phonepantallacomp" 
                    data-bs-toggle="modal" 
                    data-bs-target="#miRegistroModal">
                    &nbsp; &nbsp; &nbsp; Mi registro
                </a>

                <a href="#" class="btn btn-informe-orange boton1 boton-telefono" id="btn-phonepantrespons" 
                    data-bs-toggle="modal" 
                    data-bs-target="#miRegistroModal">
                </a>
                {{----------------------------------------------------------------- --}}
                <form action="{{ route('mantenimientos/seguimiento/excel') }}" method="POST">
                    @csrf
                    <input type="text" name="id_unidad" value="{{ $unidad_id }}" hidden>
                    <button class="btn btn-informe-orange mx-auto mx-md-0 boton-descargarInforme" type="submit" id="btn-infor-pantcomplet">
                        &nbsp;  &nbsp;  &nbsp;  Descargar informe
                    </button>
                </form>
                <a href="" class="btn btn-informe-orange boton2 boton-descargarInforme" id="btn-infor-responsive">
                </a>
                {{-- ---------------------------------------------------------------------- --}}
                <button type="button" class="btn btn-orange mx-auto mx-md-0" data-bs-toggle="modal" id="btn-agregarcitpantComp" data-bs-target="#agendarMantenimiento"
                @if ($count_pendientes == 1)
                    disabled
                @endif>
                    <i class="fas fa-plus"></i> Agendar cita
                </button>
                <button type="button" class="btn btn-orange boton3" id="btn-agregarResponsive" data-bs-toggle="modal" data-bs-target="#agendarCita"
                @if ($count_pendientes == 1)
                    disabled
                @endif>
                    <i class="fas fa-plus"></i> 
                </button>
            {{-- ------------------------------------------------------------------ --}}
            </div>       
            {{-- modal --}}
            <div class="modal fade" id="miRegistroModal" tabindex="-1" aria-labelledby="miRegistroModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg"> <!-- Cambia a modal-lg o modal-xl -->
                    <form action="{{ route('mantenimientos/seguimiento/store_llamada') }}" id="form_llamada" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="miRegistroModalLabel" style="color:#ED5429;">Información de Unidad</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong class="info-item">Cliente: {{ $info_unidad[0]->cliente }}</strong><br>
                                            <strong class="info-item">Responsable de Activo: {{ $info_unidad[0]->nombre_responsable }}</strong><br>
                                            <strong class="info-item">Cargo: {{ $info_unidad[0]->cargo }}</strong><br>
                                            <strong class="info-item">Teléfono: {{ $info_unidad[0]->telefono_responsable }}</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <strong class="info-item">ID. Unidad: {{ $info_unidad[0]->idUnidad }}</strong><br>
                                            <strong class="info-item">Marca: {{ $info_unidad[0]->marca }}</strong><br>
                                            <strong class="info-item">Placas: {{ $info_unidad[0]->placas }}</strong>
                                        </div>
                                    </div>
                                    <hr style="color: #929292dd">
                                    <div class="row">
                                        <h4 style="color:#ED5429; text-align:left;">Registro de Atención</h4>
                                    </div>
                                        @csrf
                                        <input type="text" name="id_asignacion_unidad" value="{{ $info_unidad[0]->id_asignacion_unidad }}" hidden>
                                        <div class="col-md-12 mt-2 mb-2">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <label><b>Tipo de llamada:</b></label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="tipo_llamada" id="inlineRadio1" value="1" checked>
                                                            <label class="form-check-label"><small>Agenda</small></label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="tipo_llamada" id="inlineRadio2" value="2">
                                                            <label class="form-check-label"><small>Registro</small></label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <label><b>Estatus de llamada:</b></label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="estatus" id="inlineRadio3" value="Atendido" checked>
                                                            <label class="form-check-label"><small>Atendida</small></label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="estatus" id="inlineRadio4" value="No atendido">
                                                            <label class="form-check-label"><small>No atendida</small></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label>Fecha:</label>
                                                <input class="form-control datepicker" name="fecha" type="text" placeholder="mm/dd/aaaa" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Hora:</label>
                                                <input class="form-control" name="hora" type="time" placeholder="00:00:00" required>
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <label>Usuario:</label>
                                                <input class="form-control" type="text" value="{{ Auth::user()->name }}" readonly>
                                                <input class="form-control" type="text" name="id_callcenter" value="{{ Auth::user()->id }}" hidden>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Inserte aquí sus observaciones" name="descripcion" style="height: 100px" required></textarea>
                                                    <label for="floatingTextarea">Observaciones</label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                {{-- <button type="button" class="btn btn-principal-corto btn-flis-corto" data-bs-dismiss="modal">Cerrar</button> --}}
                                <button type="submit" id="save_llamada" class="btn btn-orange btn-flis-corto">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/seguimiento/rechazado',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @elseif($mantenimiento->seguimiento_mantenimiento->status_autorizacion == 2)
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/seguimiento/aceptado',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @elseif($mantenimiento->seguimiento_mantenimiento->status_autorizacion == 1)
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/seguimiento/pendiente',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @elseif($mantenimiento->estado == 'CONCLUIDO' || $mantenimiento->estado == 'PAGADO')
                                                            <li><a class="dropdown-item" href="{{ route('mantenimientos/seguimiento/aceptado',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
                                                        @endif
                                                    @else
                                                        <li><a class="dropdown-item" href="{{ route('mantenimientos/seguimiento',$mantenimiento->id_citas_mantenimiento) }}">Ver</a></li>
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
        <a href="{{url('funciones/mantenimientos/index')}}" class="btn btn-regresar mt-2">Regresar</a>
    </div>
    @include('funciones.mantenimientos.agendarCita')
@endsection