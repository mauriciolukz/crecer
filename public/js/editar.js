$('#pais').change(function(){
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
$('#nombre').change(function(){
  nombre = $('#nombre').val();
  paterno = $('#apepaterno').val();
  $('#nickname').val(nombre[0]+paterno);
});
$('#apepaterno').change(function(){
  nombre = $('#nombre').val();
  paterno = $('#apepaterno').val();
  $('#nickname').val(nombre[0]+paterno);
});