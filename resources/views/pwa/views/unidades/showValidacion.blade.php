@extends('pwa.layouts.pwa')

@section('extra-css')
@endsection

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
    @include('pwa.views.unidades.infoCliente')
    @include('pwa.views.unidades.infoUnidad')
        <div class="container-fluid mt-4">
            <div class="card shadow-md border-gray-100 border-0 p-2">
                <div class="card-header border-0 bg-white m-0">
                    <h5 class="text-orange m-0 font-bold">Seguimiento de la unidad</h5>
                </div>
    
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            <div class="form-group d-flex justify-content-between">
                                <label for="talon_verificacion"><b class="@isset($cita->asignacionUnidad->talon_verificacion) {{ $cita->asignacionUnidad->talon_verificacion ? 'text-success' : 'text-danger' }} @endisset">Talón de verificación</b></label>
                                <input 
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->talon_verificacion)
                                        {{ $cita->supervision->talon_verificacion ? 'checked' : '' }}
                                    @endisset
                                >
                                <label for="talon_verificacion" class="checkbox-custom"></label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="llave_repuesto"><b class="@isset($cita->asignacionUnidad->llave_repuesto) {{ $cita->asignacionUnidad->llave_repuesto ? 'text-success' : 'text-danger' }} @endisset">Llave de repuesto</b></label>
                                <input 
                                disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->llave_repuesto)
                                        {{ $cita->supervision->llave_repuesto ? 'checked' : '' }}
                                    @endisset 
                                >
                                <label for="llave_repuesto" class="checkbox-custom"></label>
                            </div>
                        </div>
    
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="gato_hidraulico" class=""><b class="@isset($cita->asignacionUnidad->gato_hidraulico) {{ $cita->asignacionUnidad->gato_hidraulico ? 'text-success' : 'text-danger' }} @endisset">Gato hidráulico</b></label>
                                <input 
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->gato_hidraulico)
                                        {{ $cita->supervision->gato_hidraulico ? 'checked' : '' }}
                                    @endisset
                                >
                                <label for="gato_hidraulico" class="checkbox-custom"></label>
                            </div>
                        </div> 

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="triangulo_seguridad" class=""><b class="@isset($cita->asignacionUnidad->triangulo_seguridad) {{ $cita->asignacionUnidad->triangulo_seguridad ? 'text-success' : 'text-danger' }} @endisset">Triángulos de seguridad</b></label>
                                <input
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->triangulo_seguridad)
                                        {{ $cita->supervision->triangulo_seguridad ? 'checked' : '' }}
                                    @endisset
                                >
                                <label for="triangulo_seguridad" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="manual_usuario" class=""><b class="@isset($cita->asignacionUnidad->manual_usuario) {{ $cita->asignacionUnidad->manual_usuario ? 'text-success' : 'text-danger' }} @endisset">Manual de usuario</b></label>
                                <input
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input"
                                    @isset($cita->supervision->manual_usuario) 
                                        {{ $cita->supervision->manual_usuario ? 'checked' : '' }} 
                                    @endisset
                                >
                                <label for="manual_usuario" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="engomado" class=""><b class="@isset($cita->asignacionUnidad->engomado) {{ $cita->asignacionUnidad->engomado ? 'text-success' : 'text-danger' }} @endisset">Engomado</b></label>
                                <input 
                                    type="checkbox" 
                                    class="form-check-input"
                                    disabled
                                    @isset($cita->supervision->engomado)
                                        {{ $cita->supervision->engomado ? 'checked' : '' }} 
                                    @endisset
                                >
                                <label for="engomado" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="placas_check" class=""><b class="@isset($cita->asignacionUnidad->placas_check) {{ $cita->asignacionUnidad->placas_check ? 'text-success' : 'text-danger' }} @endisset">Placas</b></label>
                                <input 
                                    type="checkbox" 
                                    id="placas_check"
                                    name="placas_check"
                                    class="form-check-input" 
                                    disabled
                                    @isset($cita->supervision->placas_check)
                                        {{ $cita->supervision->placas_check ? 'checked' : '' }}
                                    @endisset
                                >
                                <label for="placas_check" class="checkbox-custom"></label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="poliza_mantenimiento"><b class="@isset($cita->asignacionUnidad->poliza_mantenimiento) {{ $cita->asignacionUnidad->poliza_mantenimiento ? 'text-success' : 'text-danger' }} @endisset">Póliza de mantenimiento</b></label>
                                <input
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->poliza_mantenimiento)
                                        {{ $cita->supervision->poliza_mantenimiento ? 'checked' : '' }}
                                    @endisset 
                                >
                                <label for="poliza_mantenimiento" class="checkbox-custom"></label>
                            </div>
                        </div>
    
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="llanta_refaccion" class=""><b class="@isset($cita->asignacionUnidad->llanta_refaccion) {{ $cita->asignacionUnidad->llanta_refaccion ? 'text-success' : 'text-danger' }} @endisset">Llanta de refacción</b></label>
                                <input
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->llanta_refaccion)
                                        {{ $cita->supervision->llanta_refaccion ? 'checked' : '' }}
                                    @endisset
                                >
                                <label for="llanta_refaccion" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="poliza_seguro" class=""><b class="@isset($cita->asignacionUnidad->poliza_seguro) {{ $cita->asignacionUnidad->poliza_seguro ? 'text-success' : 'text-danger' }} @endisset">Poliza de seguro</b></label>
                                <input
                                    disabled
                                    type="checkbox" 
                                    class="form-check-input" 
                                    @isset($cita->supervision->poliza_seguro) 
                                        {{ $cita->supervision->poliza_seguro ? 'checked' : '' }} 
                                    @endisset
                                >
                                <label for="poliza_seguro" class="checkbox-custom"></label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group d-flex justify-content-between">
                                <label for="tarjeta_circulacion"><b class="@isset($cita->asignacionUnidad->tarjeta_circulacion) {{ $cita->asignacionUnidad->tarjeta_circulacion ? 'text-success' : 'text-danger' }} @endisset">Tarjeta de circulación</b></label>
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    disabled
                                    @isset($cita->supervision->tarjeta_circulacion)
                                        {{ $cita->supervision->tarjeta_circulacion ? 'checked' : '' }}
                                    @endisset
                                >
                                <label for="tarjeta_circulacion" class="checkbox-custom"></label>
                            </div>
                        </div>
        
                        <div class="mt-4">
                            <div class="form-group">
                                <label for="vida_util_llantas"><b>Vida útil de las llantas</label>
                                <select class="form-select mt-2" name="vida_util_llantas" id="vida_util_llantas" disabled>
                                    <option value="" selected>-- Seleccionar --</option>
                                    <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'BUENA' ? 'selected' : '' }} @endisset value="BUENA">Buena</option>
                                    <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'REGULAR' ? 'selected' : '' }} @endisset value="REGULAR">Regular</option>Regular</option>
                                    <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'MALA' ? 'selected' : '' }} @endisset value="MALA">Mala</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="mt-4">
                            <div class="form-group">
                                <label for="observacion_supervisor"><b>Observaciones supervisión</label>
                                <textarea class="form-control mt-2" rows="6" disabled>@isset($cita->supervision->observacion_supervisor){{ $cita->supervision->observacion_supervisor }}@endisset</textarea>
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
                            <img 
                                data-id="pills-frontal-superior-img" 
                                src="{{ isset($cita->supervision->img_frontal) ? asset('storage/'.$cita->supervision->img_frontal) : asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}"
                                alt="vista frontal automovil" 
                                style="width: 100%; height: 100%;"
                            >
                        </div>
    
                        <div class="tab-pane fade text-center" id="pills-izquierda-superior" role="tabpanel" aria-labelledby="pills-izquierda-superior-tab" tabindex="0">
                            <h6>Vista izquierda</h6>
                            <img 
                                data-id="pills-izquierda-superior-img" 
                                src="{{ isset($cita->supervision->img_izquierda) ? asset('storage/'.$cita->supervision->img_izquierda) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}"
                                alt="vista izquierda automovil" 
                                style="width: 100%; height: 100%;"
                            >
                        </div>
    
                        <div class="tab-pane fade text-center" id="pills-trasera-superior" role="tabpanel" aria-labelledby="pills-trasera-superior-tab" tabindex="0">
                            <h6>Vista trasera</h6>
                            <img 
                                data-id="pills-trasera-superior-img" 
                                src="{{ isset($cita->supervision->img_trasera) ? asset('storage/'.$cita->supervision->img_trasera) : asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}"
                                alt="vista trasera automovil" 
                                style="width: 100%; height: 100%;"
                            >
                        </div>
    
                        <div class="tab-pane fade text-center" id="pills-derecha-superior" role="tabpanel" aria-labelledby="pills-derecha-superior-tab" tabindex="0">
                            <h6>Vista derecha</h6>
                            <img 
                                data-id="pills-derecha-superior-img" 
                                src="{{ isset($cita->supervision->img_derecha) ? asset('storage/'.$cita->supervision->img_derecha) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}"
                                alt="vista derecha automovil" 
                                style="width: 100%; height: 100%;"
                            >
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
                                <textarea disabled class="form-control" name="obsevaciones_vista_frontal" id="obsevaciones_vista_frontal" cols="30" rows="10" >@isset($cita->supervision->obsevaciones_vista_frontal){{ $cita->supervision->obsevaciones_vista_frontal }}@endisset</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-izquierda" role="tabpanel" aria-labelledby="pills-izquierda-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_izquierda"><b>Observaciones vista izquierda:</b><span class="text-danger">*</span></label>
                                <textarea disabled class="form-control" name="obsevaciones_vista_izquierda" id="obsevaciones_vista_izquierda" cols="30" rows="10" >@isset($cita->supervision->obsevaciones_vista_izquierda){{ $cita->supervision->obsevaciones_vista_izquierda }}@endisset</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-trasera" role="tabpanel" aria-labelledby="pills-trasera-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_trasera"><b>Observaciones vista trasera:</b><span class="text-danger">*</span></label>
                                <textarea disabled class="form-control" name="obsevaciones_vista_trasera" id="obsevaciones_vista_trasera" cols="30" rows="10" >@isset($cita->supervision->obsevaciones_vista_trasera){{ $cita->supervision->obsevaciones_vista_trasera }}@endisset</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-derecha" role="tabpanel" aria-labelledby="pills-derecha-tab" tabindex="0">
                            <div class="form-group">
                                <label for="obsevaciones_vista_derecha"><b>Observaciones vista derecha:</b><span class="text-danger">*</span></label>
                                <textarea disabled class="form-control" name="obsevaciones_vista_derecha" id="obsevaciones_vista_derecha" cols="30" rows="10" >@isset($cita->supervision->obsevaciones_vista_derecha){{ $cita->supervision->obsevaciones_vista_derecha }}@endisset</textarea>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <input required type="file" id="input-frontal" accept="image/*" style="display:none;" name="evidecia_vista_frontal" disabled>
                            <div class="card" onclick="document.getElementById('input-frontal').click();">
                                <img 
                                    id="img-frontal" 
                                    src="{{ isset($cita->supervision->evidecia_vista_frontal) ? asset('storage/'.$cita->supervision->evidecia_vista_frontal) : asset('img/administracion/vistasAutomovil/diagrama auto_frontal.png') }}"
                                    alt="vista frontal automovil" 
                                    style="width: 100%; height: 100%;"
                                >
                            </div>
                        </div>
    
                        <div class="col-3">
                            <input required type="file" id="input-izquierda" accept="image/*" style="display:none;" name="evidecia_vista_izquierda" disabled>
                            <div class="card" onclick="document.getElementById('input-izquierda').click();">
                                <img 
                                    id="img-izquierda" 
                                    src="{{ isset($cita->supervision->evidecia_vista_izquierda) ? asset('storage/'.$cita->supervision->evidecia_vista_izquierda) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral izquierda.png') }}"
                                    alt="vista izquierda automovil" 
                                    style="width: 100%; height: 100%;"
                                >
                            </div>
                        </div>
    
                        <div class="col-3">
                            <input required type="file" id="input-trasera" accept="image/*" style="display:none;" name="evidecia_vista_trasera" disabled>
                            <div class="card" onclick="document.getElementById('input-trasera').click();">
                                <img 
                                    id="img-trasera" 
                                    src="{{ isset($cita->supervision->evidecia_vista_trasera) ? asset('storage/'.$cita->supervision->evidecia_vista_trasera) : asset('img/administracion/vistasAutomovil/diagrama auto_trasera.png') }}"
                                    alt="vista trasera automovil" 
                                    style="width: 100%; height: 100%;"
                                >
                            </div>
                        </div>

                        <div class="col-3">
                            <input type="file" id="input-derecha" accept="image/*" style="display:none;" name="evidecia_vista_derecha" disabled>
                            <div required class="card" onclick="document.getElementById('input-derecha').click();">
                                <img 
                                    id="img-derecha" 
                                    src="{{ isset($cita->supervision->evidecia_vista_derecha) ? asset('storage/'.$cita->supervision->evidecia_vista_derecha) : asset('img/administracion/vistasAutomovil/diagrama auto_lateral derecho.png') }}"
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
                    <h5 class="text-orange m-0 font-bold">Firma del cliente
                </div>
    
                <div class="card-body d-flex justify-content-center">
                    @isset($cita->supervision->img_firma_cliente)
                        <img src="{{ asset('storage/' . $cita->supervision->img_firma_cliente) }}" alt="firma cliente">
                    @endisset
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4 mb-4">
            <div class="card shadow-md border-gray-100 border-0 p-2">
                <div class="form-group">
                    <label for=""><b>Proceso</b></label>
                    <input type="text" class="form-control" value="{{ $cita->notificacion_citas }}" disabled>
                </div>
    
                <div class="form-group">
                    <label for=""><b>Observaciones</b></label>
                    <textarea class="form-control" rows="5" disabled>{{ $cita->observacion_flising }}</textarea>
                </div>
            </div>
        </div>
@endsection

@section('extra-js')
    <script>
        document?.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.nav-link.pill-btn').forEach(function (element) {
                element.addEventListener('click', function () {
                    var target = this.getAttribute('data-bs-target');
        
                    document.querySelectorAll('.nav-link.pill-btn, .tab-pane').forEach(function (el) {
                        el.classList.remove('active', 'show');
                    });
        
                    document.querySelectorAll('[aria-selected="true"]').forEach(function (el) {
                        el.setAttribute('aria-selected', 'false');
                    });
        
                    this.classList.add('active');
                    this.setAttribute('aria-selected', 'true');
                    document.querySelector(target).classList.add('show', 'active');
        
                    var pairTarget = target.replace('-superior', '');
                    if (pairTarget === target) {
                        pairTarget = target + '-superior';
                    }
        
                    document.querySelectorAll(`[data-bs-target="${pairTarget}"]`).forEach(function (el) {
                        el.classList.add('active');
                        el.setAttribute('aria-selected', 'true');
                    });
        
                    document.querySelector(pairTarget).classList.add('show', 'active');
        
                });
            });
        });
    </script>
@endsection