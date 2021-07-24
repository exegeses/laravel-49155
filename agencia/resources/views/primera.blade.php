<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>hemos creado la primera view</h1>

    {{ date('d/m/Y') }}

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aut corporis cum dignissimos exercitationem mollitia nemo porro rem veritatis voluptatibus? Amet aperiam consectetur hic, necessitatibus porro qui quisquam repellat ut.</p>

    fruta: {{ $fruta }}

    <h2>directiva condicional</h2>

    @if( $nombre == 'marcos' )
        Bienvenido {{ $nombre }}
    @else
        usuario desconocido
    @endif

    <h2>operador ternario</h2>

    {{ ( $nombre == 'marcos' )?'Bienvenido '.$nombre :'usuario desconocido' }}

</body>
</html>
