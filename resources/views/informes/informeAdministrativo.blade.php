@extends('layouts.app')
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Informe Administrativo</a></label>
        </div>
        <div class="card border-0 p-2">
            <div class="card-body">
                {{-- <h5 class="title-orange titulo-pantcomp">Informe Administrativo</h5> --}}
                <div class="row">
                    <div class="col-md-4">
                        <label for="cliente" class="form-label"><b>Cliente</b></label>
                        <select class="menu" name="cliente">
                            <option disabled selected>Seleccionar Cliente</option>
                            <option value="2">Seguro de Flotillas</option>
                            <option value="3">Seguro de Riesgo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="vehiculo" class="form-label"><b>Año</b></label>
                        <select class="menu" name="vehiculo">
                            <option disabled selected>Seleccionar Año</option>
                            <option value="2">Seguro de Flotillas</option>
                            <option value="3">Seguro de Riesgo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tipo_poliza" class="form-label"><b>Mes</b></label>
                        <select class="menu" name="tipo_poliza">
                            <option disabled selected>Seleccionar Mes</option>
                            <option value="2">Seguro de Flotillas</option>
                            <option value="3">Seguro de Riesgo</option>
                        </select>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-orange">Buscar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow-md mt-4 border-0 p-2">

            {{-- ---------------------------------------BOTONES------------------------------------------------------------------------------------- --}}
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <button class="btn btn-orange boton-descargagnral" id="btn-pantcomp" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias_id">
                    &nbsp; &nbsp; &nbsp;Descargar Informe
                </button>


                <button type="button" class="btn btn-orange boton-descargagnral btn-excel me-2" data-bs-toggle="modal"
                    data-bs-target="#agendarCita" id="btn-infor-responsive" style="color: #ED5429; border-color: #ED5429;"
                    id="btn-infor-responsive">
                </button>
            </div>
            {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Unidades</th>
                                <th scope="col" class="encabezado">Año</th>
                                <th scope="col" class="encabezado">Mes</th>
                                <th scope="col" class="encabezado">Mantenimiento</th>
                                <th scope="col" class="encabezado">Seguros</th>
                                <th scope="col" class="encabezado">Tenencia</th>
                                <th scope="col" class="encabezado">Verificaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="celda-divid">P</div>
                                    <div class="celda-divid">R</div>
                                    <div class="celda-divid">%</div>
                                </td>
                                <td>
                                    <div class="celda-divid">P</div>
                                    <div class="celda-divid">R</div>
                                    <div class="celda-divid">%</div>
                                </td>
                                <td>
                                    <div class="celda-divid">P</div>
                                    <div class="celda-divid">R</div>
                                    <div class="celda-divid">%</div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="celda-dividborde">54</div>
                                    <div class="celda-dividborde">56</div>
                                    <div class="celda-dividborde">36%</div>
                                </td>
                                <td>
                                    <div class="celda-dividborde">25</div>
                                    <div class="celda-dividborde">63</div>
                                    <div class="celda-dividborde">39%</div>
                                </td>
                                <td>
                                    <div class="celda-dividborde">8</div>
                                    <div class="celda-dividborde">3</div>
                                    <div class="celda-dividborde">99%</div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
