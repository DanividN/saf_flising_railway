@extends('pwa.layouts.pwa')

@section('extra-css')
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div>
                <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Busqueda" aria-label="Buscar cliente" aria-describedby="button-addon2" data-search-url="{{ route('pwa.clientes.search') }}">
                </div>
            </div>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2 mt-2">
            <div id="resultados-busqueda">
                @include('pwa.views.clientes.listadoClientes')
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/pwa/clientes.js') }}"></script>
@endsection