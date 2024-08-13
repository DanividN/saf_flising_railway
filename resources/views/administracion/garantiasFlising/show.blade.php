@extends('layouts.app')

@section('content')
    @include('components.alertas')

    <div class="container-fluid">
        {{-- @include('components.administracion.detalleUnidad', [
        ]) --}}

        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="d-flex justify-content-end" style="margin-right: .4cm;">
                <button class="btn btn-primary boton-corto btn-flis-corto" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias">
                    <strong>Editar Garantía</strong>
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Garantia extendida</th>
                                <th scope="col" class="encabezado">Vigencia</th>
                                <th scope="col" class="encabezado">Monto</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Evidencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-start"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Proveedor 1</td>
                                <td>
                                    <a>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
