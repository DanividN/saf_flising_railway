@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
<style>
    .select2-container {
        width: 100% !important;
    }
</style>
<div class="modal fade" id="modal-asignar-garantias_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-asignar-garantias_id" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar garantías flising</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('garantias_flising.update', $garantias_flising) }}" method="POST"
                id="formulario_editar" class="needs-validation" novalidate onsubmit="validateForm(this)">

                @csrf
                @method('PUT')
                <input type="hidden" name="hidden_id_unidad" id="hidden_id_unidad"
                    value="{{ $garantias_flising->id_unidad }}">
                <input type="hidden" name="hidden_id_asignacion_unidad" id="hidden_id_asignacion_unidad"
                    value="{{ $garantias_flising->UltimoArrendamiento->id_asignacion_unidad }}">
                <input type="hidden" name="selected_garantias" id="selected_garantias">
                <input type="hidden" name="garantia_extendida_base" id="garantia_extendida_base" value="">


                <div class="modal-body">
                    {{-- <div class="row d-flex justify-content-center">
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <div>
                                    <label for="id_unidad"><b>I.D. Unidad</b><span class="require">*</span></label>
                                </div>

                                <select name="id_unidad" id="id_unidad" class="single-select-field" disabled required>
                                    @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad->id_unidad }}" @selected($unidad->id_unidad == $garantias_flising->id_unidad)>
                                            {{ $unidad->vehiculo_id }}
                                        </option>
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
                                <input type="text" class="menu" name="cliente" id="clienteInput" value=""
                                    data-id_unidad="" data-id_asignacion_unidad="" data-id_cliente="">
                            </div>
                        </div>

                    </div> --}}
                    <div class="table-responsive mt-4">
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
                                    @php
                                         $isChecked = $garantiasSeleccionadas->contains(function ($item) use ($garantia) {
                                            return $item['id_garantia_proveedor'] === $garantia->id_g_flising_extendidas 
                                            && $item['status'] !== 0
                                            && $item['fecha_final'] >= date("Y-m-d");
                                        });
                                    @endphp
                                    <tr class="text-center" id="garantia-{{ $garantia->id_g_flising_extendidas }}">
                                        <td>
                                            <label class="containercheck">
                                                <input type="checkbox" class="lista" name="id_garantia_proveedor"
                                                    value="{{ $garantia->id_g_flising_extendidas }}"
                                                    onchange="toggleDatePickerEdit(this,{{ $garantia->id_g_flising_extendidas }}, '{{ $garantia->nombre_g_extendida }}', {{ $garantia->vigencia_g_extendida }}, {{ $garantia->monto_g_extendida }},{{ $garantias_flising->id_unidad }},{{ $garantias_flising->UltimoArrendamiento->id_asignacion_unidad }})"
                                                    @if ($isChecked) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $garantia->nombre_g_extendida }}</td>
                                        <td id="vigencia">{{ $garantia->vigencia_g_extendida }} meses</td>
                                        <td>${{ number_format($garantia->monto_g_extendida, 2, '.', ',') }}</td>
                                        <td>
                                            @if ($isChecked)
                                                @php
                                                    // Encuentra el ítem seleccionado
                                                    $selectedItem = $garantiasSeleccionadas->firstWhere(
                                                        'id_garantia_proveedor',
                                                        $garantia->id_g_flising_extendidas,
                                                    );
                                                    @endphp
                                                    {{-- @dd( $selectedItem->id_unidad_garantia); --}}
                                                <input type="text" name="fecha_inicial"
                                                    class="datepicker form-control" style="display: block;"
                                                    value="{{ date('d/m/Y', strtotime($selectedItem->fecha_inicial)) }}"
                                                    onchange="
                                                        updateFecha(
                                                            this.value, 
                                                            {{ $garantia->id_g_flising_extendidas }},
                                                            '{{ $garantia->nombre_g_extendida }}',
                                                            {{ $garantias_flising->id_unidad }},
                                                            {{ $garantia->vigencia_g_extendida }},
                                                            {{ $garantia->monto_g_extendida }},
                                                            {{ $garantias_flising->UltimoArrendamiento->id_asignacion_unidad }},
                                                            {{ $selectedItem->id_unidad_garantia }},
                                                        )
                                                    ">


                                                <input type="hidden" name="hidden_vigencia" class="hidden-vigencia"
                                                    value="{{ $garantia->vigencia_g_extendida }}">
                                            @else
                                                <input type="text" class="datepicker form-control"
                                                    name="fecha_inical[]" placeholder="dd/mm/aaaa"
                                                    style="display: none;">

                                                <input type="hidden" name="hidden_vigencia" class="hidden-vigencia">
                                            @endif
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
@section('scripts')
    
    <script src="{{ asset('js/asignacionUnidad/validForm.js') }}"></script>
@endsection
