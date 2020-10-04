
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Creando Certezas | Abundancia Financiera</title>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- blueimp gallery -->
    <script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('landing2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing2/css/style.css') }}">

</head>

<body>
<body id="page-top" class="landing-page">
<!-- Inicia menu -->
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
<!-- Termina menu -->

 <!-- Inicia Slider --> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
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
                                <a href="https://api.whatsapp.com/send?phone=8712754696&text=Hola%20que%20tal,%20quisiera%20conocer%20m%C3%A1s%20sobre%20Creando%20Certezas" <button class="btn btn-primary " type="button"><i class="fa fa-mobile"></i>&nbsp;Contacta con un Asesor</button></a>
                            </p>
                        </div>
                        <div class="carousel-image wow zoomIn"><img src="landing2/img/laptop.png" alt="crecer"/></div>
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
                        <div class="carousel-image wow zoomIn"><img src="landing2/img/movil.png" alt="crecer"/></div>
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
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                        </a>
    </div>
<!-- Termina Slider -->

            
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