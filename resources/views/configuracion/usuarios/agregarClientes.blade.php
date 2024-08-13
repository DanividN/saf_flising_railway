
<div class="modal fade" id="modalClientes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalClientes" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Clientes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive mt-4">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col"></th>
                                <th scope="col">No.</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Fecha de registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $index => $cliente)
                                <tr class="text-center">
                                    <td>    
                                        <input 
                                            type="checkbox" 
                                            id="id_clientes_{{ $cliente->id_cliente }}" 
                                            data-name="{{ $cliente->nombre_cliente }}"
                                            data-id="id_clientes"
                                            value="{{ $cliente->id_cliente }}"
                                            {{ in_array($cliente->id_cliente, $usuarioClientes) ? 'checked' : '' }}
                                        >
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cliente->nombre_cliente }}</td>
                                    <td>{{ $cliente->tipo_cliente }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cliente->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-regresar rounded-lg d-flex" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-orange rounded-lg d-flex" data-bs-dismiss="modal" id="agregar-clientes-modal">Agregar</button>
            </div>
        </div>
    </div>
</div>