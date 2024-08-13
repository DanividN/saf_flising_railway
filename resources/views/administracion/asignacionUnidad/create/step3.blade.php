@extends('layouts.app')
@section('content')
@include('components.alertas')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
<script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
<script defer src="{{ asset('js/select2.js') }}"></script>
@endsection

<style>
    .trashed:hover {
        fill: black;
    }

</style>
@section('admi', 'active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.index') }}" class="rutas"><small>Asignación de unidades</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Asignación</small></a></span></li>
@endsection


{{-- paso 3 --}}
<div class="container-fluid  mt-5">

    <div class="d-block d-md-none label">Garantías - 3</div>
    <div class="card shadow-md border-gray-100 border-0 p-2">
        <div class="card-header">
            @include('components.administracion.detalleArrendamiento', [
            'arrendamiento' => $asignacionUnidade,
            ])
        </div>

        <fieldset class="card-body" {{$asignacionUnidade->etapa==4?'disabled':''}}>

            <h6 class="title-orange m-0">Garantías de agencia</h6>
            <div class="row">

                <div class="col-md-3 mt-4">
                    <div class="form-group">
                        <label for="Garantia"><b>Garantía:</b><span class="text-danger">*</span></label>
                        <select class="form-select" id="Garantia" name='Garantia' onchange="setGarantias(this.value)">
                            <option disabled>Seleccionar</option>
                            <option value='1'>Si</option>
                            <option value='0'>No</option>
                        </select><br>
                        @error('Garantia')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div id='formAgencias' class="col-md-9 mt-4">
                    <form class="row needs-validation" action='javascript:void(0)' onsubmit="agregar()" novalidate>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Agencia"><b>Agencia:</b><span class="text-danger">*</span></label>
                                <select class="single-select-field" id="Agencia" name='Agencia' onchange='getGarantias(this.value)' required {{$asignacionUnidade->etapa==4?'disabled':''}}>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option disabled>Seleccionar agencia</option>
                                    @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id_proveedor }}" {{old('plazo_arrendamiento') == $proveedor->id_proveedor ?'selected':''}}>{{ $proveedor->nombre_comercial }}</option>
                                    @endforeach
                                </select><br>
                                @error('Agencia')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Tipo_garantia"><b>Tipo de garantía:</b><span class="text-danger">*</span></label>
                                <select class="single-select-field" id="Tipo_garantia" name='Tipo_garantia' {{$asignacionUnidade->etapa==4?'disabled':''}}>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option disabled>Seleccionar</option>
                                </select><br>
                                @error('Tipo_garantia')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 d-flex justify-content-center gap-4 mt-4">
                            <div class="form-group">
                                <x-btn-enviar text='Agregar' />
                            </div>
                        </div>

                    </form>
                </div>


                <div id='tableAgencias' class="table-responsive mt-4">
                    <table class="table text-center" id="table" name='garantiasAsignadas'>
                        <thead>
                            <tr>
                                <th class='text-center'>No.</th>
                                <th class='text-center'>Garantía extendida</th>
                                <th class='text-center'>Vigencia</th>
                                <th class='text-center'>Garantía</th>
                                @if($asignacionUnidade->etapa!=4)
                                <th class='text-center'>Acción</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id='tablaGarantias'>
                            <?php $count=0; ?>
                            @foreach($garantias as $garantia)
                            <tr id='{{$garantia->garantiaProveedor->id_garantia_proveedor}}'>
                                <?php $count++; ?>
                                <td>{{$count}}</td>
                                <td>{{$garantia->garantiaProveedor->nombre_g_proveedor}}</td>
                                <td>{{$garantia->garantiaProveedor->vigencia_g_proveedor}}</td>
                                <td><a href="{{ asset('storage/'.$garantia->garantiaProveedor->a_g_evidencia) }}" target="_blank">
                                        <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf" width="23px">
                                    </a></td>
                                @if($asignacionUnidade->etapa!=4)
                                <td>
                                    <a type='button' onclick='remove(this,{{$garantia->garantiaProveedor->id_garantia_proveedor}})' target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="red" class="bi bi-trash trashed" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @error('garantiasAsignadas')
                    <div class='text-danger my-2'>
                        El campo garantias debe contener alguna garantia
                    </div>
                    @enderror

                    <div id='tableError' class='text-danger my-2' hidden>
                        El campo garantias debe contener alguna garantia
                    </div>
                </div>
            </div>

            <form id='form3' action='{{Route("store3",$asignacionUnidade->id_asignacion_unidad)}}' method='POST' novalidate>
                @csrf
                <input id="registro" name='registro' value="true" hidden readonly>
                <input id="garantiasAsignadas" name='garantiasAsignadas' value="[]" hidden readonly>
                @if($asignacionUnidade->etapa!==4)
                <div class="d-flex justify-content-center gap-4 mt-4">
                    <x-btn-regresar link='step2' params='{{$asignacionUnidade->id_asignacion_unidad}}' text='Anterior' />
                    <input type='button' class="btn-enviar" onclick="validarFormulario()" value='Guardar'>
                    <x-btn-regresar link='asignacionUnidades.show' params='{{$asignacionUnidade->id_cliente}}' text='Salir' />
                </div>
                @endif
            </form>

        </fieldset>

        @if($asignacionUnidade->etapa==4)
        <div class="d-flex justify-content-center gap-4 mb-4">
            <x-btn-regresar link='step2' params='{{$asignacionUnidade->id_asignacion_unidad}}' text='Anterior' />
            <x-btn-regresar link='step4' params='{{$asignacionUnidade->id_asignacion_unidad}}' text='Siguiente' />
        </div>
        @endif
    </div>
</div>
<script>
    const ruta = "{{asset('storage/')}}";
    const etapa = "{{$asignacionUnidade->etapa}}";

</script>
<script src='{{asset('js/asignacionUnidad/step3.js')}}'></script>

@endsection
