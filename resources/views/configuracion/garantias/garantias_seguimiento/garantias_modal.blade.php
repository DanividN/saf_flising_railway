<div class="modal fade @if ($errors->any()) show @endif" id="staticBackdrop" data-bs-backdrop="true"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar / Editar Garantía Extendida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="miFormulario" method="POST" action="{{ route('garantias_seguimiento.store') }}"
                enctype="multipart/form-data" onsubmit="validateForm(event)" class="needs-validation" novalidate>
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row d-flex">
                        <input type="hidden" name="garantia_id" id="garantia_id">
                        <input type="hidden" name="id_g_flising_extendidas" id="id_g_flising_extendidas">
                        <div class="col-12 col-md-6">
                            <label for="nombre_g_extendida" class="form-label">Tipo de Garantía</label>
                            <input type="text" class="form-control" id="nombre_g_extendida" name="nombre_g_extendida"
                                value="{{ old('nombre_g_extendida') }}" required>
                                <div class="invalid-feedback">
                                    El nombre es invalido
                                </div>
                            @if ($errors->has('nombre_g_extendida'))
                                <div class="alert alert-danger">{{ $errors->first('nombre_g_extendida') }}</div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6">
                            <label>Vigencia (en meses)</label>
                            <div class="wrapper my-2">
                                <div class="content">
                                    <div class="range-slider my-2">
                                        <input type="range" name="vigencia_g_extendida" min="0" max="36"
                                            value="{{ old('vigencia_g_extendida', 0) }}" class="range-input"
                                            id="range4" step="12" required/>
                                        <div class="sliderticks">
                                            <span>0</span>
                                            <span>12</span>
                                            <span>24</span>
                                            <span>36</span>
                                        </div>
                                        
                                        <div class="invalid-feedback my-4">
                                            La vigencia es invalida
                                        </div>
                                        @if ($errors->has('vigencia_g_extendida'))
                                        <div class="my-4 text-danger">
                                            {{ $errors->first('vigencia_g_extendida') }}
                                        </div>
                                        @endif
                                    </div>
                                   
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="eventos_por_year" class="form-label">Eventos al año</label>
                            <input type="number" class="form-control" id="eventos_por_year" name="eventos_por_year"
                                value="{{ old('eventos_por_year') }}" min="1" required>
                            <div class="invalid-feedback">
                                El evento es invalido
                            </div>
                            @if ($errors->has('eventos_por_year'))
                                <div class="alert alert-danger">{{ $errors->first('eventos_por_year') }}</div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="monto_g_extendida" class="form-label">Monto con I.V.A</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                                <input type="text" class="form-control" id="monto_g_extendida"
                                       name="monto_g_extendida" value="{{ old('monto_g_extendida') }}" required>
                                <div class="invalid-feedback">
                                    El monto es invalido
                                </div>
                                @if ($errors->has('monto_g_extendida'))
                                    <div class="alert alert-danger">{{ $errors->first('monto_g_extendida') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="a_evidencia_extendida">Evidencia de Garantía</label>
                            <div class="d-flex">
                                <div id="file-link-container" class="input-group-append p-0 m-0"></div>
                                <input type="file" class="input-archivo a_evidencia_extendida"
                                       name="a_evidencia_extendida" id="archivo-input" accept="application/pdf"
                                       onchange="validarPDF()">
                                @if ($errors->has('a_evidencia_extendida'))
                                    <div class="alert alert-danger">{{ $errors->first('a_evidencia_extendida') }}</div>
                                @endif
                            </div>
                            
                        </div>

                        <div class="col-12 col-12">
                            <label for="descripcion_g_extendida" class="form-label">Descripción</label>
                            <textarea name="descripcion_g_extendida" class="form-control" id="descripcion_g_extendida" cols="30"
                                rows="10">{{ old('descripcion_g_extendida') }}</textarea>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="activo">Estatus</label>
                            <div class="input-group mb-3 gap-2">
                                <label class="switch">
                                    <input class="form-check-input" type="checkbox" name="activo" id="activo" onchange="actualizarValorActivo()" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="form-check-label" id="labelEstatus" for="activo">Activo</label>
                                <input type="hidden" name="activo_hidden" id="activo_hidden" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn add_agencia" id="guardarBtn">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        if (@json($errors->any())) {
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();
        }
    });
</script>
{{-- <script src="{{ asset('js/asignacionUnidad/validForm.js') }}"></script> --}}
<script src='{{asset('js/input-file.js')}}'></script>
<script src="{{ asset('js/garantias/configuracion/garantias.js') }}"></script>