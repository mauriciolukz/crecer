<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/ico">
    <title>{{ config('app.name', 'Creando certezas') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/plugins/dataTables/datatables.min.css')}}"/>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
     <!-- sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
    <!-- Morris -->
    <link href="{{asset('css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Treant -->
    <link rel="stylesheet" href="{{asset('treant/Treant.css')}}">
    <link rel="stylesheet" href="{{asset('treant/collapsable.css')}}">
    <link rel="stylesheet" href="{{asset('treant/perfect-scrollbar.css')}}">
    
    <!--script para buscar codigo del patrocinador -->
    <script src="{{asset('js/codeSponsor.js')}}"></script>
     <!--Mainly scripts -->

    <script  type="text/javascript" src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.symbol.js')}}"></script>
    <script src="{{asset('js/plugins/flot/curvedLines.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/demo/peity-demo.js')}}"></script> 
    
    <!-- Custom and plugin javascript -->
    <script src="{{asset('js/inspinia.js')}}"></script>
    <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- Jvectormap -->
    <script src="{{asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{asset('js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

    <!--Mayusculas --> 
    <script src="{{asset('js/UpperCase.js')}}"></script>
    
</head>

    @if (session('status'))
	<div class="toast"
	data-title="Perfecto"
	data-message="{{ session('status') }}"
	data-type="success">
</div>
    @endif
    @if (session('error'))
    <div class="toast"
    data-title="Algo salio mal."
    data-message="{{session('error')}}"
    data-type="error">
</div>
@endif
<body class="pace-navbar">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side " role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> 
                            <span>
                                <img alt="image" id="img" class="img-circle" src="{{asset('img/perfil/profile_small.jpg')}}" style="max-width: 160px;max-height: 160px;" alt="Imagen perfil"/>
                            </span>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{URL::to('/master/perfil')}}">Perfil</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            CR
                        </div>
                    </li>
                    <li class="{{ Request::is('master') ? 'active' : '' }} ">
                        <a href="{{URL::to('/master')}}" ><i class="fa fa-home"></i> <span class="nav-lavel">Inicio</a>
                    </li>
                  
                    <li class="{{ Request::is('perfil') ? 'active' : '' }} ">
                        <a href="{{URL::to('/perfil')}}" ><i class="fa fa-user fa-fw"></i> <span class="nav-label">Perfil</span></a>
                    </li>

                    <li class="{{ Request::is('master/create') ? 'active' : '' }} ">
                        <a href="{{URL::to('/master/create')}}" ><i class="fa fa-pencil fa-fw"></i> <span class="nav-lavel">Registro</a>
                    </li>

                    <li class="{{ Request::is('master/matriz/ver') ? 'active' : '' }} ">
                        <a href="{{URL::to('master/matriz/ver')}}" ><i class="fa fa-sitemap fa-fw"></i> <span class="nav-lavel">Comunidades</a>
                    </li>
                    
                    <li class="{{ Request::is('master/mreporte') ? 'active' : '' }} ">
                        <a href="{{URL::to('master/mreporte')}}" ><i class="fa fa-address-book-o fa-fw"></i> <span class="nav-lavel">Reporte</a>
                    </li>
                    <li class="{{ Request::is('habilitar') ? 'active' : '' }} ">
                        <a href="{{URL::to('/habilitar')}}" ><i class="fa fa-user-plus" aria-hidden="true"></i> <span class="nav-lavel">Activar Usuario</a>
                    </li>
                    <!-- <li class="{{ Request::is('master/deshabilitar') ? 'active' : '' }} ">
                        <a href="{{URL::to('master/deshabilitar')}}" ><i class="fa fa-user-times fa-fw"></i> <span class="nav-lavel">Deshabilitar Usuario</a>
                    </li> -->
                    <li class="{{ Request::is('listarPagos') ? 'active' : '' }} ">
                        <a href="{{URL::to('/listarPagos')}}"><i class="fa fa-line-chart fa-fw"></i> <span class="nav-label">Finanzas</span></a>
                    </li> 
                                      
                    <!-- <li>
                        <a href="#"><i class="fa fa-handshake-o fa-fw"></i> <span class="nav-label">Servicios</span></a> 
                    </li>
                                        
                    <li>
                        <a href="#"><i class="fa fa-file fa-fw"></i> <span class="nav-label">Documentos</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-phone-square fa-fw"></i> <span class="nav-label">Servicio Al Usuario</span></a>
                    </li> -->
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> <span class="nav-label"> Salir</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                            <i class="fa fa-bars"></i> 
                        </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bienvenido {{ auth()->user()-> nombre}} {{ auth()->user()-> apellidoPaterno}} {{ auth()->user()-> apellidoMaterno}}</span>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>

                </nav>
            </div>
            @yield('content')
            <div class="footer">
                <div>
                    <strong>Copyright</strong> Creando Certezas &copy; <?php echo date('Y');?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
