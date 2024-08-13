
<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de Supervision</title>
</head>
<body>
    <table>
        <thead>
            <tr style="background-color: #ED5429;">
                <th colspan="7" rowspan="2" style="text-align: center; display: table-cell; vertical-align: middle; font-size: 18px; border: 2px solid #000000;">
                    <b style="font-weight: 800; color: #ffffff;">Informe de Supervision</b>
                </th>
            </tr>
            <tr></tr>
            <tr>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">No.</th>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">Vehiculo</th>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">Placas</th>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">Cliente</th>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">Responsable Supervision</th>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">Fecha</th>
                <th style="text-align: center; background-color: #ED5429; color: #ffffff; font-weight: 800; font-size: 12px; border: 2px solid #000000; width: 200px;">Estatus</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($citas as $key => $cita)
                @php
                    $color = '';
                    $text = '';
                
                    switch ($cita->notificacion_citas) {
                        case 'VENCIDA':
                            $color = '#ffd657';
                            $text = 'Vencida';
                            break;
                        case 'CANCELADA':
                            $color = '#ed494b';
                            $text = 'Cancelada';
                            break;
                        case 'AGENDADA':
                            $color = '#5392ef';
                            $text = 'Agendada';
                            break;
                        case 'CONCLUIDA':
                            $color = '#5cce65';
                            $text = 'Concluida';
                            break;
                        case 'VALIDADA':
                            $color = '#ffbf00';
                            $text = 'Validada';
                            break;
                    }
                @endphp
                <tr style="border-collapse: collapse; border: 1px solid #000;">
                    <td style="text-align: center; border: 2px solid #000000;">{{ $key + 1 }}</td>
                    <td style="text-align: center; border: 2px solid #000000;">{{ $cita->unidad->tipo_unidad->descripcion }}</td>
                    <td style="text-align: center; border: 2px solid #000000;">{{ $cita->asignacionUnidad->placas }}</td>
                    <td style="text-align: center; border: 2px solid #000000;">{{ $cita->cliente->nombre_cliente }}</td>
                    <td style="text-align: center; border: 2px solid #000000;">{{ $cita->supervisor->name }}</td>
                    <td style="text-align: center; border: 2px solid #000000;">{{ $cita->fecha_supervision }}</td>
                    <td style="margin-left: 5px; background-color: {{ $color }}; text-align: center; border: 2px solid #000000; color: #ffffff; font-weight: 800;">
                        {{ $text }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="21">No hay registros</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>