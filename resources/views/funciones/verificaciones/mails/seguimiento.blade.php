<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobación de Verificación</title>
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
        .verification-details p {
            margin: 10px 0;
        }
        .highlight {
            color: #e95420;
            font-weight: bold;
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
            <h1>COMPROBACIÓN</h1>
        </div>
        <div class="content">
            <h2>COMPROBACIÓN DE VERIFICACIÓN</h2>
            <div class="verification-details">
                <p>Hola {{$seguimiento->Cita->arrendamiento->Responsable->nombre_responsable}} responsable de la Unidad ID: <span class="highlight">{{$seguimiento->Cita->Unidad->vehiculo_id}}</span> con las Placas <span class="highlight">{{$seguimiento->Cita->arrendamiento->placas}}</span></p>
                <p>Se informa que su registro de comprobación de verificación agendado con el folio: <span class="highlight">VA-{{str_pad($seguimiento->Cita->id_citas_verificaciones, 4, '0', STR_PAD_LEFT)}}</span> se realizó con éxito en la plataforma demandada SAF (Sistema de Administración de Flotillas)</p>
                <p>Con el número de Folio <span class="highlight">VC-{{str_pad($seguimiento->id_citas_verificaciones, 4, '0', STR_PAD_LEFT)}}</span></p>
                <p>Agradecemos su compromiso al enviar la información (favor de no contestar a este mensaje)</p>
            </div>
        </div>
        <div class="footer">
            <p>Sistema de Administración de Flotillas</p>
        </div>
    </div>
</body>
</html>
