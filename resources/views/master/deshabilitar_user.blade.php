@extends('layouts.master')

@section('content')
<div class="container"></br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">Deshabilitar Usuario</div>

                <div class="panel-body">
                    
                    <form class="form-horizontal" method="POST" action="{{route('deshabilitar')}}">
                        {{ csrf_field() }}
                        <!--Primer parte del formulario -->
                        <div class="form-group">
                            <label for="usuario" class="col-md-1 control-label">Usuario</label>
                            <div class="col-md-3">
                                <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true">
                                    <option value=0 >Seleccione Uno</option>
                                        @foreach($usuarios as $us)
                                            <option value="{{$us->id}}">({{$us->id}}) {{$us->nombre}} {{$us->apellidoPaterno}} {{$us->apellidoMaterno}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <label for="usuario" class="col-md-1 control-label">Motivo</label>
                            <div class="col-md-3">
                                <select name="motivo" class="form-control" id="motivo">
                                    <option value=0 >Seleccione Uno</option>
                                    <option value=1>Retiro y reembolso</option>
                                    <option value=2>No desea continuar</option>
                                    <option value=3>No cumple obligaciones</option>
                                    <option value=4>Cuestiones éticas</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Deshabilitar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

