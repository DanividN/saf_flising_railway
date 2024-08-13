    <table>
        <thead>
            <tr>
                <td colspan="7" style="font-weight: bold;font-size:20px;" align="center">
                    Información de Tenencias
                </td>
            </tr>
            <tr>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" colspan="2" align="center">ID de la unidad
                </td>
                <td colspan="2" align="center">{{ $unidades->vehiculo_id }}</td>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;"  align="center">Telefono</td>
                <td colspan="2" align="center">
                    {{ $unidades->datosAsignacion->Cliente->telefono_cliente ?? 'Sin asignación' }}</td>
            </tr>
            <tr>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" colspan="2" align="center">Cliente</td>
                <td colspan="2" align="center">
                    {{ $unidades->datosAsignacion->Cliente->nombre_cliente ?? 'Sin asignación' }}</td>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Responsable del
                    activo</td>
                <td colspan="2" align="center">
                    {{ $unidades->datosAsignacion->Cliente->responsable->nombre_responsable ?? 'Sin asignación' }}</td>
            </tr>
            <tr>
                <th colspan="7"></th>
            </tr>
            <tr>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">No.</th>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">Placas</th>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">Marca</th>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">Fecha de pago</th>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">Monto con IVA</th>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">Cliente</th>
                <th align="center" bgcolor="#BE5014" style="color:white;font-weight: bold;">Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenencias as $tenencia)
                <tr>
                    <td align="center">{{ $tenencia->id_tenencia }}</td>
                    <td align="center">{{ $tenencia->arrendaminto->placas ?? 'Sin asignación' }}</td>
                    <td align="center">{{ $tenencia->unidad->marca->descripcion }}</td>
                    <td align="center">{{ $tenencia->fecha_pago }}</td>
                    <td align="center">{{ $tenencia->monto_tenencia }}</td>
                    <td align="center">{{ $tenencia->arrendaminto->Cliente->nombre_cliente ?? 'Sin asignación' }}</td>
                    <td align="center">Pagado</td>
                </tr>
            @endforeach
        </tbody>
    </table>
