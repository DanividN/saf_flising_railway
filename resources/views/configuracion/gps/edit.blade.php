@extends('layouts.app')

@section('configuracion', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Configuración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{ route('gps.index')}}"  class="rutas"><small>GPS</small></a></span></li>
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Editar registro de GPS</small></span></li>
@endsection

@section('content')
<div class="container-fluid mt-5">

    <div class="titulo-responsive mb-0">
        <label><a>Editar GPS</a></label>
    </div>

    <form action="{{ url('/configuracion/gps/'.$gps->id_gps) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <h5 class="title-orange">GPS</h5>
                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="razonSocial" class="form-label"><b>Raz&oacute;n Social</b></label>
                        <input type="text" class="form-control" name="razon_gps" id="razonSocial" value="{{$gps->razon_gps}}" placeholder="Razón Social" @if($existe) readonly @endif>
                        @error('razon_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreComercial" class="form-label"><b>Nombre comercial</b></label>
                        <input type="text" class="form-control" name="nombre_gps" id="nombreComercial" value="{{$gps->nombre_gps}}" placeholder="Nombre Comercial" @if($existe) readonly @endif>
                        @error('nombre_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror

                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefono" class="form-label"><b>Tel&eacute;fono</b></label>
                        <input type="text" class="form-control tel-input" maxlength="10" name="telefono_gps" id="telefono" value="{{$gps->telefono_gps}}" placeholder="1234567890" required>
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
                        <input type="text" class="form-control" maxlength="13" name="rfc_gps" id="rfc" value="{{$gps->rfc_gps}}"  placeholder="XAXX010101000" @if($existe) readonly @endif>
                        @error('rfc_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto" class="form-label"><b>Correo contacto</b></label>
                        <input type="email" class="form-control" name="correo_gps" id="correoContacto" value="{{$gps->correo_gps}}" placeholder="empresa@email.com" oninput="validarEmail(event)" required>
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
                        <input type="text" class="form-control" name="calle_gps" id="calle" value="{{$gps->calle_gps}}" placeholder="Nombre de la calle" required>
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
                        <input type="number" class="form-control" name="n_exterior_gps" id="numExterior" value="{{$gps->n_exterior_gps}}" placeholder="No. exterior" required>
                        @error('n_exterior_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="colonia" class="form-label"><b>Colonia</b></label>
                        <input type="text" class="form-control" name="colonia_gps" id="colonia" value="{{$gps->colonia_gps}}" placeholder="Colonia" required>
                        @error('colonia_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="estado" class="form-label"><b>Entidad federativa</b></label>
                        <select name="" id="estado" class="form-select" placeholder="Entidad federativa" required>
                            @foreach ($municipios as $municipio)
                                @foreach ($entidades_federativas as $entidad)
                                    @if($municipio->id_municipio == $gps->id_municipio)
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
                        <label for="municipio" class="form-label"><b>Municipio / Alcaldía</b></label>
                        <select name="id_municipio" id="municipio" class="form-select single-select-field" placeholder="Municipio / Alcaldia" required>
                            @foreach ($municipios as $municipio)
                                @if($municipio->id_entidad_federativa == $gps->municipio->id_entidad_federativa)
                                    <option value="{{ $municipio->id_municipio }}"
                                        @if($municipio->id_municipio == $gps->id_municipio) selected @endif>
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
                        <label for="cp" class="form-label"><b>C.P.</b></label>
                        <input type="text" maxlength="5" class="form-control cp" name="cp_gps" id="cp" value="{{$gps->cp_gps}}" placeholder="00000" required>
                        @error('cp_gps')
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

                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <label for="cp" class="form-label"><b>Observaciones</b></label>
                        <textarea class="form-control" name="observacion_gps" id="" cols="5" rows="5" @if($existe) readonly @endif>{{$gps->observacion_gps}}</textarea>
                        @error('observacion_gps')
                            <b class="invalid_field">
                                {{ $message }}
                            </b>
                        @enderror
                    </div>
                </div>

                <hr>

                <h5 class="title-orange">Registro de Contactos</h5>

                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="nombreContato1" class="form-label"><b>Nombre</b></label>
                        <input type="text" class="form-control" name="nombre_contacto[]" id="nombreContato1" @if(isset($contactos[0]->nombre_contacto)) value="{{$contactos[0]->nombre_contacto}}" @endif placeholder="Nombre de contacto" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="telefonoContacto1" class="form-label"><b>N&uacute;mero de contacto</b></label>
                        <input type="text" class="form-control tel-input" maxlength="10" name="numero_contacto[]" id="telefonoContacto1" @if(isset($contactos[0]->numero_contacto)) value="{{$contactos[0]->numero_contacto}}" @endif placeholder="1234567890" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="correoContacto1" class="form-label"><b>Correo de contacto</b></label>
                        <input type="email" class="form-control" name="correo_contacto[]" id="correoContacto1"  @if(isset($contactos[0]->correo_contacto)) value="{{$contactos[0]->correo_contacto}}" @endif placeholder="empresa@email.com" required oninput="validarEmail(event)">
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
                        <input type="text" class="form-control" name="nombre_contacto[]" id="nombreContato3" @if(isset($contactos[2]->nombre_contacto)) value="{{$contactos[2]->nombre_contacto}}" @endif placeholder="Nombre de contacto">
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
                    <a href="{{route('gps.index')}}" class="btn btn-regresar">Regresar</a>
                    <button type="submit" class="btn btn-enviar">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src='{{asset('js/gps/municipiosEdit.js')}}'></script>
<script src='{{asset('js/validacionCampos.js')}}'></script>
@endsection

