<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Autorizar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mantenimientos/autorizacion/update') }}" method="POST" class="needs-validation" name="">
                @csrf
                {{--  $info_mantenimiento[0]->id_citas_mantenimiento  --}}
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        @if (isset($info_mantenimiento))
                            <div class="col-md-12">
                                <h6 class="font-bold text-gray">Cliente: <span>{{ $info_mantenimiento[0]->asignacion_unidad->cliente->nombre_cliente }}</span></h6> 
                                <h6 class="font-bold text-gray mt-3">I.D. Unidad: <span>{{ $info_mantenimiento[0]->unidad->vehiculo_id }}</span></h6>
                                <h6 class="font-bold text-gray mt-3">Nombre agencia: <span>{{ isset($info_mantenimiento[0]->poliza) ? $info_mantenimiento[0]->poliza->aseguradora->nombre_aseguradora : 'N/A' }}</span></h6>
                                <h6 class="font-bold text-gray mt-3">Monto a autorizar: <span>{{ number_format($autorizacion[0]->monto_mantenimiento,2) }}</span></h6>
                                <h6 class="font-bold text-gray mt-3">Cotización: 
                                    <span>
                                        <a class="btn btn-sm" type="button" style="background: #ed5429;" id="button-addon1" href="{{url('storage/'.$autorizacion[0]->a_cotizacion)}}" download>
                                            <i class="bi bi-download" style="color:#ffffff"></i> Cotizaci&oacute;n.pdf
                                        </a>
                                    </span>
                                </h6>
                                <h6 class="font-bold text-gray mt-3">Observaciones call center: </h6>
                                <textarea class="form-control mt-3" rows="3" readonly>{{ $autorizacion[0]->observaciones_call  }}</textarea>
                                <div class="mt-3">
                                    <div class="form-group">
                                        <label><b>Observaciones administrativas:</b></label>
                                        <textarea class="form-control" rows="3" name="observaciones_flising"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="id_cita_mantenimiento" value="{{ $info_mantenimiento[0]->id_citas_mantenimiento }}" hidden>
                        @endif
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" value="1" name="autorizar" class="btn btn-red rounded-lg d-flex" data-bs-dismiss="modal">
                        Rechazar
                    </button>

                    <button type="submit" value="2" name="autorizar" class="btn btn-green rounded-lg d-flex" data-bs-dismiss="modal">
                        Autorizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>