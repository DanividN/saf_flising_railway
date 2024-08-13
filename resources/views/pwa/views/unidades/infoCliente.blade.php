<div class="container-fluid mb-4 mt-2">
    <div class="card shadow-md border-gray-100 border-0 p-2">
        <div class="card-body">
            <div class="row">
                <div class="text-center">
                    <div class="col">
                        <b>Cliente: </b><span class="text-gray font-bold">{{ $cita->cliente->nombre_cliente }}</span>
                    </div>

                    <div class="col mt-2">
                        <b>I.D. unidad: </b><span class="text-gray font-bold">{{ $cita->unidad->vehiculo_id }}</span>
                    </div>

                    <div class="col mt-2">
                        <b>Responsable: </b><span class="text-gray font-bold">{{ $cita->cliente->nombre_representante }}</span>
                    </div>

                    <div class="col mt-2">
                        <b>Telefono: </b><span class="text-gray font-bold">{{ $cita->cliente->telefono_cliente }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>