@extends('layouts.app')
@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">

        <div class="titulo-responsive">
            <label><a>Informe Productividad</a></label>
        </div>

        <div class="card border-0 p-2">
            <div class="card-body">
                {{-- <h5 class="title-orange titulo-pantcomp">Informe Productividad</h5> --}}
                <div class="row">
                    <div class="col-md-3">
                        <label for="cliente" class="form-label"><b>Usuario</b></label>
                        <select class="menu" name="cliente">
                            <option disabled selected>Seleccionar Usuario</option>
                            <option value="2">Seguro de Flotillas</option>
                            <option value="3">Seguro de Riesgo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="vehiculo" class="form-label"><b>Cliente</b></label>
                        <select class="menu" name="vehiculo">
                            <option disabled selected>Seleccionar Cliente</option>
                            <option value="2">Seguro de Flotillas</option>
                            <option value="3">Seguro de Riesgo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tipo_poliza" class="form-label"><b>Fecha Inicial</b></label>
                        <input type="text" name="fecha_inicial" class="form-control datepicker" placeholder="dd/mm/aaaa">
                    </div>
                    <div class="col-md-3">
                        <label for="tipo_poliza" class="form-label"><b>Fecha Final</b></label>
                        <input type="text" name="fecha_inicial" class="form-control datepicker" placeholder="dd/mm/aaaa">
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


                <button type="button" class="btn btn-orange boton-descargagnral btn-excel  boton-descargarInforme me-2"
                    data-bs-toggle="modal" data-bs-target="#agendarCita" id="btn-infor-responsive"
                    style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive">
                </button>
            </div>
            {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Call Center</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Mantenimiento</th>
                                <th scope="col" class="encabezado">Verificaciones</th>
                                <th scope="col" class="encabezado">Siniestros</th>
                                <th scope="col" class="encabezado">Emergencias</th>
                                <th scope="col" class="encabezado">Garantías Flising</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="productividad">Unidades atendidas</div>
                                    <div class="productividad">Llamadas registradas</div>
                                    <div class="productividad">Captura en el sistema</div>
                                    <div class="productividad">Eficiencia</div>
                                </td>
                                <td>
                                    <div class="productividad">Unidades atendidas</div>
                                    <div class="productividad">Llamadas registradas</div>
                                    <div class="productividad">Captura en el sistema</div>
                                    <div class="productividad">Eficiencia</div>
                                </td>
                                <td>
                                    <div class="productividad">Unidades atendidas</div>
                                    <div class="productividad">Llamadas registradas</div>
                                    <div class="productividad">Captura en el sistema</div>
                                    <div class="productividad">Eficiencia</div>
                                </td>
                                <td>
                                    <div class="productividad">Unidades atendidas</div>
                                    <div class="productividad">Llamadas registradas</div>
                                    <div class="productividad">Captura en el sistema</div>
                                    <div class="productividad">Eficiencia</div>
                                </td>
                                <td>
                                    <div class="productividad">Unidades atendidas</div>
                                    <div class="productividad">Llamadas registradas</div>
                                    <div class="productividad">Captura en el sistema</div>
                                    <div class="productividad">Eficiencia</div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>
                                    <div class="celda-dividbordeProduc">54</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">36%</div>
                                </td>
                                <td>
                                    <div class="celda-dividbordeProduc">54</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">36%</div>
                                </td>
                                <td>
                                    <div class="celda-dividbordeProduc">54</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">36%</div>
                                </td>
                                <td>
                                    <div class="celda-dividbordeProduc">25</div>
                                    <div class="celda-dividbordeProduc">63</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">39%</div>
                                </td>
                                <td>
                                    <div class="celda-dividbordeProduc">8</div>
                                    <div class="celda-dividbordeProduc">3</div>
                                    <div class="celda-dividbordeProduc">56</div>
                                    <div class="celda-dividbordeProduc">99%</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
