<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <style>
        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }
        .card {
            background-color: #ddc8c9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #ED5429;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
            border-radius: 10px;
            color: #ffffff;
        }
        .card-body {
            padding: 10px;
            text-align: center;
            color: #000000 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>CONTRASEÑA</h1>
            </div>
            <div class="card-body">
                <p style="color: #000000 !important; font-weight: 800;">Hola, {{ $name }}</p>
                <p style="color: #000000 !important; font-weight: 800;">
                    Se te genero una contraseña temporal para ingresar al Sistema de Administración de Flotillas SAF. <br> 
                    Al iniciar sesión la primera vez se te pedirá que la cambies por una contraseña nueva, para asegurar tu integridad digital.
                </p>
                <p style="color: #000000 !important; font-weight: 800;">Ingresa a <a href="#">www.gestionsaf.com</a></p>
                <p style="color: #ff0000 !important; font-weight: 800;">Contraseña: {{ $password }}</p>
            </div>
        </div>
    </div>
</body>
</html>
