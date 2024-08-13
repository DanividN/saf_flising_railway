@extends('layouts.app')

@section('funciones', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Funciones</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('emergenciasCall.index')}}" class="rutas"><small>Emergencias</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Información de emergencias</small></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-header bg-white border-0 d-flex justify-content-center justify-content-md-end gap-4">
            </div>



            {{-- ----------------------BOTONES------------------------------------------ --}}
            <div class="d-flex justify-content-between align-items-center">
                <!-- Botón de regresar alineado a la izquierda -->
                <div class="d-flex boton-back" style="margin-top: -20px; margin-bottom: -10px;">
                    {{-- <a type="button" class="btn boton-regresar">
                    </a>
                    <strong style="margin-top: 25px; color:#ED5429 font-size:18px;"><b>Regresar</b></strong> --}}

                    {{-- <a href="#" class="regresar" style="text-decoration: none; color: inherit;">
                        <i class="bi bi-reply-fill" style="font-size: 20px; font-weight: 900;" aria-hidden="true"></i>
                        Regresar
                    </a> --}}

                </div>

                <!-- Contenedor para los otros botones alineados a la derecha -->
                <div class="d-flex align-items-center" style="margin-top: -10px; margin-bottom: -10px;">
                    <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantallacomp" data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                        &nbsp; &nbsp; &nbsp; Mi registro
                    </a>

                    <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantrespons" data-bs-toggle="modal" data-bs-target="#miRegistroModal"></a>

                    <a href="{{route('informe_emergencias', $emergencias[0]->id_asignacion_unidad )}}" class="btn btn-informe-orange boton-descargarInforme me-2" id="btn-infor-pantcomplet">
                        &nbsp; &nbsp; &nbsp; &nbsp;Descargar informe
                    </a>

                    <button class="btn btn-outline-light btn-excel me-2 boton-informexcel" style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive"></button>
                </div>
                {{-- modal --}}
                <div class="modal fade" id="miRegistroModal" tabindex="-1" aria-labelledby="miRegistroModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <!-- Cambia a modal-lg o modal-xl -->
                        <form action="{{route('emergencias.llamada')}}" class="needs-validation" novalidate method="post">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="miRegistroModalLabel" style="color:#ED5429;">Registro de
                                        Atención
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong class="info-item">Cliente: {{$emergencias[0]->nombre_cliente}}</strong><br />
                                                <strong class="info-item">Responsable de Activo:  {{$emergencias[0]->nombre_responsable}}</strong><br />
                                                <strong class="info-item">Cargo:  {{$emergencias[0]->cargo}}</strong><br />
                                                <strong class="info-item">Teléfono:  {{$emergencias[0]->telefono_responsable}}</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <strong class="info-item">ID. Unidad: {{$emergencias[0]->vehiculo_id}}</strong><br />
                                                <strong class="info-item">Marca: {{$emergencias[0]->marca}}</strong><br />
                                                <strong class="info-item">Placas: {{$emergencias[0]->placas}}</strong>
                                            </div>
                                        </div>

                                        <hr style="color: #929292dd">

                                        <div class="row">
                                            <div class="col-md-6">
                                            <h5>Estatus de Llamada</h5>
                                                <input class="form-check-input" type="radio" value="Atendido" name="estatus" id="flexRadioDefault1" required>
                                                <label class="form-check-label" for="flexRadioDefault1"> Atendido
                                                <input class="form-check-input" type="radio" value="No atendido" name="estatus" id="flexRadioDefault1" required>
                                                <label class="form-check-label" for="flexRadioDefault1"> No atendido
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                @php
                                                    date_default_timezone_set('America/Mexico_City');
                                                    $fecha = date("Y-m-d");
                                                    $hora = date("h:i");
                                                    $usuario = Auth::user()->name;
                                                    $id = Auth::user()->id;
                                                @endphp
                                                <label>Fecha:</label>
                                                <input class="form-control datepicker" type="text" value="{{$fecha}}" disabled>
                                                <input class="form-control datepicker" name="fecha" type="text" value="{{$fecha}}" hidden>
                                                <input class="form-control datepicker" name="id_asignacion_unidad" type="text" value="{{$emergencias[0]->id_asignacion_unidad}}" hidden>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Hora:</label>
                                                <input class="form-control" type="time" value="{{$hora}}" disabled>
                                                <input class="form-control" name="hora" type="time" value="{{$hora}}" hidden>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Usuario:</label>
                                                <input class="form-control" type="text" value="{{$usuario}}" disabled>
                                                <input type="text" name="id_callcenter" value="{{$id}}" hidden>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Observaciones:</label>
                                                <textarea required class="form-control" name="descripcion" rows="3" placeholder="Ingrese aquí sus observaciones"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    {{-- <button type="button" class="btn btn-principal-corto btn-flis-corto" data-bs-dismiss="modal">Cerrar</button> --}}
                                    <button type="submit" class="btn btn-orange btn-flis-corto">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ------- --}}
            </div>

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
                                                <li><a class="dropdown-item" href="{{ route('emergenciasCall.show', $emergencia->id_asignacion_emergencia) }}">Ver</a>
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
