$(document).ready(function(e){

    $('#jstree1').jstree({
        'core' : {
            'check_callback' : true
        },
        'plugins' : [ 'types', 'dnd' ],
        'types' : {
            'default' : {
                'icon' : 'fa fa-user'
            },

        }
    });
});
 function getData(id)
{
    text = 'Cargando datos...';
        fontSize = '';
        maxSize = '';
        textPos = 'vertical';
    $('#container').waitMe({
            effect: 'rotation',
            text: text,
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: maxSize,
            waitTime: -1,
            source: 'img.svg',
            textPos: textPos,
            fontSize: fontSize,
            onClose: function(el) {}
        });
    var formData = new FormData();
    var token = $('meta[name="csrf-token"]').attr('content');    
    formData.append("id", id);
    formData.append("_token", token);
    
    // Use `jQuery.ajax` method
    $.ajax( {
        url:'./getUser',
        type:'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType:'json',
        success: function (data) {
            console.log(data);
            $('#img').attr("src","../img/perfil/"+data.user.imagen);
            $('#nombre').text(data.user.nombre+ ' ' +data.user.apePaterno+' '+data.user.apeMaterno);
            if (data.user.franquicia==0)
            {
                $('#tipo').text('Distribidor');
            }
            else
            {
                $('#tipo').text('Franquiciatario');
            }
            $('#id').text('ID: '+data.user.idUsuario);
            $('#nombreP').text(data.user.nombre+ ' ' +data.user.apePaterno+' '+data.user.apeMaterno);
            $('#idP').text(data.user.idUsuario);
            $('#inicio').text(data.user.created_at);
            if (data.user.estatus==0)
            {
                $('#estado').text('Inactivo');
            }
            else
            {
                $('#estado').text('Activo');
            }
            if (data.user.franquicia==0)
            {
                $('#rango').text('Distribidor');
            }
            else
            {
                $('#rango').text('Franquiciatario');
            }
            $('#ventas').text(data.tVentas);
            $('#prospectos').text(data.tProspec);
            $('#pendientes').text(data.tVentasComf);
            $('#procesando').text(data.tVentasPros);
            $('#tVentas').find('tr').remove();
            $.each(data.ventas, function (i, item) {
                var fila=$('<tr>');
                var id=$('<td>',{
                    text:item.idVenta,
                    });
                var comi=$('<td>',{
                    text:item.comision,
                    
                    });
                var total= $('<td>',{
                    text:item.totalPagar,
                });
                fila.append(id);
                fila.append(comi);
                fila.append(total);
                $('#tVentas').append(fila);
            });
            $('#pat').find('div').remove();
            $('#email').text(data.user.correo);
            $('#telefono').text(data.user.telefono);
            $('#celular').text(data.user.celular);
            $('#container').waitMe('hide');
        },
        error: function (e) {
            console.log(e.responseJSON);
            $('#container').waitMe('hide');
        }
    });
    
}
