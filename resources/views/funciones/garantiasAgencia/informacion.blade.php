@extends('layouts.app')
@section('content')

    <div class="container-fluid mt-4">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        <div class="card shadow-md mt-5 border-0 p-2">
            {{-- <div class="card-body"> --}}
            <div class="table-responsive">
                <div class="card border-0 p-2">
                    <h5 class="title-orange titulo-pantcomp">Información de unidad</h5>
                    <div class="card-body">
                        <div class="row d-flex">
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Cliente: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Vehículo: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Tipo de póliza: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Responsable de activo: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Marca: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>No. de poliza: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Cargo: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Placas: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>GPS: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Teléfono: </b><span></span>
                            </div>
                            <div class="col-md-{{ isset($garantia_extendida) ? '4' : '8' }} mt-2 text-gray">
                                <b>Motor: </b><span></span>
                            </div>
                            @if (isset($garantia_extendida))
                                <div class="col-md-4 mt-2 text-gray">
                                    <b>Garantía extendida: </b><span></span>
                                </div>
                            @endif
                            <div class="col-md-4 mt-2 text-gray">
                                <b>I.D. Unidad: </b><span></span>
                            </div>
                            <div class="col-md-4 mt-2 text-gray">
                                <b>Aseguradora: </b><span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>



            <div class="card shadow-md mt-4 border-0 p-2">
                {{-- ---------------------------------------BOTONES------------------------------------------------------------------------------------- --}}
                <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.8cm;">
                    {{-- -------------------------------------- --}}
                    <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantallacomp"
                        data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                        &nbsp; &nbsp; &nbsp; Mi registro
                    </a>

                    <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantrespons"
                        data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                    </a>
                </div>
                {{-- ------------- Modal Mi Registro ---------------- --}}
                <div class="modal fade" id="miRegistroModal" tabindex="-1" aria-labelledby="miRegistroModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg"> <!-- Cambia a modal-lg o modal-xl -->
                        <form action="{{ route('mantenimientos/seguimiento/store_llamada') }}" id="form_llamada"
                            method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong class="info-item">Cliente:</strong><br>
                                                <strong class="info-item">Responsable de Activo:</strong><br>
                                                <strong class="info-item">Cargo:</strong><br>
                                                <strong class="info-item">Teléfono:</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <strong class="info-item">ID. Unidad:</strong><br>
                                                <strong class="info-item">Marca:</strong><br>
                                                <strong class="info-item">Placas:</strong>
                                            </div>
                                        </div>
                                        <hr style="color: #929292dd">
                                        <div class="row">
                                            <h4 style="color:#ED5429; text-align:left;">Registro de Atención</h4>
                                        </div>
                                        @csrf
                                        <input type="text" name="id_asignacion_unidad" value="" hidden>
                                        <div class="col-md-12 mt-2 mb-2">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <label><b>Estatus de llamada:</b></label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="estatus"
                                                                id="inlineRadio3" value="Atendido" checked>
                                                            <label class="form-check-label"><small>Atendida</small></label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="estatus"
                                                                id="inlineRadio4" value="No atendido">
                                                            <label class="form-check-label"><small>No
                                                                    atendida</small></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label>Fecha:</label>
                                                <input class="form-control datepicker" name="fecha" type="text"
                                                    placeholder="mm/dd/aaaa" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Hora:</label>
                                                <input class="form-control" name="hora" type="time"
                                                    placeholder="00:00:00" required>

                                            </div>
                                            <div class="col-md-4">
                                                <label>Usuario:</label>
                                                <input class="form-control" type="text"
                                                    value="{{ Auth::user()->name }}" readonly>
                                                <input class="form-control" type="text" name="id_callcenter"
                                                    value="{{ Auth::user()->id }}" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Inserte aquí sus observaciones" name="descripcion" style="height: 100px"
                                                        required></textarea>
                                                    <label for="floatingTextarea">Descripción:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    {{-- <button type="button" class="btn btn-principal-corto btn-flis-corto" data-bs-dismiss="modal">Cerrar</button> --}}
                                    <button type="submit" id="save_llamada"
                                        class="btn btn-orange btn-flis-corto">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- --------------------------------------------------------------------------- --}}

                {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}
                <div class="card border-0 p-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="text-start encabezado">No.</th>
                                        <th scope="col" class="encabezado">Garantia de Agencia</th>
                                        <th scope="col" class="encabezado">Vigencia</th>
                                        <th scope="col" class="encabezado">Monto</th>
                                        <th scope="col" class="encabezado">Fecha Inicial</th>
                                        <th scope="col" class="encabezado">Fecha Final</th>
                                        <th scope="col" class="encabezado">Estatus</th>
                                        <th scope="col" class="encabezado">Eventos</th>
                                        <th scope="col" class="encabezado">Garantía</th>
                                        <th scope="col" class="encabezado">Evidencia</th>
                                        <th scope="col" class="encabezado">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td class="text-start"></td>
                                        <td></td>
                                        <td> Meses</td>
                                        <td>
                                        </td>
                                        <td></td>

                                        <td></td>

                                        <td></td>
                                        <td>
                                            <div>
                                                {{-- {{ $garantiaSelect->evento_asignado ?? 0 }}/{{ $garantiaSelect->garantiasFlising->eventos_por_year }} --}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="garantia" data-id="">

                                            </div>
                                        </td>
                                        <td>
                                            <a href="" class="boton-pdf" target="__blank">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                        alt="menu" style="width: 30px !important;">
                                                </a>

                                                <ul class="dropdown-menu p-0">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('funciones.garantiasAgencia.informacion') }}">Aplicar
                                                            Garantía</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    @endsection
