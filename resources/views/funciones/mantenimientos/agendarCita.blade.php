
<div class="modal fade" id="agendarMantenimiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asignar-garantias" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agendar mantenimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mantenimientos/informacion/store') }}" id="formulario_citas" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Entidad federativa</b><span class="text-danger">*</span></label>
                                <select class="menu" style="height:35px;" id="estado">
                                    <option selected hidden>-- Seleccionar --</option>
                                    @if(isset($entidad_federativa))
                                        @foreach ($entidad_federativa as $item)
                                            <option value="{{ $item->id_entidad_federativa }}">{{ $item->nombre_entidad_federativa }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Municipio/Alcaldía</b><span class="text-danger">*</span></label>
                                <select class="menu single-select-field municipio" name="id_municipio" style="height:35px !;width:100%;" id="municipio">
                                </select>
                            </div>
                        </div>
                        @if (isset($unidad_id))
                            @php
                                $correo_cliente = DB::table('asignacion_unidades')
                                ->join('responsables','responsables.id_responsable','asignacion_unidades.id_responsable')
                                ->select(
                                    'responsables.correo_responsable'
                                )
                                ->where('asignacion_unidades.id_unidad', $unidad_id)
                                ->where('asignacion_unidades.activo',1)
                                ->get();
                                //dd($unidad_id,$correo_cliente);
                            @endphp
                            <input type="text" name="correo_responsable" value="{{ $correo_cliente[0]->correo_responsable }}" hidden>
                            <input type="text" name="id_unidad" class="form-control" id="unidad_id" value="{{ $unidad_id }}" placeholder="Kilometraje" hidden> 
                        @endif
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Agencia/Taller</b><span class="text-danger">*</span></label>
                                <select class="menu single-select-field" name="id_proveedor" style="height:35px;" id="proveedores">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Dirección</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="direccion_prov" value="Dirección de la agencia o taller" disabled>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Mantenimiento por</b><span class="text-danger">*</span></label><br>
                                <select class="menu" name="tipo_mantenimiento" style="height:35px;" id="tipo_mantenimiento">
                                    <option value="" hidden>-- Selecciona una opción --</option>
                                    <option value="1">Kilometraje</option>
                                    <option value="2">Periodo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>D&iacute;as desde el último mantenimiento</b></label>
                                <input type="text" class="form-control" id="periodo_transcurrido" value="" placeholder="Periodo" readonly>  
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Kilometraje</b><span class="text-danger">*</span></label>
                                <input type="text" name="kilometraje" id="kilometraje" class="form-control cantidad" placeholder="Kilometraje">  
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Fecha</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_mantenimiento" id="fecha_mantenimiento" autocomplete="off" class="datepicker form-control" placeholder="dd/mm/aaaa">
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Hora</b><span class="text-danger">*</span></label>
                                <input type="time" name="hora_mantenimiento" id="hora_mantenimiento" class="form-control" placeholder="Hora de mantenimiento">
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="cliente"><b>Adjuntar cita</b><span class="text-danger">*</span></label><br>
                                <input type="file" name="a_cita_mantenimiento" id="archivo-input" accept="application/pdf" class="input-archivo" placeholder="Adjuntar cita" style="width:368px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-orange rounded-lg d-flex" id="cita_submit">Agendar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src='{{asset('js/buscadorMunicipios.js')}}'></script>
<script src="{{asset('js/agendarCita.js')}}"></script>
<script defer src="{{ asset('js/input-file.js') }}"></script>