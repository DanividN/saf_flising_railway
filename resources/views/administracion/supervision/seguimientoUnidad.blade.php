<div class="row">
    <h6 class="title-orange m-0 mt-4">Seguimiento de la unidad</h6>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->talon_verificacion == 1 ? 'text-success' : 'text-danger' }}">
                    Talón de verificación
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->talon_verificacion)
                    {{ $cita->supervision->talon_verificacion ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->engomado == 1 ? 'text-success' : 'text-danger' }}">
                    Engomado
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->engomado)
                    {{ $cita->supervision->engomado ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->tarjeta_circulacion == 1 ? 'text-success' : 'text-danger' }}">
                    Tarjeta de circulación
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->tarjeta_circulacion)
                    {{ $cita->supervision->tarjeta_circulacion ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->manual_usuario == 1 ? 'text-success' : 'text-danger' }}">
                    Manual de usuario
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->manual_usuario)
                    {{ $cita->supervision->manual_usuario ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->poliza_seguro == 1 ? 'text-success' : 'text-danger' }}">
                    Poliza de seguro
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->poliza_seguro)
                    {{ $cita->supervision->poliza_seguro ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->triangulo_seguridad == 1 ? 'text-success' : 'text-danger' }}">
                    Triángulos de seguridad
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->triangulo_seguridad)
                    {{ $cita->supervision->triangulo_seguridad ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->llanta_refaccion == 1 ? 'text-success' : 'text-danger' }}">
                    Llanta de refacción
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->llanta_refaccion)
                    {{ $cita->supervision->llanta_refaccion ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->gato_hidraulico == 1 ? 'text-success' : 'text-danger' }}">
                    Gato Hidráulico
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->gato_hidraulico)
                    {{ $cita->supervision->gato_hidraulico ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->poliza_mantenimiento == 1 ? 'text-success' : 'text-danger' }}">
                    Póliza de mantenimiento
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->poliza_mantenimiento)
                    {{ $cita->supervision->poliza_mantenimiento ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->llave_repuesto == 1 ? 'text-success' : 'text-danger' }}">
                    Llave de repuesto
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->llave_repuesto)
                    {{ $cita->supervision->llave_repuesto ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="" class="col-md-6">
                <b class="{{ $cita->asignacionUnidad->placas_check == 1 ? 'text-success' : 'text-danger' }} ">
                    Placas
                </b>
            </label>
            <input 
                type="checkbox" 
                class="form-check-input col-md-6" 
                value="1" 
                @isset($cita->supervision->placas_check)
                    {{ $cita->supervision->placas_check ? 'checked' : '' }}
                @endisset
                disabled
            >
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div>
            <label for=""><b>Acta de entrega</b></label>
        </div>
        <div class="form-group d-flex">
            @isset($cita->asignacionUnidad->a_entrega)
                <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                    <a style='color: white;'  href="{{ asset('storage/'.$cita->asignacionUnidad->a_entrega) }}" target="_blank">
                        <i class="bi bi-download"></i>
                    </a>
                </span>
            @endisset
            <input 
                type="text" 
                disabled 
                class="input-archivo-down input-archivo" 
                value="{{ $cita->unidad->nombre_archivo_entrega ? $cita->unidad->nombre_archivo_entrega : 'No hay archivo' }}"
                style="font-size: 12px !important; text-align: start !important; margin-left: 2px !important;"
            >
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for="vida_util_llantas"><b>Vida útil de las llantas</b></label>
            <select class="form-select mt-2" name="vida_util_llantas" id="vida_util_llantas" disabled>
                <option value="" selected>-- Seleccionar --</option>
                <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'BUENA' ? 'selected' : '' }} @endisset value="BUENA">Buena</option>
                <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'REGULAR' ? 'selected' : '' }} @endisset value="REGULAR">Regular</option>Regular</option>
                <option @isset($cita->supervision->vida_util_llantas) {{ $cita->supervision->vida_util_llantas == 'MALA' ? 'selected' : '' }} @endisset value="MALA">Mala</option>
            </select>
        </div>
    </div>
</div>