@extends('pwa.layouts.pwa')

@section('extra-css')
@endsection

@section('content')
@include('components.alertas')
    <div class="container-fluid">
        <div class="card shadow-md border-gray-100 border-0 p-2 mt-2">
            <div>
                <div class="input-group">
                    <input 
                        type="text" 
                        class="form-control" 
                        id="search-input-unidades" 
                        placeholder="Busqueda" 
                        aria-label="Buscar unidad" 
                        aria-describedby="button-addon2" 
                        data-search-url="{{ route('pwa.clientes.unidades.search', $cliente->id_cliente) }}"
                    >
                </div>
            </div>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2 mt-2">
            <div id="resultados-busqueda-unidades">
                @include('pwa.views.unidades.listadoUnidades')
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/pwa/unidades.js') }}"></script>
@endsection