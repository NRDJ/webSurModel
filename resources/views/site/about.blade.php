@extends('layouts.site')
@section('title', ' - Nosotros')
@section('style', 'bg_oscuro px-0 padd_content_top')
@section('about', 'active')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 bg_gris_oscuro text-black text-center p-5 d-grid align-items-center  order-lg-1 order-2">
                <div>
                   <h1 class="tit_general pt-5">Trayectoria</h1>
                    <p class="py-5">Nuestros 18 años de trayectoria, junto a nuestra capacidad de innovación y adaptación al mercado, avalan el compromiso y seriedad con el que trabajamos, por lo que incorporar tecnología de alto nivel, y contar con un staff altamente calificado al hacer énfasis en el bienestar y capacitación de nuestro capital humano, nos permiten hoy entregar de forma permanente, un servicio integral y diferenciador.
                    </p>
                    <p>Somos parte de:</p>
                    
                    <img src="img/logo_mi.png" height="80" class="d-block m-auto" alt="Logo Mujeres Influyentes">
                    <img src="img/logo_me.svg" height="70" class="pt-3 mb-5" alt="Logo Mujeres Empresarias">
                </div>
            </div>
            
            <div class="col-12 col-md-12 col-lg-4 bg_gris_claro position-relative text-center p-5 d-grid align-items-center  order-lg-2">
                <img src="img/circulo_sm.svg" class="circulo_sm" alt="Circulo SurModel">
                
                <div>
                     <h1 class="tit_general pt-5">SurModel</h1>
                    <p class="pb-5">Somos una empresa de representación y gestión de personal de promoción, dedicada al marketing y servicio BTL con capacidad de operaciones a nivel nacional.
                    Debido a que nuestra apertura al mercado se realiza desde Regiones, descentralizamos un servicio con el fin de poder entregar soluciones a empresas a lo largo de todo el País.</p>

                    <h1 class="tit_general text-black pt-5">Qué hacemos?</h1>
                    <p class="pb-5">Entregamos soluciones y asesoría en la producción de m     arketing BTL en promociones y/ó eventos a través de nuestros más de 5000 Modelos inscritos en nuestra plataforma, seleccionados según el concepto y enfoque de cada marca, y Equipamiento Tecnológico con proyectos de innovación digital.</p>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-4 p-0 order-3">
                <img src="img/perfil-carolina.png" class="img_claudia" alt="Foto Carolina y Fabiola">
            </div>
        </div>  
    </div>
      
    
    <div class="container-fluid bg_hitos padd_content_bottom padd_content_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-10 bg-light text-center py-3 mb-5">
                    <h1 class="tit_general">Hitos</h1>
                </div>
                
                <div class="col-12 col-md-5 col-lg-4 text-center text-white bg_oscuro p-5 me-0 me-md-5 mb-5">
                    <h1 class="tit_general py-5">Ironman</h1>
                    <p class="pb-5">Más de 10 años en circuito IRONMAN de Pucón 70.3 con 300 asistentes por día, capacitando de
                    forma óptima a los hidratadores.</p>
                </div>
                
                <div class="col-12 col-md-5 col-lg-4 text-center text-white bg_oscuro p-5 mb-5">
                    <h1 class="tit_general py-5">Malls</h1>
                    <p class="pb-5">Coordinación en más de 7 Mall Cencosud con motivo del día del Padre y de la Madre, con diversas promotoras
                    coordinadas desde Coyhaique.</p>
                </div>
                
                <div class="col-12 col-md-5 col-lg-4 text-center text-white bg_oscuro p-5 me-0 me-md-5 mb-5">
                    <h1 class="tit_general py-5">En todo el país</h1>
                    <p class="pb-5">Descentralización de un rubro que se encuentra alojado casi en su totalidad en la Región Metropolitana saliendo hacia Regiones, de esta forma inversa podemos llegar a clientes de cualquier parte del País, además de la capacidad de ofrecer una mayor cantidad de puestos de trabajo.</p>
                </div>
                
                <div class="col-12 col-md-5 col-lg-4 text-center text-white bg_oscuro p-5 mb-5">
                    <h1 class="tit_general py-5">Injuv</h1>
                    <p class="pb-5">Premio Nacional de emprendimiento INJUV el año 2010 con intercambio a Corea, además del apoyo de CORFO en Aysén con nuestra innovadora Aplicación.</p>
                </div>
            </div>
        </div>  
    </div>
      
      
    <div class="container-fluid bg_gris_claro padd_small_top padd_small_bottom">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-12 col-md-10 col-lg-10 bg_oscuro text-white text-center py-3 mb-5">
                    <h1 class="tit_general">Equipo</h1>
                </div>
                <div class="col-12 col-md-4 col-lg-3 text-white text-center mb-5 px-0 px-md-3">
                    <img src="img/carolina.jpeg" class="img_equipo" alt="">
                    <div class="bg_oscuro mt-3 p-3">
                        <p class="nombres_equipo mb-1">Carolina Sanhueza</p>
                        <p class="cargo_equipo m-0">Directora Surmodel</p>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 col-lg-3 text-white text-center mb-5 px-0 px-md-3">
                    <img src="img/fabiola.jpeg" class="img_equipo" alt="">
                    <div class="bg_oscuro mt-3 p-3">
                        <p class="nombres_equipo mb-1">Fabiola Neira</p>
                        <p class="cargo_equipo m-0">Directora RRHH</p>
                    </div>
                </div>
                
                <!-- <div class="col-12 col-md-4 col-lg-3 text-white text-center mb-5 px-0 px-md-3">
                    <img src="img/foto.jpg" class="img_equipo" alt="">
                    <div class="bg_oscuro mt-3 p-3">
                        <p class="nombres_equipo mb-1">Leonardo Vásquez</p>
                        <p class="cargo_equipo m-0">Director I+D</p>
                    </div>
                </div> -->
            </div>
        </div>  
        <p class="tit_modelos pt-5 mb-0"><span class="bold">y más de 5.000 modelos</span> en todo el territorio nacional</p>
    </div>
    <div class="container-fluid bg_modelos"></div>
@endsection