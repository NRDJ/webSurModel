<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="author" content="ASD Informáticos - Adrián Ríos Sánchez" />
    <meta name="Description" content="Bienvenido a SurModel, Trabaja en nuestros eventos y activaciones a lo largo de todo Chile y genera ingresos según tus tiempos"/>
    <meta name="keywords" content="Modelos, Anfitrionas, Promotor, Promotora, Supervisor, Supervisora, Eventos, Sur Model" />
    <meta name="robots" content="index, follow" /> 
    <meta content="Sur Model" property="og:title"/>
    <meta content="{{ asset('img/_surmodel_og.jpg') }}" property="og:image"/>
    <meta content="Bienvenido a SurModel, Trabaja en nuestros eventos y activaciones a lo largo de todo Chile y genera ingresos según tus tiempos." property="og:description"/>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icono_surmodel.svg') }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sitio-surmodel.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    @livewireStyles
    <title>Sur Model @yield('title')</title>
  </head>
  <body>
    <div class="container-fluid @yield('style')">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('img/logo_surmodel_color.svg') }}" height="25" alt="Logo SurModel" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <div class="icono"></div>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
                <ul class="navbar-nav text-end nav-pills bot">
                    <li><a href="{{ route('index') }}" class="@yield('index') bot">INICIO</a></li>
                    <li><a href="{{ route('about') }}" class="@yield('about') bot">NOSOTROS</a></li>
                    <li><a href="{{ route('works') }}" class="@yield('works') bot">TRABAJOS</a></li>
                    <li><a href="{{ route('services') }}" class="@yield('services') bot">SERVICIOS</a></li>
                    <li><a href="{{ route('services') }}#contacto" class="@yield('contact') bot">CONTACTO</a></li>
                </ul>
            </div>
        </nav>
        
        @yield('content')
       
    </div>

    @yield('main')
      
    <div class="container-fluid bg_oscuro">
        <div class="container">
            <div class="row">
                <div class="col-12 color_fucsia text-center py-4">
                    <p class="m-0"><i class="far fa-copyright"></i> 2022 Copyright: surmodel.cl - Todos los Derechos Reservados - ASD Informáticos - Design Adrián Ríos.</p>
                </div>
            </div>
        </div>  
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
  </body>
</html>