@extends('layouts.app')
@section('content')
@include('components.alertas')
@section('admi', 'active')
@section('breadcrumb')       
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.index') }}" class="rutas"><small>Asignación de unidades</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Asignación</small></a></span></li>            
@endsection


{{-- paso 2 --}}
<div class="container-fluid  mt-5">


    <div class="d-block d-md-none label">Documentación - 2</div>
    <div class="card shadow-md border-gray-100 border-0 p-2">
        <div class="card-header">
            @include('components.administracion.detalleArrendamiento', [
            'arrendamiento' => $asignacionUnidade,
            ])
        </div>
        <fieldset class="card-body" {{$asignacionUnidade->etapa==4?'disabled':''}}>

            <form id='form2' action='{{Route("store2",$asignacionUnidade->id_asignacion_unidad)}}' method='POST' onsubmit='validateForm(this)' class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <h6 class="title-orange m-0">Placas</h6>

                <div class="row">

                    <div class="col-md-3 mt-4">
                        <div class="form-group">
                            <label for="placas"><b>Placas:</b><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" pattern="[\w\-]+" maxlength="25" id="placas" name='placas' onblur="terminacion(this.value)" value="{{old('placas') ?? $asignacionUnidade->placas}}" required>
                            @error('placas')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                Las placas son invalidas
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="terminacion_placas">Terminación de placas:</label>
                                    <input type="text" class="form-control" id="terminacion_placas" name='terminacion_placas' value="{{old('terminacion_placas') ?? $asignacionUnidade->terminacion_placas}}" readonly>
                                    @error('terminacion_placas')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="primer_semestre">Primer semestre:</label>
                                    <input type="text" class="form-control" id="primer_semestre" name='primer_semestre' value="{{ucwords(strtolower(old('primer_semestre') ?? $asignacionUnidade->primer_semestre))}}" readonly>
                                    @error('primer_semestre')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="segundo_semestre">Segundo semestre:</label>
                                    <input type="text" class="form-control" id="segundo_semestre" name='segundo_semestre' value="{{ucwords(strtolower(old('segundo_semestre') ?? $asignacionUnidade->segundo_semestre))}}" readonly>
                                    @error('segundo_semestre')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="cambio_laminas"><b>Cambio de láminas:</b><span class="text-danger">*</span></label>
                            <select class="form-select" id="cambio_laminas" name='cambio_laminas' required>
                                <option value="" selected hidden>Seleccionar</option>
                                <option disabled>Seleccionar</option>
                                <option value='1' {{(old('cambio_laminas') ?? $asignacionUnidade->cambio_laminas)=='1'?'selected':''}}>Si</option>
                                <option value='0' {{(old('cambio_laminas') ?? $asignacionUnidade->cambio_laminas)=='0'?'selected':''}}>No</option>
                            </select>
                            @error('cambio_laminas')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                El cambio de laminas es invalido
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="reposicion_laminas"><b>Reposición de láminas:</b><span class="text-danger">*</span></label>
                            <select class="form-select" id="reposicion_laminas" name='reposicion_laminas' required>
                                <option value="" selected hidden>Seleccionar</option>
                                <option disabled>Seleccionar</option>
                                <option value='1' {{(old('reposicion_laminas') ?? $asignacionUnidade->reposicion_laminas)=='1'?'selected':''}}>Si</option>
                                <option value='0' {{(old('reposicion_laminas') ?? $asignacionUnidade->reposicion_laminas)=='0'?'selected':''}}>No</option>
                            </select>
                            @error('reposicion_laminas')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                La reposición de láminas es invalido
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="a_alta_placas">Formato de alta de placas:</label>
                            <div class="input-group mb-3">
                                @isset($asignacionUnidade->a_alta_placas)
                                <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                    <a style='color: white;' href="{{ asset('storage/'.$asignacionUnidade->a_alta_placas) }}" target="_blank">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </span>
                                @endisset
                                <input type="file" accept=".pdf" class="input-archivo-down input-archivo" id="a_alta_placas" name='a_alta_placas'>
                            </div>
                            @error('a_alta_placas')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>


                <h6 class="title-orange m-0">Documentos SCT</h6>

                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <div>
                                <label for="a_derechos_vehiculares">Comprobante pago derechos vehiculares:</label>
                            </div>
                            <div class="input-group mb-3">
                                @isset($asignacionUnidade->a_derechos_vehiculares)
                                <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                    <a style='color: white;' href="{{ asset('storage/'.$asignacionUnidade->a_derechos_vehiculares) }}" target="_blank">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </span>
                                @endisset
                                <input type="file" accept=".pdf" class="input-archivo-down input-archivo " id="a_derechos_vehiculares" name='a_derechos_vehiculares'>
                            </div>
                            @error('a_derechos_vehiculares')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="a_tarjeta_circulacion">Tarjeta de circulación:</label>
                            <div class="input-group mb-3">
                                @isset($asignacionUnidade->a_tarjeta_circulacion)
                                <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                    <a style='color: white;' href="{{ asset('storage/'.$asignacionUnidade->a_tarjeta_circulacion) }}" target="_blank">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </span>
                                @endisset
                                <input type="file" accept=".pdf" class="input-archivo-down input-archivo" id="a_tarjeta_circulacion" name='a_tarjeta_circulacion'>
                            </div>
                            @error('a_tarjeta_circulacion')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="cambio_tarjeta_circulacion"><b>Cambio o reposición de tarjeta de circulación:</b><span class="text-danger">*</span></label>
                            <select class="form-select" id="cambio_tarjeta_circulacion" name='cambio_tarjeta_circulacion' required>
                                <option value="" selected hidden>Seleccionar</option>
                                <option disabled>Seleccionar</option>
                                <option value='1' {{(old('cambio_tarjeta_circulacion') ?? $asignacionUnidade->cambio_tarjeta_circulacion)=='1'?'selected':''}}>Si</option>
                                <option value='0' {{(old('cambio_tarjeta_circulacion') ?? $asignacionUnidade->cambio_tarjeta_circulacion)=='0'?'selected':''}}>No</option>
                            </select>
                            @error('cambio_tarjeta_circulacion')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                El campo es invalido
                            </div>
                        </div>
                    </div>
                </div>
                @if($asignacionUnidade->etapa!==4)
                <div class="d-flex justify-content-center gap-4 mt-4">
                    <x-btn-regresar link='asignacionUnidades.index' text='Anterior' />
                    <x-btn-enviar text='Guardar'/>
                    <x-btn-regresar link='asignacionUnidades.show' params='{{$asignacionUnidade->id_cliente}}' text='Salir' />
                </div>
                @endif
            </form>

        </fieldset>


        @if($asignacionUnidade->etapa==4)
        <div class="d-flex justify-content-center gap-4 mb-4">
            <x-btn-regresar link='asignacionUnidades.show' params='{{$asignacionUnidade->id_cliente}}' text='Salir' />
            <x-btn-regresar link='step3' params='{{$asignacionUnidade->id_asignacion_unidad}}' text='Siguiente' />
        </div>
        @endif
    </div>
</div>

<script src='{{asset('js/asignacionUnidad/validForm.js')}}'></script>
<script src='{{asset('js/asignacionUnidad/step2.js')}}'></script>
<script src='{{asset('js/input-file.js')}}'></script>

@endsection
