<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta content="Sur Model" property="og:title"/>
  <meta content="{{ asset('img/_surmodel_og.jpg') }}" property="og:image"/>
  <meta content="Bienvenido a SurModel, Trabaja en nuestros eventos y activaciones a lo largo de todo Chile." property="og:description"/>
  <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css')}}" />
</head>
<body>

    @yield('content')

    <!-- Scripts -->
    <script src="{{asset('dist/assets/js/vendor.js')}}"></script>
    <script src="{{asset('dist/assets/js/script.js')}}"></script>
</body>
</html>