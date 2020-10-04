<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creando Certezas</title>

    <script src="{{asset('landing2/js/lightbox.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('landing2/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/css/style.css') }}">
</head>
<body id="page-top" class="landing-page">

    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="landing2/img/logocrece.png" alt="">
                </a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="nav-link page-scroll" href="#page-top">Inicio</a></li>
                        <li><a class="nav-link page-scroll" href="#features">Historia</a></li>
                        <li><a class="nav-link page-scroll" href="#team">Rangos</a></li>
                        <li><a class="nav-link page-scroll" href="#testimonials">Testimonios</a></li>
                        <li><a class="nav-link page-scroll" href="#contact">Contacto</a></li>
                        <li><a class="nav-link page-scroll"<a class="nav-link" href="{{ route('login') }}">ACCESO</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div id="inSlider" class="carousel slide" data-ride="carousel" >
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>“Muchos de nosotros <br/>   
                        no estamos viviendo <br/>
                        nuestros sueños<br/>
                        porque estamos<br/>
                        viviendo nuestros miedos”</h1>
                        <p>Les Brown</p>
                        <p>
                            <a href="https://api.whatsapp.com/send?phone=8712754696&text=Hola%20que%20tal,%20quisiera%20conocer%20m%C3%A1s%20sobre%20Creando%20Certezas" <button class="btn btn-primary " type="button"><i class="fa fa-mobile"></i>&nbsp;Contacta con un Asesor</button></a>
                        </p>
                    </div>
                    <div class="carousel-image wow zoomIn"><img src="landing2/img/laptop.png" alt="laptop"/></div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>We create meaningful <br/> interfaces that inspire.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#inSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#inSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="container services">
        <div class="row">
            <div class="col-sm-3">
                <h2>Economía Colaborativa</h2>
                <p>Economía Colaborativa Tenemos como principio el trabajo en equipo, bajo el concepto de generar ingresos estables y progresivos apoyándonos unos a otros.  </p>
                
            </div>
            <div class="col-sm-3">
                <h2>Integridad</h2>
                <p>Somos una empresa con la seriedad que destaca el funcionamiento y actuamos dentro de los más rigurosos principios éticos y legales.</p>
                
            </div>
            <div class="col-sm-3">
                <h2>Responsabilidad</h2>
                <p>Trabajamos con excelencia siendo eficientes y perseverantes, en beneficio de nuestros clientes, de nuestra empresa y de la sociedad en general.</p>
                
            </div>
            <div class="col-sm-3">
                <h2>Honestidad y Confianza</h2>
                <p>Fortalecer, promover, formar y velar por el desarrollo de principios morales y sociales. Generamos credibilidad y manejamos responsablemente la información.</p>
                
            </div>
        </div>
    </section>

    <section  id="features" class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1><br/> <span class="navy"> Conoce Nuestra Historia</span> </h1>
                <p>Creando Certezas, nace de un sueño que después de algunos años se materializa una vez que se logra integrar el equipo necesario para llevarse a cabo, con la firme certeza de que no sería un proyecto más, iniciamos con una prueba piloto el 17 de Enero del 2020.Una empresa conformada por 13 socios con experiencia en la industria de multinivel de la cual se decide sacar lo mejor de dicho sistema para formar una sociedad donde se desarrolle una economía colaborativa, todos con la visión de vivir en un mundo mejor, donde las familias fomenten valores, sobre todo el amor y el respeto, esto no es cuestión económica, ya que es en beneficios de los usuarios, porque se hace necesario tener paz y tranquilidad en los hogares. Esto nos lleva a consolidar el hecho de que CREANDO CERTEZAS será en definitiva la empresa que dejará legado, que permanecerá en la historia y se convertirá en el parteaguas de una vida mejor para todas las familias. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 text-center wow fadeInLeft">
                <div>
                    <i class="fa fa-globe features-icon"></i>  
                    <h2>Nuestra Misión</h2>
                    <p>Desarrollar una sociedad con conocimiento financiero, que pueda crear abundancia y prosperidad en todos los hogares del mundo.</p>
                </div>
                <div class="m-t-lg">
                    <i class="fa fa-thumbs-o-up features-icon"></i>
                    <h2>Confianza</h2>
                    <p>Generamos credibilidad y manejamos responsablemente la información.</p>
                </div>
            </div>
            <div class="col-md-6 text-center  wow zoomIn">
                <img src="landing2/img/perspective.png" alt="dashboard" class="img-fluid">
            </div>
            <div class="col-md-3 text-center wow fadeInRight">
                <div>
                    <i class="fa fa-eye features-icon"></i>
                    <h2>Nuestra Visión</h2>
                    <p>Ser una empresa de carácter mundial con un nivel de primer orden, que nos permita seguir creando abundancia para todas las familias en un sentido integral.</p>
                </div>
                <div class="m-t-lg">
                    <i class="fa fa-users features-icon"></i>
                    <h2>Equipo</h2>
                    <p>El trabajo en equipo nos lleva al éxito, si estamos listos para dar debemos abrir los brazos para recibir.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contamos con Alianzas Estratégicas</h1>
                <p>Dentro de los beneficios que aportamos adicionales a nuestro producto principal, son las alianzas con empresas de primer nivel en las cuales puedes obtener un trato preferencial por pertenecer a Creando Certezas. </p>
            </div>
        </div>
        <div class="row features-block">
            <div class="col-lg-6 features-text wow fadeInLeft">
                <H1>Jutzpá</H1>
                <h2>Business Management </h2>
                <p>Nos enfocamos a mejorar la ejecución de los planes de las personas y empresas, mediante una metodología de “Juego Innovador” llevándolos de las ideas a la acción. Vamos a jugar, así es como logramos cambios, basados en una plataforma de valores, para incrementar el DESEMPEÑO INDIVIDUAL y de GRUPO.</p>
                
            </div>
            <div class="col-lg-6 text-right wow fadeInRight">
                <img src="landing2/img/dashboard.png" alt="dashboard" class="img-fluid float-right">
            </div>
        </div>
        <div class="row features-block">
        <div class="col-lg-6 text-right wow fadeInRight">
                <img src="landing2/img/dashboard2.png" alt="dashboard" class="img-fluid float-right">
            </div>
            <div class="col-lg-6 features-text wow fadeInLeft">
                <H1>Genova</H1>
                <h2>Laboratorio Genético </h2>
                <p>GENOVA es una Startup Mexicana en Biotecnología con soluciones NO invasivas. Nuestros colaboradores con más de 20 años de experiencia en varios puntos del país y tecnología de vanguardia nos permite ofrecer confianza y seguridad a nuestros pacientes. Si las personas pudieran recuperar la salud y el bienestar de una forma práctica y accesible. Contamos con más de 30 pruebas genéticas: Predisposición genética para cáncer. Predisposición genética para obesidad. Nutrigenética. Actividad física. Prueba de paternidad.</p>
                
            </div>
        </div>
    </section>

