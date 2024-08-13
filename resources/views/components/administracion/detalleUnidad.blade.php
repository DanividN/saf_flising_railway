<div class="card border-0 p-2">
    <div class="card-body">
        <h5 class="title-orange titulo-pantcomp">Información de unidad</h5>
        <div class="row d-flex">
            <div class="col-md-4 mt-2 text-gray">
                <b>Cliente: </b><span>{{ $cliente }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Vehículo: </b><span>{{ $vehiculo }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Tipo de póliza: </b><span>{{ $tipo_poliza }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Responsable de activo: </b><span>{{ $responsable_activo }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Marca: </b><span>{{ $marca }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>No. de poliza: </b><span>{{ $no_poliza }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Cargo: </b><span>{{ $cargo }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Placas: </b><span>{{ $placas }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>GPS: </b><span>{{ $gps }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Teléfono: </b><span>{{ $telefono }}</span>
            </div>
            <div class="col-md-{{ isset($garantia_extendida) ? '4' : '8' }} mt-2 text-gray">
                <b>Motor: </b><span>{{ $motor }}</span>
            </div>
            @if(isset($garantia_extendida))
                <div class="col-md-4 mt-2 text-gray">
                    <b>Garantía extendida: </b><span>{{ $garantia_extendida }}</span>
                </div>
            @endif
            <div class="col-md-4 mt-2 text-gray">
                <b>I.D. Unidad: </b><span>{{ $idUnidad }}</span>
            </div>
            <div class="col-md-4 mt-2 text-gray">
                <b>Aseguradora: </b><span>{{ $aseguradora }}</span>
            </div>
        </div>
    </div>
</div>