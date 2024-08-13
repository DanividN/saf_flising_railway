@php
    $colores = [
        'CONCLUIDO' => 'text-success', 
        'VIGENTE' => 'text-primary', 
        'PENDIENTE' => 'text-warning', 
        'VENCIDO' => 'text-danger' 
    ];
@endphp

<div class="container-fluid mt-2">
    <div class="card shadow-md border-gray-100 border-0 p-2">

        <div class="card-header border-0 bg-white m-0">
            <h5 class="text-orange m-0 font-bold">Datos de la unidad</h5>
        </div>

        <div class="card-body">
            <div class="row d-flex">
                <div>
                    <div class="col d-flex justify-content-between">
                        <b>Marca: </b><span class="text-gray font-bold">{{ $cita->unidad->marca->descripcion }}</span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Modelo: </b><span class="text-gray font-bold">{{ $cita->unidad->modelo }}</span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Año: </b><span class="text-gray font-bold">{{ $cita->unidad->year }}</span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Placas: </b><span class="text-gray font-bold">{{ $cita->asignacionUnidad->placas }}</span>
                    </div>
                    
                    <div class="col d-flex justify-content-between mt-2">
                        <b>Verificación primer semestre: </b>
                        <span class="{{ $colores[$verificaciones['primer_periodo']] }} font-bold">
                            {{--  {{ $cita->asignacionUnidad->primer_semestre }}  --}}
                            {{ ucfirst(strtolower($verificaciones['primer_periodo'])) }}
                        </span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Verificación segundo semestre: </b>
                        <span class="{{ $colores[$verificaciones['segundo_periodo']] }} font-bold">
                            {{--  {{ $cita->asignacionUnidad->segundo_semestre }}  --}}
                            {{ ucfirst(strtolower($verificaciones['segundo_periodo'])) }}
                        </span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Número de serie(VIN): </b><span class="text-gray font-bold">{{ $cita->unidad->n_serie }}</span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Motor: </b><span class="text-gray font-bold">{{ $cita->unidad->n_motor }}</span>
                    </div>

                    <div class="col d-flex justify-content-between mt-2">
                        <b>Kilometraje: </b><span class="text-gray font-bold">{{ $cita->unidad->kilometraje }} Km</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>