<!-- Inicia Contenedor de Rangos -->
    <section id="team" class="gray-section team">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>En Creando Certezas tienes oportunidad de que tu Ahorro Crezca</h1>
                    <p>Ya que contamos con un sistema escalable que te permite generar mayores ingresos en cada nivel.</p>
                </div>
            </div>
                    <div class="wrapper wrapper-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox ">
                                    <div class="ibox-content">
                                        <h2 style="text-align:center">Rangos a alcanzar</h2>
                                            <div class="row">
                                                <div class="column">
                                                    <img src="landing2/img/bronce1.jpg"  style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
                                                </div>
                                                <div class="column">
                                                    <img src="landing2/img/plata1.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
                                                </div>
                                                <div class="column">
                                                    <img src="landing2/img/oro1.jpg" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
                                                </div>
                                                <div class="column">
                                                    <img src="landing2/img/platino1.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
                                                </div>
                                                <div class="column">
                                                    <img src="landing2/img/esmeralda1.jpg" style="width:100%" onclick="openModal();currentSlide(5)" class="hover-shadow cursor">
                                                </div>
                                                <div class="column">
                                                    <img src="landing2/img/diamante1.jpg" style="width:100%" onclick="openModal();currentSlide(6)" class="hover-shadow cursor">
                                                </div>
                                            </div>
                                                

                                                <div id="myModal" class="modal">
                                                    <span class="close cursor" onclick="closeModal()">&times;</span>
                                                        <div class="modal-content">

                                                            <div class="mySlides">
                                                                <img src="landing2/img/bronce1.jpg" style="width:100%">
                                                            </div>

                                                            <div class="mySlides">
                                                                <img src="landing2/img/plata1.jpg" style="width:100%">
                                                            </div>

                                                            <div class="mySlides">
                                                                <img src="landing2/img/oro1.jpg" style="width:100%">
                                                            </div>
                                                            
                                                            <div class="mySlides">
                                                                <img src="landing2/img/platino1.jpg" style="width:100%">
                                                            </div>
                                                            
                                                            <div class="mySlides">
                                                                <img src="landing2/img/esmeralda1.jpg" style="width:100%">
                                                            </div>

                                                            <div class="mySlides">
                                                                <img src="landing2/img/diamante1.jpg" style="width:100%">
                                                            </div>
                                                                
                                                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                                                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                                            <div class="caption-container">
                                                                <p id="caption"></p>
                                                            </div>


                                                            <div class="column">
                                                                <img class="demo cursor" src="landing2/img/bronce1.jpg" style="width:100%" onclick="currentSlide(1)" alt="Rango Bronce">
                                                            </div>

                                                            <div class="column">
                                                                <img class="demo cursor" src="landing2/img/plata11.jpg" style="width:100%" onclick="currentSlide(2)" alt="Rango Plata">
                                                            </div>

                                                            <div class="column">
                                                                <img class="demo cursor" src="landing2/img/oro1.jpg" style="width:100%" onclick="currentSlide(3)" alt="Rango Oro">
                                                            </div>

                                                            <div class="column">
                                                                <img class="demo cursor" src="landing2/img/platino1.jpg" style="width:100%" onclick="currentSlide(4)" alt="Rango Platino">
                                                            </div>

                                                            <div class="column">
                                                                <img class="demo cursor" src="landing2/img/esmeralda1.jpg" style="width:100%" onclick="currentSlide(5)" alt="Rango Esmeralda">
                                                            </div>

                                                            <div class="column">
                                                                <img class="demo cursor" src="landing2/img/diamante1.jpg" style="width:100%" onclick="currentSlide(6)" alt="Rango Diamante">
                                                            </div>
                                                        </div>   
                                                </div>
                                                    <div class="col-lg-12 text-center m-t-lg m-b-lg">
                                                        <p>Contamos con un plan de crecimiento que te ayudará a cumplir todas y cada una de tus metas financieras en el desarrollo de cada comunidad.</p>
                                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="row">
                
            </div>
        </div>
    </section>
