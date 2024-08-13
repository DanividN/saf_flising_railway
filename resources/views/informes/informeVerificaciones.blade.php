@extends('layouts.app')
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">

        <div class="titulo-responsive">
            <label><a>Informe Verificaciones</a></label>
        </div>

        <div class="card border-0 p-2">
            <div class="card-body">
                {{-- <h5 class="title-orange titulo-pantcomp">Informe Verificaciones</h5> --}}

                <form class="needs-validation" action='javascript:void(0)' onsubmit='informe(this)' novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cliente" class="form-label"><b>Cliente</b></label>
                                <select class="form-select" name="cliente" required>
                                    <option value="" selected hidden>Seleccionar Cliente</option>
                                    <option disabled>Seleccionar</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id_cliente }}"
                                            {{ old('cliente') == $cliente->id_cliente ? 'selected' : '' }}>
                                            {{ $cliente->nombre_cliente }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="año" class="form-label"><b>Año</b></label>
                                <select class="form-select" name="año" required>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option disabled>Seleccionar</option>
                                    @foreach ($años as $año)
                                        <option value="{{ $año->descripcion }}"
                                            {{ old('año') == $año->descripcion ? 'selected' : '' }}>{{ $año->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="mes" class="form-label"><b>Mes</b></label>
                                <select class="form-select" name="mes" required>
                                    <option value="" selected hidden>Seleccionar Mes</option>
                                    <option disabled>Seleccionar</option>
                                    @foreach ($meses as $mes => $key)
                                        <option value="{{ $key }}" {{ old('mes') == $key ? 'selected' : '' }}>
                                            {{ ucwords(strtolower($mes)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="periodo" class="form-label"><b>Periodo</b></label>
                                <select class="form-select" name="periodo" required>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option disabled>Seleccionar</option>
                                    <option value="1" {{ old('periodo') == '1' ? 'selected' : '' }}>Primer semestre
                                    </option>
                                    <option value="2" {{ old('periodo') == '2' ? 'selected' : '' }}>Segundo semestre
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="estatus" class="form-label"><b>Estatus</b></label>
                                <select class="form-select" name="estatus" required>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option disabled>Seleccionar</option>
                                    @foreach ($estatus as $estado => $key)
                                        <option value="{{ $key }}" {{ old('estatus') == $key ? 'selected' : '' }}>
                                            {{ $estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-orange">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card shadow-md mt-4 border-0 p-2">

            {{-- ---------------------------------------BOTONES------------------------------------------------------------------------------------- --}}
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <a class="btn btn-informe-orange boton-descargarInforme" id="DownloadInforme" role="button">
                    &nbsp; &nbsp; &nbsp; &nbsp;Descargar Informe
                </a>
            </div>
            {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Período</th>
                                <th scope="col" class="encabezado">Fecha de Pago</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Monto</th>
                            </tr>
                        </thead>
                        <tbody id='tabla'>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src='{{ asset('js/verificacion/informe.js') }}'></script>
@endsection
