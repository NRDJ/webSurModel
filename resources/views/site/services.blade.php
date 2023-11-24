@extends('layouts.site')
@section('title', ' - Servicios')
@section('style', 'bg_oscuro px-0 padd_small_top')
@section('services', 'active')

@section('main')
    <main class="container-fluid bg_gris_claro padd_small_bottom padd_small_top">
        <div class="container">
            <div class="row justify-content-evenly px-3">
                <div class="col-12 text-center pb-5">
                    <h1 class="tit_general">NUESTROS SERVICIOS PARA TU MARCA</h1>
                    <p class="pt-5 w-75 m-auto">Como Surmodel creemos en los proyectos personalizados, hechos a la medida para cada cliente. Por eso nuestra estrategia se basa en disponer de equipos capacitados para ampliar y fidelizar los diversos públicos con las campañas de nuestros clientes.</p>
                </div>

                <div class="col-12 col-lg-3 mb-3 bg_oscuro text-white text-center p-4 mt-5">
                    <h1 class="tit_serv">Scouting <br> personalizado</h1>
                    <p class="pt-3">Desarrollamos amplias y acertadas campañas de selección de personal, donde nos aseguramos de crear equipos altamente capacitados, confiables y responsables. Enfocándonos en captar al perfil que mejor represente los intereses y objetivos de tu marca. </p>
                </div>

                <div class="col-12 col-lg-3 mb-3 bg_oscuro text-white text-center p-4 mt-5">
                    <h1 class="tit_serv">Clippings <br></h1>
                    <p class="pt-3">Sabemos el valor de tu tiempo, por eso contamos con un detallado monitoreo de las campañas efectuadas por Surmodel a través del  apoyo de expertos en campañas publicitarias. Así, con informes periódicos, medimos la efectividad de nuestros servicios de manera que podemos flexibilizar o crear nuevas estrategias mientras efectuamos nuestro trabajo. </p>
                </div>

                <div class="col-12 col-lg-3 mb-3 bg_oscuro text-white text-center p-4 mt-5">
                    <h1 class="tit_serv">Cultura <br></h1>
                    <p class="pt-3">Nuestra apuesta busca promover las capacidades múltiples en nuestros equipos de trabajo. Por eso preparamos a nuestros jóvenes en materias como son los servicios de  atención a clientes premium y la capacitación en ventas de alta gama. Así, nos enfocamos en crear equipos multidisciplinarios que se adapten a la campaña que sea, con el profesionalismo y confianza que caracteriza a Surmodel. </p>
                </div>
            </div>
        </div>
    </main>
    
    <div class="container-fluid bg_oscuro padd_small_top padd_small_bottom">
        <div class="container">
            <div class="row justify-content-left">
                <div class="col-12 text-white text-center pb-5">
                    <h1 class="tit_general">Algunos de nuestros clientes</h1>
                </div>
                
                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente1.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">Inacap</p>
                </div>

                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente2.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">Exponor</p>
                </div>

                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente3.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">Falabella</p>
                </div>

                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente4.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">Uber Eats</p>
                </div>

                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente6.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">Parque Arauco</p>
                </div>

                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente7.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">absolut</p>
                </div>
                
                <div class="col-12 col-md-2 text-center d-inline-block clientes mx-0 mx-md-4 mx-lg-0">
                    <img src="img/cliente6.png" class="img_cliente" alt="Cliente">
                    <p class="nombre_cliente text-center">Parque Arauco</p>
                </div>
            </div>
        </div>  
    </div>
        
      
    <footer id="contacto" class="container-fluid bg_footer padd_small_bottom padd_small_top position-relative">
        <img src="img/circulo_sm.svg" class="circulo_footer" alt="Circulo SurModel">
        <div class="container">
            <div class="row justify-content-evenly">
                <div class="col-12 text-center pb-5">
                    <h1 class="tit_general">Conéctate con nosotros</h1>
                </div>
                
                <div class="col-12 col-lg-7 bg_oscuro p-5 mb-5">
                    @livewire('site.form-contact-component')
                </div>
                
                <div class="col-12 col-lg-3 text-center">
                    <p>Surmodel ofrece distinción y calidad a través de un equipo capacitado y responsable de jóvenes detalladamente seleccionadas</p>
                    
                    <div class="Redes_sociales mt-5">
                        <div class="my-2"><a href="mailto:carolina@surmodel.cl"><i class="fas fa-envelope"></i>&nbsp;&nbsp; carolina@surmodel.cl</a></div>
                        <div class="my-2"><a href="tel:+56995951722"><i class="fas fa-phone-alt"></i>&nbsp;&nbsp; +56 9 7778 8618</a></div>  
                        <div class="my-2"><a href="" target="_blank"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp; Av. Vitacura # 2909, Oficina 305, Las Condes, Chile.</a></div>
                        
                        <a href="#"><div class="d-inline-block mx-3 mt-4 icon_rrss"><i class="fab fa-facebook-f"></i></div></a>
                        <a href="#"><div class="d-inline-block mx-3 icon_rrss"><i class="fab fa-instagram"></i></div></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection