@extends('layouts.app')
@section('content')
    @include('components.alertas')

    <div class="container-fluid">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        <div class="card shadow-md mt-5 border-0 p-2">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="card border-0 p-2">
                        <div class="card-body">
                            <h5 class="title-orange titulo-pantcomp">Información de unidad</h5>
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
            </div>
        </div>


        <div class="card shadow-md mt-4 border-0 p-2">
            {{-- ---------------------------------------BOTONES------------------------------------------------------------------------------------- --}}
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <button class="btn btn-primary boton-principal-corto" id="btn-pantcomp" role="button"
                    data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias_id">
                    <strong>Editar Garantías</strong>
                </button>


                <button class="btn btn-respvagregar" id="btn-responsive" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias_id">
                    <i class="fas fa-edit"></i>
                </button>

            </div>

            {{-- ------------- Modal Editar ---------------- --}}
            <!-- Modal -->
            <div class="modal fade" id="modal-asignar-garantias_id" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="modal-asignar-garantias_id" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header border-0 m-0">
                            <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar garantías de agencia
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="card-body">
                            <form action="" method="POST" id="formulario_extendidas" class="needs-validation"
                                novalidate>
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
                                                        <input type="text" name="fecha_inicial[]"
                                                            class="datepicker form-control" placeholder="dd/mm/aaaa"
                                                            style="">
                                                        <input type="hidden" name="hidden_vigencia[]"
                                                            class="hidden-vigencia">
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
            {{-- --------------------------------------------------------------------------- --}}

            {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Garantia extendida</th>
                                <th scope="col" class="encabezado">Vigencia</th>
                                <th scope="col" class="encabezado">Monto</th>
                                <th scope="col" class="encabezado">Fecha Inicial</th>
                                <th scope="col" class="encabezado">Fecha Final</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Eventos</th>
                                <th scope="col" class="encabezado">Garantía</th>
                                <th scope="col" class="encabezado">Evidencia</th>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/garantias/administracion/editModal.js') }}"></script>
        {{-- .......................................................... --}}
    @endsection