<!-- Termina Contenedor de Rangos -->
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>"Si Piensas Que Perderás, Estás Perdido, Pues El Mundo Nos Enseña Que El Éxito Empieza En La Voluntad Del Hombre… Todo Está En El Estado De Ánimo.</h1>
                    <p>Napoleon Hill. </p>
                </div>
            </div>
            <div class="row features-block">
                <div class="col-lg-3 features-text wow fadeInLeft">
                    
                </div>
                <div class="col-lg-6 text-right m-t-n-lg wow zoomIn">
                    <img src="landing2/img/iphone.jpg" class="img-fluid" alt="dashboard">
                </div>
                <div class="col-lg-3 features-text text-right wow fadeInRight">
                    
                </div>
            </div>
        </div>
    
    </section>

    <section class="timeline gray-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Cómo Comenzar tu camino al Éxito</h1>
                    <p>Es muy sencillo comenzar a crear Abundancia Financiera con Nosotros </p>
                </div>
            </div>
            <div class="row features-block">
    
                <div class="col-lg-12">
                    <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-user"></i>
                            </div>
    
                            <div class="vertical-timeline-content">
                                <h2>Comienza tu Registro</h2>
                                <p>Si recibiste la invitación de alguno de nuestros miembros, completa tu registro cumpliendo con todos los requisitos.</p>
                                <span class="vertical-date"> Inicio del Proceso <br/> <small></small> </span>
                            </div>
                        </div>
    
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-group"></i>
                            </div>
    
                            <div class="vertical-timeline-content">
                                <h2>Comienza a Crear tu Comunidad</h2>
                                <p>Invita a tus contactos y conocidos para que conozcan esta oportunidad de generar bienestar Financiero.</p>
                                <span class="vertical-date"> Crea tu Primera Comunidad <br/> <small></small> </span>
                            </div>
                        </div>
    
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-sitemap"></i>
                            </div>
    
                            <div class="vertical-timeline-content">
                                <h2>Continúa con tu Crecimiento</h2>
                                <p>Gracias al sistema de comunidades, puedes avanzar e incrementar tus ingresos alcanzando los diferentes Rangos de la compañía.</p>
                                <span class="vertical-date"> Sigue Avanzando <br/> <small></small> </span>
                            </div>
                        </div>
    
                    </div>
                </div>
    
            </div>
        </div>
    
    </section>

    <section id="testimonials" class="navy-section testimonials" style="margin-top: 0">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center wow zoomIn">
                    <i class="fa fa-comment big-icon"></i>
                    <h1>
                        Casos de Éxito
                    </h1>
                    <div class="testimonials-text">
                        <i>"Actualmente contamos con más de mil usuarios que han confiado en nuestra empresa."</i>
                    </div>
                </div>
            </div>
        </div>
    
    </section>

    <section class="comments gray-section" style="margin-top: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Estos Son Algunos Testimonios</h1>
                </div>
            </div>
            <div class="row features-block">
                <div class="col-lg-4">
                    <div class="bubble">
                    "¡Yo como tu tenia miedo de emprender este proyecto! Pero gracias al esfuerzo y trabajo ya logre cobrar mi 1a. comunidad bronce, voy x más hasta lograr cumplir muchos sueños!
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="landing2/img/juanita.jpg">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                            Juanita Salazar
                            </div>
                            <small class="text-muted">Zacatecas, Zac.</small>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4">
                    <div class="bubble">
                        "Hola mi nombre es Marychuy estoy feliz de pertenecer a creando certezas he cobrado 4 veces y estoy x cobrar la 5 esto es real si se puede!! INTENTALO!!"
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="landing2/img/mary1.jpg">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                            Mary Chuy Galván
                            </div>
                            <small class="text-muted">Fresnillo, Zacatecas</small>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4">
                    <div class="bubble">
                        "2 meses y he generado $18,000 con 3 comunidades Bronce, una persona más para cerrar mi 4 comunidad bronce. ¡Únete a la ECONOMIA COLABORATIVA!"
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="landing2/img/carlos1.jpg">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                            Carlos D. Ibarra Ochoa
                            </div>
                            <small class="text-muted">Torreón, Coahuila</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bubble">
                        "Muy contenta de pertenecer a esta gran empresa, ya cobre mi pimer bronce y voy x el segundo, GAD x esta oportunidad. !! ANIMATE y obtén todo lo que anhelas!!"
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="landing2/img/oralia.jpg">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                            Oralia Galván
                            </div>
                            <small class="text-muted">Fresnillo Zacatecas</small>
                        </div>
                    </div>
                </div>
    
    
    
            </div>
        </div>
    
    </section>

   

    <section id="#" class="pricing">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Creando Certezas</h1>
                    <p>“Todos tus sueños pueden hacerse realidad si tienes el coraje de perseguirlos”. – Walt Disney.</p>
                </div>
            </div>
            <div class="row features-block">
                <div class="col-lg-3 features-text wow fadeInLeft">
                    
                </div>
                <div class="col-lg-6 text-right m-t-n-lg wow zoomIn">
                    <img src="landing2/img/iphone1.png" class="img-fluid" alt="dashboard">
                </div>
                <div class="col-lg-3 features-text text-right wow fadeInRight">
                    
                </div>
            </div>
                
    
    </section>

    <section id="contact" class="gray-section contact">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Contáctanos</h1>
                </div>
            </div>
            <div class="row m-b-lg justify-content-center">
                <div class="col-lg-3 ">
                    
                </div>
                <div class="col-lg-4">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                
                    <a href="https://api.whatsapp.com/send?phone=8712754696&text=Hola%20que%20tal,%20quisiera%20conocer%20m%C3%A1s%20sobre%20Creando%20Certezas" <button class="btn btn-primary " type="button"><i class="fa fa-mobile"></i>&nbsp;Contacta con un Asesor</button></a>
                    <p class="m-t-sm">
                        Síguenos en Redes sociales
                    </p>
                    <ul class="list-inline social-icon">
                        <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCdNBUbFvgFI1FrfOur2dmgA"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="https://www.facebook.com/CreCer2020/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/creando_certezas/"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center m-t-lg m-b-lg">
                    <p><strong>&copy; 2020 Creando Certezas</strong><br/> Todos los Derechos Reservados</p>
                </div>
            </div>
        </div>
    </section>
 
                
    <script src="{{ asset('landing2/js/jquery-2.1.1.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script> 
    <script src="{{ asset('landing2/js/pace.min.js') }}"></script>
    <script src="{{ asset('landing2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing2/js/classie.js') }}"></script>
    <script src="{{ asset('landing2/js/cbpAnimatedHeader.js') }}"></script>
    <script src="{{ asset('landing2/js/wow.min.js') }}"></script>
    <script src="{{ asset('landing2/js/inspinia.js') }}"></script>
</body>
</html>