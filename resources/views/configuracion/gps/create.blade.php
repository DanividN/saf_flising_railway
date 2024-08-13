@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
@endsection

@section('configuracion', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Configuración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{ route('gps.index')}}"  class="rutas"><small>GPS</small></a></span></li>
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Registro de GPS</small></span></li>
@endsection

@section('content')
<div class="container-fluid mt-5">
    <div class="titulo-responsive mb-0">
        <label><a>Agregar GPS</a></label>
    </div>
    <form action="{{ route('gps.store')}}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <h5 class="title-orange">GPS</h5>
                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="razonSocial" class="form-label"><b>Raz&oacute;n Social</b></label>
                        <input placeholder="Ingresar razón social" value="{{ old('razon_gps') }}" type="text" class="form-control" name="razon_gps" id="razonSocial" required>
                        @error('razon_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreComercial" class="form-label"><b>Nombre comercial</b></label>
                        <input placeholder="Nombre comercial" value="{{ old('nombre_gps') }}" type="text" class="form-control" name="nombre_gps" id="nombreComercial" required>
                        @error('nombre_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefono" class="form-label"><b>Tel&eacute;fono</b></label>
                        <input placeholder="1234567890" value="{{ old('telefono_gps') }}" maxlength="10" type="text" class="form-control tel-input" name="telefono_gps" id="telefono" required>
                        @error('telefono_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="rfc" class="form-label"><b>RFC</b></label>
                        <input placeholder="XAXX010101000" maxlength="13" value="{{ old('rfc_gps') }}" type="text" class="form-control" name="rfc_gps" id="rfc" oninput="validarRFC(event)" required>
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                        @error('rfc_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto" class="form-label"><b>Correo contacto</b></label>
                        <input placeholder="empresa@email.com" value="{{ old('correo_gps') }}" type="email" class="form-control" name="correo_gps" id="correoContacto" oninput="validarEmail(event)" required>
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                        @error('correo_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="calle" class="form-label"><b>Calle</b></label>
                        <input placeholder="Nombre de la calle" value="{{ old('calle_gps') }}" type="text" class="form-control" name="calle_gps" id="calle" required>
                        @error('calle_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="numExterior" class="form-label"><b>No. exterior</b></label>
                        <input placeholder="Número exterior" value="{{ old('n_exterior_gps') }}" type="number" class="form-control" name="n_exterior_gps" id="numExterior" required>
                        @error('n_exterior_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="colonia" class="form-label"><b>Colonia</b></label>
                        <input placeholder="Nombre de la colonia" value="{{ old('colonia_gps') }}" type="text" class="form-control" name="colonia_gps" id="colonia" required>
                        @error('colonia_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="estado" class="form-label"><b>Entidad federativa</b></label>
                        <select id="estado" class="form-select" required>
                            <option value="" hidden>Entidad federativa</option>
                            @foreach ($entidades_federativas as $entidad)
                                <option value="{{$entidad->id_entidad_federativa}}">{{$entidad->nombre_entidad_federativa}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="municipio" class="form-label"><b>Municipio / Alcaldía</b></label>
                        <select name="id_municipio" id="id_municipio" class="single-select-field" required>
                            <option value="" hidden>Municipio</option>
                        </select>
                        @error('id_municipio')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="cp" class="form-label"><b>C.P.</b></label>
                        <input placeholder="00000" maxlength="5" value="{{ old('cp_gps') }}" type="text" class="form-control cp" name="cp_gps" id="cp" required>
                        @error('cp_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12" hidden>
                        <label for="calle" class="form-label"><b>Activo</b></label>
                        <input type="number" value="1" name="activo" required>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <label for="cp" class="form-label"><b>Observaciones</b></label>
                        <textarea class="form-control" value="{{ old('observacion_gps')}}" name="observacion_gps" id="" cols="5" rows="5"></textarea>
                        @error('observacion_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                </div>
                <hr>

                <h5 class="title-orange mt-3">Registro de Contactos</h5>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato1" class="form-label"><b>Nombre</b></label>
                        <input placeholder="Nombre de contacto" type="text" class="form-control" name="nombre_contacto[]" id="nombreContato1" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto1" class="form-label"><b>N&uacute;mero de contacto</b></label>
                        <input placeholder="1234567890" maxlength="10" type="text" class="form-control tel-input" name="numero_contacto[]" id="telefonoContacto1" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto1" class="form-label"><b>Correo de contacto</b></label>
                        <input placeholder="contacto@email.com" type="email" class="form-control" name="correo_contacto[]" id="correoContacto1" required oninput="validarEmail(event)">
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato2" class="form-label"><b>Nombre</b></label>
                        <input placeholder="Nombre de contacto" type="text" class="form-control" name="nombre_contacto[]" id="nombreContato2">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto2" class="form-label"><b>N&uacute;mero de contacto</b></label>
                        <input placeholder="1234567890" maxlength="10" type="text" class="form-control tel-input" name="numero_contacto[]" id="telefonoContacto2">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto2" class="form-label"><b>Correo de contacto</b></label>
                        <input placeholder="contacto@email.com" type="email" class="form-control" name="correo_contacto[]" id="correoContacto2" oninput="validarEmail(event)">
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato3" class="form-label"><b>Nombre</b></label>
                        <input placeholder="Nombre de contacto" type="text" class="form-control" name="nombre_contacto[]" id="nombreContato3">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto3" class="form-label"><b>N&uacute;mero de contacto</b></label>
                        <input placeholder="1234567890" maxlength="10" type="text" class="form-control tel-input" name="numero_contacto[]" id="telefonoContacto3">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto3" class="form-label"><b>Correo de contacto</b></label>
                        <input placeholder="contacto@email.com" type="email" class="form-control" name="correo_contacto[]" id="correoContacto3" oninput="validarEmail(event)">
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3 gap-3">
                    <a href="{{route('gps.index')}}" class="btn btn-regresar">Regresar</a>
                    <button type="submit" class="btn btn-enviar">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src='{{asset('js/buscadorMunicipios.js')}}'></script>
<script src='{{asset('js/validacionCampos.js')}}'></script>
@endsection

