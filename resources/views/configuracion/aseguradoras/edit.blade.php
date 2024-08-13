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
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{ route('aseguradoras.index')}}"  class="rutas"><small>Aseguradoras</small></a></span></li>
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Editar registro de aseguradora</small></span></li>
@endsection

@section('content')
<div class="container-fluid mt-5">
    <div class="titulo-responsive">
        <label><a>Lista de aseguradoras</a></label>
    </div>

    <form action="{{ url('/configuracion/aseguradoras/'.$aseguradora->id_aseguradora) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <h5 class="title-orange">Aseguradora</h5>
                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="razonSocial" class="form-label"><b>Raz&oacute;n Social</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="razon_aseguradora" id="razonSocial" value="{{$aseguradora->razon_aseguradora}}" placeholder="Razón Social" @if($existe) readonly @endif>
                        @error('razon_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreComercial" class="form-label"><b>Nombre comercial</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nombre_aseguradora" id="nombreComercial" value="{{$aseguradora->nombre_aseguradora}}" placeholder="Nombre Comercial" @if($existe) readonly @endif>
                        @error('nombre_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror

                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefono" class="form-label"><b>Tel&eacute;fono</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control tel-input" maxlength="10"  name="telefono_aseguradora" id="telefono" value="{{$aseguradora->telefono_aseguradora}}" placeholder="1234567890" required>
                        @error('telefono_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="rfc" class="form-label"><b>RFC</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" maxlength="13" name="rfc_aseguradora" id="rfc" value="{{$aseguradora->rfc_aseguradora}}"  placeholder="XAXX010101000" @if($existe) readonly @endif>
                        @error('rfc_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto" class="form-label"><b>Correo contacto</b><span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="correo_aseguradora" id="correoContacto" value="{{$aseguradora->correo_aseguradora}}" placeholder="empresa@email.com" oninput="validarEmail(event)" required>
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                        @error('correo_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="calle" class="form-label"><b>Calle</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="calle_aseguradora" id="calle" value="{{$aseguradora->calle_aseguradora}}" placeholder="Nombre de la calle" required>
                        @error('calle_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="numExterior" class="form-label"><b>No. exterior</b><span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="n_exterior_aseguradora" id="numExterior" value="{{$aseguradora->n_exterior_aseguradora}}" placeholder="No. exterior" required>
                        @error('n_exterior_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="colonia" class="form-label"><b>Colonia</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="colonia_aseguradora" id="colonia" value="{{$aseguradora->colonia_aseguradora}}" placeholder="Colonia" required>
                        @error('colonia_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="estado" class="form-label"><b>Entidad federativa</b><span class="text-danger">*</span></label>
                        <select name="" id="estado" class="form-select" placeholder="Entidad federativa" required>
                            @foreach ($municipios as $municipio)
                                @foreach ($entidades_federativas as $entidad)
                                    @if($municipio->id_municipio == $aseguradora->id_municipio)
                                        @php
                                            $select = '';
                                        @endphp
                                        @if ($entidad->id_entidad_federativa == $municipio->id_entidad_federativa)
                                            @php
                                                $select = 'selected';
                                            @endphp
                                        @endif
                                        <option value="{{ $entidad->id_entidad_federativa }}" {{ $select }}>{{ $entidad->nombre_entidad_federativa }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="municipio" class="form-label"><b>Municipio / Alcaldía</b><span class="text-danger">*</span></label>
                        <select name="id_municipio" id="id_municipio" class="menu single-select-field" placeholder="Municipio / Alcaldia" required>
                            @foreach ($municipios as $municipio)
                                @if($municipio->id_entidad_federativa == $aseguradora->municipio->id_entidad_federativa)
                                    <option value="{{ $municipio->id_municipio }}"
                                        @if($municipio->id_municipio == $aseguradora->id_municipio) selected @endif>
                                        {{ $municipio->nombre_municipio }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('id_municipio')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="cp" class="form-label"><b>C.P.</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control cp" maxlength="5"  name="cp_aseguradora" id="cp" value="{{$aseguradora->cp_aseguradora}}" placeholder="00000" required>
                        @error('cp_aseguradora')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12" hidden>
                        <label for="calle" class="form-label"><b>Activo</b></label>
                        <input type="number" value="1" name="activo">
                    </div>
                </div>

                <hr>

                <h5 class="title-orange">Registro de Contactos</h5>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato1" class="form-label"><b>Nombre</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nombre_contacto[]" id="nombreContato1" @if(isset($contactos[0]->nombre_contacto)) value="{{$contactos[0]->nombre_contacto}}"  @endif placeholder="Nombre de contacto" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto1" class="form-label"><b>N&uacute;mero de contacto</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control tel-input" maxlength="10" name="numero_contacto[]" id="telefonoContacto1" @if(isset($contactos[0]->numero_contacto)) value="{{$contactos[0]->numero_contacto}}"  @endif placeholder="1234567890" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto1" class="form-label"><b>Correo de contacto</b><span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="correo_contacto[]" id="correoContacto1" @if(isset($contactos[0]->correo_contacto)) value="{{$contactos[0]->correo_contacto}}"  @endif placeholder="empresa@email.com" oninput="validarEmail(event)" required>
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato2" class="form-label"><b>Nombre</b></label>
                        <input type="text" class="form-control" name="nombre_contacto[]" id="nombreContato2" @if(isset($contactos[1]->nombre_contacto)) value="{{$contactos[1]->nombre_contacto}}"  @endif placeholder="Nombre de contacto">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto2" class="form-label"><b>N&uacute;mero de contacto</b></label>
                        <input type="text" class="form-control tel-input" maxlength="10" name="numero_contacto[]" id="telefonoContacto2" @if(isset($contactos[1]->numero_contacto)) value="{{$contactos[1]->numero_contacto}}"  @endif  placeholder="1234567890">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto2" class="form-label"><b>Correo de contacto</b></label>
                        <input type="email" class="form-control" name="correo_contacto[]" id="correoContacto2" @if(isset($contactos[1]->correo_contacto)) value="{{$contactos[1]->correo_contacto}}"  @endif placeholder="empresa@email.com" oninput="validarEmail(event)">
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato3" class="form-label"><b>Nombre</b></label>
                        <input type="text" class="form-control" name="nombre_contacto[]" id="nombreContato3" @if(isset($contactos[2]->nombre_contacto)) value="{{$contactos[2]->nombre_contacto}}" @endif placeholder="Nombre de contacto" >
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto3" class="form-label"><b>N&uacute;mero de contacto</b></label>
                        <input type="text" class="form-control tel-input" maxlength="10" name="numero_contacto[]" id="telefonoContacto3" @if(isset($contactos[2]->numero_contacto)) value="{{$contactos[2]->numero_contacto}}" @endif placeholder="1234567890">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto3" class="form-label"><b>Correo de contacto</b></label>
                        <input type="email" class="form-control" name="correo_contacto[]" id="correoContacto3"  @if(isset($contactos[2]->correo_contacto)) value="{{$contactos[2]->correo_contacto}}" @endif placeholder="empresa@email.com" oninput="validarEmail(event)">
                        <div class="invalid-feedback">
                            ¡Formato invalido!
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3 gap-3">
                    <a href="{{route('aseguradoras.index')}}" class="btn btn-regresar">Regresar</a>
                    <button type="submit" class="btn btn-enviar">Editar</button>
                </div>
            </div>
        </div>
    </form>
</div>
    <script src='{{asset('js/aseguradoras/municipiosEdit.js')}}'></script>
    <script src='{{asset('js/validacionCampos.js')}}'></script>
@endsection

