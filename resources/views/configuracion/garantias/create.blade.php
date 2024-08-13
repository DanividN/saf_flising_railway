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
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('garantias.create') }}" class="rutas"><small>Agregar Proveedor</small></a></span></li>
    @endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Agregar Proveedor</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                <form method="POST" action="{{ route('garantias.store') }}" id="formulario" class="needs-validation" id="formulario" onsubmit="validateForm(this)" novalidate>
                    @csrf
                    <div class="row">
                        <h6 class="title-orange m-0">Proovedor</h6>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="razon_social" class="font-bold">Proveedor <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social"
                                    value="{{ old('razon_social') }}" placeholder="Proveedor" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ.,\s]+" required>
                                    <div class="text-danger my-2">
                                    @error('razon_social')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="invalid-feedback text-start">
                                        <p class="text-danger">El nombre del proveedor no es valido</p>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="nombre_comercial" class="font-bold">Nombre Comercial<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial"
                                    value="{{ old('nombre_comercial') }}" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ.,\s]+" placeholder="Nombre Comercial" required>

                                <div class="text-danger my-2">
                                    @error('nombre_comercial')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El nombre comercial no es valido</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="telefono_g_flising" class="font-bold">Teléfono <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="telefono_g_flising" name="telefono_g_flising" 
                                       maxlength="10" placeholder="1234567890"
                                       value="{{ old('telefono_g_flising') }}" pattern="\d{10}" required>
                                <div class="text-danger my-2">
                                    @error('telefono_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El numero de telefono no es valido</p>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="rfc_g_flising" class="font-bold">RFC <span class="text-danger"> *</span></label>
                                <input type="text" id="rfc_g_flising" name="rfc_g_flising" oninput ="validarRFC(event)" class="form-control"
                                       value="{{ old('rfc_g_flising') }}" pattern="^([A-ZÑ&]{3,4})(\d{6})([A-Z\d]{3})$" 
                                       placeholder="AAAA123456XXX" maxlength="13" required>
                                <div class="text-danger my-2">
                                    @error('rfc_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El RFC no es valido</p>
                                </div>
                            </div>
                            
                            
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="correo_g_flising" class="font-bold">Correo electrónico <span class="text-danger"> *</span></label>
                                <input type="email" id="correo_g_flising" class="form-control" name="correo_g_flising"
                                    value="{{ old('correo_g_flising')}}" 
                                   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|mx|org)"
                                    placeholder="proveedor@email.com" oninput="convertirAMinusculas(event)" required></input>
                                <div class="text-danger my-2">
                                    @error('correo_g_flising')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">El correo electrónico no es valido</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="calle_g_flising" class="font-bold">Calle  <span class="text-danger"> *</span></label>
                                <input type="text" id="calle_g_flising" class="form-control" name="calle_g_flising"
                                    value="{{ old('calle_g_flising') }}" placeholder="Nombre de la calle" required></input>
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
                                <label for="n_exterior_g_flising" class="font-bold">No. exterior <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="n_exterior_g_flising"
                                    name="n_exterior_g_flising" value="{{ old('n_exterior_g_flising') }}" placeholder="Número exterior" required></input>
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
                                <label for="colonia_g_flising" class="font-bold">Colonia <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="colonia_g_flising" name="colonia_g_flising"
                                    value="{{ old('colonia_g_flising') }}" placeholder="Nombre de la colonia" required></input>
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
                                <label for="entidad_g_flising" class="font-bold">Entidad Federativa <span class="text-danger"> *</span></label>
                                <select name="entidad_g_flising" id="entidad_g_flising" onchange="consultarApi(this.value)" required class="single-select-field" required>
                                    <option value="" hidden>--Entiedad Federativa--</option>
                                    @foreach ($entidadesFederativas as $entidadFederativa)
                                        <option value="{{ $entidadFederativa->id_entidad_federativa }}">
                                            {{ $entidadFederativa->nombre_entidad_federativa }}</option>
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
                                <label for="id_municipio" class="font-bold">Municipio / Alcaldia <span class="text-danger"> *</span></label>
                                {{-- <select name="id_municipio" class="menu" id="id_municipio" required>
                                    <option value=""hidden>--Municipio--</option>

                                </select> --}}
                               
                                <select name="id_municipio" id="id_municipio" class="single-select-field" required>
                                </select>
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
                                <label for="cp_g_flising" class="font-bold">C.P <span class="text-danger"> *</span></label>
                                <input class="form-control" type="text" id="cp_g_flising" name="cp_g_flising"
                                       value="{{ old('cp_g_flising') }}" maxlength="5" pattern="^\d{5}$" placeholder="12345" required>
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
                        <h6 class="title-orange m-0 mt-4" class="font-bold">Registro de Contactos</h6>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="nombre_contacto" class="font-bold">Nombre <span class="text-danger"> *</span></label>
                                <input class="form-control" type="text" id="nombre_contacto" name="nombre_contacto[]"
                                       value="{{ old('nombre_contacto.0') }}" pattern="^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s'´]+$" placeholder="Nombre de Contacto" required>
                                @error('nombre_contacto.0')
                                    {{ $message }}
                                @enderror
                                <div class="invalid-feedback text-start">
                                    <p class="text-danger">Al menos un nombre de contacto es requerido</p>
                                </div>
                            </div>                            
                        </div>

                        <div class="col-md-4 mt-4">
                          <div class="form-group">
                            <label for="numero_contacto" class="font-bold">Número de Contacto <span class="text-danger"> *</span></label>
                            <input class="form-control" type="text" id="numero_contacto" name="numero_contacto[]" value="{{ old('numero_contacto.0') }}" pattern="^\d{10,15}$" maxlength="10" placeholder="1234567890" required></input>
                            @error('numero_contacto.0')
                                {{ $message }}
                            @enderror
                            <div class="invalid-feedback text-start">
                                <p class="text-danger">Al menos un número de contacto es requerido</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="correo_contacto" class="font-bold">Correo de Contacto <span class="text-danger"> *</span></label>
                                <input class="form-control" type="email" id="correo_contacto" name="correo_contacto[]"
                                       value="{{ old('correo_contacto.0') }}"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  
                                       placeholder="correo@email.com" oninput="convertirAMinusculas(event)" required>
                                <div class="text-danger">
                                    @error('correo_contacto.0')
                                        {{ $message }}
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
                            <input type="text" id="nombre_contacto_dos" name="nombre_contacto[]"
                                value="{{ old('nombre_contacto.1') }}" pattern="^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s'´]+$" placeholder="Nombre de Contacto" class="form-control"></input>
                            @error('nombre_contacto.1')
                                {{ $message }}
                            @enderror
                          </div>
                        </div>
                        
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="numero_contacto_dos" class="font-bold">Número de Contacto</label>
                                <input type="text" class="form-control" id="numero_contacto_dos" name="numero_contacto[]"
                                       value="{{ old('numero_contacto.1') }}" maxlength="10" pattern="^\d{10,15}$" placeholder="1234567890" >
                                @error('numero_contacto.1')
                                    {{ $message }}
                                @enderror
                            </div>
                            
                        </div>
                        
                        <div class="col-md-4 mt-4">
                          <div class="group-control">
                            <label for="correo_contacto_dos" class="font-bold">Correo de Contacto</label>
                            <input type="email" id="correo_contacto_dos" class="form-control" name="correo_contacto[]"
                                value="{{ old('correo_contacto.1') }}" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  placeholder="correo@email.com" oninput="convertirAMinusculas(event)"></input>
                                @error('correo_contacto.1')
                                {{ $message }}
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4 mt-4">
                          <div class="group-control">
                            <label for="nombre_contacto_tres" class="font-bold">Nombre</label>
                            <input type="text" class="form-control"pattern="^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s'´]+$" placeholder="Nombre de Contacto" id="nombre_contacto_tres" name="nombre_contacto[]"
                                value="{{ old('nombre_contacto.2') }}"></input>
                                @error('nombre_contacto.2')
                                {{ $message }}
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4 mt-4">
                          <div class="group-control">
                            <label for="numero_contacto_tres" class="font-bold">Número de Contacto</label>
                            <input type="text" class="form-control" id="numero_contacto_tres" name="numero_contacto[]"
                                value="{{ old('numero_contacto.2') }}" maxlength="10" pattern="^\d{10,15}$" placeholder="1234567890"></input>
                                @error('numero_contacto.2')
                                {{ $message }}
                            @enderror
                          </div>
                        </div>
                        
                        <div class="col-md-4 mt-4">
                          <div class="group-control">
                            <label for="correo_contacto_tres" class="font-bold">Correo de Contacto</label>
                            <input type="email" class="form-control" id="correo_contacto_tres" name="correo_contacto[]"
                                value="{{ old('correo_contacto.2') }}" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" oninput="convertirAMinusculas(event)"  placeholder="correo@email.com"></input>
                                @error('correo_contacto.2')
                                {{ $message }}
                            @enderror
                          </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-4">
                      @include('components.btn-regresar', ['link' => 'garantias.index'])
                    {{--  El text es opcional, por default es 'Guardar'  --}}
                    @include('components.btn-guardar', [
                        'link' => 'tenencias.index',
                        'text' => 'Guardar',
                    ])
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/garantias/configuracion/garantias.js') }}"></script>
    <script src="{{ asset('js/asignacionUnidad/validForm.js') }}"></script>
@endsection
