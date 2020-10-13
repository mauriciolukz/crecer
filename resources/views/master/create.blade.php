@extends('layouts.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
<div class="container-fluid"></br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">Registro Usuarios</div>

                <div class="panel-body">
                    @if (session('error'))
                   <div class="alert alert-danger">
                    {{ session('error') }}
                 </div>
               @endif
               @if (session('status'))
               <div class="alert alert-success">
                {{ session('status') }}
             </div>
           @endif
                                <div class="text-center">
                                            <img src="{{asset('img/logo/imagotipo_ creando_certezas_03.png')}}" alt="Logo crecer" height="200px" width="200px">
                                        </div>
                    
                                        <div class="ibox-content"></div>
                    
                                                    <div class="panel-body">
                                                        <nav class="col-md-8 mb-3">
                                                        <form class="form-inline" id="form">
                                                            <div class="panel-heading"><h3>Escribe el ID o nombre del Patrocinador</h3></div>
                                                      <div class="row" >
                                                          <div  class="col-md-6">
                                                              <input class="form-control" onkeyup="Search();" style="width: 100%" type="search" placeholder="Busca al patrocinador" aria-label="Search" name="codigo" id="codigo"  autocomplete="off"> 
                                                              
                                                          </div>
                    
                                                         <!-- <div>
                                                            
                                                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Comprobar</button>  
                                                          </div> -->
                                                           
                                                          
                                                      </div>
                                                               
                    
                                                                <div id="spanPat"  class="valid-feedback">
                                                                
                                                                </div>
                                                      
                                                          
                                                            </div>
                                                        </nav>
                                                    </form>
                                            
                    
                    
                                                    <div class="panel-body">
                                                        <div class="panel-heading"><h3>Datos Generales</h3></div>
                    
                                                        <form  class="form-material" action="/crear" method="post">
                                                            {{ csrf_field() }}
                    
                                                            <div class="form-row">
                                                                <div class="col-md-4 mb-3">
                                                                <label for="nombre">Nombre (s)</label>
                                                                <input type="text" class="form-control" id="nombre" placeholder="Escribe tu Nombre (s)" name="nombre" value="{{ old('nombre') }}" required autofocus>
                                                                    @if ($errors->has('nombre'))
                                                                        <span class="badge badge-danger">
                                                                            <b>{{ $errors->first('nombre') }}</b>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <input type="hidden" name="idPatrocinador" id="idPatrocinador">
                                                                <div class="col-md-4 mb-3">
                                                                <label for="apepaterno">Apellido Paterno</label>
                                                                <input type="text" class="form-control " id="apepaterno" placeholder="Apellido Paterno" name="apepaterno" value="{{ old('apepaterno') }}"  required autofocus>
                                                                    @if ($errors->has('apepaterno'))
                                                                        <span class="badge badge-danger">
                                                                            <b>{{ $errors->first('apepaterno') }}</b>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                <label for="apematerno">Apellido Materno</label>
                                                                <input type="text" class="form-control" id="apematerno" placeholder="Apellido Materno" name="apematerno" value="{{ old('apematerno') }}" required autofocus>
                                                                    @if ($errors->has('apematerno'))
                                                                        <span class="badge badge-danger">
                                                                            <b>{{ $errors->first('apematerno') }}</b>
                                                                        </span>
                                                                    @endif
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                <label for="email">Correo electrónico</label>
                                                                        <input type="email" class="form-control" id="email" placeholder="Escribe tu correo electrónico" name="email" value="{{ old('email') }}"  required>
                                                                            @if ($errors->has('email'))
                                                                                <span class="badge badge-danger">
                                                                                    <b>{{ $errors->first('email') }}</b>
                                                                                </span>
                                                                            @endif
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                <label for="telefono">Teléfono Móvil</label>
                                                                        <input type="text" maxlength = "10" class="form-control" id="telefono" placeholder="Teléfono Celular" name="telefono" value="{{ old('telefono') }}" required autofocus>
                                                                            @if ($errors->has('telefono'))
                                                                                <span class="badge badge-danger">
                                                                                    <b>{{ $errors->first('telefono') }}</b>
                                                                                </span>
                                                                            @endif
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                <label for="curp">CURP <a href="https://www.sat.gob.mx/tramites/operacion/28753/obten-tu-rfc-con-la-clave-unica-de-registro-de-poblacion-curp" target="_blank" rel="noopener noreferrer"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Da clic aquí para revisar tu RFC"></i></a></label>
                                                                    <input type="text" maxlength = "18" class="form-control UpperCase" id="curp" placeholder="Escribe tu CURP" name="curp" value="{{ old('curp') }}"  autofocus>
                                                                    @if ($errors->has('curp'))
                                                                        <span class="badge badge-danger">
                                                                            <b>{{ $errors->first('curp') }}</b>
                                                                        </span>
                                                                    @endif
                                                            </div>
                    
                    
                    
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-8"><p>* Al realizar tu Pre-registro el sistema te otorgará una contraseña Temporal.</p></div>
                                                                    <div class="col-md-4"></div>
                                                                </div>
                    
                                                                <div class="panel-body">
                                                                        <div class="form-row">
                                                                            <div class="col-md-4 mb-3">
                                                                                <!--<div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="" id="politicas" name="politicas" value="1" required>
                                                                                    <label class="form-check-label" for="politicas">
                                                                                        He leído y Acepto los <a href="https://drive.google.com/file/d/1C6ZASHTBrBzSglGcjn_Y1HS3YFbqMZ9r/view?usp=sharing" target="_blank" rel="noopener noreferrer"><i data-toggle="tooltip" data-placement="right" title="Da clic aquí para Revisar los Términos y Condiciones">Términos y Condiciones</i></a>
                                                                                    </label>
                                                                                </div>-->
                                                                            </div>
                    
                                                                            <div class="col-md-8 mb-3">
                                                                                <button class="btn btn-primary btn-block" type="submit">Realizar Pre-registro</button>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                        </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>

<!--formulario de preregistro nuevo --> 
<style>
    #p{
        cursor: pointer;
    }
#p:hover {
  background-color: #18a689;
  color: white;
}    
</style>


<script>   usuarios={!! $usuarios !!}</script>
<script src="{{asset('js/master.js')}}"></script>
@endsection


