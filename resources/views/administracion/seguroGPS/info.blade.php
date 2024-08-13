@extends('layouts.app')

@section('admi', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Administración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{route('asignacionPoliza.index')}}" class="rutas"><small>Asignación seguro</small></a></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Información de unidad</small></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">

            <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.8cm;">
                <a href="{{ route('informe_poliza', $unidad) }}" class="btn btn-informe-orange me-2 boton-descargarInforme"
                    id="btn-infor-pantcomplet">
                    &nbsp; &nbsp; &nbsp; Descargar informe
                </a>

                <button type="button" class="btn btn-outline-light btn-excel boton-descargarInforme me-2"
                    data-bs-toggle="modal" data-bs-target="#agendarCita" id="btn-infor-responsive"
                    style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive">
                </button>
                @if ($existe == 0)
                <a class="btn boton-principal rounded-lg d-flex me-2 text-white" href="{{ route('asignacionPoliza.addSeguro',$unidad) }}"> + Agregar
                    seguro</a>
                @endif
            </div>


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
                                <th scope="col" class="encabezado">Póliza</th>
                                <th scope="col" class="encabezado">Aseguradora</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($polizaAsiganada as $poliza)
                                <tr class="text-center">
                                    <td class="text-start">{{ ++$i }}</td>
                                    <td>{{ $poliza->unidad->datosAsignacion->placas ?? 'No hay placas asignadas' }}</td>
                                    <td>{{ $poliza->unidad->marca->descripcion }}</td>
                                    <td>{{ $poliza->unidad->datosAsignacion->cliente->nombre_cliente ?? 'No hay cliente asignado' }}
                                    </td>
                                    <td>{{ $poliza->fecha_pago }}</td>
                                    <td>${{ number_format($poliza->monto_seguro, 2) }}</td>
                                    <td>
                                        <a href="{{ url('storage/' . $poliza->a_evidencia) }}" target="__blank">
                                            <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf"
                                                width="23px">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('storage/' . $poliza->a_poliza) }}" target="__blank">
                                            <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf"
                                                width="23px">
                                        </a>
                                    </td>
                                    <td>{{ $poliza->aseguradora->nombre_aseguradora }}</td>
                                    <td>
                                        <span style="display: inline-flex; align-items: center;">
                                            <span class="badge bg-green-status status"
                                                style="border-radius: 50%; display: inline-block;"></span>
                                            <span class="text-green-status" style="margin-left: 5px;">Pagado</span>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('showPoliza', $poliza->id_asignacion_seguros) }}">Ver</a>
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
