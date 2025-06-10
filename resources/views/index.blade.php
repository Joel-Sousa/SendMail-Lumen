<?php
$logFile = dirname(__DIR__, 3) . '/public/mail_log.log';

if (file_exists($logFile)) {

    $conteudo = file_get_contents($logFile);
    $arrBroken = explode('§', $conteudo);

} else {
    $arrBroken = 'Arquivo de log não encontrado.';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css"
        integrity="sha384-3fdgwJw17Bi87e1QQ4fsLn4rUFqWw//KU0g8TvV6quvahISRewev6/EocKNuJmEw" crossorigin="anonymous">
    <style>
        .border {
            border: solid 1px;
        }

        .negrito {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class='container'>
        <div class='row'>
            <div class="col-md-7 border" style="height: 48vh;">
                <div class="row">
                    <div class="col-md-5">
                        <div class='negrito'>Input de entrada</div>
                        <div class="col">
                            <form action="/send-mail" method='POST' enctype="multipart/form-data">
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search" name='host'
                                        placeholder="Host do correio *" value='{{ $data['host'] ?? '' }}' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search" name='port'
                                        placeholder="Porta do correio *" value='{{ $data['port'] ?? '' }}' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search" name='user'
                                        placeholder="Usuario *" value='{{ $data['user'] ?? '' }}' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search" name='pass'
                                        placeholder="Senha *" value='{{ $data['pass'] ?? '' }}' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search" name='encryption'
                                        placeholder="Criptografia *" value='{{ $data['encryption'] ?? 'tls' }}'
                                        value='tls' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search"
                                        name='originAddress' placeholder="Endereço de origem *"
                                        value='{{ $data['originAddress'] ?? '' }}' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search"
                                        name='destinationAddress' placeholder="Endereço de destino *"
                                        value='{{ $data['destinationAddress'] ?? '' }}' required>
                                </div>
                                <div class=row>
                                    <input class="form-control me-sm-2 form-control-sm" type="search" name='subject'
                                        placeholder="Assunto" value='{{ $data['subject'] ?? 'Isso e um teste' }}'
                                        value='Isso e um teste' required>
                                </div>
                                <div>
                                    <input type="file" name="file">
                                </div>
                                <div>
                                    <button class='btn btn-outline-success btn-sm'>Enviar</button>
                                    <button type='reset' class='btn btn-outline-secondary btn-sm'>Limpar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="negrito">Lista de dados</div>
                        <div class="col">
                            <b>Host:</b> {{ $data['host'] ?? 'Sem dados!' }}<br>
                            <b>Porta:</b> {{ $data['port'] ?? 'Sem dados!' }}<br>
                            <b>Usuario:</b> {{ $data['user'] ?? 'Sem dados!' }}<br>
                            <b>Senha:</b> {{ $data['pass'] ?? 'Sem dados!' }}<br>
                            <b>Criptografia:</b> {{ $data['encryption'] ?? 'Sem dados!' }}<br>
                            <b>Endereço de origem:</b> {{ $data['originAddress'] ?? 'Sem dados!' }}<br>
                            <b>Endereço de destino:</b> {{ $data['destinationAddress'] ?? 'Sem dados!' }}<br>
                            <b>Assunto:</b> {{ $data['subject'] ?? 'Sem dados!' }}<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 border" style="height: 48vh;">
                <div class='negrito'>Log do email (Status)</div>
                <div>
                    {{ $data['status'] ?? 'Sem dados!' }}
                    <br>
                </div>
                <div>
                    @if (!empty($data['data']))
                        <b>Host:</b> {{ $data['data']['host'] ?? 'Sem dados!' }}<br>
                        <b>Porta:</b> {{ $data['data']['port'] ?? 'Sem dados!' }}<br>
                        <b>Usuario:</b> {{ $data['data']['user'] ?? 'Sem dados!' }}<br>
                        <b>Senha:</b> {{ $data['data']['pass'] ?? 'Sem dados!' }}<br>
                        <b>Criptografia:</b> {{ $data['data']['encryption'] ?? 'Sem dados!' }}<br>
                        <b>Endereço de origem</b> {{ $data['data']['originAddress'] ?? 'Sem dados!' }}<br>
                        <b>Endereço de destino</b> {{ $data['data']['destinationAddress'] ?? 'Sem dados!' }}<br>
                        <b>Assunto</b> {{ $data['data']['subject'] ?? 'Sem dados!' }}<br>
                    @endif
                </div>
            </div>
        </div>
        <div class='row border'>
            <div class="col">
                <div class='row'>
                    <form action="/clean-log" method='POST' enctype="multipart/form-data">
                        <button class='btn btn-outline-warning btn-sm'>Limpar log</button>
                        <b>Logs dos disparos dos emails</b>
                    </form>
                </div>
                <div class="row m-0" style="height: 48vh; overflow: auto">
                    <?php
                    // echo nl2br(htmlspecialchars($arrBroken));
                    foreach (array_reverse($arrBroken) as $linha) {
                        echo htmlspecialchars($linha) . '<br><br>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
