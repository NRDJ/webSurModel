@extends('layouts.site')
@section('title', ' - Inicio')
@section('style', 'bg_portada1 px-0')
@section('index', 'active')

@section('content')

<div class="container padd_content_top mt-5">
    <div class="row justify-content-end m-0">
        <div class="col-12 col-md-5 col-lg-3 text-white text-center borde_ini">
            <h1 class="tit_registro_ini pb-5">Sé parte de Surmodel</h1>
            <p>TRABAJA EN NUESTROS EVENTOS Y ACTIVACIONES A LO LARGO DE TODO CHILE <br> GENERA INGRESOS SEGÚN TUS TIEMPOS.</p>
            <a href="{{ route('register') }}"><button class="btn_gral mt-5">Registrate</button></a>
        </div>
    </div>
</div>
        
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <img src="{{ asset('img/surmodel.svg')}}" class="img_blend img-fluid" alt="SurModel">
        </div>
    </div>
</div>

@endsection

@section('main')
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 p-0 order-lg-1 order-2">
                <img src="{{ asset('img/perfil-carolina.png')}}" class="img_claudia" alt="Foto Carolina y Fabiola">
            </div>
            
            <div class="col-12 col-md-12 col-lg-4 bg_gris_claro position-relative text-center p-5 d-grid align-items-center order-lg-2">
                <img src="{{ asset('img/circulo_sm.svg')}}" class="circulo_sm" alt="Circulo SurModel">
                
                <div>
                    <p class="py-5">“Como empresa, nuestro compromiso se orienta al mejoramiento continuo de nuestros procesos con el fin de atender con eficiencia, eficacia y efectividad, las necesidades de nuestros clientes para su plena satisfacción. Para ello buscamos innovar constantemente con nuestras propuestas, basadas en la capacitación permanente y en el análisis continuo del mercado, adecuándonos y adaptándonos al cambio de forma permanente.”
                    </p>
                    <img src="{{ asset('img/firma_carolina.svg')}}" height="100" alt="Firma Carolina">
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-4 bg_gris_oscuro text-black text-center p-5 d-grid align-items-center order-3">
                <div>
                    <h1 class="tit_general pt-5">qué nos mueve</h1>
                    <p class="pb-5">Crear una solución personalizada y eficiente a nuestros clientes entregando la mejor calidad de servicio y acompañándolos de principio a fin, generando una experiencia inolvidable a través de estrategias que permitan resaltar los atributos y beneficios de la marca impulsándola a destacar, con el compromiso y la calidad que nos caracteriza.</p>

                    <h1 class="tit_general text-black pt-5">Propósito</h1>
                    <p class="pb-5">Ser reconocidos como líderes en el mercado y posicionarnos como una empresa de referencia en el ámbito nacional, esforzándonos por ofrecer los más altos estándares de calidad y seguridad, brindando soluciones atractivas e innovadoras con el fin de satisfacer las expectativas de nuestros clientes.</p>
                </div>
            </div>
        </div>  
    </main>
      
    <div class="container-fluid bg_ini_trabajos">
        <div class="container">
            <div class="row padd_small_top padd_small_bottom">
                <div class="col-12 col-md-12 col-lg-6 px-3 py-5 p-md-5 text-center text-white bg_oscuro">
                    <h1 class="text-uppercase tit_general">Trabaja con nosotros</h1>
                    <p>trabaja en nuestros eventos y activaciones a lo largo de todo chile <br> genera ingresos según tus tiempos!!</p>
                    <a href="{{ route('register') }}"><button class="btn_gral mt-5">Registrate</button></a>
                </div>
            </div>  
        </div>
    </div>
@endsection