<div class="modal fade" id="agendarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-asignar-garantias" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agendar verificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id='FormAgendarCita' action="{{ route('verificacion.agendar', 0) }}" method='POST'>
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Entidad federativa</b><span
                                        class="text-danger">*</span></label>
                                <select class="menu" style="width: 200px; height: 30px;">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="1">Entidad 1</option>
                                    <option value="2">Entidad 2</option>
                                    <option value="3">Entidad 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Municipio/Alcaldía</b><span
                                        class="text-danger">*</span></label>
                                <select class="menu" style="width: 200px; height: 30px;">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="1">Municipio 1</option>
                                    <option value="2">Municipio 2</option>
                                    <option value="3">Municipio 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Verificentro</b><span class="text-danger">*</span></label>
                                <select class="menu" style="width: 200px; height: 30px;">
                                    <option selected disabled>-- Selecciona una opción --</option>
                                    <option value="1">Verificentro 1</option>
                                    <option value="2">Verificentro 2</option>
                                    <option value="3">Verificentro 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Dirección</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="Dirección del verificentro" disabled>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Fecha</b><span class="text-danger">*</span></label>
                                <input type="text" class="datepicker form-control" placeholder="dd/mm/aaaa">
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Hora</b><span class="text-danger">*</span></label>
                                <input type="time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Adjuntar Cita</b><span class="text-danger">*</span></label><br>
                                <input type="file" class="input-archivo" id="archivo">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-enviar rounded-lg d-flex">Agendar</button>
                </div>
            </form>
        </div>
    </div>
</div>
