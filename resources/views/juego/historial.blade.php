<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Historial de Partidas</title>
    <link rel="stylesheet" href="{{ asset('css/historial.css') }}">
</head>

<body>
    <h1>Historial de Partidas</h1>
    <table>
        <thead>
            <tr>
                <th>Ganador</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $resultado)
                <tr>
                    <td>{{ $resultado->ganador }}</td>
                    <td>{{ \Carbon\Carbon::parse($resultado->fecha)->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/juego">Volver al juego</a>
</body>

</html>