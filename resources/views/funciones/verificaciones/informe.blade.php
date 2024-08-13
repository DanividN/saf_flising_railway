<table>
    <thead>
        <tr>
            <th colspan="8" align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Informe Verificación</th>
        </tr>
        <tr>
            <th colspan="8"></th>
        </tr>
        <tr>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">No.</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Placas</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Marca</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Período</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Fecha de pago</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Cliente</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Estatus</th>
            <th align='center' bgcolor="#B15728" style="border: 1px solid black;color:white">Monto</th>
        </tr>
    </thead>
    <tbody>
        <?php $cont = 1; ?>
        @foreach ($unidades as $unidad)
            <tr>
                <td style='border: 1px solid black' align='left'>{{ $cont++ }}</td>
                <td style='border: 1px solid black' align='left'>{{ $unidad->ultimo_arrendamiento->placas }}</td>
                <td style='border: 1px solid black'>{{ $unidad->marca->descripcion }}</td>
                <td style='border: 1px solid black'>{{ ($unidad->estado[1] ? 'Primer' : 'Segundo') . ' semestre' }}</td>
                <td style='border: 1px solid black' align='left'>
                    {{ $unidad->ultima_verificacion->seguimiento->fecha_verificacion ?? 'Pendiente' }}</td>
                <td style='border: 1px solid black'>{{ $unidad->ultimo_arrendamiento->cliente->nombre_cliente }}</td>
                <td style='border: 1px solid black'>{{ $unidad->estado[0] }}</td>
                <td style='border: 1px solid black'>
                    {{ $unidad->ultima_verificacion->seguimiento->monto_verificacion ?? 'Pendiente' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
