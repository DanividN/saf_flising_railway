@extends('layouts.app')
@section('configuracion','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('unidades.index')}}" class="rutas"><small>Registro de unidades</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Agregar unidad</small></a></span></li>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('content')
<style>
    #observacion {
            width: 100%;
            height: auto;
        }
    @media (min-width: 992px) {
        #observacion {
            width: calc(135ch + 2rem);
            height: auto;
        }
    }
</style>
    <div class="container-fluid mt-5">
        <div class="titulo-responsive mb-0" >
            <label><a>Agregar Unidad:</a></label>
        </div>
        <div class="card shadow-md mt-5 border-0 p-2">
            <div class="card-body">
                <form action="{{ route('unidades.store') }}" method="post" class="needs-validation" id="formulario" novalidate enctype="multipart/form-data" onsubmit="return bloqueoBoton(event)">
                    @csrf
                    <div class="card-title" style="color:#ED5429;">
                       <b>Datos de la unidad</b>
                    </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="id_tipo_unidad" class="form-label"><b>Tipo</b><span class="require">*</span></label>
                                    <select class="single-select-field"  name="id_tipo_unidad" id="id_tipo_unidad" required>
                                        <option value="" hidden>Tipo de vehículo</option>
                                        @foreach ($tipo_unidades as $tp)
                                            <option value="{{ $tp->id_tipo_unidad }}" {{ old('id_tipo_unidad') == $tp->id_tipo_unidad ? 'selected' : '' }}>{{ $tp->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"style="margin:10px 0px;">
                                        <p class="text-danger">El tipo de vehículo no es valido</p>
                                    </div>
                                    <div class="text-danger"style="margin:10px 0px;">
                                        @error('id_tipo_unidad')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="id_marca" class="form-label"><b>Marca</b><span class="require">*</span></label>
                                    <select class="single-select-field" name="id_marca" id="id_marca" required>
                                        <option value="" hidden>Marca de vehículo</option>
                                        @foreach ($marcas as $marca)
                                            <option value="{{ $marca->id_marca }}" {{ old('id_marca') == $marca->id_marca ? 'selected' : '' }}>{{ $marca->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">La marca de vehículo no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('id_marca')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label class="form-label" for="modelo"><b>Modelo</b><span class="require">*</span></label>
                                    <input class="form-control" type="text" name="modelo" placeholder="Modelo de vehículo" id="modelo" value="{{ old('modelo') }}" required>
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El modelo no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('modelo')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="year"><b>Año<span class="require">*</span></b></label>
                                    <select name="year" id="year"  class="single-select-field" required>
                                        <option value="" hidden>Seleccionar año</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id_year }}" {{ old('year') == $year->id_year ? 'selected' : '' }}> {{ $year->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El año no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('year')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label for="color" class="form-label"><b>Color</b><span class="require">*</span></label>
                                    <input type="text" class="form-control" name="color" id="color" placeholder="Color del vehículo" value="{{ old('color') }}" pattern="[A-Za-z ]{1,}" required>
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El color no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('color')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label for="n_serie" class="form-label"><b>No. de serie</b><span class="require">*</span></label>
                                    <input type="text" class="form-control" name="n_serie" placeholder="Ingresa Número de serie" id="n_serie" value="{{ old('n_serie') }}" maxlength="20" required pattern="[A-Za-z0-9\s\-\\]{20}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El no. de serie no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('n_serie')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="n_motor" class="form-label"><b>Motor</b></label>
                                    <input type="text" class="form-control" name="n_motor" id="n_motor" placeholder="Número de motor" value="{{ old('n_motor') }}"  maxlength="11" pattern="[A-Z0-9\s\-\\]{11}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El no. de motor no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('n_motor')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="kilometraje" class="form-label"><b>Kilometraje</b><span class="require">*</span></label>
                                    <input type="text" class="form-control cantidad" name="kilometraje" value="{{old('kilometraje')}}" placeholder="Cantidad de kilometraje" required maxlength="7" pattern="[0-9\,]{1,}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El kilometraje no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('kilometraje')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="vehiculo_id" class="form-label"><b>I.D unidad</b><span class="require">*</span></label>
                                    <input type="text" class="form-control" name="vehiculo_id" id="vehiculo_id" value="{{ old('vehiculo_id') }}" placeholder="Ingresa ID del vehículo" required pattern="[A-Za-z0-9\s\-\/]+">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El i.d unidad no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('vehiculo_id')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="fecha_mantenimiento" class="form-label"><b>Última fecha de mantenimiento</b><span class="require">*</span></label>
                                    <input type="text" name="fecha_mantenimiento" id="datepicker" class="form-control datepicker" placeholder="dd/mm/aaaa" required value="{{ old('fecha_mantenimiento') }}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">La última fecha de mantenimiento no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('fecha_mantenimiento')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="costo_mantenimiento" class="form-label"><b>Costo básico de mantenimiento</b><span class="require">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: #999998;"><i
                                            class="bi bi-currency-dollar" style="color:white;"></i></span>
                                        <input type="text" class="form-control cantidad" name="costo_mantenimiento" placeholder="Monto de mantenimiento" value="{{ old('costo_mantenimiento') }}" required>
                                        <div class="invalid-feedback" style="margin:10px 0px;">
                                            <p class="text-danger">El costo básico de mantenimiento no es valido</p>
                                        </div>
                                        <div class="text-danger" style="margin:10px 0px;">
                                            @error('costo_mantenimiento')
                                               <b class="invalid_field"> {{ $message }}</b>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="card-title" style="color:#ED5429;">
                        <b>Papeles de la unidad</b>
                    </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="a_factura" class="form-label"><b>Factura</b></label>
                                    <input type="file"  class="input-archivo" name="a_factura" >
                                </div>
                                <div style="margin:10px 0px;">
                                    @error('a_factura')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="a_garantia_fabrica" class="form-label"><b>Garantía de fábrica</b></label>
                                    <input type="file"  class="input-archivo" name="a_garantia_fabrica" >
                                </div>
                                <div style="margin:10px 0px;">
                                    @error('a_garantia_fabrica')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="a_manual_servicio" class="form-label"><b>Manuales de servicio</b></label>
                                    <input type="file" class="input-archivo" name="a_manual_servicio" >
                                </div>
                                <div style="margin:10px 0px;">
                                    @error('a_manual_servicio')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="n_factura" class="form-label"><b>No. de factura</b><span class="require">*</span></label>
                                    <input type="text" class="form-control" name="n_factura" id="n_factura" placeholder="Número de factura" value="{{ old('n_factura') }}" maxlength="10" required pattern="[A-Za-z0-9]{10}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El no. de factura no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('n_factura')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="codigo" class="form-label"><b>Código de la llave del fabricante</b><span class="require">*</span></label>
                                    <input type="text" class="form-control" name="codigo_llave" id="codigo" placeholder="Código de llave" value="{{ old('codigo_llave') }}" required pattern="[A-Za-z0-9\s\-\/]{4,}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El código de la llave no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('codigo_llave')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="codigo" class="form-label"><b>Código locker</b><span class="require">*</span></label>
                                    <input type="text" class="form-control" name="codigo_locker" id="codigo" placeholder="Código de locker" value="{{ old('codigo_locker') }}" required pattern="[A-Za-z0-9\s\-\/]{4,}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El código de locker no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('codigo_locker')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="observacion"><b>Observaciones</b></label>
                                    <textarea name="observaciones" id="observacion" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="card-title" style="color:#ED5429;">
                       <b>Datos de proveedor del vehículo</b>
                    </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-grup">
                                    <label for="id_proveedor" class="form-label"><b>Proveedor</b><span class="require">*</span></label>
                                    <select class="single-select-field" name="id_proveedor" id="id_proveedor" required>
                                        <option value="" hidden>Seleccionar</option>
                                        @foreach ($preveedores as $proveedor)
                                            <option value="{{ $proveedor->id_proveedor }}" {{ old('id_proveedor') == $proveedor->id_proveedor ? 'selected' : '' }}>{{ $proveedor->nombre_comercial }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El proveedor no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('id_proveedor')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="rfc_proveedor" class="form-label"><b>RFC</b></label>
                                    <input type="text" class="form-control" name="rfc" placeholder="XAXX0101101000" style="text-transform: uppercase" id="rfc_proveedor" value="{{ old('rfc') }}"
                                        disabled>
                                </div>
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    @error('rfc')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label class="form-label" for="nombre_contacto"><b>Nombre del contacto</b></label>
                                    <input class="form-control" type="text" name="nombre_contacto" placeholder="Nombre de cliente" id="nombre_contacto" value="{{ old('nombre_contacto') }}" disabled>
                                </div>
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    @error('nombre_contacto')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label class="form-label" for="direccion"><b>Dirección</b></label>
                                    <input class="form-control" type="text" placeholder="Dirección" id="direccion"  disabled>
                                </div>
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    @error('direccion')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="telefono" class="form-label"><b>Teléfono</b></label>
                                    <input type="text" class="form-control" placeholder="Número de telefono" id="telefono" disabled>
                                </div>
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    @error('telefono')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="mantenimiento_km" class="form-label"><b>Mantenimiento (Km)</b><span class="require">*</span></label>
                                    <input type="text" class="form-control cantidad" name="mantenimiento_km" placeholder="Mantenimiento (km)" id="mantenimiento_km" value="{{ old('mantenimiento_km') }}" required maxlength="7" pattern="[0-9\,]{1,}">
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El mantenimiento (km) no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('mantenimiento_km')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="mantenimiento_tiempo" class="form-label"><b>Mantenimiento tiempo<span class="require">*</span></b></label>
                                    <select class="menu single-select-field" name="mantenimiento_tiempo" id="mantenimiento_tiempo" required>
                                        <option value="" hidden>Seleccionar</option>
                                        @foreach ($tiempos as $tiempos)
                                            <option value="{{ $tiempos->id_mantenimiento_tiempo }}" {{ old('id_mantenimiento_tiempo') == $tiempos->id_mantenimiento_tiempo ? 'selected' : '' }}>
                                                {{ $tiempos->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" style="margin: 10px 0px;">
                                        <p class="text-danger">El mantenimiento tiempo no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin: 10px 0px;">
                                        @error('mantenimiento_tiempo')
                                           <b class="invalid_field"> {{ $message }}</b>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="situacion_fiscal" class="form-label"><b>Garantía contractual</b></label>
                                    <input type="file" class="input-archivo" name="a_garantia_contractual">
                                </div>
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    @error('a_garantia_contractual')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="situacion_fiscal" class="form-label"><b>Garantía sobre la unidad</b></label>
                                    <input type="file" class="input-archivo" name="a_garantia_unidad">
                                </div>
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    @error('a_garantia_unidad')
                                       <b class="invalid_field"> {{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-regresar', ['link' => 'unidades.index'])
                        <button class="btn guardar" type="submit" id="guardarBtn">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
    <script>
        var responsableShowUrl = "{{ route('unidades.proveedor') }}";
    </script>
    <script src="{{ asset('js/configuracion/unidad/proveedor.js') }}"></script>
    <script src='{{asset('js/input-file.js')}}'></script>
    <script src="{{ asset('js/botonBloqueo.js') }}"></script>
@endsection
@endsection
