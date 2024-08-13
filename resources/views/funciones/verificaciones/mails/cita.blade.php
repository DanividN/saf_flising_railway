<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Verificación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 20px;
        }
        .header {
            background-color: #e95420;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            text-align: center;
            color: #e95420;
        }
        .verification-details {
            background-color: #ffe6e6;
            padding: 20px;
            margin-top: 20px;
        }
        .verification-details table {
            width: 100%;
        }
        .verification-details table th,
        .verification-details table td {
            padding: 10px;
            text-align: left;
        }
        .verification-details table th {
            background-color: #e95420;
            color: #ffffff;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>AGENDA DE VERIFICACIÓN</h1>
        </div>
        <div class="content">
            <h2>CITA DE VERIFICACIÓN</h2>
            <div class="verification-details">
                <table>
                    <tr>
                        <th>FOLIO</th>
                        <td>VA-{{str_pad($cita->id_citas_verificaciones, 4, '0', STR_PAD_LEFT)}}</td>
                    </tr>
                    <tr>
                        <th>Fecha y hora</th>
                        <td>{{$cita->fecha_hora_verificacion}} Horas</td>
                    </tr>
                    <tr>
                        <th>Verificentro</th>
                        <td>{{$cita->Verificentro->no_verificentro}}</td>
                    </tr>
                    <tr>
                        <th>Placas</th>
                        <td>{{$cita->arrendamiento->placas}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <p>Sistema de Administración de Flotillas</p>
        </div>
    </div>
</body>
</html>
