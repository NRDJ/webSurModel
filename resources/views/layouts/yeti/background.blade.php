<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Agencia Sur Model</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icono_surmodel.svg') }}">
  <meta content="Sur Model" property="og:title"/>
  <meta content="{{ asset('img/_surmodel_og.jpg') }}" property="og:image"/>
  <meta content="Bienvenido a SurModel, a continuación te presentamos nuestro casting." property="og:description"/>
  
  @livewireStyles
  <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css')}}" />
  @livewireScripts
  @yield('css')
</head>
<body>

    @yield('content')
    
    <script src="{{ asset('dist/assets/js/vendor.js')}}"></script>
    <script src="{{ asset('dist/assets/js/glide.min.js')}}"></script>
    @yield('js')
    <script src="{{ asset('dist/assets/js/script.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts/>
</body>
</html>