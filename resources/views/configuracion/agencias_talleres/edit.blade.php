@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap" type="text/javascript"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/agencias_talleres.js') }}"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/maps.google_edit.js') }}"></script>
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
@endsection
@section('content')
    <div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header contacto_registro">
                    Agencia / Taller
                </div>
                <form action="{{ route('agencias_talleres/update',$proveedor[0]->id_proveedor) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            {{--  Tipo y Servicios  --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label><b>Tipo <span class="require">*</span></b></label>
                                    <select name="tipo" class="single-select-field" id="type_service" required>
                                        <option value="" hidden>Seleccionar</option>
                                        <option value="AGENCIA" @if($proveedor[0]->tipo == 'AGENCIA') selected @endif>Agencia</option>
                                        <option value="TALLER"  @if($proveedor[0]->tipo == 'TALLER') selected @endif>Taller</option>
                                    </select>
                                    @error('tipo')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div>  
                                <div class="col-md-4" id="services_div">
                                    <label><b>Servicios <span class="require">*</span></b></label>
                                    <select name="servicios" class="single-select-field" id="servicios" required>
                                        <option value="" hidden>Seleccionar</option>
                                        <option value="VENTA" @if($proveedor[0]->servicios == 'VENTA') selected @endif>Venta</option>
                                        <option value="MANTENIMIENTO" @if($proveedor[0]->servicios == 'MANTENIMIENTO') selected @endif>Mantenimiento</option>
                                        <option value="AMBOS" @if($proveedor[0]->servicios == 'AMBOS') selected @endif>Ambos</option>
                                    </select>
                                    @error('servicios')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4" id="mantenimiento" hidden>
                                    <label><b>Servicios <span class="require">*</span></b></label>
                                    <input type="text" id="mantenimiento_service" name="servicios" class="form-control" value="MANTENIMIENTO" readonly>
                                </div>
                            </div>
                            {{--  Razon, Nombre y Teléfono  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>Raz&oacute;n Social <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" value="{{ $proveedor[0]->razon_social }}" name="razon_social" required>
                                    @error('razon_social')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Nombre Comercial <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" value="{{ $proveedor[0]->nombre_comercial }}" required>
                                    @error('nombre_comercial')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Tel&eacute;fono <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" maxlength="10" name="telefono_proveedor" value="{{ $proveedor[0]->telefono_proveedor }}" required>
                                    @error('telefono_proveedor')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            {{--  RFC, Correo contacto, Calle  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>RFC <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" maxlength="13" name="rfc_proveedor" value="{{ $proveedor[0]->rfc_proveedor }}" required>
                                    @error('rfc_proveedor')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Correo de contacto <span class="require">*</span></b></label>
                                    <input type="email" class="form-control" name="correo_proveedor" placeholder="agencia@email.com" value="{{ $proveedor[0]->correo_proveedor }}" required>
                                    @error('correo_proveedor')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Calle <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" name="calle_proveedor" value="{{ $proveedor[0]->calle_proveedor }}" required>
                                    @error('calle_proveedor')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div>
                            </div>
                            {{--  No. exterior, colonia, entidad  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>No. exterior <span class="require">*</span></b></label>
                                    <input type="number" class="form-control" name="n_exterior" value="{{ $proveedor[0]->n_exterior }}" required>
                                    @error('n_exterior')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Colonia <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" name="colonia" value="{{ $proveedor[0]->colonia }}" required>
                                    @error('colonia')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Entidad federativa <span class="require">*</span></b></label>
                                    <select id="entidad_id" class="single-select-field" required>
                                        <option value="" hidden>Seleccionar</option>
                                        @foreach ($entidades as $entidad)
                                            @php
                                                $select = '';
                                            @endphp          
                                            @if ($entidad->id_entidad_federativa == $proveedor[0]->municipios->id_entidad_federativa)
                                                @php
                                                    $select = 'selected';
                                                @endphp
                                            @endif                              
                                            <option value="{{$entidad->id_entidad_federativa }}" {{ $select }}>{{ $entidad->nombre_entidad_federativa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--  Municipio / Alcaldia  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>Municipio <span class="require">*</span></b></label>
                                    <select name="id_municipio" id="id_municipio" class="single-select-field" required>
                                        @foreach ($municipios as $municipio)
                                            @if ($municipio->id_entidad_federativa == $proveedor[0]->municipios->id_entidad_federativa)
                                                @php
                                                    $select = '';
                                                @endphp          
                                                @if ($municipio->id_municipio == $proveedor[0]->id_municipio)
                                                    @php
                                                        $select = 'selected';
                                                    @endphp
                                                @endif                              
                                                <option value="{{$municipio->id_municipio }}" {{ $select }}>{{ $municipio->nombre_municipio }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_municipio')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div>  
                                <div class="col-md-4">  
                                    <label><b>C.P <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" name="cp_proveedor" value="{{ $proveedor[0]->cp_proveedor }}" required>
                                    @error('cp_proveedor')
                                        <b class="invalid_field">{{ $message }}</b>
                                    @enderror
                                </div> 
                            </div>
                        </div>
                        <hr class="rounded">
                        {{--  Registro de contactos  --}}
                        <label class="contacto_registro">Registro de contactos</label>
                        <div class="col-md-12 mt-2">
                            @if ($count == 1)
                                @foreach ($proveedor[0]->contactos as $contacto)
                                    {{--  Contactos  --}}
                                    <div class="row mt-2">
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Nombre</b></label>
                                            <input type="text" name="nombre_contacto[]" class="form-control" value="{{ $contacto->nombre_contacto }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>N&uacute;mero de contacto</b></label>
                                            <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" maxlength="10" onkeypress="return valideKey(event);" value="{{ $contacto->numero_contacto }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Correo de contacto</b></label>
                                            <input type="email" name="correo_contacto[]" class="form-control" value="{{ $contacto->correo_contacto }}" required>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-2">
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Nombre</b></label>
                                        <input type="text" name="nombre_contacto[]" class="form-control" placeholder="Nombre de contacto">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>N&uacute;mero de contacto</b></label>
                                        <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" maxlength="10" onkeypress="return valideKey(event);">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" name="correo_contacto[]" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Nombre</b></label>
                                        <input type="text" name="nombre_contacto[]" class="form-control" placeholder="Nombre de contacto">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>N&uacute;mero de contacto</b></label>
                                        <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" maxlength="10" onkeypress="return valideKey(event);">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" name="correo_contacto[]" class="form-control" placeholder="correo@email.com">
                                    </div>
                                </div>
                            @endif
                            @if ($count == 2)
                                @foreach ($proveedor[0]->contactos as $contacto)
                                    {{--  Contactos  --}}
                                    <div class="row mt-2">
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Nombre</b></label>
                                            <input type="text" name="nombre_contacto[]" class="form-control" value="{{ $contacto->nombre_contacto }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>N&uacute;mero de contacto</b></label>
                                            <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" maxlength="10" onkeypress="return valideKey(event);" required value="{{ $contacto->numero_contacto }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Correo de contacto</b></label>
                                            <input type="email" name="correo_contacto[]" class="form-control" value="{{ $contacto->correo_contacto }}" required>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-2">
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Nombre</b></label>
                                        <input type="text" name="nombre_contacto[]" class="form-control" placeholder="Nombre de contacto">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>N&uacute;mero de contacto</b></label>
                                        <input type="text" name="numero_contacto[]" class="form-control" maxlength="10" onkeypress="return valideKey(event);" placeholder="1234567890">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" name="correo_contacto[]" class="form-control" placeholder="correo@email.com">
                                    </div>
                                </div>
                            @endif
                            @if ($count == 3)
                                @foreach ($proveedor[0]->contactos as $contacto)
                                    {{--  Contactos  --}}
                                    <div class="row mt-2">
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Nombre</b></label>
                                            <input type="text" name="nombre_contacto[]" class="form-control" value="{{ $contacto->nombre_contacto }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>N&uacute;mero de contacto</b></label>
                                            <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" maxlength="10" onkeypress="return valideKey(event);" required value="{{ $contacto->numero_contacto }}" required>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Correo de contacto</b></label>
                                            <input type="email" name="correo_contacto[]" class="form-control" value="{{ $contacto->correo_contacto }}" required>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <hr class="rounded">
                        <label class="contacto_registro">Direcci&oacute;n</label>
                        <div class="input-group mb-3 mt-3">
                            <input type="text" name="direccion_proveedor" id="location" class="form-control" value="{{ $proveedor[0]->direccion_proveedor }}" required>
                            <button class="btn btn-outline-secondary" type="button" id="location_search" onclick="getNameDirection()">Buscar</button>
                            @error('direccion_proveedor')
                                <b class="invalid_field">{{ $message }}</b>
                            @enderror
                        </div>
                        <div class="row mt-3" hidden>
                            <div class="col-md-6">
                                <label for="latitud"><strong>Latitud: <span class="require">*</span></strong></label>
                                <input type="text" name="cx" class="form-control" id="latitud" value="{{ $proveedor[0]->cx }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="longitud"><strong>Longitud: <span class="require">*</span></strong></label>
                                <input type="text" name="cy" class="form-control" id="longitud" value="{{ $proveedor[0]->cy }}" required>
                            </div>
                        </div>
                        {{--  Google Maps  --}}
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mt-3">
                                <input type="text" class="form-control" id="name_com" value="{{ $proveedor[0]->nombre_comercial }}" required>
                                <textarea rows="5" id="direccion_a" class="form-control mt-1" required>{{ $proveedor[0]->direccion_proveedor }}</textarea>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div id="map" class="mt-3"></div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <a href="{{ url('configuracion/agencias_talleres/ver/'.$proveedor[0]->id_proveedor) }}" class="btn regresar">Regresar</a>
                            <button class="btn guardar" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#entidad_id").on('change', function(){
            var id_estado = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ url('configuracion/agencias_talleres/agencias_talleres_municipios') }}",
                data: {
                    id_estado: id_estado
                },
                success: function(data){
                    var option = "<option value='' hidden>Seleccionar:</option>";
                    for(var i = 0; i < data.length; i++){
                        option += '<option value="' + data[i].id_municipio + '">' + data[i].nombre_municipio + '</option>';
                    }
                    $("#id_municipio").empty().html(option);
                }
            })
        });
        $("#type_service").on('change', function(){
            var tipo = $(this).val();
            if(tipo == 'AGENCIA'){
                $("#services_div").attr('hidden', false);
                $("#servicios").attr('required', true);
                $("#mantenimiento").attr('hidden', true);
                $("#mantenimiento_service").attr('required', false);
            }else if(tipo == 'TALLER'){
                $("#services_div").attr('hidden', true);
                $("#servicios").attr('required', false);
                $("#mantenimiento").attr('hidden', false);
                $("#mantenimiento_service").attr('required', true);
            }
        });
    </script>
@endsection