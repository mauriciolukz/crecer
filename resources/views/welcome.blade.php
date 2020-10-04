<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.ico" type="image/ico">
        <title>Creando Certezas</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{asset('css/personalizado.css')}}">
        <link href="landing/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="landing/css/custom.css" rel="stylesheet">

        <!-- Page Loader -->
        <link href="landing/css/loaders.css" rel="stylesheet">
        
        <!-- Font Awesome Style -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>
        <div class="loader loader-bg">
          <div class="loader-inner line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>

        <!-- Top Navigation 
            ================================================== -->
        <nav class="navbar top-bar navbar-static-top sps sps--blw">
          <div class="container relative-box "> <a class="navbar-brand" href="#" style="font-size: 20px;">CREANDO CERTEZAS</a>
            <button class="navbar-toggler hidden-lg-up collapsed" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation"> ☰ </button>
            <div class="navbar-toggleable-md collapse" id="exCollapsingNavbar2" >
              <ul class="nav navbar-nav pull-xs-right">
                <li class="nav-item active"> <a class="nav-link" href="#myCarousel">INICIO <span class="sr-only">(current)</span></a> </li>
                <li class="nav-item"> <a class="nav-link" href="#about">HISTORIA</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#services">NOSOTROS</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#price">COMUNIDADES</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#faq">¿COMO FUNCIONA?</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#servicios">SERVICIOS</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#testimonials">CASOS ÉXITO</a> </li>
                <li class="nav-item"> 
                  <a class="nav-link" href="{{ route('login') }}">ACCESO</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <!-- Carousel
            ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Integridad</h1>
                  <p>Actuamos dentro de los más rigurosos principios éticos y legales..</p>
                  <a class="btn btn-aqua btn-capsul" href="#contact" role="button">Conocer más</a> </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Responsabilidad</h1>
                  <p>Trabajamos con excelencia siendo eficientes y perseverantes, en beneficio de nuestros clientes, de nuestra empresa y de la sociedad.</p>
                  <a class="btn btn-capsul btn-aqua" href="#faq" role="button">Aprender más</a> </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Honestidad y Confianza</h1>
                  <p>Fortalecer, promover, formar y velar por el desarrollo de principios morales y sociales. Generamos credibilidad y manejamos responsablemente la información.</p>
                  <a class="btn btn-capsul btn-aqua" href="#services" role="button">Muestrame</a> </div>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
        <!-- /.carousel --> 

        <!-- Qucik Call to Action
            ================================================== -->
        <aside class="cta-block">
          <div class="container">
            <div class="row">
              <div class="col-md-9 text-md-left col-sm-12 text-xs-center text">
                <h4> CREANDO CERTEZAS  ECONOMÍA COLABORATIVA</h4>
                <p> QUE PUEDES SEGUIR HACIENDO LO MISMO QUE YA HACES Y OBTENER RESULTADOS DIFERENTES SIGUIENDO LA MEJOR ESTRATEGIA… CreCer </p>
              </div>
              <div class="col-md-3 col-sm-12 text-xs-center"> <a href="#contact" class="btn btn-capsul btn-dark-blue btn-lg">Quiero participar!</a> </div>
            </div>
          </div>
        </aside>

        <!-- Marketing messaging and featurettes
            ================================================== --> 
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <section class="about-home-block" id="about">
          <div class="container">
            <div class="row">
              <div class="col-md-5 text-md-left push-md-7 col-sm-12 text-xs-center">
                <h2 class="featurette-heading"><small>HISTORIA</small></h2>
                <p class="lead justificado" >Creando Certezas, nace de un sueño que después de algunos años se materializa una vez que se logra integrar el equipo necesario para llevarse a cabo, con la firme certeza de que no sería un proyecto más, iniciamos con una prueba piloto el 17 de Enero del 2020.Una empresa conformada por 13 socios con experiencia en la industria de multinivel de la cual se decide sacar lo mejor de dicho sistema para formar una sociedad donde se desarrolle una economía colaborativa, todos con la visión de vivir en un mundo mejor, donde las familias fomenten valores, sobre todo el amor y el respeto, esto no es cuestión económica, ya que es en beneficios de los usuarios, porque se hace necesario tener paz y tranquilidad en los hogares. Esto nos lleva a consolidar el hecho de que CREANDO CERTEZAS será en definitiva la empresa que dejará legado, que permanecerá en la historia y se convertirá en el parteaguas de una vida mejor para todas las familias.</p>
                <!--
                <a href="#" class="btn btn-capsul btn-aqua">Explore More</a> 
                -->
              </div>
              <div class="col-md-7 pull-md-5"> <img class="featurette-image img-fluid m-x-auto" src="img/logo/imagotipo_ creando_certezas_03.png" width="600px" height="600 px" alt="logotipo" > </div>
            </div>
          </div>
        </section>
        <section class="service-sec" id="services">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 text-xs-center service-block">
                <br>
                <br>
                <br>
                <br>
                <h3>NUESTRA MISIÓN ES:</h3>
                <p class="justificado ">Desarrollar una sociedad con conocimiento financiero, que pueda crear abundancia y prosperidad en todos los hogares del mundo.</p>
              </div>
              <div class="col-lg-6 text-xs-center service-block">
                <img class="featurette-image img-fluid m-x-auto img-responsive borderradius8px" src="landing/img/MISION.JPEG" alt="mision">
              </div>

              <div class="col-lg-6 text-xs-center service-block">
                <img class="featurette-image img-fluid m-x-auto img-responsive borderradius8px" src="landing/img/vision.JPG" alt="vision">
              </div>
              <div class="col-lg-6 text-xs-center service-block">
                <br>
                <br>
                <br>
                <br>
                <h3>NUESTRA VISIÓN ES:</h3>
                <p class="justificado">Ser una  empresa de carácter mundial con  un nivel de primer orden,  que nos permita seguir creando abundancia para todas  las familias en un sentido integral.</p>
              </div>
            </div>
          </div>
            <div class="row">
              <div class="col-lg-6 text-xs-center service-block"> <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                <h3>Integridad</h3>
                <p>Actuamos dentro de los más rigurosos principios éticos y legales.</p>
              </div>
              <!-- /.col-lg-4 -->
              
              <div class="col-lg-6  text-xs-center service-block"> <i class="fa fa-handshake-o" aria-hidden="true"></i>
                <h3>Responsabilidad</h3>
                <p>Trabajamos con excelencia siendo eficientes y perseverantes.</p>
              </div>
              <!-- /.col-lg-4 -->
              <div class="col-lg-12 text-xs-center service-block">
                <img class="featurette-image img-fluid m-x-auto img-responsive borderradius8px" width="570px" src="landing/img/Valores.png" alt="valores">
              </div>
              
              
              <div class="col-lg-6  text-xs-center service-block"> <i class="fa fa-book" aria-hidden="true"></i>
                <h3>Honestidad</h3>
                <p>Fortalecer, promover, formar y velar por el desarrollo de principios morales y sociales.</p>
              </div>
              <!-- /.col-lg-4 -->
              <div class="col-lg-6 text-xs-center service-block"> <i class="fa fa-diamond" aria-hidden="true"></i>
                <h3>Confianza</h3>
                <p>Generamos credibilidad y manejamos responsablemente la información.</p>
              </div> 
            </div> 
          </div>
        </section>
        <section class="price-sec" id="price">
          <div class="container">
            <div class="row">
              <h2>TU CAMINO A DIAMANTE INICIA EN BRONCE</h2>
              <h2>
              <div class="col-md-4">
                <div class="plan-block">
                  <div class="heading"> <span class="plan-type">Bronce</span> <span class="colorbronce fuenteper" ><b>$</b>8,000.00</span> <span class="duration">Generas</span> </div>
                  <div class="detail-sec">
                    <img class="featurette-image img-fluid m-x-auto" width="260px" height="260px" src="landing/img/bronce.JPG" alt="bronce">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="plan-block "> <!--middle-->
                  <div class="heading"> <span class="plan-type">Plata</span> <span class="fuenteper colorplata"><b>$</b>16,000.00</span> <span class="duration">Generas</span> </div>
                  <div class="detail-sec">
                    <img class="featurette-image img-fluid m-x-auto" width="260px" height="260px" src="landing/img/plata.JPG" alt="plata">
                  </div>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="plan-block">
                  <div class="heading"> <span class="plan-type">Oro</span> <span class="fuenteper colororo"  ><b>$</b>40,000.00</span> <span class="duration">Generas</span> </div>
                  <div class="detail-sec">
                    <img class="featurette-image img-fluid m-x-auto" width="260px" height="260px"  src="landing/img/oro.JPG" alt="oro">
                  </div>
                    
                </div>
              </div>
            </h2>
          </div>
          <div class="row">
            <h2>
              <div class="col-md-4">
                <div class="plan-block">
                  <div class="heading"> <span class="plan-type">Platino</span> <span class="fuenteper colorplatino" ><b>$</b>100,000.00</span> <span class="duration">Generas</span> </div>
                  <div class="detail-sec">
                     <img class="featurette-image img-fluid m-x-auto" width="260px" height="260px" src="landing/img/platino.JPG" alt="platino">
                  </div>
                   
                </div>
              </div>
              <div class="col-md-4">
                <div class="plan-block "> <!--middle-->
                  <div class="heading"> <span class="plan-type">Esmeralda</span> <span class="fuenteper coloresmeralda"><b>$</b>200,000.00</span> <span class="duration">Generas</span> </div>
                  <div class="detail-sec">
                    <img class="featurette-image img-fluid m-x-auto" width="260px" height="260px" src="landing/img/esmeralda.JPG" alt="esmeralda">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="plan-block">
                  <div class="heading"> <span class="plan-type">Diamante</span> <span class="fuenteper colordiamante"><b>$</b>400,000.00</span> <span class="duration">Generas</span> </div>
                  <div class="detail-sec">
                    <img class="featurette-image img-fluid m-x-auto" width="260px" height="260px" src="landing/img/diamante.JPG" alt="diamante">
                  </div>
                </div>
              </div>
            </h2>
            </div>
          </div>
        </section>
        <section class="qa-section" id="faq">
          <div class="container">
            <h2 class="text-xs-center"> ¿Cómo funciona? </h2>
            <h2 class="text-xs-center alineadoderecha" ><small>Si piensas que perderás, estás perdido,<br> pues el mundo nos enseña que el éxito<br> empieza en la voluntad del hombre…<br>Todo está en el estado de ánimo.</small></h2> <h2 class="alineadoderecha"> Napoleon Hill.</h2>
            <div id="accordion" role="tablist" aria-multiselectable="true">
              <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                  <h5 class="mb-0"> 
                    <button class="botonlanding" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> DESARROLLO MATRIZ BRONCE: </button>

                  </h5>
                </div>
                <div id="collapseOne" class="collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="card-block">
                    <img class="featurette-image img-fluid m-x-auto" src="landing/img/faq_bronce.JPG" alt="faq_bronce">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" role="tab" id="headingTwo">
                  <h5 class="mb-0"> 
                    <button class="botonlanding" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> DESARROLLO MATRIZ PLATA:</button>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="card-block"> 
                    <img class="featurette-image img-fluid m-x-auto" src="landing/img/faq_plata.JPG" alt="faq_plata">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" role="tab" id="headingThree">
                  <h5 class="mb-0"> 
                    <button class="botonlanding" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">DESARROLLO MATRIZ ORO:</button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="card-block">
                    <img class="featurette-image img-fluid m-x-auto" src="landing/img/faq_oro.JPG" alt="faq_oro">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" role="tab" id="headingFour">
                  <h5 class="mb-0"> 
                    <button class="botonlanding" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"> DESARROLLO MATRIZ PLATINO: </button>
                  </h5>
                </div>
                <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
                  <div class="card-block">
                    <img class="featurette-image img-fluid m-x-auto" src="landing/img/faq_platino.JPG" alt="faq_platino">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" role="tab" id="headingFive">
                  <h5 class="mb-0"> 
                    <button class="botonlanding" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> DESARROLLO MATRIZ ESMERALDA: </button>
                  </h5> 
                </div>
                <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
                  <div class="card-block">
                    <img class="featurette-image img-fluid m-x-auto" src="landing/img/faq_esmeralda.JPG" alt="faq_esmeralda">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" role="tab" id="headingSix">
                  <h5 class="mb-0"> 
                    <button class="botonlanding" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"> DESARROLLO MATRIZ DIAMANTE:  </button>
                  </h5>
                </div>
                <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix">
                  <div class="card-block">
                    <img class="featurette-image img-fluid m-x-auto" src="landing/img/faq_diamante.JPG" alt="faq_diamante">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section  class="about-home-block" id="servicios">
          <div class="container">
            <div class="row">
              <div class="col-md-3 text-md-left push-md-3 col-sm-12 text-xs-center">
                <h2 class="featurette-heading"><small>JUTZPÁ: Carácter para crecer.</small></h2>
                <p class="lead justificado" >
                  Nos enfocamos a mejorar la ejecución de los planes de las personas y empresas, mediante una metodología de “Juego Innovador” llevándolos de las ideas a la acción. Vamos a jugar, así es como logramos cambios, basados en una plataforma de valores, para incrementar el DESEMPEÑO INDIVIDUAL y de GRUPO.</p>
                <!--
                <a href="#" class="btn btn-capsul btn-aqua">Explore More</a> 
                -->
              </div>
              <div class="col-md-3 pull-md-3"> <img class="featurette-image img-fluid m-x-auto" src="landing/img/jutzpa.JPG" width="600px" height="600 px" alt="jutzpa"> </div>
            <div class="col-md-3 text-md-left push-md-3 col-sm-12 text-xs-center">
                <h2 class="featurette-heading"><small>GENOVA: El mundo sería mejor…</small></h2>
                <p class="lead justificado" >
                  Si las personas pudieran recuperar la salud y el bienestar de una forma práctica y accesible.
                  Contamos con más de 30 pruebas genéticas:
                  Predisposición genética para cáncer.
                  Predisposición genética para obesidad.
                  Nutrigenética.
                  Actividad física.
                  Prueba de paternidad.
                  </p>
                <!--
                <a href="#" class="btn btn-capsul btn-aqua">Explore More</a> 
                -->
              </div>
              <div class="col-md-3 pull-md-3"> <img class="featurette-image img-fluid m-x-auto" src="landing/img/genova.JPG" width="600px" height="600 px" alt="genova"> </div>
            </div>
          </div>
        </section>
        <section class="testimonial-sec" id="testimonials">
          <div class="container">
            <h2 class="text-xs-center"> Casos de éxito <small>Mira lo que nuestros socios dicen:</small> </h2>
            <div class="row">
              <div class="col-md-4 text-xs-center">
                <div class="card"> <img class="card-img-top" src="landing/img/davidrodriguez.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h3>David Rodríguez<small>Zacatecas, Zac.</small></h3>
                    <p class="card-text">¡¡Logrado!! 2 matrices cobradas de Bronce de $8,000.00 c/u en tan sólo 15 días, si yo pude tú también! ¡Únete a nuestra familia seremos socios creando abundancia en las familias mexicanas, nuestra honestidad y certeza serán para trabajar como equipo! Crecer tu mejor emprendimiento.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 text-xs-center">
                <div class="card"> <img class="card-img-top" src="landing/img/marychuy.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h3>Mary Chuy Galván<small>Fresnillo Zacatecas</small></h3>
                    <p class="card-text">¡Tengo 11 semanas en este programa y estoy feliz! porque en este tiempo llevamos en la familia 5 matrices cobradas de Bronce de $8,000.00 cada una y ¡¡vamos por más!!</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 text-xs-center">
                <div class="card"> <img class="card-img-top" src="landing/img/carlosdibarra.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h3>Carlos D. Ibarra Ochoa<small>Torreón, Coahuila</small></h3>
                    <p class="card-text">Tengo 2 meses en CREANDO CERTEZAS y he generado $18,000.00 he cerrado 3 matrices Bronce y solo me falta una persona para cerrar mi 4 matriz bronce. ¡¡¡Únete a la ECONOMIA COLABORATIVA!!!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="contact-sec" id="contact">
          <div class="container">
            <h2>Contáctanos <small>Agradecemos tú interés.</small> </h2>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleName">Nombre</label>
                  <input type="text" class="form-control" id="exampleName" aria-describedby="emailHelp">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="examplePhone">Teléfono</label>
                  <input type="text" class="form-control" id="examplePhone" aria-describedby="emailHelp">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electrónico</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">No compartimos tu correo con nadie.</small> </div>
              </div>
              <div class="col-md-12">
                <label for="exampleTextarea">Escribe un mensaje</label>
                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
              </div>
              <div class="col-md-12 text-xs-center action-block"> <a href="#" class="btn btn-capsul btn-aqua">Enviar</a> </div>
            </div>
          </div>
        </section>
        <footer>
          <div class="container">
            <div class="row">
              <p>Siguenos en nuestras redes sociales</p>
              <a href="https://www.facebook.com/CreCer2020/"><i class="fa fa-facebook-square fuente36px" target="_blank"  rel="noopener noreferrer"></i> Creando Certezas</a>
              </br>
              <a href="https://www.youtube.com/channel/UCdNBUbFvgFI1FrfOur2dmgA"><i class="fa fa-youtube-play fuente36px" target="_blank"  rel="noopener noreferrer"></i> CREANDO CERTEZAS LA MEJOR ESTRATEGIA</a>
              </br>
              <a href="https://www.instagram.com/creando_certezas/"><i class="fa fa-instagram fuente36px" target="_blank"  rel="noopener noreferrer"></i> Creando Certezas</a>
              </br>
              <a href="https://twitter.com"><i class="fa fa-twitter fuente36px" target="_blank"  rel="noopener noreferrer"></i> Creando Certezas</a>
            </div>
          </div>
        </footer>

        <!-- Bootstrap core JavaScript
            ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script> 
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script> 
        <script src="landing/js/bootstrap.min.js"></script> 
        <script src="landing/js/scrollPosStyler.js"></script> 
        <script src="landing/js/core.js"></script> 
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>