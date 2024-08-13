<div class="modal fade" id="supervisionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asignar-garantias" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agendar supervisión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('supervision.agendar.cita') }}" class="needs-validation" novalidate method="POST" id="form-agendar-supervision">
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <label for="cliente"><b>Cliente</b><span class="text-danger">*</span></label>
                                <select class="form-select" name="id_cliente" id="id_cliente" required>
                                    <option value="" disabled selected>Seleccionar Cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_cliente }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <label for="cliente"><b>Supervisor</b><span class="text-danger">*</span></label>
                                <select class="form-select" name="id_usuario" id="id_usuario" required>
                                    <option value="" disabled selected>Seleccionar Supervisor</option>
                                    @foreach ($supervisores as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <label for="fecha"><b>Fecha</b><span class="text-danger">*</span></label><br>
                                <input type="text" id="datepicker" class="form-control datepicker" placeholder="dd/mm/aaaa" name="fecha_supervision">
                            </div>
                        </div>

                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="form-group">
                                <label for="hora"><b>Hora</b><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="hora" required>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-4" style="max-height: 300px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    {{-- <th scope="col" class="encabezado">Activar</th> --}}
                                    <th scope="col" class="encabezado"></th>
                                    <th scope="col" class="encabezado">No.</th>
                                    <th scope="col" class="encabezado">Placa</th>
                                    <th scope="col" class="encabezado">I.D. Unidad</th>
                                    <th scope="col" class="encabezado">Responsable de activo</th>
                                    <th scope="col" class="encabezado">Numero de empleado</th>
                                </tr>
                            </thead>
                            <tbody id="listado-unidades"></tbody>
                        </table>
                    </div>
                </div>

                <div style="display: flex !important; justify-content: center !important; display: none !important;" id="spinner">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
          
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-regresar rounded-lg d-flex" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-orange-submit rounded-lg d-flex" id="btn-agendar-supervision">
                        Agendar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>