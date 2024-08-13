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
            <td colspan="3" style="text-align: center; width: 310px;">{{$polizaAsiganada[0]->unidad->vehiculo_id}}</td>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white; width: 150px;"><strong> Teléfono </strong></td>
            <td colspan="3" style="text-align: center;  width: 310px;">{{$polizaAsiganada[0]->unidad->datosAsignacion->responsable->telefono_responsable ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white;"><strong> Cliente </strong></td>
            <td colspan="3" style="text-align: center;">{{$polizaAsiganada[0]->unidad->datosAsignacion->cliente->nombre_cliente ?? ''}}</td>
            <td colspan="1" style="text-align: center; background-color: #be5014; color:white;"><strong>Responsable de activo</strong></td>
            <td colspan="3" style="text-align: center;">{{$polizaAsiganada[0]->unidad->datosAsignacion->responsable->nombre_responsable ?? ''}}</td>
        </tr>
        <tr></tr>
        <tr>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>No</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Placas</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Marca</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Cliente</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Fecha de Pago</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Monto</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Aseguradora</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;"><strong>Estatus</strong></th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($polizaAsiganada as $poliza)
            <tr>
                <th style="text-align: center;">{{++$i}}</th>
                <th style="text-align: center; width: 80px">{{ $poliza->unidad->datosAsignacion->placas ?? 'No hay placas asignadas' }}</th>
                <th style="text-align: center; width: 80px">{{ $poliza->unidad->marca->descripcion }}</th>
                <th style="text-align: center; width: 180px">{{ $poliza->unidad->datosAsignacion->cliente->nombre_cliente ?? 'No hay placas asignadas' }}</th>
                <th style="text-align: center;">{{ $poliza->fecha_pago }}</th>
                <th style="text-align: center; width: 80px">${{number_format($poliza->monto_seguro, 2)}}</th>
                <th style="text-align: center; width: 150px">{{ $poliza->aseguradora->nombre_aseguradora }}</th>
                <th style="text-align: center; width: 80px">Pagado</th>
            </tr>
        @endforeach
    </table>
</body>
</html>
