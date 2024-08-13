@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/modulo.supervision.js') }}"></script>
@endsection

@section('admi','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Superivisión</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Supervisión</a></label>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="d-flex justify-content-end align-items-center" style="margin-left: .4cm; margin-top:0.4cm;">
                <a href="{{ route('supervision.informe.supervision') }}" class="btn btn-informe me-2"
                    id="btn-infor-pantcomplet">
                    <strong>Informe</strong>
                </a>

                <a href="{{ route('supervision.informe.supervision') }}" class="btn btn-informe boton-informexcel me-2"
                    id="btn-responsive">
                </a>

                <button class="btn boton-corto btn-flis-corto" data-bs-toggle="modal" id="btn-pantcomp"
                    data-bs-target="#supervisionModal" style="margin-right: .4cm;">
                    <strong>Agendar Cita</strong>
                </button>

                <button class="btn btn-respvagregar" id="btn-agregarResponsive" data-bs-toggle="modal"
                    data-bs-target="#supervisionModal" style="margin-right: .4cm;">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Cantidad de activos</th>
                                <th scope="col" class="encabezado">Tipo de cliente</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $key => $cliente)
                                <tr class="text-center">
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td>{{ $cliente->nombre_cliente }}</td>
                                    <td>{{ $cliente->activos->count() }}</td>
                                    <td>{{ $cliente->tipo_cliente }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('supervision.lista.unidades', $cliente->id_cliente) }}">
                                                        Lista de unidades
                                                    </a>
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
    @include('administracion.supervision.agendarSupervision', [
        'clientes' => $clientes,
        'supervisores' => $supervisores,
    ])
@endsection