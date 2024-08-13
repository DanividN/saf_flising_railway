@forelse ($clientes as $key => $cliente)
    <a href="{{ route('pwa.clientes.unidades', $cliente->id_cliente) }}" class="text-decoration-none text-dark">
        <div class="card-body row p-3">
            <div class="col-2 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/pwa/clientes.png') }}" alt="icono clientes" width="40" height="40">
            </div>
            
            <div class="text-start col-8">
                <h6 class="m-0 text-orange font-bold">{{ $cliente->nombre_cliente }}</h6>
                <h6 class="m-0">{{ $cliente->nombre_representante }}</h6>
                <h6 class="m-0">{{ $cliente->telefono_cliente }}</h6>
            </div>
            
            <div class="col-2 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/pwa/right-arrow.png') }}" alt="icono flecha">
            </div>
        </div>
    </a>
    <hr>    
@empty
    <div class="d-flex justify-content-center align-items-center mt-2 font-bold">
        <p>No se encontraron coincidencias.</p>
    </div>
@endforelse