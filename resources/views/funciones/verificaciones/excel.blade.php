<table>
    <thead>

        <tr>
            <th colspan="7" align='center' style='font-weight:bold;font-size:20px;'>Información de Verificaciones</th>
        </tr>
        <tr>
            <th style='border: 1px solid black;font-weight:bold;color:white' align='center' bgcolor='#B15728'>ID de Unidad
            </th>
            <th colspan="3" align='center' style='border: 1px solid black;font-weight:bold;'>{{ $unidad->vehiculo_id }}
            </th>
            <th style='border: 1px solid black;font-weight:bold;color:white' align='center' bgcolor='#B15728'>Telefono
            </th>
            <th colspan="2" align='center' style='border: 1px solid black;font-weight:bold;'>
                {{ $unidad->UltimoArrendamiento->Responsable->telefono_responsable }}</th>
        </tr>
        <tr>
            <th style='border: 1px solid black;font-weight:bold;color:white' align='center' bgcolor='#B15728'>Cliente
            </th>
            <th colspan="3" align='center' style='border: 1px solid black;font-weight:bold;'>
                {{ $unidad->UltimoArrendamiento->Cliente->nombre_cliente }}</th>
            <th style='border: 1px solid black;font-weight:bold;color:white' align='center' bgcolor='#B15728'>
                Responsable de activo</th>
            <th colspan="2" align='center' style='border: 1px solid black;font-weight:bold;'>
                {{ $unidad->UltimoArrendamiento->Responsable->nombre_responsable }}</th>
        </tr>
        <tr>
            <th colspan="7"></th>
        </tr>
        <tr>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Folio</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Placas</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Marca</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Cliente</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Fecha de pago</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Monto</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Estatus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($unidad->HistorialVerificacion as $cita)
            <tr>
                <td style='border: 1px solid black' align='left'>{{ $cita->folio }}</td>
                <td style='border: 1px solid black' align='left'>{{ $cita->arrendamiento->placas }}</td>
                <td style='border: 1px solid black'>{{ $unidad->marca->descripcion }}</td>
                <td style='border: 1px solid black'>{{ $cita->arrendamiento->Cliente->nombre_cliente }}</td>
                <td style='border: 1px solid black' align='center'>
                    {{ $cita->Seguimiento->fecha_verificacion ?? 'Pendiente' }}</td>
                <td style='border: 1px solid black'>{{ $cita->Seguimiento->monto_verificacion ?? 'Pendiente' }}</td>
                <td style='border: 1px solid black'>{{ $cita->estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
