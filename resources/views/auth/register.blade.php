@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!--  Error handle -->
                @if($errors->any())
                <div class="row collapse">
                    <ul class="alert-box warning radius">
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="panel-heading">Registro</div>

                <div class="panel-body">
                    <div class="panel-heading">Datos Generales</div>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nombre" class="col-md-1 control-label">Nombre(s)</label>
                            <div class="col-md-3">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="apepaterno" class="col-md-2 control-label">Apellido Paterno</label>
                            <div class="col-md-2">
                                <input id="apepaterno" type="text" class="form-control" name="apepaterno" value="{{ old('apepaterno') }}" required autofocus>

                                @if ($errors->has('apepaterno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apepaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="apematerno" class="col-md-2 control-label">Apellido Materno</label>
                            <div class="col-md-2">
                                <input id="apematerno" type="text" class="form-control" name="apematerno" value="{{ old('apematerno') }}" required autofocus>

                                @if ($errors->has('apematerno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apematerno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="col-md-1 control-label">Dirección</label>

                            <div class="col-md-3">
                                <input id="direccion" type="text" class="form-control" name="direccion" required>
                            </div>
                            <label for="email" class="col-md-2 control-label">Correo Electrónico</label>

                            <div class="col-md-3">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefono" class="col-md-1 control-label">Teléfono</label>
                            <div class="col-md-3">
                                <input id="telefono" type="text" class="form-control" name="telefono" required>
                            </div>
                            <label for="password" class="col-md-2 control-label">Contraseña</label>

                            <div class="col-md-3">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rfc" class="col-md-1 control-label">RFC</label>

                            <div class="col-md-3">
                                <input id="rfc" type="text" class="form-control" name="rfc" required>
                            </div>
                            <label for="password-confirm" class="col-md-2 control-label">Confirmar Contraseña</label>

                            <div class="col-md-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estado" class="col-md-1 control-label">Estado</label>
                            <div class="col-md-3">
                                <input id="estado" type="text" class="form-control" name="estado" required>
                            </div>
                            <label for="municipio" class="col-md-2 control-label">Municipio</label>
                            <div class="col-md-3">
                                <input id="municipio" type="text" class="form-control" name="municipio" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
