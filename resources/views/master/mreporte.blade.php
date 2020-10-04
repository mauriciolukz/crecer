@extends('layouts.master')

@section('content')
<div class="container-fluid"></br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">Usuarios</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
 
                    <table id="usuarios" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código de Usuario</th>
                                <th>Nombre Completo</th>
                                <th>Patrocinador</th>
                                <th>Fecha Alta</th>
                                <th>Comunidades</th>
                                <th>Acción</th>
                                <th>Edición</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($usuarios !== NULL)

                                @foreach($usuarios as $user)
                                    <tr>
                                        <td>{{$user['datos']->codigo}}</td>
                                        <td>{{$user['datos']->nombre}} {{$user['datos']->apellidoPaterno}} {{$user['datos']->apellidoMaterno}}</td>
                                        <td>{{$user['patrocinador']}}</td>
                                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$user['datos']->created_at)->format('Y-m-d') }}</td>
                                        <td>
                                        @foreach ($matrizUsuarios as $matrizU)
                                            @if ($matrizU->idUser==$user['datos']->id)
                                            <?php  $mat=$matrizU->idMatriz; ?>
                                                @foreach ($matrices as $matriz)
                                                @if ($matriz->id==$mat)
                                                    <?php echo $matriz->nombre; ?>
                                                @endif    
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>
                                            @if ($user['datos']->estatus==1)
                                                
                                                <button class="btn btn-primary disabled-user" data-id='{{ $user['datos']->id }}' data-name='{{$user['datos']->nombre}} {{$user['datos']->apellidoPaterno}} {{$user['datos']->apellidoMaterno}}'>Desactivar</button>
                                            @endif
                                            @if ($user['datos']->estatus==0)
                                                <button  class="btn btn-danger" onclick="window.location='/validarUsuario/{{$user['datos']->id}}'; swal('Procesando...', {
                                                    buttons: false,
                                                  });">Activar</button>   
                                            @endif 
                                        
                                        </td>
                                        <td>
                                            <form class="form-horizontal" method="POST" action="{{URL::to('/master/edita')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="id" name="id" value="{{ $user['datos']->id }}">
                                                <button type="submit" class="btn btn-primary">Detalles</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Código de Usuario</th>
                                <th>Nombre completo</th>
                                <th>Patrocinador</th>
                                <th>Fecha Alta</th>
                                <th>Comunidades</th>
                                <th>Acción</th>
                                <th>Edición</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/dataTableMaster.js')}}"></script>
<script>
    $( document ).ready( function(){

        let motivoCurrent = "";

        $( document ).on( "change", "#motivo", function(){

            motivoCurrent = $( this ).val();
            console.log( "mtv => " + motivoCurrent );
        });

        $( ".disabled-user" ).click( function(){

            let user = $( this ).data( "name" );
            let userId = $( this ).data( "id" );

            var motivo = document.createElement( "select" );
            motivo.setAttribute("id", "motivo");
            document.body.appendChild( motivo );

            var z = document.createElement( "option" );
            z.setAttribute( "value", "1" );
            var t = document.createTextNode( "Vencimiento de suscripción" );
            z.appendChild( t );

            var zz = document.createElement( "option" );
            zz.setAttribute( "value", "2" );
            var tz = document.createTextNode( "Retiro y reembolso" );
            zz.appendChild( tz );

            var z3 = document.createElement( "option" );
            z3.setAttribute( "value", "3" );
            var t3 = document.createTextNode( "No desea continuar" );
            z3.appendChild( t3 );

            var z4 = document.createElement( "option" );
            z4.setAttribute( "value", "4" );
            var t4 = document.createTextNode( "No cumple obligaciones" );
            z4.appendChild( t4 );

            var z5 = document.createElement( "option" );
            z5.setAttribute( "value", "5" );
            var t5 = document.createTextNode( "Cuestiones éticas" );
            z5.appendChild( t5 );

            document.getElementById( "motivo" ).appendChild( z );
            document.getElementById( "motivo" ).appendChild( zz );
            document.getElementById( "motivo" ).appendChild( z3 );
            document.getElementById( "motivo" ).appendChild( z4 );
            document.getElementById( "motivo" ).appendChild( z5 );

            motivo.type = "select";

            swal({
                title: "Esta seguro de querer desactivar a " + user + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: motivo,
            }).then((willDelete) => {
                    if( willDelete ){
                        swal("Eliminacion en proceso...", {
                        buttons: false,
                    });
                    
                    window.location="/validarUsuario/" + userId + "/" + motivoCurrent;
                }
            });
        });
    });
</script>
@endsection