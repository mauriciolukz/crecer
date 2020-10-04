@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h3 class="my-0 font-weight-normal">Ingresa a tu Cuenta</h3>
          </div>
          <div class="card-body">
          <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="loginColumns fadeInDown" style="padding-top: 5px">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning">
                                            {{ session('warning') }}
                                        </div>
                                    @endif

                                    <div class="ibox-content">

                                        <div class="text-center">
                                            <img src="{{asset('img/logo/imagotipo_ creando_certezas_03.png')}}" alt="Logo crecer" height="200px" width="200px">
                                        </div>

                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Iniciar Sesión</h3>
                                                        <p>Coloca tus datos correctamente.</p>
                                                            <form role="form" method="POST" action="{{ route('login') }}">
                                                            {{ csrf_field() }}

                                                                <div class="form-group"><label>Email</label> <input type="email" placeholder="Ingresa tu email" class="form-control"required="" name="email" value="{{ old('email') }}" required autofocus>
                                                                        @if ($errors->has('email'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                                </span>
                                                                        @endif
                                                                </div>

                                                                <div class="form-group"><label>Password</label> <input type="password" placeholder="Ingresa tu Contraseña" name="password" required="" class="form-control">
                                                                    @if ($errors->has('password'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                            </span>
                                                                    @endif
                                                                </div>

                                                                    <div>
                                                                        <label> <input type="checkbox" class="i-checks" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme </label>
                                                                        <button class="btn btn-bg btn-primary btn-block" type="submit"><strong>Iniciar Sesión</strong></button>
                                                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                                    ¿Olvidaste tu contraseña?
                                                                            </a>

                                                                    </div>
                                                            </form>
                                                    </div>
                                                    <div class="col-sm-6 text-center"><br><h4>Aún no tienes cuenta?</h4>
                                                        <p>Realiza tu Pre-registro:</p>
                                                        <p class="text-center"><br>
                                                        <button class="btn btn-bg btn-primary btn-block" type="button"><strong>Contacta un Asesor</strong></button>
                                                                            <a class="btn btn-link" href="https://api.whatsapp.com/send?phone=528712754696&text=Hola%20que%20tal,%20quisiera%20conocer%20m%C3%A1s%20sobre%20Creando%20Certezas"></a>
                                                            <!-- <a href="{{ route('register') }}"><i class="fa fa-sign-in big-icon"></i></a> -->
                                                        </p>
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
    </div>
</div>
@endsection
