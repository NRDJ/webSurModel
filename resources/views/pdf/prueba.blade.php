{{-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Document</title>
    </head>
    <body>
        Hola! {{ $publication->event->name}}

        @foreach ($people as $person)
            <p>{{ $person->name }}</p>
        @endforeach

    </body>
</html> --}}

<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        .page_break { page-break-before: always; }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
<header>
    <h1>{{ config('app.name') }}</h1>
</header>

<main>
    <h1>Evento {{ $publication->event->name }}</h1>
    <h2>Perfil {{ $publication->profile->name }}</h2>
    <br>
    <h3>Personas Seleccionadas</h3>

    @foreach ($people as $person)
        @if ($person->photos)
        @foreach ($person->photos as $photo)
            @if ($photo->confirmed)
                <div class="page_break"></div>
                <h4>{{ $person->name }}</h4>
                <p><img src="{{ storage_path('app/photos/'.$person->id.'/'.$photo->photo_path) }}" width="300"/></p>
                @endif
            @endforeach
        @endif
    @endforeach

</main>

<footer>
    <h1>{{ asset('') }}</h1>
</footer>
</body>
</html>