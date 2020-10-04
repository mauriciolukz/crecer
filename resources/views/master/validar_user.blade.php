@extends('layouts.master')

@section('content')
    <div class="container-fluid"></br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">Validación de  Usuario(s)</div>

                    <div class="panel-body">
                        <table id="dt-cell-sellection" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Nombre Completo</th>
                                    <th class="th-sm">Patrocinador</th>
                                    <th class="th-sm">Correo</th> 
                                    <th class="th-sm">Curp</th>
                                    <th class="th-sm">Motivo</th>
                                    <th class="th-sm">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forEach($usuarios as $usuario)
                                    <tr>
                                        <td>
                                            {{$usuario->nombre}} {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}}
                                        </td>
                                        <td>
                                            @foreach ($users as $user)
                                                @if ($user->id==$usuario->padre)
                                                    {{$user->nombre}} {{$user->apellidoPaterno}} {{$user->apellidoMaterno}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->curp}}</td>
                                        <td>
                                            @php
                                                $userMotivoResult = "";
                                                $userMotivo = \App\bajas::Where( "iduser", $user->id )->orderBy( "created_at" )->Limit( 1 )->get();
                                                if( count( $userMotivo ) > 0 ){

                                                    switch ( $userMotivo[0]->motivo ) {
                                                        case 1:
                                                            $userMotivoResult = "Vencimiento de suscripción";
                                                            break;
                                                        case 2:
                                                            $userMotivoResult = "Retiro y reembolso";
                                                            break;
                                                        case 3:
                                                            $userMotivoResult = "No desea continuar";
                                                            break;
                                                        case 4:
                                                            $userMotivoResult = "No cumple obligaciones";
                                                            break;
                                                        case 5:
                                                            $userMotivoResult = "Cuestiones éticas";
                                                            break;
                                                    }
                                                }
                                            @endphp

                                            {{ $userMotivoResult }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" onclick=" window.location='validarUsuario/{{$usuario->id}}';"><i class="fa fa-check" aria-hidden="true"></i></button><button class="btn btn-danger" onclick='swal({
                                            title: "Esta seguro de querer eliminar a {{$usuario->nombre}} {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}}?",
                                            text: "El registro no se podra recuperar!",
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                            if (willDelete) {
                                                swal("Eliminacion en proceso...", {
                                                buttons: false,
                                            });
                                            window.location="eliminarUsuario/{{$usuario->id}}";
                                            }
                                            else {
                                                swal("Registro guardado");
                                            }
                                            });'><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                @endForEach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="th-sm">Nombre Completo</th>
                                    <th class="th-sm">Patrocinador</th>
                                    <th class="th-sm">Correo</th>
                                    <th class="th-sm">Curp</th>
                                    <th class="th-sm">Motivo</th>
                                    <th class="th-sm">Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection