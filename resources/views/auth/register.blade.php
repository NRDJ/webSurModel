@extends('layouts.site')
@section('title', ' - Registro')
@section('style', 'bg_portada1 px-0')
@section('register', 'active')

@section('content')
<main class="container-fluid padd_content_top padd_content_bottom bg_inscripcion">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 col-xl-3 text-center text-xl-end mb-5 me-0 me-xl-5">
            <h1 class="tit_general text-white p-5 mb-5 bg_oscuro">INSCRÍBETE Y SÉ PARTE DEL UNIVERSO SURMODEL</h1>
             <p class="text-white mb-5 subtit_registro"><span class="bold">¡QUERÉMOS SABER SOBRE TÍ!</span><br> COMPLETA EL FORMULARIO, ADJUNTANOS FOTOGRAFÍAS PARA CONOCERTE Y COMÉNTANOS SI HAZ TRABAJADO EN BTL ANTERIORMENTE</p>
        </div>

        <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center text-xl-end">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row justify-content-end">
                            
                    <div class="col-12 col-md-12 form-floating mb-4">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
                        <label for="floatingInput">Nombre de usuario</label>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        
                    <div class="col-12 col-md-12 form-floating mb-4">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <label for="floatingInput">Email</label>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                            
                    <div class="col-12 col-md-6 form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nombre">
                        <label for="floatingInput">Contraseña</label>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 form-floating mb-4">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nombre">
                        <label for="floatingInput">Confirmar contraseña</label>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 form-floating mb-4">
                        <div class="text-start mt-4">
                            <a class="btn_gral mt-4" href="{{ route('login') }}">¿ya posees una cuenta?</a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 form-floating mb-4">
                        <div class="text-md-end">
                            <input type="submit" class="btn_gral mt-4" id="floatingInput" value="Registrarse">
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</main>
@endsection