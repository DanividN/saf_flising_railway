@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/botonBloqueo.js') }}"></script>
    <script>
        var responsableShowUrl = "{{ route('responsables.show', ':id') }}";
        var responsableUpdateUrl = "{{ route('responsables.update', ':id') }}";
        var responsableStoreUrl = "{{ route('responsables.store') }}";
        var baseStorageUrl = "{{ url('storage') }}";
    </script>
    <script src="{{ asset('js/configuracion/responsable.js') }}"></script>
@endsection
@section('configuracion', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href=""
                class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('clientes.index') }}"
                class="rutas"><small>Registro de clientes</small></a></span></li>
@endsection
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Clientes Responsables:</a></label>
        </div>
        <div class="card border-0 p-2">
            <div class="card-body">
                {{-- <h5 class="title-orange">Información de unidad</h5> --}}

                <div class="row d-flex">

                    <div class="mt-2 text-gray">
                        <b style="color:black; font-size:18px;">Tipo de cliente:
                        </b><span>{{ $cliente->tipo_cliente }}</span>
                    </div>

                    <div class="mt-2 text-gray">
                        <b style="color:black; font-size:18px;">Nombre: </b><span>{{ $cliente->nombre_cliente }}</span>
                    </div>

                    <div class="mt-2 text-gray">
                        <b style="color:black; font-size:18px;">Titular del área:
                        </b><span>{{ $cliente->nombre_representante }}</span>
                    </div>

                    <div class="mt-2 text-gray">
                        <b style="color:black; font-size:18px;">Correo:
                        </b><span>{{ $cliente->correo_representante }}</span>
                    </div>

                    <div class="mt-2 text-gray">
                        <b style="color:black; font-size:18px;">Tel&eacute;fono:
                        </b><span>{{ $cliente->telefono_cliente }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mt-4 mb-2">
                        <button type="button" class="btn add_agencia" data-bs-toggle="modal" id="btn-pantcomp"
                            data-bs-target="#responsableModal">
                            <i class="bi bi-plus-lg"></i>Agregar Responsable
                        </button>

                        <button type="button" class="btn add_agencia btn-responsive" data-bs-toggle="modal"
                            id="btn-responsive" data-bs-target="#responsableModal">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <th class="text-center encabezado">No</th>
                                <th class="text-center encabezado">Responsable de activos</th>
                                <th class="text-center encabezado">Teléfono</th>
                                <th class="text-center encabezado">Correo electrónico</th>
                                <th class="text-center encabezado">Cargo</th>
                                <th class="text-center encabezado">Número de empleado</th>
                                <th class="text-center encabezado">Tipo</th>
                                <th class="text-center encabezado">INE</th>
                                <th class="text-center encabezado">Estatus</th>
                                <th class="text-center encabezado">Acción</th>
                            </thead>
                            <tbody>
                                @foreach ($responsables as $responsable)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $responsable->nombre_responsable }}</td>
                                        <td class="text-center">{{ $responsable->telefono_responsable }}</td>
                                        <td class="text-center">{{ $responsable->correo_responsable }}</td>
                                        <td class="text-center">{{ $responsable->cargo }}</td>
                                        <td class="text-center">{{ $responsable->numero_empleado }}</td>
                                        <td class="text-center">
                                            @if ($responsable->vip)
                                                VIP
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($responsable->a_ine_responsable)
                                                <a href="{{ url('storage/' . $responsable->a_ine_responsable) }}"
                                                    class="boton-pdf" target="__blank">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($responsable->activo == 1)
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-green-status status"
                                                        style="border-radius: 50%; display: inline-block;"></span>
                                                    <span class="text-green-status" style="margin-left: 5px;">Activo</span>
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center;">
                                                    <span class="badge bg-red-status status"
                                                        style="border-radius: 50%; display: inline-block;"></span>&nbsp;
                                                    <span class="text-red-status" style="margin-left: 5px;">Inactivo</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                        alt="menu" style="width: 30px !important;">
                                                </a>

                                                <ul class="dropdown-menu p-0">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#responsableModal"
                                                        data-id="{{ $responsable->id_responsable }}">
                                                        Ver/editar
                                                    </button>
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
    </div>
    @include('configuracion.clienteResponsable.create')
@endsection
