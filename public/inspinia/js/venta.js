$(document).ready(function(){
	$('#años').change(function(){
		var anios=this.value;2
		
		var total=300*alum*anios;
		var comision=total*.10;
		var pago=total-comision;
		$('#total').text(total);
		$('#comision').text(comision);
		$('#pago').text(pago);
	});
});