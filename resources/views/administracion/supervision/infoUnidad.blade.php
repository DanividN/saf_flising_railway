@php
    $colores = [
        'CONCLUIDO' => 'text-success', 
        'VIGENTE' => 'text-primary', 
        'PENDIENTE' => 'text-warning', 
        'VENCIDO' => 'text-danger' 
    ];
@endphp

<div class="row">
    <h6 class="title-orange m-0">Dastos de la unidad</h6>
    
    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Cliente</b></label>
            <input type="text" class="form-control" value="{{ $cita->cliente->nombre_cliente }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Vehículo</b></label>
            <input type="text" class="form-control" value="{{ $cita->unidad->tipo_unidad->descripcion }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Marca</b></label>
            <input type="text" class="form-control" value="{{ $cita->unidad->marca->descripcion }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Modelo</b></label>
            <input type="text" class="form-control" value="{{ $cita->unidad->modelo }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Año</b></label>
            <input type="text" class="form-control" value="{{ $cita->unidad->year }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Placas</b></label>
            <input type="text" class="form-control" value="{{ $cita->asignacionUnidad->placas }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Verificación primer semestre</b></label>
            {{--  <input type="text" class="form-control" value=" {{ $verificaciones['primer_periodo'] }}" disabled>  --}}
            <input type="text" class="form-control" value="{{ ucfirst(strtolower($verificaciones['primer_periodo'])) }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Verificación segundo semestre</b></label>
            {{--  <input type="text" class="form-control" value="{{ $verificaciones['segundo_periodo'] }}" disabled>  --}}
            <input type="text" class="form-control" value="{{ ucfirst(strtolower($verificaciones['segundo_periodo'])) }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>No. de serie</b></label>
            <input type="text" class="form-control" value="{{ $cita->unidad->n_serie }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Motor</b></label>
            <input type="text" class="form-control" value="{{ $cita->unidad->n_motor }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="form-group">
            <label for=""><b>Kilometraje</b></label>
            <input type="text" class="form-control" value="{{ number_format($cita->unidad->kilometraje) }}" disabled>
        </div>
    </div>
</div>

<hr class="mt-4 mb-2">