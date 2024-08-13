@extends('layouts.app')
@section('scripts')
    <script src='{{ asset('js/input-file.js') }}'></script>
    <script src="{{ asset('js/configuracion/cliente/create.js') }}"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap"
        type="text/javascript"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/maps.google.js') }}"></script>
@endsection
@section('configuracion', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href=""
                class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('clientes.index') }}"
                class="rutas"><small>Registro de clientes</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Editar
                    cliente</small></a></span></li>
@endsection
@section('content')
    <div class="titulo-responsive mb-0">
        <label><a>Editar Cliente:</a></label>
    </div>
    <div class="card shadow-md border-0 mt-5 p-2">
        <div class="card-body">
            <div class="row">
                <form id="formulario">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="tipo_cliente" class="form-label"><b>Tipo Cliente</b></label>
                                <select class="menu" name="tipo_cliente" id="tipo_cliente" disabled>
                                        <option> {{ $cliente->tipo_cliente }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label class="form-label" for="nombre_cliente"><b>Nombre
                                        cliente/Área/Dependencia</b></label>
                                <input class="form-control" type="text" name="nombre_cliente"
                                    placeholder="Nombre de cliente" id="nombre_cliente"
                                    value="{{ $cliente->nombre_cliente }}" pattern="[A-Za-zÀ-ÖØ-öø-ÿñÑ\s]{1,}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="rfc" class="form-label"><b>RFC</b></label>
                                <input type="text" class="form-control" name="rfc" placeholder="XAXX0101101000"
                                    id="rfc" value="{{ $cliente->rfc }}" maxlength="13"
                                    style="text-transform: uppercase" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="calle" class="form-label"><b>Calle</b></label>
                                <input type="text" class="form-control" name="calle" placeholder="Nombre de la calle"
                                    id="calle" value="{{ $cliente->calle }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <label for="n_exterior" class="form-label"><b>No. exterior</b></label>
                                <input type="text" class="form-control" name="n_exterior" placeholder="Número exterior"
                                    id="n_exterior" value="{{ $cliente->n_exterior }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <label for="n_interior" class="form-label"><b>No. interior</b></label>
                                <input type="text" class="form-control" name="n_interior" placeholder="Número interior"
                                    id="n_interior" value="{{ $cliente->n_interior }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="entidad" class="form-label"><b>Entidad federativa</b></label>
                                <select class="menu" name="" id="entidad_id" disabled>
                                        <option value="{{ $entidad_federativa->id_entidad_federativa }}">{{ $entidad_federativa->nombre_entidad_federativa }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="municipio"><b>Municipio / Alcaldía</b></label>
                                <select name="id_municipio" class="menu" id="id_municipio" disabled>
                                    <option value="{{ $municipios->id_municipio }}" hidden>{{ $municipios->nombre_municipio }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="codigo" class="form-label"><b>Código postal</b></label>
                                <input type="text" class="form-control" name="codigo_postal" id="codigo"
                                    placeholder="00000" value="{{ $cliente->codigo_postal }}" maxlength="5" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="area" class="form-label"><b>Titular del área</b></label>
                                <input type="text" class="form-control" name="nombre_representante" id="area"
                                    placeholder="Nombre del titular" value="{{ $cliente->nombre_representante }}"
                                    pattern="[A-Za-zÀ-ÖØ-öø-ÿñÑ\s]{1,}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="correo" class="form-label"><b>Correo del titular del área</b></label>
                                <input type="email" class="form-control" name="correo_representante" id="correo"
                                    placeholder="correo@email.com" value="{{ $cliente->correo_representante }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="telefono" class="form-label"><b>Telefono celular u oficina</b></label>
                                <input type="text" class="form-control" name="telefono_cliente" id="telefono"
                                    placeholder="7220001111" value="{{ $cliente->telefono_cliente }}" maxlength="10"  pattern="[0-9]{10}"disabled>
                                    <div class="invalid-feedback">
                                        El número de teléfono debe contener exactamente 10 dígitos.
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="ine" class="form-label"><b>INE</b></label>
                                <div class="input-group">
                                    @if (isset($cliente->a_identificacion))
                                        <a href="{{ url('storage/' . $cliente->a_identificacion) }}" target="_blank"
                                            class="input-download-link">
                                            <span class="input-group-text icono-download"><i
                                                    class="bi bi-download"></i></span>
                                        </a>
                                    @endif
                                    <input type="file" name="a_identificacion" class="input-archivo-down"
                                        id="archivo-input-down{{ $cliente->id_cliente }}"
                                        data-id="{{ $cliente->id_cliente }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="situacion_fiscal" class="form-label"><b>Constancia de situación
                                        físcal</b></label>
                                <div class="input-group">
                                    @if (isset($cliente->a_situacion_fiscal))
                                        <a href="{{ url('storage/' . $cliente->a_situacion_fiscal) }}" target="_blank"
                                            class="input-download-link">
                                            <span class="input-group-text icono-download"><i
                                                    class="bi bi-download"></i></span>
                                        </a>
                                    @endif
                                    <input type="file" name="a_situacion_fiscal" class="input-archivo-down"
                                        id="archivo-input-down{{ $cliente->id_cliente }}"
                                        data-id="{{ $cliente->id_cliente }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="comprobante" class="form-label"><b>Comprobante de domicilio</b></label>
                                <div class="input-group">
                                    @if (isset($cliente->a_comprobante_domicilio))
                                        <a href="{{ url('storage/' . $cliente->a_comprobante_domicilio) }}" target="_blank"
                                            class="input-download-link">
                                            <span class="input-group-text icono-download"><i
                                                    class="bi bi-download"></i></span>
                                        </a>
                                    @endif
                                    <input type="file" name="a_comprobante_domicilio" class="input-archivo-down"
                                        id="archivo-input-down{{ $cliente->id_cliente }}"
                                        data-id="{{ $cliente->id_cliente }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <div class="mb-3 mt-3">
                                <label class="contacto_registro">Direcci&oacute;n</label>
                                <div class="input-group">
                                    <input type="text" name="direccion_cliente" id="location" class="form-control"
                                        placeholder="Introducir direcci&oacute;n completa"
                                        value="{{ $cliente->direccion_cliente }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3" hidden>
                            <div class="col-md-6">
                                <label for="latitud"><strong>Latitud: <span class="require">*</span></strong></label>
                                <input type="text" name="cx" class="form-control" id="latitud" readonly
                                    placeholder="Latitud" value="{{ $cliente->cx }}">
                            </div>
                            <div class="col-md-6">
                                <label for="longitud"><strong>Longitud: <span class="require">*</span></strong></label>
                                <input type="text" name="cy" class="form-control" id="longitud" readonly
                                    placeholder="Longitud" value="{{ $cliente->cy }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mt-3">
                            <input type="text" class="form-control" id="name_com"
                                value="{{ $cliente->nombre_cliente }}" readonly>
                            <textarea rows="5" id="direccion_a" class="form-control mt-1" readonly>{{ $cliente->direccion_cliente }}</textarea>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div id="map" class="mt-3" style="width: 100%; height:400px;"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a href="{{ route('clientes.index') }}" class="btn regresar">Regresar</a>
                        <a href="{{ route('clientes.edit',$cliente) }}" class="btn add_agencia">Editar</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
