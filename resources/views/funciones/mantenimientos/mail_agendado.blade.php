<!DOCTYPE html>
<html lang="en">
<head>
    <title>MANTENIMIENTO AGENDADO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;900&display=swap');
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div>
        <div 
        style="background: #ed5429; 
        color: #ffffff;
        height:45px; 
        text-align:center;
        font-weight:600;
        font-size:1.9em;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;"
        >
            <h4 style="margin-top: 20px !important;">AGENDA</h4>
        </div>
        <div style="padding: 30px;text-align: center;background-color: #EEE; margin-top:-1px;">
            <div style="width: 70% !important;margin-left:15%;">
                <div>
                    <div 
                    style="background: #ed5429; 
                    color: #ffffff;
                    height:38px; 
                    text-align:center;
                    font-weight:600;
                    font-size:1.5em;"
                    >
                        <h4 style="margin-top: 20px !important;">CITA DE MANTENIMIENTO</h4>
                    </div>
                </div>
                <div style="width: 100% !important;">
                    <div style="font-size:1.4em;border:1px solid #000000;">
                        <table style="margin-left:25%;border:none !important;background:transparent !important;">
                            <tr style="text-align:left !important;">
                                <th style="width: 250px !important;">Folio:</th>
                                <th style="width: 250px !important;">{{ $folio }}</th>
                            </tr>
                            <tr style="text-align:left !important;">
                                <th style="width: 250px !important;">Fecha y Hora:</th>
                                <th style="width: 250px !important;">{{ $fecha }} {{ $hora }} Horas</th>
                            </tr>
                            <tr style="text-align:left !important;">
                                <th style="width: 250px !important;">Taller o Agencia:</th>
                                <th style="width: 250px !important;">{{ $proveedor[0]->nombre_comercial }}</th>
                            </tr>
                            <tr style="text-align:left !important;">
                                <th style="width: 250px !important;">Placas:</th>
                                <th style="width: 250px !important;">{{ $placas[0]->placas }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>