@extends('layouts.app')
@section('configuracion', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href=""
                class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('clientes.index') }}"
                class="rutas"><small>Registro de clientes</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Agregar
                    cliente</small></a></span></li>
@endsection
@section('content')
    <div class="titulo-responsive mb-0">
        <label><a>Nuevo Cliente:</a></label>
    </div>
    <div class="card shadow-md mt-5 border-0 p-2">
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="post" class="needs-validation" id="formulario" novalidate enctype="multipart/form-data" onsubmit="return bloqueoBoton(event)">
                @csrf
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="tipo_cliente" class="form-label"><b>Tipo Cliente</b><span
                                    class="require">*</span></label>
                            <select name="tipo_cliente" id="tipo_cliente" class="menu single-select-field" required>
                                <option value="" hidden>Seleccionar</option>
                                @foreach ($tipos_clientes as $tp)
                                    <option value="{{ $tp->id_tipo }}"
                                        {{ old('tipo_cliente') == $tp->id_tipo ? 'selected' : '' }}>
                                        {{ $tp->descripcion }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback text-start">
                                <p class="text-danger">El tipo de cliente no es valido</p>
                            </div>
                        </div>
                        <div class="text-danger" style="margin:10px 0px;">
                            @error('tipo_cliente')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label" for="nombre_cliente"><b>Nombre
                                    cliente/Área/Dependencia</b><span class="require">*</span></label>
                            <input class="form-control" type="text" name="nombre_cliente" placeholder="Nombre de cliente"
                                id="nombre_cliente" value="{{ old('nombre_cliente') }}" required
                                pattern="[A-Za-zÀ-ÖØ-öø-ÿñÑ\s]{1,}">
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El nombre del cliente/Área/Dependencia no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"tyle="margin:10px 0px; ">
                            @error('nombre_cliente')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="rfc" class="form-label"><b>RFC</b><span class="require">*</span></label>
                            <input type="text" class="form-control" name="rfc" placeholder="XAXX0101101000"
                                style="text-transform: uppercase" maxlength="13" id="rfc" value="{{ old('rfc') }}" required onblur="validarRFC(event)">
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El RFC no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger" data-error="rfc"  style="margin:10px 0px;">
                            @error('rfc')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="calle" class="form-label"><b>Calle</b><span class="require">*</span></label>
                            <input type="text" class="form-control" name="calle" placeholder="Nombre de la calle"
                                id="calle" value="{{ old('calle') }}" required>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">La calle no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('calle')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="form-group">
                            <label for="n_exterior" class="form-label"><b>No. exterior</b><span
                                    class="require">*</span></label>
                            <input type="text" class="form-control" name="n_exterior" placeholder="Número exterior"
                                id="n_exterior" value="{{ old('n_exterior') }}" required pattern="[0-9]{1,4}">
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El No. exterior no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('n_exterior')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="form-group">
                            <label for="n_interior" class="form-label"><b>No. interior</b></label>
                            <input type="text" class="form-control" name="n_interior" placeholder="Número interior"
                                id="n_interior" value="{{ old('n_interior') }}" pattern="[A-Za-z0-9]{1,4}">
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El No. interior no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('n_interior')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="entidad_id" class="form-label"><b>Entidad federativa <span
                                        class="require">*</span></b></label>
                            <select class="menu" id="entidad_id" required>
                                <option value="" hidden>Seleccionar</option>
                                @foreach ($entidad_federativa as $entidad)
                                    <option value="{{ $entidad->id_entidad_federativa }}">
                                        {{ $entidad->nombre_entidad_federativa }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback text-start">
                                <p class="text-danger">La entidad federativa no es valido</p>
                            </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('nombre_cliente')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="municipio"><b>Municipio / Alcaldía</b><span class="require">*</span></label>
                            <select name="id_municipio" id="id_municipio" class="menu single-select-field"
                                required></select>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El municipio / alcadía no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('id_municipio')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="codigo" class="form-label"><b>Código postal</b><span
                                    class="require">*</span></label>
                            <input type="text" class="form-control" name="codigo_postal" id="codigo"
                                placeholder="00000" value="{{ old('codigo_postal') }}" maxlength="5" required
                                pattern="[0-9]{5}">
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El código postal no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('codigo_postal')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="area" class="form-label"><b>Titular del área</b><span
                                    class="require">*</span></label>
                            <input type="text" class="form-control" name="nombre_representante" id="area"
                                placeholder="Nombre del titular" value="{{ old('nombre_representante') }}" required
                                pattern="[A-Za-zÀ-ÖØ-öø-ÿñÑ\s]{1,}">
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El titular del área no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('nombre_representante')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="correo" class="form-label"><b>Correo del titular del área</b><span
                                    class="require">*</span></label>
                            <input type="email" class="form-control" name="correo_representante" id="correo"
                                placeholder="correo@email.com" value="{{ old('correo_representante') }}" required>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El correo del titular del área no es valido</p>
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('correo_representante')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="telefono" class="form-label"><b>Teléfono celular u oficina</b><span
                                    class="require">*</span></label>
                            <input type="text" class="form-control" name="telefono_cliente" id="telefono"
                                maxlength="10" placeholder="7220001111" value="{{ old('telefono_cliente') }}"pattern="[0-9]{10}"required>
                                <div class="invalid-feedback">
                                    El número de teléfono debe contener exactamente 10 dígitos.
                                </div>
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('telefono_cliente')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="ine" class="form-label"><b>INE</b></label>
                            <input type="file" class="input-archivo" name="a_identificacion" id="ine">
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('a_identificacion')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="situacion_fiscal" class="form-label"><b>Constancia de situación físcal</b></label>
                            <input type="file" class="input-archivo" name="a_situacion_fiscal" id="situacion_fiscal">
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('a_situacion_fiscal')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="comprobante" class="form-label"><b>Comprobante de domicilio</b></label>
                            <input type="file" class="input-archivo" name="a_comprobante_domicilio" id="comprobante">
                        </div>
                        <div class="text-danger"style="margin:10px 0px;">
                            @error('a_comprobante_domicilio')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <hr class="rounded">
                <label class="contacto_registro" for="location">Direcci&oacute;n</label>
                <div class="input-group mb-3 mt-3">
                    <input type="text" name="direccion_cliente" id="location" class="form-control"
                        placeholder="Introducir direcci&oacute;n completa" required>
                        <button class="btn btn-outline-secondary" type="button" id="location_search"
                        onclick="getNameDirection()">Buscar</button>
                        <div class="invalid-feedback text-start">
                            <p class="text-danger">La dirección no es valido</p>
                        </div>
                </div>
                <div class="row mt-3" hidden>
                    <div class="col-md-6">
                        <label for="latitud"><strong>Latitud: <span class="require">*</span></strong></label>
                        <input type="text" name="cx" class="form-control" id="latitud" readonly
                            placeholder="Latitud">
                    </div>
                    <div class="col-md-6">
                        <label for="longitud"><strong>Longitud: <span class="require">*</span></strong></label>
                        <input type="text" name="cy" class="form-control" id="longitud" readonly
                            placeholder="Longitud">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 mt-3">
                        <input type="text" class="form-control" id="name_com" readonly>
                        <textarea rows="5" id="direccion_a" class="form-control mt-1" readonly></textarea>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div id="map" class="mt-3"></div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-3">
                    @include('components.btn-regresar', ['link' => 'clientes.index'])
                    @include('components.btn-guardar', ['link' => 'clientes.store', 'id' => 'guardarBtn'])
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap"
        type="text/javascript"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/maps.google.js') }}"></script>
    <script src='{{ asset('js/input-file.js') }}'></script>
    <script>
        var responsableShowUrl = "{{ route('clientes.municipio') }}";
    </script>
    <script src="{{ asset('js/configuracion/cliente/create.js') }}"></script>
    <script src="{{ asset('js/botonBloqueo.js') }}"></script>
@endsection
