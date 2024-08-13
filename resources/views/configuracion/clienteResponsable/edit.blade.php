<div class="modal fade" id="responsableEditarModal" tabindex="-1" aria-labelledby="responsableEditarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('responsables.update', $responsable) }}" method="POST" class="needs-validation" id="formulario" novalidate enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 contacto_registro" id="responsableEditarModalLabel"><b>Editar
                            responsable de activo</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label" for="nombre_responsable"><b>Nombre</b></label>
                                <input class="form-control" type="text" name="nombre_responsable"
                                    placeholder="Nombre de cliente" id="nombre_responsable" value="{{$responsable->nombre_responsable}}" required>
                                <div style="margin:10px 0px;">
                                    @error('nombre_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="cargo" class="form-label"><b>Cargo</b></label>
                                <input type="text" class="form-control" name="cargo" placeholder="Director"
                                    id="cargo" value="{{$responsable->cargo}}" required>
                                <div style="margin:10px 0px;">
                                    @error('cargo')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="telefono_responsable" class="form-label"><b>Telefono</b></label>
                                <input type="text" class="form-control" name="telefono_responsable" id="telefono"
                                    placeholder="7220001111" value="{{$responsable->telefono_responsable}}" required>
                                <div style="margin:10px 0px;">
                                    @error('telefono_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="numero_empleado" class="form-label"><b>Número de empleado</b></label>
                                <input type="numeric" class="form-control" name="numero_empleado" placeholder="00000"
                                    id="numero_empleado" value="{{$responsable->numero_empleado}}">
                                <div style="margin:10px 0px;">
                                    @error('numero_empleado')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="correo" class="form-label"><b>Correo electrónico</b></label>
                                <input type="text" class="form-control" name="correo_responsable" id="correo"
                                    placeholder="correo@email.com" value="{{$responsable->correo_responsable}}">
                                <div style="margin:10px 0px;">
                                    @error('correo_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="folio" class="form-label"><b>Folio de INE</b></label>
                                <input type="numeric" class="form-control" name="folio_ine" id="folio"
                                    placeholder="00000" value="{{ $responsable->folio_ine }}">
                                <div style="margin:10px 0px;">
                                    @error('folio_ine')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-3 mb-3">
                                <label for="situacion_fiscal" class="form-label"><b>VIP</b></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="VIP">
                                    <label class="form-check-label" for="VIP" id="vipLabel">No</label>
                                </div>
                                <input type="hidden" name="vip" id="vipHidden" value="{{$responsable->vip}}">
                                <div style="margin:10px 0px;">
                                    @error('vip')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <label for="situacion_fiscal" class="form-label"><b>Estatus</b></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="estatus">
                                    <label class="form-check-label" for="estatus" id="estatusLabel">Inactivo</label>
                                </div>
                                <input type="hidden" name="estatus" id="estatusHidden" value="{{$responsable->activo}}">
                                <div style="margin:10px 0px;">
                                    @error('estatus')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="ine" class="form-label"><b>INE</b></label>
                                <input type="file" class="form-control" name="a_ine_responsable" id="ine">
                                <div style="margin:10px 0px;">
                                    @error('a_ine_responsable')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save_responsable" class="btn add_agencia">Guardar</button>
                </div>
            </div>
        </form>

        <script>
            $("#save_responsable").on("click", function() {
                var formulario = document.getElementById("formulario");
                var nombre = $("#nombre_responsable").val();
                var cargo = $("#cargo").val();
                var telefono = $("#telefono").val();
                var no_empleado = $("#numero_empleado").val();
                var correo = $("#correo").val();
                var folio = $("#folio").val();
                var VIP = $("#VIP").val();
                var ine = $("#ine").val();
                if (nombre = '' || cargo = '' || telefono = '' || no_empleado = '' || correo = '' || folio = '' || VIP =
                    '' || ine = '') {
                    Swal.fire({
                        title: "Error",
                        text: "Hay campos vacíos, revise nuevamente.",
                        icon: "error"
                    });
                } else {
                    formulario.submit();
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const vipInput = document.getElementById('VIP');
                const vipLabel = document.getElementById('vipLabel');
                const vipHidden = document.getElementById('vipHidden');

                const estatusInput = document.getElementById('estatus');
                const estatusLabel = document.getElementById('estatusLabel');
                const estatusHidden = document.getElementById('estatusHidden');

                // Cambia el texto inicial basado en el estado del interruptor
                vipLabel.textContent = vipInput.checked ? 'Sí' : 'No';
                vipHidden.value = vipInput.checked ? '1' : '0';

                estatusLabel.textContent = estatusInput.checked ? 'Activo' : 'Inactivo';
                estatusHidden.value = estatusInput.checked ? '1' : '0';

                // Agrega un evento para detectar cambios en el interruptor
                vipInput.addEventListener('change', function() {
                    const switchValue = this.checked ? '1' : '0';
                    vipLabel.textContent = this.checked ? 'Sí' : 'No';
                    vipHidden.value = switchValue;
                    console.log('El valor del interruptor VIP es:', switchValue);
                });

                estatusInput.addEventListener('change', function() {
                    const switchValue = this.checked ? '1' : '0';
                    estatusLabel.textContent = this.checked ? 'Activo' : 'Inactivo';
                    estatusHidden.value = switchValue;
                    console.log('El valor del interruptor Estatus es:', switchValue);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Configurar estado inicial del checkbox Estatus
                if ($('#estatusHidden').val() === '1') {
                    $('#estatus').prop('checked', true);
                    $('#estatusLabel').text('Activo');
                } else {
                    $('#estatus').prop('checked', false);
                    $('#estatusLabel').text('Inactivo');
                }

                // Manejar cambio en el checkbox Estatus
                $('#estatus').change(function() {
                    if ($(this).is(':checked')) {
                        $('#estatusLabel').text('Activo');
                        $('#estatusHidden').val('1'); // Asignar valor true (1) al campo oculto
                    } else {
                        $('#estatusLabel').text('Inactivo');
                        $('#estatusHidden').val('0'); // Asignar valor false (0) al campo oculto
                    }
                });
            });
            $(document).ready(function() {
                // Configurar estado inicial del checkbox Estatus
                if ($('#vipHidden').val() === '1') {
                    $('#VIP').prop('checked', true);
                    $('#vipLabel').text('Sí');
                } else {
                    $('#VIP').prop('checked', false);
                    $('#vipLabel').text('No');
                }

                // Manejar cambio en el checkbox Estatus
                $('#VIP').change(function() {
                    if ($(this).is(':checked')) {
                        $('#vipLabel').text('Sí');
                        $('#vipHidden').val('1'); // Asignar valor true (1) al campo oculto
                    } else {
                        $('#vipLabel').text('No');
                        $('#vipHidden').val('0'); // Asignar valor false (0) al campo oculto
                    }
                });
            });
        </script>


    </div>
</div>

