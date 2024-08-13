<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Garantia Extendida</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


    <!-- Modal -->
    <div class="modal fade @if ($errors->any()) show @endif" id="modalEditarGarantia" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Garantia Extendida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('garantias_seguimiento.store') }}" id="miFormulario" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_g_extendida" class="form-label">Tipo de Garantia</label>
                            <input type="text" class="form-control" id="nombre_g_extendida" name="nombre_g_extendida">
                            <div>
                                @if ($errors->has('nombre_g_extendida'))
                                    <div class="alert alert-danger">{{ $errors->first('nombre_g_extendida') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label><b>Vigencia (en meses) <span class="require">*</span></b></label>
                            <div class="wrapper">
                                <div class="content">
                                    <div class="range-slider">
                                        <input type="range" name="vigencia_g_extendida" min="0" max="36" value="0" class="range-input" id="range4" step="12"/>
                                        <div class="sliderticks">
                                            <span>0</span>
                                            <span>12</span>
                                            <span>24</span>
                                            <span>36</span>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="monto_g_extendida" class="form-label">Monto con I.V.A</label>
                            <input type="text" class="form-control" id="monto_g_extendida" name="monto_g_extendida">
                            <div>
                                @if ($errors->has('monto_g_extendida'))
                                    <div class="alert alert-danger">{{ $errors->first('monto_g_extendida') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="a_evidencia_extendida" class="form-label">Evidencia de Garantía</label>
                            <input type="file" class="form-control" name="a_evidencia_extendida" id="a_evidencia_extendida" accept="application/pdf" onchange="validarPDF()">
                            <div>
                                @if ($errors->has('a_evidencia_extendida'))
                                    <div class="alert alert-danger">{{ $errors->first('a_evidencia_extendida') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_g_extendida" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion_g_extendida" name="descripcion_g_extendida">
                        </div>
                        <label for="activo">Estatus</label>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo" onchange="actualizarValorActivo()">
                                <label class="form-check-label" id="labelEstatus" for="activo">Inactivo</label>
                                <input type="hidden" name="activo_hidden" id="activo_hidden" value="0">
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="guardarBtn" disabled>Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function actualizarValorActivo() {
        var checkbox = document.getElementById('activo');
        var activoHidden = document.getElementById('activo_hidden');
        var labelEstatus = document.getElementById('labelEstatus');

        if (checkbox.checked) {
            activoHidden.value = '1';
            labelEstatus.textContent = 'Activo';
        } else {
            activoHidden.value = '0';
            labelEstatus.textContent = 'Inactivo';
        }
    }
        $(document).ready(function() {
            // Mostrar modal si hay errores de validación
            if (@json($errors->any())) {
                var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                myModal.show();
            }

            // Validar campos y habilitar/deshabilitar botón "Guardar"
            function validarCampos() {
                let hasValue = false;
                $('#miFormulario input').each(function() {
                    if ($(this).val().trim() !== '') {
                        hasValue = true;
                        return false;  // Rompe el bucle si encuentra un campo con valor
                    }
                });

                if (hasValue) {
                    $('#guardarBtn').prop('disabled', false);
                } else {
                    $('#guardarBtn').prop('disabled', true);
                }

                return hasValue;
            }

            // Evento para validar campos en tiempo real
            $('#miFormulario input').on('input change', function() {
                validarCampos();
            });

            // Validar el formulario al hacer clic en "Guardar"
            $('#guardarBtn').click(function(e) {
                if (!validarCampos()) {
                    e.preventDefault();
                    $('#staticBackdrop').modal('hide');
                }
            });
        });

    </script>
    <script>
        
            // Validar PDF
            function validarPDF() {
        let input = document.getElementById('a_evidencia_extendida');
        let archivo = input.files[0];
        let extension = archivo.name.split('.').pop().toLowerCase();

        if (extension !== 'pdf') {
            Swal.fire('Por favor, selecciona un formato PDF.');
            input.value = '';
            return false;
        }
    }
    </script>
</body>
</html>
