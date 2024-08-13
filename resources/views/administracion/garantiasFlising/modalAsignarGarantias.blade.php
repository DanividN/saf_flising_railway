{{-- MODAL------------------------------------------------------- --}}
<div class="modal fade" id="modal-asignar-garantias_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-asignar-garantias_id" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar garantias flising</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('garantias_flising.store') }}" method="POST" id="formulario_extendidas">
                <input type="hidden" name="hidden_id_unidad" id="hidden_id_unidad">
                <input type="hidden" name="hidden_vehiculo_id" id="hidden_vehiculo_id">
                <input type="hidden" name="hidden_id_asignacion_unidad" id="hidden_id_asignacion_unidad">
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <label for="cliente"><b>Cliente</b></label>
                                <select class="menu" name="" id="clienteSelect" onchange="">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="" selected>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <label for="cliente"><b>I.D. Unidad</b></label>
                                <select class="menu" name="id_unidad" id="unidades">
                                    <option hidden>-- Selecciona una opción --</option>
                                    <option value="" selected data-id_asignacion_unidad="" data-vehiculo_id="">

                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr class="text-center">

                                    <th scope="col"class="encabezado"></th>
                                    <th scope="col"class="encabezado">No.</th>
                                    <th scope="col"class="encabezado">Tipo de Garantía</th>
                                    <th scope="col"class="encabezado">Vigencia</th>
                                    <th scope="col"class="encabezado">Monto con IVA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <label class="containercheck">
                                            <input type="checkbox" name="" value="" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>MESES</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-regresar rounded-lg d-flex" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-enviar rounded-lg d-flex">
                        Agendar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/garantias/administracion/index.js') }}"></script>
{{-- .......................................................... --}}
