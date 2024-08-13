@extends('layouts.app')

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="card shadow-md border-gray-100 border-0 p-2">

            <div class="card-header bg-white border-0 d-flex justify-content-center justify-content-md-end"
                style="margin-top:0.8cm;">
                <a href="" class="btn btn-informe" id="btn-pantcomp">
                    Informe
                </a>

                <a href="" class="btn btn-informe" id="btn-responsive">
                    Informe
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
                                <th scope="col" class="encabezado">Modelo - año</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Teléfono</th>
                                <th scope="col" class="encabezado">Número de serie</th>
                                <th scope="col" class="encabezado">Periodo de verificación</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-start">1</td>
                                <td>123-ABC</td>
                                <td>Marca 1</td>
                                <td>Modelo 1</td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                        <span class="badge bg-green-status"
                                            style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                        <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                    </span>
                                </td>
                                <td>Cliente 1</td>
                                <td>1234567890</td>
                                <td>1234567890</td>
                                <td>2021-2022</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                alt="menu" style="width: 30px !important;">
                                        </a>

                                        <ul class="dropdown-menu p-0">
                                            <li><a class="dropdown-item"
                                                    href="{{ url('administracion/verificaciones/informacion') }}">Información</a>
                                            </li>
                                            {{-- <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agendarCita">Agendar cita</button></li> --}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td class="text-start">1</td>
                                <td>123-ABC</td>
                                <td>Marca 1</td>
                                <td>Modelo 1</td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                        <span class="badge bg-yellow-status"
                                            style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                        <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                                    </span>
                                </td>
                                <td>Cliente 1</td>
                                <td>1234567890</td>
                                <td>1234567890</td>
                                <td>2021-2022</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                alt="menu" style="width: 30px !important;">
                                        </a>

                                        <ul class="dropdown-menu p-0">
                                            <li><a class="dropdown-item"
                                                    href="{{ url('administracion/verificaciones/informacion') }}">Información</a>
                                            </li>
                                            {{-- <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agendarCita">Agendar cita</button></li> --}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td class="text-start">1</td>
                                <td>123-ABC</td>
                                <td>Marca 1</td>
                                <td>Modelo 1</td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                        <span class="badge bg-red-status"
                                            style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                        <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                                    </span>
                                </td>
                                <td>Cliente 1</td>
                                <td>1234567890</td>
                                <td>1234567890</td>
                                <td>2021-2022</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                alt="menu" style="width: 30px !important;">
                                        </a>

                                        <ul class="dropdown-menu p-0">
                                            <li><a class="dropdown-item"
                                                    href="{{ url('administracion/verificaciones/informacion') }}">Información</a>
                                            </li>
                                            {{-- <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agendarCita">Agendar cita</button></li> --}}
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
