<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguro</title>
</head>
<body>
    <table>
        <tr>
            <th colspan="8" style="text-align: center; font-size: 16pt;">
                <strong> Información Seguros </strong>
            </th>
        </tr>
        <tr>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white; width: 150px;"><strong> ID de Unidad</strong></td>
            <td colspan="3" style="text-align: center; width: 310px;">{{$emergencias[0]->vehiculo_id}}</td>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white; width: 150px;"><strong> Teléfono </strong></td>
            <td colspan="3" style="text-align: center;  width: 310px;">{{$emergencias[0]->telefono_responsable ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white;"><strong> Cliente </strong></td>
            <td colspan="3" style="text-align: center;">{{$emergencias[0]->nombre_cliente ?? ''}}</td>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white;"><strong>Responsable de activo</strong></td>
            <td colspan="3" style="text-align: center;">{{$emergencias[0]->nombre_responsable ?? ''}}</td>
        </tr>
        <tr></tr>
        <tr>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Folio</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Placas</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Marca</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Cliente</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Fecha de Registro</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Estatus</strong></th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($emergencias as $emergencia)
            <tr>
                @php
                    $folio = 'EM-' . str_pad($emergencia->id_asignacion_emergencia, 4, '0', STR_PAD_LEFT);
                @endphp
                <th style="text-align: center;">{{$folio}}</th>
                <th style="text-align: center; width: 80px">{{ $emergencia->placas ?? 'No hay placas asignadas' }}</th>
                <th style="text-align: center; width: 80px">{{ $emergencia->marca }}</th>
                <th style="text-align: center; width: 180px">{{ $emergencia->nombre_cliente ?? 'No hay placas asignadas' }}</th>
                <th style="text-align: center;">{{ $emergencia->created_at }}</th>
                <th style="text-align: center; width: 80px">
                    @if ($emergencia->estado_emergencia === 1)
                        En proceso
                    @elseif($emergencia->estado_emergencia === 2)
                        Concluido
                    @else
                        Cancelado>
                    @endif
                </th>
            </tr>
        @endforeach
    </table>
</body>
</html>
