<div class="row d-flex justify-content-between">
    <div class="col-12 col-lg-12 col-md-12 col-xl-3 mt-4">
        <div class="form-group">
            <label for="cliente"><b>Tipo de usuario</b><span class="text-danger">*</span></label>
            <select class="form-select" id="tipo_usuario" name="tipo_usuario" {{ $usuario->id ? 'disabled' : 'required' }}>
                <option value="" selected disabled>-- Selecciona una opción --</option>
                <option value="{{ \App\Models\User::ADMINISTRATIVO }}" {{ old('tipo_usuario', $usuario->tipo_usuario) == \App\Models\User::ADMINISTRATIVO ? 'selected' : '' }}>Administrativo</option>
                <option value="{{ \App\Models\User::CALLCENTER }}" {{ old('tipo_usuario', $usuario->tipo_usuario) == \App\Models\User::CALLCENTER ? 'selected' : '' }}>Call Center</option>
                <option value="{{ \App\Models\User::SUPERVISIONAPP }}" {{ old('tipo_usuario', $usuario->tipo_usuario) == \App\Models\User::SUPERVISIONAPP ? 'selected' : '' }}>Supervisión(Aplcación)</option>
            </select>

            @error('tipo_usuario')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-lg-12 col-md-12 col-xl-3 mt-4">
        <div class="form-group">
            <label for="cliente"><b>Nombre</b><span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $usuario->name) }}" required>

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-lg-12 col-md-12 col-xl-3 mt-4">
        <div class="form-group">
            <label for="cliente"><b>Correo</b><span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $usuario->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-lg-12 col-md-12 col-xl-3 mt-4" id="contenedorTurno" style="display: none;">
        <label for="turno"><b>Turno</b><span class="text-danger">*</span></label>
        <div class="form-group d-flex justify-content-around">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="turno" required id="{{ \App\Models\User::MATUTINO }}" value="{{ \App\Models\User::MATUTINO }}" {{ old('turno', $usuario->turno) == \App\Models\User::MATUTINO ? 'checked' : '' }}>
                <label class="form-check-label" for="turno1">Matutino</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="turno" required id="{{ \App\Models\User::VESPERTINO }}" value="{{ \App\Models\User::VESPERTINO }}" {{ old('turno', $usuario->turno) == \App\Models\User::VESPERTINO ? 'checked' : '' }}>
                <label class="form-check-label" for="turno2">Vespertino</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="turno" required id="{{ \App\Models\User::NOCTURNO }}" value="{{ \App\Models\User::NOCTURNO }}" {{ old('turno', $usuario->turno) == \App\Models\User::NOCTURNO ? 'checked' : '' }}>
                <label class="form-check-label" for="turno3">Nocturno</label>
            </div>
        </div>
    
        @error('turno')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr class="mt-4 mb-2">

<div class="d-block" id="permisos">
    <div class="card p-0">
        <div class="card-body p-3 pt-0 pb-0 d-flex justify-content-between">
            <h6 class="font-bold p-1 m-0">Rol: </h6>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" style="border: 1px solid #bdbfc2;">
        </div>
    </div>

    <div class="card p-0 mt-1" style="margin-left: 20px;">
        <div class="card-body p-0">
            <div class="form-check form-check-inline d-flex justify-content-between">
                <label class="form-check-label" for="flexCheckIndeterminate">Administrador</label>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" style="border: 1px solid #bdbfc2;">
            </div>
        </div>
    </div>
</div>

<div class="d-none mt-1" id="listado_clientes">
    <div class="card p-0">
        <div class="card-body p-1 d-flex justify-content-between">
            <h6 class="font-bold">Clientes</h6>

            <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#modalClientes">
                <img src="{{ asset('img/configuracion/edit.png') }}">
            </button>
        </div>
    </div>

    <div class="card p-0 mt-1" style="margin-left: 20px;">
        <div class="card-body d-flex justify-content-between pt-0 pb-0">
            <h6 class="font-bold">Atención VIP</h6>

            <input type="checkbox" name="vip" id="atencion_vip" value="1" {{ old('vip', $usuario->vip) == 1 ? 'checked' : '' }} disabled>
        </div>
    </div>

    <div class="card p-0 mt-1">
        <div class="card-body">
            <div class="agregar-clientes clientes_agregados"></div>
        </div>
    </div>
</div>