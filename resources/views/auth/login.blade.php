<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="author" content="ASD Informáticos - Adrián Ríos Sánchez" />
    <meta name="Description" content=""/>
    <meta name="keywords" content="" />
    <meta name="robots" content="index, follow" /> 
    <meta content="Sur Model" property="og:title"/>
    <meta content="img/_surmodel_og.jpg" property="og:image"/>
    <meta content="Bienvenido a SurModel, Trabaja en nuestros eventos y activaciones a lo largo de todo Chile y genera ingresos según tus tiempos." property="og:description"/>
    
    
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sitio-surmodel.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">
    <script src="js/fontawesome.js"></script>

    <title>Sur Model | Login</title>
  </head>
  <body>
      
    <div class="container-fluid bg_login d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 bg_form_login p-5 text-center">
                <img src="img/logo_surmodel_color.svg" class="mb-5 img-fluid"  alt="Logo SurModel color">
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row justify-content-end">
                        <div class="col-12 form-floating mb-4">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            <label for="floatingInput">Email</label>
                        </div>

                        <div class="col-12 form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                            <label for="floatingInput">Contraseña</label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label" for="formCheckDefault">Recuerdame</label>
                            <input class="form-check-input" type="checkbox" value="" id="formCheckDefault">

                        </div>
                    </div>
                    <div class="text-start text-md-end">
                        <input type="submit" class="btn_login mt-5" id="floatingInput" value="Ingresar">
                    </div>

                </form>
                <div class="btn_recuperar mt-4 d-block text-center">
                    <a href="{{ route('register') }}">Registrarse</a>
                </div>
                <div class="btn_recuperar mt-4 d-block text-center">
                    <a href="{{ route('forget.password.get')}}">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
      
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>