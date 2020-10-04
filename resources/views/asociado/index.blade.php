@extends('layouts.asociado')

@section('content')
<div class="container-fluid"></br>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Usuario Registrado</h5>
				</div>
				<div class="modal-body">
					@if ($user != 'null')
					<b>FOLIO:    </b> {{$user->id}}<br>
					<b>Nickname: </b> {{$user->nickname}}<br>
					<b>Nombre:   </b> {{$user->nombre}} {{$user->apellidoPaterno}} {{$user->apellidoMaterno}} <br>
					<b>correo:   </b> {{$user->email}}<br>
					<b>Teléfono: </b> {{$user->telefono}}<br>
					@endif
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Error de Notificación.</h5>
				</div>
				<div class="modal-body">
					@if ($errormail != '')
					<b>ATENCIÓN:    </b> No se pudo enviar Notificación.<br>
					@endif
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="container-fluid">
  			<div class="panel panel-default">
				<div class="panel-body">
					<!--Inicia widget-->
					<div class="row">
						<div class="ibox-content ibox-heading">
                            <h3>Que tengas un Excelente día!</h3>
                            <h2><i class="fa fa-address-card"></i> Recuerda que debes completar todos los datos de tu perfil para poder Gozar de todos los Beneficios de Crenado Certezas.</h2>
						</div>
								



							<div class="col-lg-4 col-md-offset-8">
									<div class="widget-head-color-box navy-bg p-lg text-center">
										<div class="m-b-md">
										<h2 class="font-bold no-margins">
										{{ csrf_field() }}
											Sigue adelante  {{ auth()->user()-> nombre}} {{ auth()->user()-> apellidoPaterno}} {{ auth()->user()-> apellidoMaterno}}
										</h2>
											<small>Rango Alcanzado {{$matriz->nombre}}</small>
										</div>
										<!--<img src="img/a4.jpg" class="rounded-circle circle-border m-b-md" alt="profile"> --> 
										<div>
										@if (Auth::user()->estatus==1)
											<span>Tu suscripción Vence el</span> |
											<span>
												@if ($sub!='')
												{{$sub->created_at->addDays(30)->format('d-m-Y')}}	
												@endif
											</span>
										@endif
										@if (Auth::user()->estatus==0)
											<span>Tu suscripción Venció el</span> |
											<span>
												@if ($sub!='')
												{{$sub->created_at->addDays(30)->format('d-m-Y')}}	
												@endif
											</span><br><br>
											<span>Necesitas Renovar para continuar con los Beneficios de Creando Certezas </span>
										@endif

										</div>
									</div>
									<div class="widget-text-box">
										
										
										@if (Auth::user()->estatus==1)
											<p>«El éxito no es definitivo, el fracaso no es fatal: lo que realmente cuenta es el valor para continuar» <br><br> <div class="text-right">– Winston Churchill</div> </p><br>
											<div class="text-right">
											<a href="" class="btn btn-sm btn-primary"><i class="fa fa-star"></i> Suscripción Activa</a>
											@endif	
										@if (Auth::user()->estatus==0)
											<p>«Algunas personas sueñan con tener éxito, mientras que otras se levantan cada mañana y lo hacen realidad» <br><br> <div class="text-right"> – Wayne Huizenga</div></p><br>
											<div class="text-right">
											<a href=""  class="btn btn-sm btn-white"><i class="fa fa-ban"></i> Suscripción Inactiva </a>
										@endif
											
										</div>
									</div>
							</div>
					<!--termina widget--> 
					</div>
 		 		</div>
			</div>
		</div>     
    </div>
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		usuario = {!! $user !!} 
  		if(usuario != null){
  			$('#myModal').modal('show');
  		}
  		errormail = {!! $errormail !!}
  		if(errormail != "null"){
  			$('#myModal2').modal('show');
  		}
	});
</script>
@endsection