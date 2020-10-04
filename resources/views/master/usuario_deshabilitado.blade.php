@extends('layouts.master')

@section('content')
<div class="container"></br>
		<!-- Modal -->
		<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
			<div class="modal-dialog modal-dialog-centered " role="document">
				<div class="modal-content ">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle3">{{$titulo}}</h5>
					</div>
					<div class="modal-body">
					<b>ATENCIÓN:    </b> {{$mensaje}}<br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
    <div class="row">
        <div class="col-md-12">
            <img src="{{asset('img/fondo/Crecer_Mesa_trabajo_1.png')}}" width="90%" height="90%">
        </div>
    </div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		$('#myModal3').modal('show');
	});
</script>
@endsection

