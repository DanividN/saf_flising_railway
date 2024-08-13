@extends('layouts.app')
@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Informe Supervisión</a></label>
        </div>

        <div class="card border-0 p-2">
            <div class="card-body">
                {{-- <h5 class="title-orange titulo-pantcomp">Informe Supervisión</h5> --}}
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-3">
                        <label for="id_cliente" class="form-label"><b>Cliente</b></label>
                        <select class="menu" name="id_cliente" id="id_cliente">
                            <option value="" disabled selected>Seleccionar Cliente</option>
                            @foreach ($clientes as $id_cliente => $cliente)
                                <option value="{{ $id_cliente }}">{{ $cliente }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="year" class="form-label"><b>Año</b></label>
                        <select class="menu" name="year" id="year">
                            <option value="" selected disabled>Seleccionar Año</option>
                            @for ($i = date('Y') + 1; $i >= date('Y') - 20; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="mes" class="form-label"><b>Mes</b></label>
                        <select class="menu" name="mes" id="mes">
                            <option value="" disabled selected>Seleccionar Mes</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="estatus" class="form-label"><b>Estatus</b></label>
                        <select class="menu" name="estatus" id="estatus">
                            <option value="" disabled selected>Seleccionar Estatus</option>
                            <option value="{{ \App\Models\administracion\CitaSupervision::AGENDADA }}">Agendada</option>
                            <option value="{{ \App\Models\administracion\CitaSupervision::CANCELADA }}">Cancelada</option>
                            <option value="{{ \App\Models\administracion\CitaSupervision::CONCLUIDA }}">Concluida</option>
                            <option value="{{ \App\Models\administracion\CitaSupervision::VENCIDA }}">Vencida</option>
                            <option value="{{ \App\Models\administracion\CitaSupervision::VALIDADA }}">Validada</option>
                        </select>
                    </div>

                    <div class="col-md-12 text-center mt-3">
                        <button type="button" id="generar_informe" class="btn btn-orange">Buscar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <a href="" class="btn btn-orange boton-descargagnral informe-excel-sipervision" id="btn-pantcomp">
                    &nbsp; &nbsp; &nbsp;Descargar Informe
                </a>

                <a type="button" href=""
                    class="btn btn-orange boton-descargagnral btn-excel me-2 informe-excel-sipervision"
                    id="btn-infor-responsive" style="color: #ED5429; border-color: #ED5429;" id="btn-infor-responsive"></a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Vehiculo</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Responsable Supervision</th>
                                <th scope="col" class="encabezado">Fecha</th>
                                <th scope="col" class="encabezado">Estatus</th>
                            </tr>
                        </thead>
                        <tbody id="resultados_informe"></tbody>
                    </table>
                </div>
                <div id="loading" style="display: none !important; justify-content: center; align-items: center;">
                    <div class="sk-chase">
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/informes/informeSupervision.js') }}"></script>
@endsection
