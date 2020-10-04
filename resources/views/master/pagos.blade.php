@extends('layouts.master')


@section('content')
<div class="container-fluid"></br>
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">Listado de usuarios que completaron comunidad;<div class="pull-right">  Fitrar por  <a href="/listarPagos/0"> Pendientes</a> | <a href="/listarPagos/1">Pagados</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ $pagos->links() }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></div>
                <style>
                    .pagination {
                    display: inline-block;
                    padding-left: 0;
                    margin: -10px;
                    border-radius: 4px;
                }
                
                </style>
                <div class="panel-body">
                  
<table id="dt-cell-sellection" class="table" cellspacing="0" width="100%">
 
  <thead>
    <tr>
      <th class="th-sm">Nombre Completo
      </th>
      <th class="th-sm">Codigo
      </th>
      <th class="th-sm">Comunidad
      </th>
      <th class="th-sm">Ciclo
      </th>
      <th class="th-sm">Clabe interbancaria
      </th>
      <th class="th-sm">Comisiones
      </th>
      <th class="th-sm">Saldo a pagar
      </th>
      <th class="th-sm">Acción
      </th>
    </tr>
  </thead>
  <tbody>
     @forEach($pagos as $pago)
    <tr>
      <td>
          @foreach ($users as $user)
              @if ($user->id==$pago->user_id)
               {{$user->nombre}}  
               @if (!empty($user->apellidoPaterno) )
                   {{$user->apellidoPaterno}}
               @endif
               @if (!empty($user->apellidoMaterno) )
                   {{$user->apellidoPaterno}}
               @endif
              @endif
          @endforeach
      </td>
      <td> @foreach ($users as $user)
        @if ($user->id==$pago->user_id)
        @if (!empty($user->codigo) )
        {{$user->codigo}}
        @else
        N/A
         @endif
        
        @endif
    @endforeach</td>
      <td >
      @foreach ($matrices as $matriz)
      @if ($matriz->id==$pago->matriz_id)         
      {{$matriz->nombre}} 
      @endif          
      @endforeach
        </td>
      <td>Ciclo {{$pago->comunidad}}</td>
      <td>
        @foreach ($bancos as $banco)
        @if ($banco->idUser==$pago->user_id)  
        @if (!empty($banco->clabe))
        {{$banco->clabe}}    
        @else
        00000-000000-000000
        @endif       
        @endif          
        @endforeach
      </td>
      <td>$ {{number_format($pago->comisiones, 2, '.', ',')}}</td>
      <?php 
      $saldo=$pago->comisiones;
      $saldo1 = $saldo-($saldo*0.25);
      $saldo2= $saldo1 - ($saldo1*0.05);
      
      ?>
      <td>$ {{number_format($saldo2, 2, '.', ',')}}</td>
      <td><button class="btn @if ($pago->estatus==0)btn-primary @else btn-success  @endif" 
        @if ($pago->estatus==0) 
      onclick='swal({
        title: "Esta seguro?",
        text: "No se puede revertir esta acción!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
    swal("Procesando Pago...", {
      buttons: false,
    });
 window.location="/procesarPago/{{$pago->id}}";
  } else {
          swal("Acción cancelada....");
        }
      });'
      @endif      
      >@if ($pago->estatus==0)Pagar @else Pagado  @endif</button></td>
    </tr>
    @endForEach
  </tbody>
  <tfoot>
    <tr>
        <th class="th-sm">Nombre Completo
        </th>
        <th class="th-sm">Codigo
        </th>
        <th class="th-sm">Comunidad
        </th>
        <th class="th-sm">Ciclo
        </th>
        <th class="th-sm">Clabe interbancaria
        </th>
        <th class="th-sm">Comisiones
        </th>
        <th class="th-sm">Saldo a pagar
        </th>
        <th class="th-sm">Acción
        </th>
        
      </tr>
   
  </tfoot>

</table>
                </div>
            </div>
          
        </div>

    </div>
</div>


@endsection


