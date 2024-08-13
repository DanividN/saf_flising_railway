@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
<style>
    .select2-container {
        width: 100% !important;
    }
    @media (max-width: 576px) { /* Pantallas pequeñas */
        .input-custom-width {
            width: 7rem; /* Ancho deseado */
        }
    }
</style>
<div class="modal fade" id="modal-asignar-garantias_id" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-asignar-garantias_id" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange">Agregar garantías flising</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card-body">
                <form action="{{ route('garantias_flising.store') }}" method="POST" id="formulario_extendidas" class="needs-validation" onsubmit="validateForm(this)" novalidate>
                    <input type="hidden" name="selected_garantias" id="selected_garantias">
                    <input type="hidden" name="hidden_id_unidad" id="hidden_id_unidad">
                    <input type="hidden" name="hidden_vehiculo_id" id="hidden_vehiculo_id"> 
                    <input type="hidden" name="hidden_id_asignacion_unidad" id="hidden_id_asignacion_unidad">

                    @csrf
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="form-group">
                                    <div>
                                        <label for="id_unidad"><b>I.D. Unidad</b><span class="require">*</span></label>
                                    </div>

                                    <select name="id_unidad" id="id_unidad" class="single-select-field form-control"
                                        onchange="obtenerCliente(this.value)" required>
                                        <option hidden value="">-- Selecciona una opción --</option>
                                        @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id_unidad }}">{{ $unidad->vehiculo_id }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback text-start">
                                        <p class="text-danger">Seleccione una opción</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="form-group">
                                    <label for="cliente"><b>Cliente</b></label>
                                    <input type="text" class="form-control" name="cliente" id="clienteInput" value=""
                                        data-id_unidad="" data-id_asignacion_unidad="" data-id_cliente="" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive-xl mt-4">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="encabezado"></th>
                                        <th scope="col" class="encabezado">No.</th>
                                        <th scope="col" class="encabezado">Tipo de Garantía</th>
                                        <th scope="col" class="encabezado">Vigencia</th>
                                        <th scope="col" class="encabezado">Monto con IVA</th>
                                        <th scope="col" class="encabezado">Fecha Inicial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($garantiasDisponibles as $garantia)
                                        <tr id="garantia-{{ $garantia->id_g_flising_extendidas }}" class="text-center">
                                            <td>
                                                <label class="containercheck">
                                                    <input type="checkbox" class="lista" name="id_garantia_proveedor[]"
                                                        value="{{ $garantia->id_g_flising_extendidas }}"
                                                        onchange="
                                                            toggleDatePicker(
                                                                this,
                                                                '{{ $garantia->id_g_flising_extendidas }}', 
                                                                '{{ $garantia->nombre_g_extendida }}', 
                                                                '{{ $garantia->vigencia_g_extendida }}', 
                                                                '{{ number_format($garantia->monto_g_extendida, 2, '.', ',') }}'
                                                            )"
                                                        disabled><span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $garantia->nombre_g_extendida }}</td>
                                            <td id="vigencia">{{ $garantia->vigencia_g_extendida }} meses</td>
                                            <td>${{ number_format($garantia->monto_g_extendida, 2, '.', ',') }}</td>
                                            <td>
                                                <div class="input-custom-width">
                                                    <input type="text" class="datepicker form-control" name="fecha_inical[]" placeholder="dd/mm/aaaa" style="display: none;">
                                                    <input type="hidden" name="hidden_vigencia[]" class="hidden-vigencia">
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="button" class="btn btn-regresar rounded-lg d-flex"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-enviar rounded-lg d-flex">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/asignacionUnidad/validForm.js') }}"></script>
@endsection
