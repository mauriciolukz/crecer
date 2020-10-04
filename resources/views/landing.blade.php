
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


    <!-- Custom and plugin javascript -->

    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- blueimp gallery -->
    <script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/plugins/blueimp/css/blueimp-gallery.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('landing/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">


</head>

<body id="page-top" class="landing-page">
<!-- Inicia menu -->
<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="landing/img/logocrece.png" alt="">
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
<!-- Termina menu -->

 <!-- Inicia Slider -->
  <div id="inSlider" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
        <li data-target="#inSlider" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
                <div class="item active">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>“Muchos de nosotros <br/>
                            no estamos viviendo <br/>
                            nuestros sueños<br/>
                            porque estamos<br/>
                            viviendo nuestros miedos”</h1>
                            <p>Les Brown</p>
                            <p>
                                <a href="https://api.whatsapp.com/send?phone=528712754696&text=Hola%20que%20tal,%20quisiera%20conocer%20m%C3%A1s%20sobre%20Creando%20Certezas" <button class="btn btn-primary " type="button"><i class="fa fa-mobile"></i>&nbsp;Contacta con un Asesor</button></a>
                            </p>
                        </div>
                        <div class="carousel-image wow zoomIn"><img src="landing/img/laptop.png" alt="crecer"/></div>
                    </div>
                    <!-- Set background for slide in css -->
                    <div class="header-back one"></div>
                </div>

                <div class="item">
                    <div class="container">
                        <div class="carousel-caption">
                        <br/><br/><br/><h1>“Dando aprendes <br/>
                            a Recibir, <br/>
                            Recibiendo<br/>
                            aprendes a Dar”</h1>

                        </div>
                        <div class="carousel-image wow zoomIn"><img src="landing/img/movil.png" alt="crecer"/></div>
                    </div>
                    <!-- Set background for slide in css -->
                    <div class="header-back two"></div>
                </div>
                <div class="item">
                    <div class="container">
                        <div class="carousel-caption">

                        </div>

                    </div>
                    <!-- Set background for slide in css -->
                    <div class="header-back three"></div>
                </div>


        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#inSlider" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#inSlider" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                        </a>
    </div>
<!-- Termina Slider -->

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
            <img src="landing/img/perspective.png" alt="dashboard" class="img-fluid">
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
            <img src="landing/img/dashboard.png" alt="dashboard" class="img-fluid float-right">
        </div>
    </div>
    <div class="row features-block">
    <div class="col-lg-6 text-right wow fadeInRight">
            <img src="landing/img/dashboard2.png" alt="dashboard" class="img-fluid float-right">
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


            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">

                            <div class="ibox-content">

                                <h2 style="text-align:center">Rangos a alcanzar</h2>
                                    <p>
                                        <strong>En Creando Certezas</strong> tienes la capacidad de avanzar cada vez que cicle tu comunidad y puedes llegar a los siguientes rangos:</a>
                                    </p>

                                <div class="lightBoxGallery">

                                    <div class="content">
                                        <div class="column">
                                                <a href="landing/img/bronce8.jpg"  title="Bronce" data-gallery=""><img src="landing/img/bronce2.jpg" style="width:90%"></a>
                                                <h4><span class="navy">Rango Bronce</span> </h4>
                                        </div>
                                        <div class="column">
                                                <a href="landing/img/plata16.jpg"  title="Plata" data-gallery=""><img src="landing/img/plata2.jpg" style="width:90%"></a>
                                                <h4><span class="navy">Rango Plata</span> </h4>
                                        </div>
                                        <div class="column">
                                                <a href="landing/img/oro40.jpg"  title="Oro" data-gallery=""><img src="landing/img/oro2.jpg" style="width:90%"></a>
                                                <h4><span class="navy">Rango Oro</span> </h4>
                                        </div>
                                        <div class="column">
                                                <a href="landing/img/platino75.jpg"  title="Platino" data-gallery=""><img src="landing/img/platino2.jpg" style="width:90%"></a>
                                                <h4><span class="navy">Rango Platino</span> </h4>
                                        </div>
                                        <div class="column">
                                                <a href="landing/img/esmeralda150.jpg"  title="Esmeralda" data-gallery=""><img src="landing/img/esmeralda2.jpg" style="width:90%"></a>
                                                <h4><span class="navy">Rango Esmeralda</span> </h4>
                                        </div>
                                        <div class="column">
                                                <a href="landing/img/diamante300.jpg" title="Diamante" data-gallery=""><img src="landing/img/diamante2.jpg" style="width:90%"></a>
                                                <h4><span class="navy">Rango Diamante</span> </h4>
                                        </div>


                                    </div>

                                    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                                    <div id="blueimp-gallery" class="blueimp-gallery">
                                        <div class="slides"></div>
                                        <h3 class="title"></h3>
                                        <a class="prev">‹</a>
                                        <a class="next">›</a>
                                        <a class="close">×</a>
                                        <a class="play-pause"></a>
                                        <ol class="indicator"></ol>
                                    </div>

                                </div>

                                    <div class="wrapper wrapper-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <div class="ibox ">

                                                <div class="ibox-content">
                                                <div class="col-lg-12 text-center m-t-lg m-b-lg">
                                                <p>Contamos con un plan de crecimiento que te ayudará a cumplir todas y cada una de tus metas financieras en el desarrollo de cada comunidad.</p>
                                        </div>
                                        <div class="row features-block">
                                            <div class="col-lg-3 features-text wow fadeInLeft"></div>
                                            <div class="col-lg-6 text-right m-t-n-lg wow zoomIn">
                                                <img src="landing/img/feliz.png" class="img-fluid" alt="dashboard">
                                            </div>
                                        <div class="col-lg-3 features-text text-right wow fadeInRight">

            </div>
        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
                <img src="landing/img/iphone.jpg" class="img-fluid" alt="dashboard">
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
                        <img alt="image" src="landing/img/juanita.jpg">
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
                        <img alt="image" src="landing/img/mary1.jpg">
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
                        <img alt="image" src="landing/img/carlos1.jpg">
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
                        <img alt="image" src="landing/img/oralia.jpg">
                    </a>
                    <div class="media-body">
                        <div class="commens-name">
                        Oralia Galván
                        </div>
                        <small class="text-muted">Fresnillo, Zacatecas</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bubble">
                    "Soy socio fundador y mi crecimiento en esta compañia es de tres comunidades pagadas y cerrando mi cuarta, solo me queda decirles que esta empresa es real y esta funcionando al 100%"
                </div>
                <div class="comments-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="landing/img/florencio.jpg">
                    </a>
                    <div class="media-body">
                        <div class="commens-name">
                        Florencio Gaxiola Gutierrez
                        </div>
                        <small class="text-muted">Culiacan, Sinaloa</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bubble">
                    "Estoy forjando mis sueños, y ahora puedo contemplar un futuro con prosperidad en todos los sentidos,¡¡Gracias a Dios por permitirme ser parte de esta gran empresa!!!"
                </div>
                <div class="comments-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="landing/img/zoila.jpg">
                    </a>
                    <div class="media-body">
                        <div class="commens-name">
                        Zoila Luna Marroquín
                        </div>
                        <small class="text-muted">Fresnillo, Zacatecas</small>
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
                <img src="landing/img/iphone1.png" class="img-fluid" alt="dashboard">
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

                <a href="https://api.whatsapp.com/send?phone=528712754696&text=Hola%20que%20tal,%20quisiera%20conocer%20m%C3%A1s%20sobre%20Creando%20Certezas" <button class="btn btn-primary " type="button"><i class="fa fa-mobile"></i>&nbsp;Contacta con un Asesor</button></a>
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


<script src="{{ asset('landing/js/jquery-2.1.1.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="{{ asset('landing/js/pace.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('landing/js/classie.js') }}"></script>
<script src="{{ asset('landing/js/cbpAnimatedHeader.js') }}"></script>
<script src="{{ asset('landing/js/wow.min.js') }}"></script>
<script src="{{ asset('landing/js/inspinia.js') }}"></script>
</body>
</html>
