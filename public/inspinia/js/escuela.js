$(document).ready(function(){
	$('#pais').change(function(){
		var pais=this.value;
		var opt=$('#estados');
		opt.find('option').not(':first').remove();
		$.ajax({
          	method: 'get',
          	url: '../getEstados',
          	data:{pais:pais},
          	success: function (data) {          		
              	$.each(data, function (i, item) {
                  //console.log(item.nombre);
                  	opt.append($('<option>', {
	                    value: item.idEstado,
	                    text : item.nombre

                	}));

              	});
          	}
      	});
	});

	$('#estados').change(function(){
		var estado=this.value;
		var opt=$('#municipio');
		opt.find('option').not(':first').remove();
		$.ajax({
          	method: 'get',
          	url: '../getMunicipios',
          	data:{estado:estado},
          	success: function (data) {          		
              	$.each(data, function (i, item) {
                  //console.log(item.nombre);
                  	opt.append($('<option>', {
	                    value: item.idMunicipio,
	                    text : item.nombre

                	}));

              	});
          	}
      	});
	});
});