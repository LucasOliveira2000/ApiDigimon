<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digimon</title>
</head>
<body>
    <div>
        @foreach($digimons as $digimon)
            <li>
                ID: {{ $digimon->id}} <br>
                NOME: {{ $digimon->name }} <br>
                LEVEL: {{ $digimon->level }}<br>
                IMAGEM:<img width="150px"  src="{{ asset($digimon->imgBaixada) }}" alt="{{ $digimon->name }}">
            </li>
            <br>
        @endforeach
    </div>
</body>
</html>