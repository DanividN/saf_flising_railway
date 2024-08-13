@extends('layouts.app')

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-header bg-white border-0 d-flex justify-content-end justify-content-md-end gap-4"
                style="margin-top:0.8cm;">

                {{-- -----------BOTON descargar informe----------------- --}}
                <a href="" class="btn btn-informe-orange boton-descargarInforme" id="btn-infor-pantcomplet">
                    &nbsp; &nbsp; &nbsp; Descargar informe
                </a>

                <a href="" class="btn btn-informe-orange boton2 boton-descargarInforme" id="btn-infor-responsive">
                </a>
                {{-- ---------------------BOTON maS+------------------------ --}}
                <button type="button" class="btn btn-orange" id="btn-agregarcitpantComp" data-bs-toggle="modal"
                    data-bs-target="#agendarCita">
                    <i class="fas fa-plus"></i> Agregar cita
                </button>

                <button type="button" class="btn btn-orange" id="btn-responsive" data-bs-toggle="modal"
                    data-bs-target="#agendarCita">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            {{-- ------------------------------------------------------ --}}
            {{-- -----------------MODAL------------------------------ --}}
            <div class="modal fade" id="agendarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="modal-asignar-garantias" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 m-0">
                            <h5 class="modal-title title-orange" id="staticBackdropLabel">Agendar verificación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id='FormAgendarCita' action="{{ route('verificacion.agendar', 0) }}" method='POST'>
                            @csrf
                            <div class="modal-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-4 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Entidad federativa</b><span
                                                    class="text-danger">*</span></label>
                                            <select class="menu" style="width: 200px; height: 30px;">
                                                <option selected disabled>-- Selecciona una opción --</option>
                                                <option value="1">Entidad 1</option>
                                                <option value="2">Entidad 2</option>
                                                <option value="3">Entidad 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Municipio/Alcaldía</b><span
                                                    class="text-danger">*</span></label>
                                            <select class="menu" style="width: 200px; height: 30px;">
                                                <option selected disabled>-- Selecciona una opción --</option>
                                                <option value="1">Municipio 1</option>
                                                <option value="2">Municipio 2</option>
                                                <option value="3">Municipio 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Verificentro</b><span
                                                    class="text-danger">*</span></label>
                                            <select class="menu" style="width: 200px; height: 30px;">
                                                <option selected disabled>-- Selecciona una opción --</option>
                                                <option value="1">Verificentro 1</option>
                                                <option value="2">Verificentro 2</option>
                                                <option value="3">Verificentro 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Dirección</b><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="Dirección del verificentro"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Fecha</b><span class="text-danger">*</span></label>
                                            <input type="text" class="datepicker form-control" placeholder="dd/mm/aaaa">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Hora</b><span class="text-danger">*</span></label>
                                            <input type="time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <label for="cliente"><b>Adjuntar Cita</b><span
                                                    class="text-danger">*</span></label><br>
                                            <input type="file" class="input-archivo" id="archivo">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer border-0 d-flex justify-content-center">
                                <button type="button" class="btn btn-enviar rounded-lg d-flex">Agendar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- -------------------------------------------------------------------------------- --}}
            {{-- -------------------------------------------------------------------------------- --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Fecha de pago</th>
                                <th scope="col" class="encabezado">Monto</th>
                                <th scope="col" class="encabezado">Evidecia</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Llamadas</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-start">1</td>
                                <td>123-ABC</td>
                                <td>Marca 1</td>
                                <td>Cliente 1</td>
                                <td>01/01/2021</td>
                                <td>$1,000.00</td>
                                <td>
                                    icono pdf
                                </td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                        <span class="badge bg-green-status status"
                                            style="border-radius: 50%; display: inline-block;"></span>
                                        <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                    </span>
                                </td>
                                <td>
                                    53
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                alt="menu" style="width: 30px !important;">
                                        </a>

                                        <ul class="dropdown-menu p-0">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.verificacion.show') }}">Ver</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td class="text-start">1</td>
                                <td>123-ABC</td>
                                <td>Marca 1</td>
                                <td>Cliente 1</td>
                                <td>01/01/2021</td>
                                <td>$1,000.00</td>
                                <td>
                                    icono pdf
                                </td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                        <span class="badge bg-blue-status status"
                                            style="border-radius: 50%; display: inline-block;"></span>
                                        <span class="text-blue-status" style="margin-left: 5px;">Agendado</span>
                                    </span>
                                </td>
                                <td>
                                    10
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                alt="menu" style="width: 30px !important;">
                                        </a>

                                        <ul class="dropdown-menu p-0">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.verificacion.show') }}">Ver</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td class="text-start">1</td>
                                <td>123-ABC</td>
                                <td>Marca 1</td>
                                <td>Cliente 1</td>
                                <td>01/01/2021</td>
                                <td>$1,000.00</td>
                                <td>
                                    icono pdf
                                </td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                        <span class="badge bg-red-status status"
                                            style="border-radius: 50%; display: inline-block;"></span>
                                        <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                                    </span>
                                </td>
                                <td>
                                    2
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                alt="menu" style="width: 30px !important;">
                                        </a>

                                        <ul class="dropdown-menu p-0">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.verificacion.show') }}">Ver</a>
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
    {{-- @include('funciones.verificaciones.agendarCita') --}}
@endsection
