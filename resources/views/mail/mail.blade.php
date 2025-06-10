<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <b>Host:</b> {{ $data['host'] ?? 'Sem dados!' }}<br>
    <b>Porta:</b> {{ $data['port'] ?? 'Sem dados!' }}<br>
    <b>Usuario:</b> {{ $data['user'] ?? 'Sem dados!' }}<br>
    {{-- <b>Senha:</b> {{ $data['pass'] ?? 'Sem dados!' }}<br> --}}
    <b>Criptografia:</b> {{ $data['encryption'] ?? 'Sem dados!' }}<br>
    <b>Endere&#231;o de origen:</b> {{ $data['originAddress'] ?? 'Sem dados!' }}<br>
    <b>Endere&#231;o de destino:</b> {{ $data['destinationAddress'] ?? 'Sem dados!' }}<br>
    <b>Assunto:</b> {{ $data['subject'] ?? 'Sem dados!' }}<br>
</body>

</html>
