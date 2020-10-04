$(document).ready(function(){
	var firstEstados=true;
	var firstMunicipios=true;
	$('#estados').hide();
	$('#municipios').hide();
	$('#pais').change(function(){
		if(firstEstados)
    	{
    		firstEstados=false;
    		$('#estados').show('slow','swing');
    	}
		var pais=this.value;
		var opt=$('#estado');
		opt.find('option').not(':first').remove();
		$.ajax({
          	method: 'get',
          	url: '../getEstados',
          	data:{pais:pais},
          	success: function (data) {          		
              	$.each(data, function (i, item) {
                  //console.log(item.nombre);
                  	opt.append($('<option>', {
	                    value: item.id,
	                    text : item.nombre

                	}));

              	});
          	}
      	});
	});

	$('#estado').change(function(){
		if(firstMunicipios)
    	{
    		firstMunicipios=false;
    		$('#municipios').show('slow','swing');
    	}
		var estado=this.value;
		var opt=$('#municipio');
		opt.find('option').not(':first').remove();
		$.ajax({
          	method: 'get',
          	url: '../getMunicipios',
          	data:{estado:estado},
          	success: function (data) {          		
              	$.each(data, function (i, item) {
                  	opt.append($('<option>', {
	                    value: item.id,
	                    text : item.nombre

                	}));

              	});
          	}
      	});
	});
});

$('#nombre').on('change', function() {
  nombre = $('#nombre').val();
  paterno = $('#apepaterno').val();
  $('#nickname').val(nombre[0]+paterno);
});
$('#apepaterno').on('change', function() {
  nombre = $('#nombre').val();
  paterno = $('#apepaterno').val();
  $('#nickname').val(nombre[0]+paterno);
});