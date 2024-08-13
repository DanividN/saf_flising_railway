@extends('layouts.app')
@section('configuracion', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Configuración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><a href="{{ route('aseguradoras.index')}}"  class="rutas"><small>Aseguradoras</small></a></span></li>
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Información de aseguradora</small></span></li>
@endsection
@section('content')
<div class="container-fluid mt-5">
    <div class="titulo-responsive mb-0">
        <label><a>Lista de aseguradoras</a></label>
    </div>
    <div class="card shadow-md mt-4 border-0 p-2">
        <div class="card-body">
            <h5 class="title-orange">Aseguradora</h5>
            <div class="row mt-3">
                <div class="col-md-4 col-sm-12">
                    <label for="razonSocial" class="form-label"><b>Raz&oacute;n Social</b></label>
                    <input type="text" class="form-control" id="razonSocial" value="{{$aseguradora->razon_aseguradora}}" disabled placeholder="Ingresar razón social">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="nombreComercial" class="form-label"><b>Nombre comercial</b></label>
                    <input type="text" class="form-control" id="nombreComercial" value="{{$aseguradora->nombre_aseguradora}}" disabled placeholder="Nombre comercial">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="telefono" class="form-label"><b>Tel&eacute;fono</b></label>
                    <input type="text" class="form-control tel-input" id="telefono" value="{{$aseguradora->telefono_aseguradora}}" disabled placeholder="1234567890">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 col-sm-12">
                    <label for="rfc" class="form-label"><b>RFC</b></label>
                    <input type="text" class="form-control" id="rfc" value="{{$aseguradora->rfc_aseguradora}}" disabled placeholder="XAXX010101000">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="correoContacto" class="form-label"><b>Correo contacto</b></label>
                    <input type="email" class="form-control" id="correo_aseguradora" value="{{$aseguradora->correo_aseguradora}}" disabled placeholder="empresa@email.com">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="calle" class="form-label"><b>Calle</b></label>
                    <input type="text" class="form-control" id="calle" value="{{$aseguradora->calle_aseguradora}}" disabled placeholder="Nombre de la calle">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 col-sm-12">
                    <label for="numExterior" class="form-label"><b>No. exterior</b></label>
                    <input type="number" class="form-control" id="numExterior" value="{{$aseguradora->n_exterior_aseguradora}}" disabled placeholder="Número exterior">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="colonia" class="form-label"><b>Colonia</b></label>
                    <input type="text" class="form-control" id="colonia" value="{{$aseguradora->colonia_aseguradora}}" disabled placeholder="Nombre de la colonia">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="estado" class="form-label"><b>Entidad federativa</b></label>
                    <select id="estado" class="form-select" disabled>
                        @foreach ($municipios as $municipio)
                            @foreach ($entidades_federativas as $entidad)
                                @if($municipio->id_municipio == $aseguradora->id_municipio)
                                    @if ($entidad->id_entidad_federativa == $municipio->id_entidad_federativa)
                                    <option selected>{{ $entidad->nombre_entidad_federativa }}</option>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <div class="col-md-4 col-sm-12">
                    <label for="municipio" class="form-label"><b>Municipio / Alcaldia</b></label>
                    <select name="id_municipio" id="municipio" class="form-select" disabled>
                        @foreach ($municipios as $municipio)
                            @if($municipio->id_municipio == $aseguradora->id_municipio)
                                <option selected>{{ $municipio->nombre_municipio }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="cp" class="form-label"><b>C.P.</b></label>
                    <input type="text" class="form-control" id="cp" value="{{$aseguradora->cp_aseguradora}}" disabled placeholder="00000">
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
                    <label for="nombreContato1" class="form-label"><b>Nombre</b></label>
                    <input type="text" class="form-control" id="nombreContato1"  @if(isset($contactos[0]->nombre_contacto)) value="{{$contactos[0]->nombre_contacto}}" @endif disabled  placeholder="Nombre de contacto">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="telefonoContacto1" class="form-label"><b>N&uacute;mero de contacto</b></label>
                    <input type="text" class="form-control" id="telefonoContacto1"  @if(isset($contactos[0]->numero_contacto)) value="{{$contactos[0]->numero_contacto}}" @endif disabled placeholder="1234567890">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="correoContacto1" class="form-label"><b>Correo de contacto</b></label>
                    <input type="email" class="form-control" id="correoContacto1" @if(isset($contactos[0]->correo_contacto)) value="{{$contactos[0]->correo_contacto}}" @endif disabled placeholder="contacto@email.com">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 col-sm-12">
                    <label for="nombreContato2" class="form-label"><b>Nombre</b></label>
                    <input type="text" class="form-control" id="nombreContato2" @if(isset($contactos[1]->nombre_contacto)) value="{{$contactos[1]->nombre_contacto}}"  @endif disabled placeholder="Nombre de contacto">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="telefonoContacto2" class="form-label"><b>N&uacute;mero de contacto</b></label>
                    <input type="text" class="form-control" id="telefonoContacto2" @if(isset($contactos[1]->numero_contacto)) value="{{$contactos[1]->numero_contacto}}"  @endif disabled placeholder="1234567890">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="correoContacto2" class="form-label"><b>Correo de contacto</b></label>
                    <input type="email" class="form-control" id="correoContacto2" @if(isset($contactos[1]->correo_contacto)) value="{{$contactos[1]->correo_contacto}}"  @endif disabled placeholder="contacto@email.com">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 col-sm-12">
                    <label for="nombreContato3" class="form-label"><b>Nombre</b></label>
                    <input type="text" class="form-control" id="nombreContato3" @if(isset($contactos[2]->nombre_contacto)) value="{{$contactos[2]->nombre_contacto}}" @endif  disabled placeholder="Nombre de contacto">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="telefonoContacto3" class="form-label"><b>N&uacute;mero de contacto</b></label>
                    <input type="text" class="form-control" id="telefonoContacto3" @if(isset($contactos[2]->numero_contacto)) value="{{$contactos[2]->numero_contacto}}" @endif disabled placeholder="1234567890">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="correoContacto3" class="form-label"><b>Correo de contacto</label>
                    <input type="email" class="form-control" id="correoContacto3"  @if(isset($contactos[2]->correo_contacto)) value="{{$contactos[2]->correo_contacto}}" @endif disabled placeholder="contacto@email.com">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3 gap-3">
                <a href="{{route('aseguradoras.index')}}" class="btn btn-regresar">Regresar</a>
                <a href="{{ route('aseguradoras.edit',$aseguradora->id_aseguradora) }}" class="btn btn-enviar">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
