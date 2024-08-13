@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
@endsection

@section('configuracion','active')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('garantias.index') }}" class="rutas"><small>Garantias</small></a></span></li>
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Editar Proveedor</small></a></span></li>
    @endsection


@section('content')
  @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Editar Proveedor</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
              <form action="{{ route('garantias.update', $garantia) }}" method="POST" id="editForm" id="formulario" class="needs-validation" onsubmit="validateForm(this)" novalidate>
                  @csrf
                  @method('PUT')
                    <div class="row">
                        <h6 class="title-orange m-0">Proovedor</h6>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="razon_social" class="font-bold">Proveedor :</label>
                                <input type="text" id="razon_social" name="razon_social" class="form-control"
                                    value="{{ $garantia->razon_social }}" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ.,\s]+" required>
                                 <div class="text-danger my-2">
                                    @error('razon_social')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El nombre del Proveedor no es validio</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="nombre_comercial" class="font-bold">Nombre Comercial:</label>
                                <input type="text" id="nombre_comercial" class="form-control" name="nombre_comercial"
                                    value="{{ $garantia->nombre_comercial }}" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ.,\s]+">
                                 <div class="text-danger my-2">
                                    @error('nombre_comercial')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El nombre comercial no es validio</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="telefono_g_flising" class="font-bold">Telefono:</label>
                                <input type="text" class="form-control" id="telefono_g_flising" name="telefono_g_flising"
                                minlength="10" maxlength="10" pattern="\d{10}" placeholder="1234567890" value="{{ $garantia->telefono_g_flising }}" required ></input>
                                <div class="text-danger my-2">
                                    @error('telefono_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El telefono no es validio</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="rfc_g_flising" class="font-bold">RFC:</label>
                                <input type="text" class="form-control" id="rfc_g_flising" name="rfc_g_flising"
                                    value="{{ $garantia->rfc_g_flising }}" maxlength="13" placeholder="AAAA123456XXX" pattern="^([A-ZÑ&]{3,4})(\d{6})([A-Z\d]{3})$" required onblur="validarRFC(event)"></input>
                                 <div class="text-danger my-2">
                                    @error('rfc_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El RFC no es validio</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="correo_g_flising" class="font-bold">Correo electrónico:</label>
                                <input type="email" class="form-control" id="correo_g_flising" name="correo_g_flising"
                                    value="{{ $garantia->correo_g_flising }}" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" 
                                    placeholder="proveedor@email.com" required oninput="convertirAMinusculas(event)"></input>
                                 <div class="text-danger my-2">
                                    @error('correo_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El correo electrónico no es validio</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="calle_g_flising" class="font-bold">Calle:</label>
                                <input type="text" id="calle_g_flising" class="form-control" name="calle_g_flising"
                                    value="{{ $garantia->calle_g_flising }}" required></input>
                                 <div class="text-danger my-2">
                                    @error('calle_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">La calle no es valida</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="n_exterior_g_flising" class="font-bold">No. exterior:</label>
                                <input type="text" id="n_exterior_g_flising" class="form-control"
                                    name="n_exterior_g_flising" value="{{ $garantia->n_exterior_g_flising }}"
                                    required></input>
                                 <div class="text-danger my-2">
                                    @error('n_exterior_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El numero no es valido</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="colonia_g_flising" class="font-bold">Colonia:</label>
                                <input type="text" id="colonia_g_flising" class="form-control" name="colonia_g_flising"
                                    value="{{ $garantia->colonia_g_flising }}" required></input>
                                 <div class="text-danger my-2">
                                    @error('colonia_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">La colonia es requerida</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="entidad_g_flising" class="font-bold">Entidad Federativa:</label>
                                <select name="entidad_g_flising" id="entidad_g_flising" onchange="consultarApiEdit(this.value,{{ $municipioSeleccionado->id_municipio }})" class="single-select-field" required>
                                    <option value="" hidden>--Selecciona--</option>
                                    @foreach ($entidadesFederativas as $entidadFederativa)
                                        <option value="{{ $entidadFederativa->id_entidad_federativa }}"
                                            {{ $municipioSeleccionado->id_entidad_federativa == $entidadFederativa->id_entidad_federativa ? 'selected' : '' }}>
                                            {{ $entidadFederativa->nombre_entidad_federativa }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                 <div class="text-danger my-2">
                                    @error('entidad_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">La entidad federativa es requerida</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="id_municipio" class="font-bold">Municipio / Alcaldia:</label>
                                <input type="hidden" id="municipio_dos" value="{{ $municipioSeleccionado->id_municipio }}">
                                <select name="id_municipio" id="id_municipio" class="single-select-field" required></select>
                                 <div class="text-danger my-2">
                                    @error('id_municipio')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El municipio es requerido</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cp_g_flising" class="font-bold">C.P:</label>
                                <input type="text" class="form-control" id="cp_g_flising" name="cp_g_flising"
                                    value="{{ $garantia->cp_g_flising }}" maxlength="5" pattern="^\d{5}$" placeholder="12345" required></input>
                                 <div class="text-danger my-2">
                                    @error('cp_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El C.P es invalido</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-2">
                  
                    <div class="row">
                        <h6 class="title-orange m-0">Registro de Contactos</h6>
                        
                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="nombre_contacto" class="font-bold">Nombre</label>
                            <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[0]['nombre_contacto']) ? $contactos[0]['nombre_contacto'] : '' }}"
                                pattern="^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s'´]+$" placeholder="Nombre de Contacto"
                                required></input>
                            <input type="hidden" name="contacto_id[]" value="{{ $contactos[0]['id_contacto'] ?? '' }}">
                             <div class="text-danger my-2">
                                @error('nombre_contacto.0')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="invalid-feedback text-start">
                                <p class="text-danger">Al menos un nombre de contacto es requerido</p>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="numero_contacto"class="font-bold">Número de Contacto</label>
                            <input type="text" id="numero_contacto" class="form-control" name="numero_contacto[]"
                            value="{{ !empty($contactos) && isset($contactos[0]['numero_contacto']) ? $contactos[0]['numero_contacto'] : '' }}"
                            maxlength="10" pattern="^\d{10,15}$" placeholder="1234567890"
                            required></input>

                             <div class="text-danger my-2">
                                @error('numero_contacto.0')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="invalid-feedback text-start">
                                <p class="text-danger">Al menos un número de contacto es requerido</p>
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="correo_contacto" class="font-bold">Correo de Contacto</label>
                                <input type="email" id="correo_contacto" class="form-control" name="correo_contacto[]"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  placeholder="correo@email.com" required
                                    value="{{ old('correo_contacto.0', isset($contactos[0]['correo_contacto']) ? $contactos[0]['correo_contacto'] : '') }}" oninput="convertirAMinusculas(event)">
                                 <div class="text-danger my-2">
                                    @error('correo_contacto.0')
                                        <span class="">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">Al menos un correo de contacto es requerido</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="nombre_contacto_dos" class="font-bold">Nombre</label>
                            <input type="hidden" name="contacto_dos"
                                value="{{ !empty($contactos) && isset($contactos[1]['id_contacto']) ? $contactos[1]['id_contacto'] : '' }}">
                            <input type="text" class="form-control" id="nombre_contacto_dos" name="nombre_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[1]['nombre_contacto']) ? $contactos[1]['nombre_contacto'] : '' }}"
                                 pattern="^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s'´]+$" placeholder="Nombre de Contacto"></input>
                            <input type="hidden" name="contacto_id[]" value="{{ $contactos[1]['id_contacto'] ?? '' }}">
                             <div class="text-danger my-2">
                                @error('nombre_contacto.1')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="numero_contacto_dos" class="font-bold">Número de Contacto</label>
                            <input class="form-control" type="text" id="numero_contacto_dos" name="numero_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[1]['numero_contacto']) ? $contactos[1]['numero_contacto'] : '' }}"
                                maxlength="10" pattern="^\d{10,15}$" placeholder="1234567890"
                                ></input>
                             <div class="text-danger my-2">
                                @error('numero_contacto.1')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="correo_contacto_dos" class="font-bold">Correo de Contacto</label>
                            <input type="email" id="correo_contacto_dos" class="form-control" name="correo_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[1]['correo_contacto']) ? $contactos[1]['correo_contacto'] : '' }}"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  placeholder="correo@email.com"
                                oninput="convertirAMinusculas(event)"></input>
                             <div class="text-danger my-2">
                                @error('correo_contacto.1')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>
                        </div>
        
                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="nombre_contacto_tres" class="font-bold">Nombre</label>
                            <input type="hidden" name="contacto_tres"
                                value="{{ !empty($contactos) && isset($contactos[2]['id_contacto']) ? $contactos[2]['id_contacto'] : '' }}">
                            <input type="hidden" name="contacto_id[]" value="{{ $contactos[2]['id_contacto'] ?? '' }}">
                            <input type="text" class="form-control" id="nombre_contacto_tres" name="nombre_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[2]['nombre_contacto']) ? $contactos[2]['nombre_contacto'] : '' }}"
                                 pattern="^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s'´]+$" placeholder="Nombre de Contacto"></input>
                             <div class="text-danger my-2">
                                @error('nombre_contacto.2')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                            <label for="numero_contacto_tres" class="font-bold">Número de Contacto</label>
                            <input type="text" id="numero_contacto_tres" class="form-control" name="numero_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[2]['numero_contacto']) ? $contactos[2]['numero_contacto'] : '' }}"
                                maxlength="10" pattern="^\d{10,15}$" placeholder="1234567890"
                                ></input>
                             <div class="text-danger my-2">
                                @error('numero_contacto.2')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="correo_contacto_tres" class="font-bold">Correo de Contacto</label>
                            <input type="email" class="form-control" id="correo_contacto_tres" name="correo_contacto[]"
                                value="{{ !empty($contactos) && isset($contactos[2]['correo_contacto']) ? $contactos[2]['correo_contacto'] : '' }}"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  placeholder="correo@email.com"
                                ></input>
                             <div class="text-danger my-2">
                                @error('correo_contacto.2')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>

                <div class="d-flex justify-content-center gap-4 mt-4">
                  @include('components.btn-regresar', ['link' => 'garantias.index'])
                {{--  El text es opcional, por default es 'Guardar'  --}}
                @include('components.btn-guardar', [
                    'link' => 'garantias.update',
                    'text' => 'Editar',
                ])
                </div>
              </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/garantias/configuracion/garantias.js') }}"></script>
    <script src="{{ asset('js/asignacionUnidad/validForm.js') }}"></script>
@endsection
