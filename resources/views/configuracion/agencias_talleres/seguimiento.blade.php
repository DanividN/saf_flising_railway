@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/input-file.js') }}"></script>
    <script src="{{asset('js/datatable.js')}}"></script> 
@endsection
@section('content')
    @include('components.alertas')
        <div>
            {{-- <div class="regresar_btn mb-2">
                <a href="{{ url('configuracion/agencias_talleres/index') }}" class="btn btn-outline-light btn_back"><i class="bi bi-arrow-90deg-left"></i> Regresar</a>
            </div> --}}
            {{--  Datos de proveedor  --}}
            <div class="titulo-responsive mb-0">
                <label><a>Lista de garantías</a></label>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <h5 class="title-orange"></h5>
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>Nombre:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->nombre_comercial }}" readonly>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>Tipo:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->tipo }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>Raz&oacute;n Social:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->razon_social }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>RFC:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->rfc_proveedor }}">
                                </div>
                            </div>
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>Fecha de registro:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->fecha_registro }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>Tel&eacute;fono:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->telefono_proveedor }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text span_grp text-black"><b>Municipio:</b></span>
                                    <input type="text" class="form-control input_grp" value="{{ $proveedor[0]->nombre_municipio }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  Tabla de garantías  --}}
            <div class="card mt-2">
                <div class="">
                    <div class="d-flex justify-content-end align-items-center mt-5 me-3">
                            <button type="button" class="btn add_agencia" data-bs-toggle="modal" data-bs-target="#garantiaModal"
                                id="btn-pantcomp">
                                <i class="bi bi-plus-lg"></i> Agregar garant&iacute;a
                            </button>

                            <button type="button" class="btn add_agencia" data-bs-toggle="modal" data-bs-target="#garantiaModal"
                                id="btn-responsive">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    <!-- Modal -->
                    <div class="modal fade" id="garantiaModal" tabindex="-1" aria-labelledby="garantiaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <form action="{{ route('agencias_talleres/garantiaStore') }}" enctype="multipart/form-data" id="formulario" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 contacto_registro" id="garantiaModalLabel">Agregar garant&iacute;a extendida</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <input type="text" name="activo" value="1" hidden>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input type="text" name="id_proveedor" value="{{ $id_proveedor }}" hidden>
                                                <div class="col-md-6 col-sm-12">
                                                    <label><b>Nombre de garant&iacute;a <span class="require">*</span></b></label>
                                                    <input type="text" class="form-control" id="nombre_g_proveedor" name="nombre_g_proveedor">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label><b>Vigencia (en meses) <span class="require">*</span></b></label>
                                                    <div class="wrapper">
                                                        <div class="content">
                                                            <div class="range-slider">
                                                                <input type="range" name="vigencia_g_proveedor" min="0" max="36" value="0" class="range-input" id="range4" step="12"/>
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
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 col-sm-12">
                                                    <label><b>Monto con I.V.A <span class="require">*</span></b></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="bi bi-currency-dollar"></i>
                                                        </span>
                                                        <input type="text" class="form-control numero1" id="monto_g_proveedor" onkeypress="return valideKey(event);">
                                                        <input type="text" class="form-control numero1" value="" name="monto_g_proveedor" id="real_monto_g_proveedor" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label><b>Evidencia de garant&iacute;a <span class="require">*</span></b></label>
                                                    <input type="file" class="input-archivo" id="archivo-input" accept="application/pdf" name="a_g_evidencia">
                                                </div>
                                            </div>

                                            <div class="col-md-4 mt-2">
                                                <div class="form-group">
                                                  <label for="flexSwitchCheckCheckedDisabled"><b>Estatus:</b></label>
                                                  <div class="form-check form-switch custom-control">
                                                    <span>&nbsp;Activo</span>
                                                    <input class="form-check-input custom-control" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" checked style="width: 40px; height: 20px;">
                                                  </div>
                                                </div>
                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" id="save_garantia" class="btn add_agencia">Guardar</button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                $("#save_garantia").on("click", function(){
                                    var formulario = document.getElementById("formulario");
                                    var garantia = $("#nombre_g_proveedor").val();
                                    var vigencia = $("#range4").val();
                                    var monto = $("#monto_g_proveedor").val();
                                    var monto_u = monto.replaceAll(",",'')
                                    $("#real_monto_g_proveedor").val(monto_u);
                                    var evidencia = $("#archivo-input").val();
                                    if(garantia == '' || vigencia == '' || monto_u == '' || evidencia == ''){
                                        Swal.fire({
                                            title: "Error",
                                            text: "Hay campos vacíos, revise nuevamente.",
                                            icon: "error"
                                        });
                                    }else{
                                        formulario.submit();
                                    }
                                });
                                // Formato de miles
                                $(function() {
                                    new AutoNumeric('.numero1', {
                                        decimalPlaces: 2
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center encabezado">No.</th>
                                    <th class="text-center encabezado">Nombre de garant&iacute;a</th>
                                    <th class="text-center encabezado">Vigencia</th>
                                    <th class="text-center encabezado">Monto</th>
                                    <th class="text-center encabezado">Evidencia</th>
                                    <th class="text-center encabezado">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($garantias))
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($garantias as $garantia)
                                        <tr>
                                            <td class="text-center align-middle">{{ ++$i }}</td>
                                            <td class="text-center align-middle">{{ $garantia->nombre_g_proveedor }}</td>
                                            <td class="text-center align-middle">{{ $garantia->vigencia_g_proveedor }} meses</td>
                                            <td class="text-center align-middle">${{ $garantia->monto_g_proveedor }}</td>
                                            <td class="text-center align-middle">
                                                <a href="{{url('storage/'.$garantia->a_g_evidencia)}}" target="__blank" class="boton-pdf">
                                                </a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                    </a>
                                                    <ul class="dropdown-menu p-0">
                                                        <li>
                                                            <a class="dropdown-item">
                                                                <button type="button" class="btn btn_edit_garantia btn-sm" data-bs-toggle="modal" data-bs-target="#garantiaModal{{ $garantia->id_garantia_proveedor }}">
                                                                    Ver / Editar
                                                                </button>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Garantia -->
                                        <div class="modal fade" id="garantiaModal{{ $garantia->id_garantia_proveedor }}" tabindex="-1" 
                                            aria-labelledby="exampleModalLabel{{ $garantia->id_garantia_proveedor }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <form action="{{ route('agencias_talleres/garantiaUpdate',$garantia->id_garantia_proveedor) }}" enctype="multipart/form-data" id="formulario_update" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 contacto_registro" id="exampleModalLabel{{ $garantia->id_garantia_proveedor }}">Editar garant&iacute;a extendida</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                {{--  GARANTIAS EDIT  --}}
                                                                @php
                                                                    $garantias = DB::SELECT("SELECT * FROM garantia_proveedores WHERE id_garantia_proveedor = $garantia->id_garantia_proveedor");
                                                                @endphp
                                                                <div class="row">
                                                                    <input type="text" name="id_proveedor" value="{{ $id_proveedor }}" hidden>
                                                                    <input type="text" name="id_garantia_proveedor" value="{{ $garantia->id_garantia_proveedor }}" hidden>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label><b>Nombre de garant&iacute;a <span class="require">*</span></b></label>
                                                                        <input type="text" class="form-control" id="nombre_g_proveedor" value="{{ $garantias[0]->nombre_g_proveedor }}" name="nombre_g_proveedor" required>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label><b>Vigencia (en meses) <span class="require">*</span></b></label>
                                                                        <div class="wrapper">
                                                                            <div class="content">
                                                                                <div class="range-slider">
                                                                                    <input type="range" name="vigencia_g_proveedor" min="0" max="36" value="{{ $garantias[0]->vigencia_g_proveedor }}" class="range-input" id="range4" step="12" required/>
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
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label><b>Monto con I.V.A <span class="require">*</span></b></label>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <i class="bi bi-currency-dollar"></i>
                                                                            </span>
                                                                            <input type="text" class="input-archivo-down" value="{{ $garantias[0]->monto_g_proveedor }}" name="monto_g_proveedor" 
                                                                            id="monto_g_proveedor_upd{{ $garantia->id_garantia_proveedor }}" onkeypress="return valideKey(event);" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label><b>Evidencia de garant&iacute;a <span class="require">*</span></b></label>
                                                                        <div class="input-group">
                                                                            @if (isset($garantia->a_g_evidencia))
                                                                                <a href="{{ url('storage/' . $garantia->a_g_evidencia) }}" download class="input-download-link">
                                                                                    <span class="input-group-text icono-download"><i class="bi bi-download"></i></span>
                                                                                </a>
                                                                            @endif
                                                                            <input
                                                                                type="file"
                                                                                name="a_g_evidencia"
                                                                                value="{{ $garantia->a_g_evidencia }}"
                                                                                class="input-archivo-down"
                                                                                id="a_g_evidencia"
                                                                                data-id="a_g_evidencia"
                                                                                placeholder="Documento de póliza"
                                                                            >
                                                                        </div>
                                                                        {{--  <a href="{{url('storage/'.$garantia->a_g_evidencia)}}" download class="input-download-link">
                                                                            <span class="input-group-text icono-download"><i class="bi bi-download"></i></span>
                                                                        </a>
                                                                        <input type="file" class="input-archivo-down" id="a_g_evidencia" accept="application/pdf" name="a_g_evidencia">  --}}
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label><b>Estatus</b></label>
                                                                        <div class="input-group mb-3">
                                                                            @if ($garantia->activo == 1)
                                                                                <label class="switch">
                                                                                    <input type="checkbox" name="activo" id="active{{ $garantia->id_garantia_proveedor }}" value="1" checked>
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                                <input type="text" class="switch_label" id="active_label{{ $garantia->id_garantia_proveedor }}" value="Activo" readonly>
                                                                            @endif
                                                                            @if ($garantia->activo == 0)
                                                                                <label class="switch">
                                                                                    <input type="checkbox" name="activo" id="not_active{{ $garantia->id_garantia_proveedor }}" value="0">
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                                <input type="text" class="switch_label" id="inactive_label{{ $garantia->id_garantia_proveedor }}" value="Inactivo" readonly>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        $(document).ready(function(){
                                                                            new AutoNumeric('#monto_g_proveedor_upd' + {{ $garantia->id_garantia_proveedor }},{
                                                                                decimalPlaces: 2,
                                                                            });
                                                                            {{--  Activo  --}}
                                                                            $("#active" + {{ $garantia->id_garantia_proveedor }}).on("change", function(){
                                                                                $("#active_label" + {{ $garantia->id_garantia_proveedor }}).val("Inactivo");
                                                                            });
                                                                            $("#active" + {{ $garantia->id_garantia_proveedor }}).on("change", function(){
                                                                                if($(this).is(":checked")){
                                                                                    $("#active_label" + {{ $garantia->id_garantia_proveedor }}).val("Activo");
                                                                                }
                                                                            });
    
                                                                            {{--  Inactivo  --}}
                                                                            $("#not_active" + {{ $garantia->id_garantia_proveedor }}).on("change", function(){
                                                                                if($(this).is(":checked")){
                                                                                    $("#inactive_label" + {{ $garantia->id_garantia_proveedor }}).val("Activo");
                                                                                }else{
                                                                                    $("#inactive_label" + {{ $garantia->id_garantia_proveedor }}).val("Inactivo");
                                                                                }
                                                                            });
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn add_agencia">Guardar</button>
                                                        </div
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection