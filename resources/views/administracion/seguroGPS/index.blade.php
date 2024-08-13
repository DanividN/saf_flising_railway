@extends('layouts.app')

@section('admi', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Administración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Asignación seguro</small></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Seguro-GPS</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            {{-- seaerch y boton  --}}
            <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.8cm;">
                <button class="btn btn-informe" role="button" id="btn-infor-pantcomplet">
                    <strong>Informe</strong>
                </button>


                <button class="btn btn-outline-light btn-excel boton-informexcel me-2"
                    style="background-color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive">
                </button>
                {{-- ---------------- --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Modelo</th>
                                <th scope="col" class="encabezado">Año</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Póliza</th>
                                <th scope="col" class="encabezado">GPS</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $anio = date('Y');
                            @endphp
                            @foreach ($unidades as $unidad)
                                <tr class="text-center">
                                    <td class="text-start">{{ ++$i }}</td>
                                    <td>
                                        {{ $unidad->datosAsignacion->placas ?? 'No hay placas asignadas' }}
                                    </td>
                                    <td>{{ $unidad->marca->descripcion }}</td>
                                    <td>{{ $unidad->modelo }}</td>
                                    <td> {{ $anio }} </td>
                                    <td>
                                        @if (isset($unidad->datosAseguradora->fecha_pago))
                                            @php
                                                $fechaPago = new DateTime($unidad->datosAseguradora->fecha_pago);
                                                $fechaActual = new DateTime();

                                                $mesesDiferencia =
                                                    $fechaPago->diff($fechaActual)->y * 12 +
                                                    $fechaPago->diff($fechaActual)->m;

                                                if ($mesesDiferencia < 11) {
                                                    $statusClass = 'bg-green-status';
                                                    $statusText = 'Concluido';
                                                    $botonHidden = 'hidden';
                                                } elseif ($mesesDiferencia < 12) {
                                                    $statusClass = 'bg-yellow-status';
                                                    $statusText = 'Pendiente';
                                                    $botonHidden = '';
                                                } else {
                                                    $statusClass = 'bg-red-status';
                                                    $statusText = 'Vencida';
                                                    $botonHidden = '';
                                                }
                                            @endphp
                                        @else
                                            @php
                                                $statusClass = 'bg-yellow-status';
                                                $statusText = 'Pendiente';
                                                $botonHidden = '';
                                            @endphp
                                        @endif

                                        <span style="display: inline-flex; align-items: center;">
                                            <span class="badge {{ $statusClass }} status"
                                                style="border-radius: 50%; display: inline-block;"></span>
                                            <span
                                                class="text-{{ $statusClass == 'bg-green-status' ? 'green' : ($statusClass == 'bg-yellow-status' ? 'yellow' : 'red') }}-status"
                                                style="margin-left: 5px;">{{ $statusText }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        @if (isset($unidad->datosAseguradora->a_poliza))
                                            <a href="{{ url('storage/' . $unidad->datosAseguradora->a_poliza) }}"
                                                target="__blank">
                                                <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf"
                                                    width="23px">
                                            </a>
                                        @else
                                            No hay póliza asignada
                                        @endif
                                    </td>
                                    <td>{{ $unidad->datosAseguradora->gps->nombre_gps ?? 'No hay gps asignado' }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('informacion.poliza', $unidad->id_unidad) }}">Información</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('asignacionPoliza.addSeguro', $unidad->id_unidad) }}"
                                                        {{ $botonHidden }}>Agregar
                                                        seguro</a>
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
            {{-- -------------------- --}}
        </div>
    </div>
@endsection
