@extends('layouts.app')
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Garantías Flising</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <button class="btn boton-principal" id="btn-pantcomp" role="button"
                    data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias_id">
                    <i class="fa fa-plus"></i>
                    <strong>Asignar Garantía</strong>
                </button>


                <button class="btn btn-respvagregar" id="btn-responsive" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias_id">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

{{--------------- Modal ------------------}}
            <!-- Modal -->
            <div class="modal fade" id="modal-asignar-garantias_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modal-asignar-garantias_id" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0">
                        <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar garantías de agencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
        
                    <div class="card-body">
                        <form action="" method="POST" id="formulario_extendidas" class="needs-validation" novalidate>
                            {{-- <input type="hidden" name="selected_garantias" id="selected_garantias"> --}}
                            {{-- <input type="hidden" name="hidden_id_unidad" id="hidden_id_unidad"> --}}
                            {{-- <input type="hidden" name="hidden_vehiculo_id" id="hidden_vehiculo_id">  --}}
                            {{-- <input type="hidden" name="hidden_id_asignacion_unidad" id="hidden_id_asignacion_unidad"> --}}
        
                            @csrf
                            <div class="modal-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-6 mt-4 mt-md-0">
                                        <div class="form-group">
                                            <div class="invalid-feedback text-start">
                                                <p class="text-danger">Seleccione una opción</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="table-responsive mt-4">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" class="encabezado"></th>
                                                <th scope="col" class="encabezado">No.</th>
                                                <th scope="col" class="encabezado">Tipo de Garantía</th>
                                                <th scope="col" class="encabezado">Vigencia</th>
                                                <th scope="col" class="encabezado">Monto con IVA</th>
                                                <th scope="col" class="encabezado">Fecha Inicial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="garantia" class="text-center">
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" checked>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td id="vigencia">4</td>
                                                <td>6</td>
                                                <td>
                                                    <input type="text" name="fecha_inicial[]" class="datepicker form-control" placeholder="dd/mm/aaaa" style="">
                                                    <input type="hidden" name="hidden_vigencia[]" class="hidden-vigencia">
                                                </td>
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                </div>
                            </div>
        
                            <div class="modal-footer border-0 d-flex justify-content-center">
                                <button type="button" class="btn btn-regresar rounded-lg d-flex"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-enviar rounded-lg d-flex">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
{{-- ------------------------------------------------- --}}

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
                                    <td>ejemplo 1</td>
                                    <td>ejemplo 1</td>
                                    <td>ejemplo 1</td>
                                    <td>ejemplo 1</td>
                                    <td>ejemplo 1</td>
                                    <td>ejemplo 1</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{route('admin.garantiasAgencia.informacion')}}">Información</a>
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
