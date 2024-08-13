@extends('layouts.app')
@section('content')
@include('components.alertas')
@section('admi', 'active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.index') }}" class="rutas"><small>Asignación de unidades</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Asignación</small></a></span></li>
@endsection


{{-- paso 4 --}}

<div class="container-fluid  mt-5">

    <div class="d-block d-md-none label">Check list - 4</div>
    <div class="card shadow-md border-gray-100 border-0 p-2">
        <div class="card-header">
            @include('components.administracion.detalleArrendamiento', [
            'arrendamiento' => $asignacionUnidade,
            ])
        </div>
        <fieldset class="card-body" {{$asignacionUnidade->etapa==4?'disabled':''}}>
            <form id='form4' action='{{Route("store4",$asignacionUnidade->id_asignacion_unidad)}}' method='POST' class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <h6 class="title-orange m-0">Cominicación general a usuarios</h6>

                <div class="row">

                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="politica_uso" class="col-md-6">Políticas de buen uso</label>
                            <input type="checkbox" class="form-check-input col-md-6" id="politica_uso" name="politica_uso" value="true" {{(old('politica_uso') ?? $asignacionUnidade->politica_uso) == "1" ?'checked':''}}><br>
                            @error('politica_uso')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="informacion_movilidad" class="col-md-6">Información relevante de movilidad</label>
                            <input type="checkbox" class="form-check-input col-md-6" id="informacion_movilidad" name="informacion_movilidad" value="true" {{(old('informacion_movilidad') ?? $asignacionUnidade->informacion_movilidad) == "1" ?'checked':''}}><br>
                            @error('informacion_movilidad')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="comunicados_generales" class="col-md-6">Comunicados generales</label>
                            <input type="checkbox" class="form-check-input col-md-6" id="comunicados_generales" name="comunicados_generales" value="true" {{(old('comunicados_generales') ?? $asignacionUnidade->comunicados_generales) == "1" ?'checked':''}}><br>
                            @error('comunicados_generales')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="informacion_mormont" class="col-md-6">Información relevante de Marmont</label>
                            <input type="checkbox" class="form-check-input col-md-6" id="informacion_mormont" name="informacion_mormont" value="true" {{(old('informacion_mormont') ?? $asignacionUnidade->informacion_mormont) == "1" ?'checked':''}}><br>
                            @error('informacion_mormont')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                </div>

                <h6 class="title-orange m-0">Check list de validación</h6>

                <div class="row">

                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="talon_verificacion" class="col-md-6"> Talón de verificación </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="talon_verificacion" name="talon_verificacion" value="true" {{(old('talon_verificacion') ?? $asignacionUnidade->talon_verificacion) == "1" ?'checked':''}}><br>
                            @error('talon_verificacion')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="llave_repuesto" class="col-md-6"> Llave de repuesto </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="llave_repuesto" name="llave_repuesto" value="true" {{(old('llave_repuesto') ?? $asignacionUnidade->llave_repuesto) == "1" ?'checked':''}}><br>
                            @error('llave_repuesto')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="gato_hidraulico" class="col-md-6"> Gato Hidráulico </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="gato_hidraulico" name="gato_hidraulico" value="true" {{(old('gato_hidraulico') ?? $asignacionUnidade->gato_hidraulico) == "1" ?'checked':''}}><br>
                            @error('gato_hidraulico')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="triangulo_seguridad" class="col-md-6"> Triángulos de seguridad </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="triangulo_seguridad" name="triangulo_seguridad" value="true" {{(old('triangulo_seguridad') ?? $asignacionUnidade->triangulo_seguridad) == "1" ?'checked':''}}><br>
                            @error('triangulo_seguridad')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="manual_usuario" class="col-md-6"> Manual de usuario </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="manual_usuario" name="manual_usuario" value="true" {{(old('manual_usuario') ?? $asignacionUnidade->manual_usuario) == "1" ?'checked':''}}><br>
                            @error('manual_usuario')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="engomado" class="col-md-6"> Engomado </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="engomado" name="engomado" value="true" {{(old('engomado') ?? $asignacionUnidade->engomado) == "1" ?'checked':''}}><br>
                            @error('engomado')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="placas_check" class="col-md-6"> Placas </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="placas_check" name="placas_check" value="true" {{(old('placas_check') ?? $asignacionUnidade->placas_check) == "1" ?'checked':''}}><br>
                            @error('placas_check')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="poliza_mantenimiento" class="col-md-6"> Póliza de mantenimiento </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="poliza_mantenimiento" name="poliza_mantenimiento" value="true" {{(old('poliza_mantenimiento') ?? $asignacionUnidade->poliza_mantenimiento) == "1" ?'checked':''}}><br>
                            @error('poliza_mantenimiento')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="llanta_refaccion" class="col-md-6"> Llanta de refacción </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="llanta_refaccion" name="llanta_refaccion" value="true" {{(old('llanta_refaccion') ?? $asignacionUnidade->llanta_refaccion) == "1" ?'checked':''}}><br>
                            @error('llanta_refaccion')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="poliza_seguro" class="col-md-6"> Póliza de seguro </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="poliza_seguro" name="poliza_seguro" value="true" {{(old('poliza_seguro') ?? $asignacionUnidade->poliza_seguro) == "1" ?'checked':''}}><br>
                            @error('poliza_seguro')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="form-group">
                            <label for="tarjeta_circulacion" class="col-md-6"> Tarjeta de circulación </label>
                            <input type="checkbox" class="form-check-input col-md-6" id="tarjeta_circulacion" name="tarjeta_circulacion" value="true" {{(old('tarjeta_circulacion') ?? $asignacionUnidade->tarjeta_circulacion) == "1" ?'checked':''}}><br>
                            @error('tarjeta_circulacion')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="col-md-12 mt-4">
                    <div class="form-group">
                        <div>
                            <label for="a_entrega"> Acta de entrega </label>
                        </div>
                        <div class="input-group mb-3">
                            @isset($asignacionUnidade->a_entrega)
                            <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                <a style='color: white;' href="{{ asset('storage/'.$asignacionUnidade->a_entrega) }}" target="_blank">
                                    <i class="bi bi-download"></i>
                                </a>
                            </span>
                            @endisset
                            <input type="file" accept=".pdf" class="input-archivo-down input-archivo" id="a_entrega" name='a_entrega'>
                        </div>
                        @error('a_entrega')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                @if($asignacionUnidade->etapa!==4)
                <div class="d-flex justify-content-center gap-4 mt-4">
                    <x-btn-regresar link='step3' params='{{$asignacionUnidade->id_asignacion_unidad}}' text='Anterior' />
                    <input type='button' class="btn-enviar" data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias" value='Terminar'>
                    <x-btn-regresar link='asignacionUnidades.show' params='{{$asignacionUnidade->id_cliente}}' text='Salir' />

                    <div class="modal fade" id="modal-asignar-garantias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asignar-garantias" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 m-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="border-0 d-flex justify-content-center">
                                    <h5 class="modal-title" id="staticBackdropLabel">¿Estás seguro de agregar este registro?</h5>
                                </div>

                                <div class="modal-body text-red-status">
                                    <center>
                                        Una vez agregado, este registro formará parte de la base de datos y no podrá ser editado posteriormente.
                                        <br>
                                        <br>
                                        Por favor, confirma que deseas proceder con esta acción.
                                    </center>
                                </div>
                                <div class="modal-footer border-0 d-flex justify-content-center">
                                    <input type='button' class="btn btn-regresar" data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias" value='Cancelar'>
                                    <x-btn-enviar text='Confirmar' />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </fieldset>

        @if($asignacionUnidade->etapa==4)
        <div class="d-flex justify-content-center gap-4 mb-4">
            <x-btn-regresar link='step3' params='{{$asignacionUnidade->id_asignacion_unidad}}' text='Anterior' />
            <x-btn-regresar link='asignacionUnidades.show' params='{{$asignacionUnidade->id_cliente}}' text='Salir' />
        </div>
        @endif

    </div>
</div>

<script src='{{asset('js/input-file.js')}}'></script>
@endsection
