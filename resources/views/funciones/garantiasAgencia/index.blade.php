@extends('layouts.app')
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Garantías Flising</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            {{-- <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <button class="btn boton-principal" id="btn-pantcomp" role="button"
                    data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias_id">
                    <i class="fa fa-plus"></i>
                    <strong>Asignar Garantía</strong>
                </button>

                <button class="btn btn-respvagregar" id="btn-responsive" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias_id">
                    <i class="fas fa-plus"></i>
                </button>
            </div> --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Vehiculo</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Número de serie</th>
                                <th scope="col" class="encabezado">Proveedor</th>
                                <th scope="col" class="encabezado">I.D. Unidad</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                    <td class="text-start"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{route('funciones.garantiasAgencia.informacion')}}">Información</a>
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

    {{-- MODAL --}}
    {{-- @include('administracion.garantiasFlising.garantiasFlisingModal.modalGarantiasFlising', [
        'garantiasDisponibles' => $garantiasDisponibles,
        'unidades' => $unidades,
        'count' => 1,
    ]) --}}

    <script src="{{ asset('js/garantias/administracion/index.js') }}"></script>
@endsection
