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
            <th colspan="9" style="text-align: center; font-size: 16pt;">
                <strong>Informe de Mantenimientos</strong>
            </th>
        </tr>
        <tr></tr>
        <tr>
            <td style="text-align: center; background-color: #be5014; color:white; width: 150px;border:1px solid #000000;"><strong> ID de Unidad</strong></td>
            <td style="text-align: center; width: 210px;border:1px solid #000000;">{{ $mantenimientos[0]->unidad->vehiculo_id }}</td>
            <td style="text-align: center; background-color: #be5014; color:white; width: 150px;border:1px solid #000000;"><strong> Placas </strong></td>
            <td style="text-align: center;  width: 210px;border:1px solid #000000;">{{ $mantenimientos[0]->asignacion_unidad->placas }}</td>
        </tr>
        <tr>
            <td style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong> Cliente </strong></td>
            <td style="text-align: center;border:1px solid #000000;">{{ $mantenimientos[0]->asignacion_unidad->cliente->nombre_cliente }}</td>
            <td style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Responsable de activo</strong></td>
            <td style="text-align: center;border:1px solid #000000;">{{ $mantenimientos[0]->asignacion_unidad->responsable->nombre_responsable }}</td>
        </tr>
        <tr></tr>
        <tr>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>No</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Placas</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Marca</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Cliente</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Fecha de mantenimento</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Monto con I.V.A</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Nivel de autorizaci&oacute;n</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Agencia o Taller</strong></th>
            <th style="text-align: center; background-color: #be5014; color:white;border:1px solid #000000;"><strong>Estatus</strong></th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($mantenimientos as $mantenimiento)
            <tr>
                <td style="text-align: center;border:1px solid #000000">{{ ++$i }}</td>
                <td style="text-align: center;border:1px solid #000000">{{ $mantenimiento->asignacion_unidad->placas }}</td>
                <td style="text-align: center;border:1px solid #000000">{{ $mantenimiento->unidad->marca->descripcion }}</td>
                <td style="text-align: center;border:1px solid #000000">{{ $mantenimiento->asignacion_unidad->cliente->nombre_cliente }}</td>
                <td style="text-align: center;border:1px solid #000000;width:160px;">{{ $mantenimiento->unidad->fecha_mantenimiento }}</td>
                <td style="text-align: center;border:1px solid #000000;width:160px;">{{ isset($mantenimiento->seguimiento_mantenimiento) ? number_format($mantenimiento->seguimiento_mantenimiento->monto_mantenimiento,2) : 'N/A' }}</td>
                <td style="text-align: center;border:1px solid #000000;width:140px;">
                    @if ($mantenimiento->seguimiento_mantenimiento == null)
                        N/A
                    @else
                        @if ($mantenimiento->seguimiento_mantenimiento->autorizacion == 1)
                            B&aacute;sico
                        @else
                            Avanzado
                        @endif
                    @endif
                </td>
                <td style="text-align: center;border:1px solid #000000;width:170px;">{{ $mantenimiento->proveedor->nombre_comercial }}</td>
                <td style="text-align: center;border:1px solid #000000;width:100px;">
                    @if ($mantenimiento->estado == 'PENDIENTE')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-yellow-status status" style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-yellow-status" style="margin-left: 5px;">Pendiente</span>
                        </span>
                    @elseif($mantenimiento->estado == 'AGENDADO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-agendado status" style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-agendado-status" style="margin-left: 5px;">Agendado</span>
                        </span>
                    @elseif($mantenimiento->estado == 'PAGADO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-green-status" style="margin-left: 5px;">Pagado</span>
                        </span>
                    @elseif($mantenimiento->estado == 'VENCIDO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-red-status status"
                                style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-red-status" style="margin-left: 5px;">Vencido</span>
                        </span>
                    @elseif($mantenimiento->estado == 'RECHAZADO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-red-status status"
                                style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-red-status" style="margin-left: 5px;">Rechazado</span>
                        </span>
                    @elseif($mantenimiento->estado == 'AUTORIZADO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-green-status status"
                                style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-green-status" style="margin-left: 5px;">Autorizado</span>
                        </span>
                    @elseif($mantenimiento->estado == 'CONCLUIDO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-green-status status"
                                style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                        </span>
                    @elseif($mantenimiento->estado == 'CANCELADO')
                        <span style="display: inline-flex; align-items: center;">
                            <span class="badge bg-gray-status status"
                                style="border-radius: 50%; display: inline-block;"></span>
                            <span class="text-gray-status" style="margin-left: 5px;">Cancelado</span>
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
