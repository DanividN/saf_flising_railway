<div class="modal fade" id="exampleModal{{$poliza->id_poliza_seguro}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{route('aseguradoras.tracking.update', $poliza->id_poliza_seguro)}}" id="validacion{{$poliza->id_poliza_seguro}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header border-0">
                    <h5 class="modal-title title-orange" id="staticBackdropLabel">Editar póliza</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="id_aseguradora" value="{{$aseguradora[0]->id_aseguradora}}" hidden>
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex justify-content-start">
                                <label for="">Nombre de póliza<span class="text-danger">*</span></label>
                            </div>
                            <input type="text" name="nombre_poliza" value="{{$poliza->nombre_poliza}}" class="form-control" placeholder="Nombre de póliza" required>
                            @error('nombre_poliza')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex justify-content-start">
                                <label for="">Porcentaje de daño material<span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">%</span>
                                <input type="text" name="dano_material" value="{{$poliza->dano_material}}" class="form-control" placeholder="00" required>
                            </div>
                            @error('dano_material')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex justify-content-start">
                                <label for="">Porcentaje de robo total<span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">%</span>
                                <input type="text" name="robo_total" value="{{$poliza->robo_total}}" class="form-control" placeholder="00" required>
                            </div>
                            @error('robo_total')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex justify-content-start">
                                <label for="">Documento de póliza</label>
                            </div>
                            <div class="input-group">
                                @if (isset($poliza->a_poliza))
                                    <a href="{{ url('storage/' . $poliza->a_poliza) }}" download class="input-download-link">
                                        <span class="input-group-text icono-download"><i class="bi bi-download"></i></span>
                                    </a>
                                @endif
                                <input
                                    type="file"
                                    name="a_poliza"
                                    value="{{ $poliza->a_poliza }}"
                                    class="input-archivo-down"
                                    id="archivo-input-down{{$aseguradora[0]->id_aseguradora}}"
                                    data-id="{{$aseguradora[0]->id_aseguradora}}"
                                    placeholder="Documento de póliza"
                                >
                                @error('a_poliza')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="d-flex justify-content-start">
                                <label><b>Estatus</b></label>
                            </div>
                            <div class="input-group mb-3">
                                @if ($poliza->activo == 1)
                                    <label class="switch">
                                        <input type="checkbox" name="activo" id="active{{ $poliza->id_poliza_seguro }}" value="1" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="text" class="switch_label" id="active_label{{ $poliza->id_poliza_seguro }}" value="Activo" readonly>
                                @endif
                                @if ($poliza->activo == 0)
                                    <label class="switch">
                                        <input type="checkbox" name="activo" id="not_active{{ $poliza->id_poliza_seguro }}" value="0">
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="text" class="switch_label" id="inactive_label{{ $poliza->id_poliza_seguro }}" value="Inactivo" readonly>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $count = DB::select("SELECT COUNT(*) as count FROM asignacion_seguros WHERE id_poliza_seguro = ? AND activo = 1", [$poliza->id_poliza_seguro]);
                    $exists = $count[0]->count > 0;
                @endphp

                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-enviar rounded-lg d-flex"
                            @if($exists) disabled @endif>
                        Editar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        {{--  Activo  --}}
        $("#active" + {{ $poliza->id_poliza_seguro }}).on("change", function(){
            $("#active_label" + {{ $poliza->id_poliza_seguro }}).val("Inactivo");
        });
        $("#active" + {{ $poliza->id_poliza_seguro }}).on("change", function(){
            if($(this).is(":checked")){
                $("#active_label" + {{ $poliza->id_poliza_seguro }}).val("Activo");
            }
        });
        {{--  Inactivo  --}}
        $("#not_active" + {{ $poliza->id_poliza_seguro }}).on("change", function(){
            if($(this).is(":checked")){
                $("#inactive_label" + {{ $poliza->id_poliza_seguro }}).val("Activo");
            }else{
                $("#inactive_label" + {{ $poliza->id_poliza_seguro }}).val("Inactivo");
            }
        });
    });
</script>
