@extends('layouts.master')

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
	<!-- Modal 
			<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered " role="document">
					<div class="modal-content ">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Error de Notificación.</h5>
						</div>
						<div class="modal-body">
							@if ($errormail != 'null')
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
				<div class="col-md-12">
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<span class="label label-success pull-right">Mensualmente</span>
							<h5>Generado</h5>
						</div>
						<div class="ibox-content">
							<div class="stat-percent font-bold text-success"><i class="fa fa-dollar"> 0.00 </i></div>
							<small>Total generado</small>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<span class="label label-info pull-right">Anual</span>
							<h5>Generado</h5>
						</div>
						<div class="ibox-content">
							<div class="stat-percent font-bold text-info"><i class="fa fa-dollar"> 0.00 </i></div>
							<small>Total</small>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<span class="label label-primary pull-right">Directos</span>
							<h5>Invitados semanales</h5>
						</div>
						<div class="ibox-content">
							<div class="stat-percent font-bold text-navy">0 <i class="fa fa-level-up"></i></div>
							<small>Inscritos</small>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<span class="label label-primary pull-right">Directos</span>
							<h5>Invitados mensuales</h5>
						</div>
						<div class="ibox-content">
							<div class="stat-percent font-bold text-navy">0 <i class="fa fa-level-up"></i></div>
							<small>Inscritos</small>
						</div>
					</div>
				</div>
			</div> -->
		<div>
            <center><img src="{{asset('img/fondo/Crecer_Mesa_trabajo_1.png')}}" width="75%" height="75%"></center>
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

