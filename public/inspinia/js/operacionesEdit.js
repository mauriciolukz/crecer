$(document).ready(function(){
	$('#enviar').click(function(e) {
		// body...
		e.preventDefault();
		swal({
		  title: "¿Deseas continuar?",
		  text: "Si ya has revisado toda la información da clic en aceptar",
		  icon: "info",
		  buttons: {
		    cancel: "Cancelar",
		    confirm: "Confirmar",
		  },
		}).then((result) => {
	        if (result) {
	            $('#form').submit();
	        }
	    });
	})
	
});