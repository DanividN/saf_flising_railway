@extends('pwa.layouts.pwa')

@section('headers-navbar')
    <div class="col-12 border-0 p-2 d-flex align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('pwa.clientes.unidades', $cita->id_cliente) }}">
                <img src="{{ asset('img/pwa/flecha.png') }}" alt="iconno regresar" width="24" height="24">
            </a>
        </div>
        <div class="col-11 text-center">
            <h5>{{ $cita->unidad->modelo }}/{{ $cita->asignacionUnidad->placas }}</h5>
        </div>
    </div>
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger p-1 m-1">{{ $error }}</div>
        @endforeach
    @endif

    @include('pwa.views.unidades.infoCliente')
    @include('pwa.views.unidades.infoUnidad')

    <form id="formularioSeguimiento" novalidate class="needs-validation" action="{{ route('pwa.clientes.unidades.crear-validacion', $cita->id_citas_supervision) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="container-fluid mt-4">
            <div class="card shadow-md border-gray-100 border-0 p-2">
                <div class="card-header border-0 bg-white m-0">
                    <h5 class="text-orange m-0 font-bold">Seguimiento de la unidad</h5>
                </div>
    
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            <div class="form-group d-flex justify-content-between">
                                <label for="talon_verificacion" class="{{ $cita->asignacionUnidad->talon_verificacion == 1 ? 'text-success' : 'text-danger' }}"><b>Talón de verificación</b></label>
                                <input 
                                    type="checkbox" 
                                    name="talon_verificacion"
                                    id="talon_verificacion" 
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="talon_verificacion" class="checkbox-custom"></label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="llave_repuesto" class="{{ $cita->asignacionUnidad->llave_repuesto == 1 ? 'text-success' : 'text-danger' }}"><b>Llave de repuesto</b></label>
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="llave_repuesto" 
                                    name="llave_repuesto" 
                                    value="1"
                                >
                                <label for="llave_repuesto" class="checkbox-custom"></label>
                            </div>
                        </div>
    
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="gato_hidraulico" class="{{ $cita->asignacionUnidad->gato_hidraulico == 1 ? 'text-success' : 'text-danger' }}"><b>Gato hidráulico</b></label>
                                <input 
                                    type="checkbox" 
                                    id="gato_hidraulico" 
                                    name="gato_hidraulico"
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="gato_hidraulico" class="checkbox-custom"></label>
                            </div>
                        </div> 

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="triangulo_seguridad" class="{{ $cita->asignacionUnidad->triangulo_seguridad == 1 ? 'text-success' : 'text-danger' }}"><b>Triángulos de seguridad</b></label>
                                <input 
                                    type="checkbox" 
                                    id="triangulo_seguridad" 
                                    name="triangulo_seguridad"
                                    class="form-check-input" 
                                    value="1"
                                >
                                <label for="triangulo_seguridad" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="manual_usuario" class="{{ $cita->asignacionUnidad->manual_usuario == 1 ? 'text-success' : 'text-danger' }}"><b>Manual de usuario</b></label>
                                <input 
                                    type="checkbox" 
                                    id="manual_usuario" 
                                    class="form-check-input"
                                    name="manual_usuario" 
                                    value="1" 
                                >
                                <label for="manual_usuario" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="engomado" class="{{ $cita->asignacionUnidad->engomado == 1 ? 'text-success' : 'text-danger' }}"><b>Engomado</b></label>
                                <input 
                                    type="checkbox" 
                                    id="engomado" 
                                    class="form-check-input"
                                    name="engomado" 
                                    value="1" 
                                >
                                <label for="engomado" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="placas_check" class="{{ $cita->asignacionUnidad->placas_check == 1 ? 'text-success' : 'text-danger' }}"><b>Placas</b></label>
                                <input 
                                    type="checkbox" 
                                    id="placas_check"
                                    name="placas_check"
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="placas_check" class="checkbox-custom"></label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="poliza_mantenimiento" class="{{ $cita->asignacionUnidad->poliza_mantenimiento == 1 ? 'text-success' : 'text-danger' }}"><b>Póliza de mantenimiento</b></label>
                                <input 
                                    type="checkbox" 
                                    id="poliza_mantenimiento"
                                    name="poliza_mantenimiento" 
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="poliza_mantenimiento" class="checkbox-custom"></label>
                            </div>
                        </div>
    
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="llanta_refaccion" class="{{ $cita->asignacionUnidad->llanta_refaccion == 1 ? 'text-success' : 'text-danger' }}"><b>Llanta de refacción</b></label>
                                <input 
                                    type="checkbox" 
                                    id="llanta_refaccion"
                                    name="llanta_refaccion" 
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="llanta_refaccion" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="poliza_seguro" class="{{ $cita->asignacionUnidad->poliza_seguro == 1 ? 'text-success' : 'text-danger' }}"><b>Poliza de seguro</b></label>
                                <input 
                                    type="checkbox" 
                                    id="poliza_seguro"
                                    name="poliza_seguro" 
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="poliza_seguro" class="checkbox-custom"></label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="tarjeta_circulacion" class="{{ $cita->asignacionUnidad->tarjeta_circulacion == 1 ? 'text-success' : 'text-danger' }}"><b>Tarjeta de circulación</b></label>
                                <input 
                                    type="checkbox" 
                                    id="tarjeta_circulacion"
                                    name="tarjeta_circulacion"
                                    class="form-check-input" 
                                    value="1" 
                                >
                                <label for="tarjeta_circulacion" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group">
                                <label for="vida_util_llantas"><b>Vida útil de las llantas</b><span class="text-danger">*</span></label>
                                <select class="form-select mt-2" name="vida_util_llantas" id="vida_util_llantas" required>
                                    <option value="" selected>-- Seleccionar --</option>
                                    <option value="BUENA" {{ old('vida_util_llantas') == 'BUENA' ? 'selected' : '' }}>Buena</option>
                                    <option value="REGULAR" {{ old('vida_util_llantas') == 'REGULAR' ? 'selected' : '' }}>Regular</option>Regular</option>
                                    <option value="MALA" {{ old('vida_util_llantas') == 'MALA' ? 'selected' : '' }}>Mala</option>
                                </select>

                                @error('vida_util_llantas')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="mt-4">
                            <div class="form-group">
                                <label for="observacion_supervisor"><b>Observaciones supervisión</b><span class="text-danger">*</span></label>
                                <textarea class="form-control mt-2" rows="6" id="observacion_supervisor" name="observacion_supervisor" required placeholder="Observaciones supervisión">{{ old('observacion_supervisor') }}</textarea>
                                @error('observacion_supervisor')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container-fluid mt-4">
            <div class="card shadow-md border-gray-100 border-0 p-2">
                <div class="card-header border-0 bg-white m-0 text-center">
                    <h5 class="text-orange m-0 font-bold">Estetica de la unidad</h5>
                </div>
                
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active text-center" id="pills-frontal-superior" role="tabpanel" aria-labelledby="pills-frontal-superior-tab" tabindex="0">
                            <h6>Vista frontal</h6>
                            <img data-id="pills-frontal-superior-img" src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}" alt="vista frontal automovil" style="width: 100%; height: 100%;">
                        </div>
    
                        <div class="tab-pane fade text-center" id="pills-izquierda-superior" role="tabpanel" aria-labelledby="pills-izquierda-superior-tab" tabindex="0">
                            <h6>Vista izquierda</h6>
                            <img data-id="pills-izquierda-superior-img" src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}" alt="vista izquierda automovil" style="width: 100%; height: 100%;">
                        </div>
    
                        <div class="tab-pane fade text-center" id="pills-trasera-superior" role="tabpanel" aria-labelledby="pills-trasera-superior-tab" tabindex="0">
                            <h6>Vista trasera</h6>
                            <img data-id="pills-trasera-superior-img" src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}" alt="vista trasera automovil" style="width: 100%; height: 100%;">
                        </div>
    
                        <div class="tab-pane fade text-center" id="pills-derecha-superior" role="tabpanel" aria-labelledby="pills-derecha-superior-tab" tabindex="0">
                            <h6>Vista derecha</h6>
                            <img data-id="pills-derecha-superior-img" src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}" alt="vista derecha automovil" style="width: 100%; height: 100%;">
                        </div>
                    </div>
    
                    <ul class="nav nav-pills mb-3 d-flex justify-content-center gap-2" id="pills-tab" role="tablist">
                        <li class="nav-item mt-3" role="presentation">
                            <button class="nav-link active pill-btn" id="pills-frontal-tab" data-bs-toggle="pill" data-bs-target="#pills-frontal" type="button" role="tab" aria-controls="pills-frontal" aria-selected="true"></button>
                        </li>
                        <li class="nav-item mt-3" role="presentation">
                            <button class="nav-link pill-btn" id="pills-izquierda-tab" data-bs-toggle="pill" data-bs-target="#pills-izquierda" type="button" role="tab" aria-controls="pills-izquierda" aria-selected="false"></button>
                        </li>
                        <li class="nav-item mt-3" role="presentation">
                            <button class="nav-link pill-btn" id="pills-trasera-tab" data-bs-toggle="pill" data-bs-target="#pills-trasera" type="button" role="tab" aria-controls="pills-trasera" aria-selected="false"></button>
                        </li>
                        <li class="nav-item mt-3" role="presentation">
                            <button class="nav-link pill-btn" id="pills-derecha-tab" data-bs-toggle="pill" data-bs-target="#pills-derecha" type="button" role="tab" aria-controls="pills-derecha" aria-selected="false"></button>
                        </li>
                    </ul>
    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-frontal" role="tabpanel" aria-labelledby="pills-frontal-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_frontal"><b>Observaciones vista frontal:</b><span class="text-danger">*</span></label>
                                <textarea required class="form-control" name="obsevaciones_vista_frontal" id="obsevaciones_vista_frontal" cols="30" rows="10" placeholder="Observaciones vista frontal">{{ old('obsevaciones_vista_frontal') }}</textarea>
                                @error('obsevaciones_vista_frontal')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-izquierda" role="tabpanel" aria-labelledby="pills-izquierda-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_izquierda"><b>Observaciones vista izquierda:</b><span class="text-danger">*</span></label>
                                <textarea required class="form-control" name="obsevaciones_vista_izquierda" id="obsevaciones_vista_izquierda" cols="30" rows="10" placeholder="Observaciones vista izquierda">{{ old('obsevaciones_vista_izquierda') }}</textarea>
                                @error('obsevaciones_vista_izquierda')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-trasera" role="tabpanel" aria-labelledby="pills-trasera-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_trasera"><b>Observaciones vista trasera:</b><span class="text-danger">*</span></label>
                                <textarea required class="form-control" name="obsevaciones_vista_trasera" id="obsevaciones_vista_trasera" cols="30" rows="10" placeholder="Observaciones vista trasera">{{ old('obsevaciones_vista_trasera') }}</textarea>
                                @error('obsevaciones_vista_trasera')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-derecha" role="tabpanel" aria-labelledby="pills-derecha-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_derecha"><b>Observaciones vista derecha:</b><span class="text-danger">*</span></label>
                                <textarea required class="form-control" name="obsevaciones_vista_derecha" id="obsevaciones_vista_derecha" cols="30" rows="10" placeholder="Observaciones vista derecha">{{ old('obsevaciones_vista_derecha') }}</textarea>
                                @error('obsevaciones_vista_derecha')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <input required type="file" id="input-frontal" accept="image/*" style="display:none;" name="evidecia_vista_frontal">
                            <div class="card" onclick="document.getElementById('input-frontal').click();">
                                <img 
                                    id="img-frontal" 
                                    src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}"
                                    data-default-src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}" 
                                    alt="vista frontal automovil" 
                                    style="width: 100%; height: 100%;"
                                >
                            </div>
                        </div>
    
                        <div class="col-3">
                            <input required type="file" id="input-izquierda" accept="image/*" style="display:none;" name="evidecia_vista_izquierda">
                            <div class="card" onclick="document.getElementById('input-izquierda').click();">
                                <img 
                                    id="img-izquierda" 
                                    src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}" 
                                    alt="vista izquierda automovil" 
                                    style="width: 100%; height: 100%;"
                                    data-default-src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}"
                                >
                            </div>
                        </div>
    
                        <div class="col-3">
                            <input required type="file" id="input-trasera" accept="image/*" style="display:none;" name="evidecia_vista_trasera">
                            <div class="card" onclick="document.getElementById('input-trasera').click();">
                                <img 
                                    id="img-trasera" 
                                    src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}" 
                                    data-default-src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}"
                                    alt="vista trasera automovil" 
                                    style="width: 100%; height: 100%;"
                                >
                            </div>
                        </div>

                        <div class="col-3">
                            <input type="file" id="input-derecha" accept="image/*" style="display:none;" name="evidecia_vista_derecha">
                            <div required class="card" onclick="document.getElementById('input-derecha').click();">
                                <img 
                                    id="img-derecha" 
                                    src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}" 
                                    data-default-src="{{ asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}"
                                    alt="vista derecha automovil" 
                                    style="width: 100%; height: 100%;"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container-fluid mt-4 mb-4">
            <div class="card shadow-md border-gray-100 border-0 p-2">
                <div class="card-header border-0 bg-white m-0 text-center">
                    <h5 class="text-orange m-0 font-bold">Firma del cliente</h5>
                </div>
    
                <div class="card-body d-flex justify-content-center">
                    <canvas id="canvas" style="border: 1px solid black;"></canvas>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="button" role="button" id="btnLimpiar" class="btn btn-orange">Limpiar</button>
                </div>
                
                <div class="mt-4">
                    <input type="submit" class="btn btn-orange font-bold" value="Completar revisión" id="guardar-validacion" style="width: 100%;">
                </div>
            </div>
        </div>
    </form>

@endsection

@section('extra-js')
    <script src="{{ asset('js/pwa/unidades.js') }}"></script>
@endsection