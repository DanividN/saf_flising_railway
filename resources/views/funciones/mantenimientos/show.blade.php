@extends('layouts.app')
@section('scripts')
    <script defer src="{{asset('js/agendarCita.js')}}"></script>
    <script defer src="{{ asset('js/input-file.js') }}"></script>
@endsection
@section('content')
    @include('components.alertas')
    <div class="container-fluid">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div> 
        @include('components.administracion.detalleUnidad',[
            'cliente' =>  $info_mantenimiento[0]->asignacion_unidad->cliente->nombre_cliente,
            'vehiculo' => $info_mantenimiento[0]->unidad->tipo_unidad->descripcion,
            'tipo_poliza' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->polizas->nombre_poliza : 'N/A',
            'responsable_activo' => $info_mantenimiento[0]->asignacion_unidad->responsable->nombre_responsable,
            'marca' => $info_mantenimiento[0]->unidad->marca->descripcion,
            'no_poliza' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->n_poliza : 'N/A',
            'cargo' => $info_mantenimiento[0]->asignacion_unidad->responsable->cargo,
            'placas' => $info_mantenimiento[0]->asignacion_unidad->placas,
            'gps' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->gps->nombre_gps : 'N/A',
            'telefono' => $info_mantenimiento[0]->asignacion_unidad->responsable->telefono_responsable,
            'motor' => $info_mantenimiento[0]->unidad->n_motor,
            'garantia_extendida' => isset($garantia_extendida) ? $garantia_extendida : 'N/A',
            'idUnidad' => $info_mantenimiento[0]->unidad->vehiculo_id,
            'aseguradora' => isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->aseguradora->nombre_aseguradora : 'N/A'
        ])
        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <form action="{{ route('mantenimientos/seguimiento/store') }}" class="needs-validation" novalidate method="POST" id="form_seguimiento" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <input type="text" value="{{ $info_mantenimiento[0]->id_citas_mantenimiento }}" name="id_citas_mantenimiento" hidden>
                            <input type="text" name="id_unidad" value="{{ $info_mantenimiento[0]->id_unidad }}" hidden>
                            <input type="text" name="unidad_id" value="{{ $info_mantenimiento[0]->unidad->vehiculo_id }}" hidden>
                            <input type="text" name="id_proveedor" value="{{ $info_mantenimiento[0]->id_proveedor }}" hidden>
                            <input type="text" name="responsable" value="{{ $info_mantenimiento[0]->asignacion_unidad->responsable->nombre_responsable }}" hidden>
                            <input type="text" name="placas" value="{{ $info_mantenimiento[0]->asignacion_unidad->placas }}" hidden>
                            <div class="form-group">
                                <label for=""><b>Agencia/Taller</b></label>
                                <input type="text" class="form-control" value="{{ $info_mantenimiento[0]->proveedor->nombre_comercial }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Mantenimiento por</b></label>
                                <input type="text" class="form-control" name="tipo_mantenimiento" value="{{ $info_mantenimiento[0]->tipo_mantenimiento }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Kilometraje</b></label>
                                <input type="text" name="kilometraje" id="kilometraje" class="form-control cantidad" placeholder="Kilometraje" required>  
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de cita</b></label>
                                <input type="text" class="form-control" value="{{ $info_mantenimiento[0]->fecha_mantenimiento }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de mantenimiento</b></label>
                                <input type="text" class="datepicker form-control" autocomplete="off" id="fecha_mant" name="fecha_mantenimiento" placeholder="dd/mm/aaaa" required>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Monto de mantenimiento con IVA</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control monto_mantenimiento" placeholder="Monto con IVA" name="monto_mantenimiento" id="monto_mantenimiento" required>
                                    <input type="text" value="{{ $info_mantenimiento[0]->unidad->costo_mantenimiento }}" id="max_mantenimiento" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Tipo de mantenimiento</b></label>
                                <input type="text" class="form-control" value="Preventivo" id="preventivo" readonly>
                                <input type="text" class="form-control" value="Correctivo" id="correctivo" readonly hidden>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Nivel de autorización</b></label>
                                <input type="text" class="form-control" name="autorizacion" id="autorizacion" value="Basico" readonly>
                                {{--  <input type="text" class="form-control" name="autorizacion" id="advanced" value="Avanzado" readonly hidden>  --}}
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Estatus</b><span class="text-danger">*</span></label>
                                <select class="menu" name="status_cancelado" id="status_cancelado">
                                    <option value="" hidden>-- Selecciona una opción --</option>
                                    <option value="CANCELADO">Cancelado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Cotización</b></label>
                                <input type="file" name="a_cotizacion" id="archivo-input" accept="application/pdf" class="input-archivo cotizacion">
                            </div>
                        </div>

                        <input type="text" name="correo_responsable" value="{{ $info_mantenimiento[0]->asignacion_unidad->responsable->correo_responsable }}" hidden>

                        <div class="col-md-4 mt-4" id="factura">
                            <div class="form-group">
                                <label for=""><b>Factura</b></label>
                                <input type="file" name="a_factura" id="archivo-input" accept="application/pdf" class="input-archivo factura">
                            </div>
                        </div>
                {{---------------------boton toogle------------------------}}
                    <div class="col-md-4 mt-4" id="check_payment">
                        <label><b>Estatus</b></label>
                        <div class="input-group mb-3">
                            <label class="switch">
                                <input type="checkbox" id="pagado" value="">
                                <span class="slider round"></span>
                            </label>
                            <input type="text" class="switch_label" id="pagado_label" value="No pagado" readonly>
                        </div>
                    </div>
                    <input type="text" name="estatus_pago" id="estatus_pago" value="" hidden>
                {{-----------------------------------------------------}}
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" name="observaciones_call" placeholder="Observaciones" id="observaciones"></textarea>
                                    <label for="floatingTextarea">Observaciones</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-4">
                        <a  href="{{url('funciones/mantenimientos/informacion',$info_mantenimiento[0]->unidad->id_unidad)}}" class="btn btn-regresar">Regresar</a>
                        <button type="button" class="btn btn-enviar" id="basico">Guardar</button>
                        <button type="button" class="btn btn-solicitar" id="avanzado" hidden>Solicitar autorizaci&oacute;n</button>
                        {{-- @include('components.btn-regresar', ['Url' => 'verificacion/informacion']) --}}
                        {{--  El text es opcional, por default es 'Guardar'  --}}
                        {{-- @include('components.btn-enviar', [
                            'link' => 'tenencias.index',
                        ]) --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection