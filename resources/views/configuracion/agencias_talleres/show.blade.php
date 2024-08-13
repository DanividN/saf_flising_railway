@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap" type="text/javascript"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/agencias_talleres.js') }}"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/maps.google_edit.js') }}"></script>
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
@endsection
@section('content')
    <div>
        <div class="col-md-12">
            <div class="titulo-responsive mb-0">
                <label><a>Agregar agencia o taller</a></label>
            </div>
            <div class="card mt-5">
                <div class="contacto_registro">
                    &nbsp; &nbsp; <label>Agencia / Taller</label>
                </div>

                <form action="" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            {{--  Tipo y Servicios  --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label><b>Tipo <span class="require">*</span></b></label>
                                    <select name="tipo" class="single-select-field" disabled>
                                        <option value="" hidden>Seleccionar</option>
                                        <option value="AGENCIA" @if($proveedor[0]->tipo == 'AGENCIA') selected @endif>Agencia</option>
                                        <option value="TALLER"  @if($proveedor[0]->tipo == 'TALLER') selected @endif>Taller</option>
                                    </select>
                                </div>  
                                <div class="col-md-4">
                                    <label><b>Servicios <span class="require">*</span></b></label>
                                    <select name="servicios" class="single-select-field" disabled>
                                        <option value="" hidden>Seleccionar</option>
                                        <option value="VENTA" @if($proveedor[0]->servicios == 'VENTA') selected @endif>Venta</option>
                                        <option value="MANTENIMIENTO" @if($proveedor[0]->servicios == 'MANTENIMIENTO') selected @endif>Mantenimiento</option>
                                        <option value="AMBOS" @if($proveedor[0]->servicios == 'AMBOS') selected @endif>Ambos</option>
                                    </select>
                                </div> 
                            </div>
                            {{--  Razon, Nombre y Teléfono  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>Raz&oacute;n Social <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" value="{{ $proveedor[0]->razon_social }}" name="razon_social" disabled>
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Nombre Comercial <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" value="{{ $proveedor[0]->nombre_comercial }}" disabled>
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Tel&eacute;fono <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" maxlength="10" name="telefono_proveedor" value="{{ $proveedor[0]->telefono_proveedor }}" disabled>
                                </div>
                            </div>
                            {{--  RFC, Correo contacto, Calle  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>RFC <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" maxlength="13" name="rfc_proveedor" value="{{ $proveedor[0]->rfc_proveedor }}" disabled>
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Correo de contacto <span class="require">*</span></b></label>
                                    <input type="email" class="form-control" name="correo_proveedor" placeholder="agencia@email.com" value="{{ $proveedor[0]->correo_proveedor }}" disabled>
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Calle <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" name="calle_proveedor" value="{{ $proveedor[0]->calle_proveedor }}" disabled>
                                </div>
                            </div>
                            {{--  No. exterior, colonia, entidad  --}}
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label><b>No. exterior <span class="require">*</span></b></label>
                                    <input type="number" class="form-control" name="n_exterior" value="{{ $proveedor[0]->n_exterior }}" disabled>
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Colonia <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" name="colonia" value="{{ $proveedor[0]->colonia }}" disabled>
                                </div> 
                                <div class="col-md-4">
                                    <label><b>Entidad federativa <span class="require">*</span></b></label>
                                    <select id="entidad_id" class="single-select-field" disabled>
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
                                    <select name="id_municipio" id="id_municipio" class="single-select-field" disabled>
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
                                </div>  
                                <div class="col-md-4">  
                                    <label><b>C.P <span class="require">*</span></b></label>
                                    <input type="text" class="form-control" name="cp_proveedor" value="{{ $proveedor[0]->cp_proveedor }}" disabled>
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
                                            <input type="text" name="nombre_contacto[]" class="form-control" value="{{ $contacto->nombre_contacto }}" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>N&uacute;mero de contacto</b></label>
                                            <input type="text" name="numero_contacto[]" class="form-control" value="{{ $contacto->numero_contacto }}" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Correo de contacto</b></label>
                                            <input type="email" name="correo_contacto[]" class="form-control" value="{{ $contacto->correo_contacto }}" disabled>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-2">
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Nombre</b></label>
                                        <input type="text" name="nombre_contacto[]" class="form-control" placeholder="Nombre de contacto" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>N&uacute;mero de contacto</b></label>
                                        <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" name="correo_contacto[]" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Nombre</b></label>
                                        <input type="text" name="nombre_contacto[]" class="form-control" placeholder="Nombre de contacto" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>N&uacute;mero de contacto</b></label>
                                        <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" name="correo_contacto[]" class="form-control" placeholder="correo@email.com" disabled>
                                    </div>
                                </div>
                            @endif
                            @if ($count == 2)
                                @foreach ($proveedor[0]->contactos as $contacto)
                                    {{--  Contactos  --}}
                                    <div class="row mt-2">
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Nombre</b></label>
                                            <input type="text" name="nombre_contacto[]" class="form-control" value="{{ $contacto->nombre_contacto }}" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>N&uacute;mero de contacto</b></label>
                                            <input type="text" name="numero_contacto[]" class="form-control" value="{{ $contacto->numero_contacto }}" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Correo de contacto</b></label>
                                            <input type="email" name="correo_contacto[]" class="form-control" value="{{ $contacto->correo_contacto }}" disabled>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-2">
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Nombre</b></label>
                                        <input type="text" name="nombre_contacto[]" class="form-control" placeholder="Nombre de contacto" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>N&uacute;mero de contacto</b></label>
                                        <input type="text" name="numero_contacto[]" class="form-control" placeholder="1234567890" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" name="correo_contacto[]" class="form-control" placeholder="correo@email.com" disabled>
                                    </div>
                                </div>
                            @endif
                            @if ($count == 3)
                                @foreach ($proveedor[0]->contactos as $contacto)
                                    {{--  Contactos  --}}
                                    <div class="row mt-2">
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Nombre</b></label>
                                            <input type="text" name="nombre_contacto[]" class="form-control" value="{{ $contacto->nombre_contacto }}" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>N&uacute;mero de contacto</b></label>
                                            <input type="text" name="numero_contacto[]" class="form-control" value="{{ $contacto->numero_contacto }}" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label><b>Correo de contacto</b></label>
                                            <input type="email" name="correo_contacto[]" class="form-control" value="{{ $contacto->correo_contacto }}" disabled>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <hr class="rounded">
                        <label class="contacto_registro">Direcci&oacute;n</label>
                        <div class="input-group mb-3 mt-3">
                            <input type="text" name="direccion_proveedor" id="location" class="form-control" value="{{ $proveedor[0]->direccion_proveedor }}" disabled>
                            <button class="btn btn-outline-secondary" type="button" id="location_search" onclick="getNameDirection()" disabled>Buscar</button>
                        </div>
                        {{--  <input name="direccion" type="text" id="location" class="form-control" placeholder="Introducir direcci&oacute;n completa" required>     --}}
                        {{--  <div class="col-md-12 text-center mt-2">
                            <input type="button" id="location_search" class="btn btn-outline-primary" value="Buscar">
                        </div>  --}}
                        <div class="row mt-3" hidden>
                            <div class="col-md-6">
                                <label for="latitud"><strong>Latitud: <span class="require">*</span></strong></label>
                                <input type="text" name="cx" class="form-control" id="latitud" value="{{ $proveedor[0]->cx }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="longitud"><strong>Longitud: <span class="require">*</span></strong></label>
                                <input type="text" name="cy" class="form-control" id="longitud" value="{{ $proveedor[0]->cy }}" disabled>
                            </div>
                        </div>
                        {{--  Google Maps  --}}
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mt-3">
                                <input type="text" class="form-control" id="name_com" value="{{ $proveedor[0]->nombre_comercial }}" disabled>
                                <textarea rows="5" id="direccion_a" class="form-control mt-1" disabled>{{ $proveedor[0]->direccion_proveedor }}</textarea>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div id="map" class="mt-3"></div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <a href="{{ route('agencias_talleres/index') }}" class="btn regresar">Regresar</a>
                            <a href="{{ url('configuracion/agencias_talleres/editar/'.$proveedor[0]->id_proveedor) }}" class="btn guardar">Editar</a>
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
        })
    </script>
@endsection