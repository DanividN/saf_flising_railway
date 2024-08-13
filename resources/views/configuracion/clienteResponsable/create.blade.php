<div class="modal fade @if ($errors->any()) show @endif" id="responsableModal" tabindex="-1"
    aria-labelledby="responsableModalLabel" aria-hidden="true" @if ($errors->any()) style="display:block;" @endif>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title" id="responsableModalLabel" style="color:#ED5429;">Crear/Editar Responsable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ isset($responsable) ? route('responsables.update', $responsable) : route('responsables.store') }}" method="POST" class="needs-validation" id="formulario" novalidate enctype="multipart/form-data" onsubmit="return bloqueoBoton(event)">
                    @csrf
                    @if (isset($responsable))
                        @method('PUT') <!-- Para el método PUT en la actualización -->
                    @endif
                    <div class="container">
                        <div class="row">
                            <!-- Campos del formulario -->
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label" for="nombre_responsable"><b>Nombre</b></label>
                                <input class="form-control" type="text" name="nombre_responsable" placeholder="Nombre de cliente" id="nombre_responsable" value="{{ old('nombre_responsable') }}" required pattern="[A-Za-zÀ-ÖØ-öø-ÿñÑ\s]{1,}">
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">El nombre no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('nombre_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="cargo" class="form-label"><b>Cargo</b></label>
                                <input type="text" class="form-control" name="cargo" placeholder="Director" id="cargo" value="{{ old('cargo') }}" required pattern="[A-Za-zÀ-ÖØ-öø-ÿñÑ0-9\s]{1,}">
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">El cargo no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('cargo')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!-- Agrega más campos aquí -->
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="telefono_responsable" class="form-label"><b>Telefono</b></label>
                                <input type="text" class="form-control" name="telefono_responsable" id="telefono" placeholder="7220001111" value="{{ old('telefono_responsable') }}" maxlength="10" required pattern="[0-9]{10}">
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">El télefono no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('telefono_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="numero_empleado" class="form-label"><b>Número de empleado</b></label>
                                <input type="numeric" class="form-control" name="numero_empleado" placeholder="00000" id="numero_empleado" value="{{ old('numero_empleado') }}" required pattern="[0-9]{1,}">
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">El número de empleado no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('numero_empleado')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="correo" class="form-label"><b>Correo electrónico</b></label>
                                <input type="email" class="form-control" name="correo_responsable" id="correo" placeholder="correo@email.com" value="{{ old('correo_responsable') }}" required>
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">El correo electrónico no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('correo_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="folio" class="form-label"><b>Folio de INE</b></label>
                                <input type="numeric" class="form-control" name="folio_ine" id="folio" placeholder="00000" value="{{ old('folio_ine') }}" maxlength="13" required>
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">El folio de ine no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('folio_ine')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Campos adicionales -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label for="VIP" class="form-label"><b>VIP</b></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="VIP" name="vip" >
                                    <label class="form-check-label" for="VIP" id="vipLabel">No</label>
                                    <input type="hidden" id="vipHidden" name="vip" value="0">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3 mb-3">
                                <label for="activo" class="form-label"><b>Estatus</b></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="activo" name="activo">
                                    <label class="form-check-label" for="activo" id="activoLabel">Inactivo</label>
                                    <input type="hidden" id="activoHidden" name="activo" value="0">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="ine" class="form-label"><b>INE</b></label>
                                    <div class="input-group">
                                        <a href="" target="_blank" class="input-download-link" id="archivo">
                                            <span class="input-group-text icono-download"><i class="bi bi-download"></i></span>
                                        </a>
                                        <input type="file" name="a_ine_responsable"  class="input-archivo-down"  id="archivo-input-down{{ $cliente->id_cliente }}" data-id="{{ $cliente->id_cliente }}">
                                    </div>
                                    <div class="invalid-feedback" style="margin:10px 0px;">
                                        <p class="text-danger">El ine no es valido</p>
                                    </div>
                                    <div class="text-danger" style="margin:10px 0px;">
                                        @error('a_ine_responsable')
                                            {{ $message }}
                                        @enderror
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                            <button type="button" id="edit_responsable" class="btn add_agencia" style="display: none;">Editar</button>
                            <button type="submit" id="guardarBtn" class="btn add_agencia">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src='{{asset('js/input-file.js')}}'></script>
