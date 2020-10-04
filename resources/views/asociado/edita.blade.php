@extends('layouts.asociado')

@section('content')


<div class="container-fluid"></br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
          
                <div class="panel-heading">Edición de Usuarios</div>
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
                <div class="panel-body">
        
                    <form class="form-horizontal" method="POST" action="/guardaAsociado">
                        {{ csrf_field() }}
                        <!--Primer parte del formulario -->
                        <input type="hidden" id="idUser" type="text" name="idUser" value="{{$user->id }}">
                        <div class="form-group">
                            <label for="directo" class="col-md-1 control-label">Patrocinador</label>
                            <div class="col-md-3">
                            <input id="padre" type="text" class="form-control" name="padre" value="{{ $patrocinador->nombre }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" disabled>
                            

                                
                                <!-- <select name="directo" class="form-control" id="directo">
                                    <option value=1 >Seleccione Uno</option>
                                    @foreach($usuarios as $us)
                                        @if($us->id === $user->padre)
                                            <option value="{{$us->id}}" selected>{{$us->nombre}} {{$us->apellidoPaterno}} {{$us->apellidoMaterno}}</option>
                                        @else
                                            <option value="{{$us->id}}">{{$us->nombre}} {{$us->apellidoPaterno}} {{$us->apellidoMaterno}}</option>
                                        @endif
                                    @endforeach
                                </select> -->
                            </div>
                            
                            <label for="nickname" class="col-md-1 control-label">NickName</label>
                            <div class="col-md-2">
                                <input id="nickname" type="text" class="form-control" name="nickname" value="{{$user->nickname }}" required>

                                @if ($errors->has('nickname'))
                                    <span class="badge badge-danger">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>    
                                                      
                        </div>
                        <!--Fin primer parte del formulario --> 
                                <div class="form-group">
                                    <div class="form-row">
                                        <div id="segundaParte">
                                            <div class="panel-heading">--- Datos Personales ---</div>
                                            <div class="ibox-content">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                            <label for="nombre">Nombre (s)</label>
                                                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $user->nombre }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>   
                                                        </div>
                                                                                                                    
                                                        <div class="col-md-4 mb-3">
                                                            <label for="apepaterno">Apellido Paterno</label>
                                                            <input id="apepaterno" type="text" class="form-control" name="apepaterno" value="{{ $user->apellidoPaterno }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label for="apematerno">Apellido Materno</label>
                                                            <input id="apematerno" type="text" class="form-control" name="apematerno" value="{{$user->apellidoMaterno }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                            @if ($errors->has('apematerno'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('apematerno') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="email">Correo electrónico</label>
                                                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" disabled>

                                                                    @if ($errors->has('email'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="telefono">Teléfono Móvil</label>
                                                                <input id="telefono" type="text" maxlength="10" class="form-control" name="telefono" value="{{ $user->telefono }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('telefono'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('telefono') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="curp">Contraseña</label>
                                                                <input id="password" type="password" class="form-control" name="password" >

                                                                    @if ($errors->has('password'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                            <label for="rfc">RFC</label>
                                                                <input id="rfc" type="text" maxlength = "13" class="form-control UpperCase" name="rfc" value="{{ $user->rfc }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('rfc'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('rfc') }}</strong>
                                                                        </span>
                                                                    @endif   
                                                        </div>
                                                                                                                    
                                                        <div class="col-md-4 mb-3">
                                                            <label for="apepaterno">CURP</label>
                                                                <input id="curp" type="text" maxlength = "18" class="form-control UpperCase" name="curp" value="{{ $user->curp }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('curp'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('curp') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label for="id">ID de Usuario</label>
                                                            <input id="id" type="text" class="form-control" name="id" value="{{ $user->codigo }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" disabled>

                                                                    @if ($errors->has('id'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-5 mb-3">
                                                            <label for="calle">Calle</label>
                                                                <input id="calle" type="text" class="form-control" name="calle" value="{{$user->calle }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('calle'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('calle') }}</strong>
                                                                        </span>
                                                                    @endif  
                                                        </div>
                                                                                                                    
                                                        <div class="col-md-2 mb-3">
                                                            <label for="numero">No</label>
                                                                <input id="numero" type="text" class="form-control" name="numero" value="{{ $user->numero }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('numero'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('numero') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <label for="colonia">Colonia</label>
                                                                <input id="colonia" type="text" class="form-control" name="colonia" value="{{ $user->colonia }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('colonia'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('colonia') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-md-2 mb-3">
                                                            <label for="id">C.P</label>
                                                                <input id="cp" type="text" class="form-control" name="cp" value="{{ $user->codigoPostal }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                    @if ($errors->has('cp'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('cp') }}</strong>
                                                                        </span>
                                                                        @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                            <label for="pais">País</label>
                                                                <select name="pais" class="form-control" id="pais">
                                                                    <option>Seleccione</option>
                                                                    @foreach($pais as $pa)
                                                                        <option value="{{$pa->id}}" selected>{{$pa->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                                                                                    
                                                        <div class="col-md-4 mb-3">
                                                            <label for="estado">Estado</label>
                                                                <select name="estado" class="form-control" id="estado">
                                                                    <option>Seleccione</option>
                                                                    @foreach($estados as $esta)
                                                                        @if($esta->id === $user->idEstado)
                                                                            <option value="{{$esta->id}}" selected>{{$esta->nombre}}</option>
                                                                        @else
                                                                            <option value="{{$esta->id}}" >{{$esta->nombre}}</option>
                                                                            @endif
                                                                    @endforeach
                                                                </select>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label for="municipio">Municipio</label>
                                                                <select name="municipio" class="form-control" id="municipio">
                                                                    <option>Seleccione</option>
                                                                    @foreach($municipios as $muni)
                                                                        @if($muni->id === $user->idMunicipio)
                                                                            <option value="{{$muni->id}}" selected>{{$muni->nombre}}</option>
                                                                        @else
                                                                            <option value="{{$muni->id}}" >{{$muni->nombre}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                    </div>
                                                            <!-- Fin formato Will--> 
                                                </div>
                                            <!-- Formulario Banco Will-->
                                            <div class="panel-heading">--- Información Bancaria ---</div> 
                                            <div class="ibox-content">
                                                <div class="form-row">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="banco">Nombre del Banco</label>
                                                            <input id="banco" type="text" class="form-control UpperCase" name="banco" value="{{ $user->banco}}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('banco'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('banco') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>
                                                                                                                    
                                                    <div class="col-md-3 mb-3">
                                                        <label for="cuenta">No de Cuenta</label>
                                                            <input id="cuenta" type="text" maxlength="16" class="form-control" name="cuenta" value="{{ $user->noCuenta }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('cuenta'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('cuenta') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label for="tarjeta">No. de Tarjeta</label>
                                                            <input id="tarjeta" type="text" maxlength="16" class="form-control" name="tarjeta" value="{{ $user->tarjeta }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('tarjeta'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('tarjeta') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="clabe">Clabe Interbancaria</label>
                                                            <input id="clabe" type="text" maxlength="18" class="form-control" name="clabe" value="{{ $user->clabe }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('clabe'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('clabe') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>
                                                </div>
                                            </div>
                                                <!-- Fin Formulario Banco Will--> 
                                                <!-- Beneficiarios Will-->
                                <div class="form-group">
                                    <div class="form-row">
                                            
                                            <div class="ibox-content">
                                                <div class="form-row">                                                                    
                                                    <div class="col-md-4 mb-3">
                                                        <label for="nombreben">Nombre del Beneficiario</label>
                                                            <input id="nombreben" type="text" class="form-control" name="nombreben" value="{{ $user->nombreben }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('nombreben'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('nombreben') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label for="telefonoben">Teléfono del Beneficiario</label>
                                                            <input id="telefonoben" type="text" maxlength="10" class="form-control" name="telefonoben" value="{{ $user->celular }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('telefonoben'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('telefonoben') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="emailben">Correo electrónico</label>
                                                            <input id="emailben" type="text" class="form-control" name="emailben" value="{{ $user->correo }}" oninvalid="this.setCustomValidity('Por favor rellene este campo')" required autofocus>

                                                                @if ($errors->has('emailben'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('emailben') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="nombreben">Parentesco</label>
                                                            <select name="parentesco" class="form-control" id="parentesco" required="">
                                                                <option value=1 >Seleccione</option>
                                                                @if($user->parentesco == 1)
                                                                    <option value=1 selected>Padre</option>
                                                                @else
                                                                    <option value=1 >Padre</option>
                                                                @endif
                                                                @if($user->parentesco == 2)
                                                                    <option value=2 selected>Madre</option>
                                                                @else
                                                                    <option value=2 >Madre</option>
                                                                @endif
                                                                @if($user->parentesco == 3)
                                                                    <option value=3 selected>Hermano(a)</option>
                                                                @else
                                                                    <option value=3 >Hermano(a)</option>
                                                                @endif
                                                                    @if($user->parentesco == 4)
                                                                    <option value=4 selected>Esposo(a)</option>
                                                                @else
                                                                    <option value=4 >Esposo(a)</option>
                                                                @endif
                                                                @if($user->parentesco == 5)
                                                                    <option value=5 selected>Hijo(a)</option>
                                                                @else
                                                                    <option value=5 >Hijo(a)</option>
                                                                @endif
                                                                @if($user->parentesco == 6)
                                                                    <option value=6 selected>Otro</option>
                                                                @else
                                                                    <option value=6 >Otro</option>
                                                                @endif
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                                <!-- Fin Beneficiarios Will--> 
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="politicas" name="politicas" value="1" required>
                                                            <label class="form-check-label" for="politicas">
                                                                He leído y Acepto los <a href="https://drive.google.com/file/d/1C6ZASHTBrBzSglGcjn_Y1HS3YFbqMZ9r/view?usp=sharing" target="_blank" rel="noopener noreferrer"><i data-toggle="tooltip" data-placement="right" title="Da clic aquí para Revisar los Términos y Condiciones">Términos y Condiciones</i></a>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 mb-3">
                                                        <button class="btn btn-primary btn-block" type="submit">Actualizar mi Perfil</button>
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
<script src="{{asset('js/editar.js')}}"></script>
@endsection

