cargaArbol(users);
function verificaDirecto(usernodo)
{

    directo = "";
    if(typeof usernodo.id !== 'undefined' && usernodo.id != userid)
    {
        directo="Indirecto";
        if(usernodo.padre == userid)
        {
            directo="Directo";
        }
    }
    return directo;
}
function existe(id)
{
    text = id;
    if (typeof id === 'undefined') 
    {
        text="vacio";
    }
    return text;
}        
function recargamatriz(id)
{
    if(id!=0)
    {
        $.ajax({
            method: 'post',
            url: '../../traeArbolNodo',
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:
                {
                    nodo:id
                },
            success: function (data) 
                {
                    data=JSON.parse(data);
                    cargaArbol(data);            
                }
        });    
    }
    
}
function traeArbolCiclo(ciclo)
{
    $.ajax({
        method: 'post',
        url: '../../traeArbolCiclo',
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:
            {
                ciclo:ciclo
            },
        success: function (data) 
            {
                data=JSON.parse(data);
                cargaArbol(data);           
            }
    });
}
function subeArbol(nodo)
{
    $.ajax({
        method: 'post',
        url: '../../subeArbol',
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:
            {
                nodo:nodo
            },
        success: function (data) 
            {
                if(data != ''){
                    data=JSON.parse(data);
                    cargaArbol(data);
                }
                else{
                    $('#myModal').modal('show');
                }         
            }
    });
}
function cargaArbol(data)
{
    var config = {
            container: "#collapsable-example",

            nodeAlign: "BOTTOM",

            animateOnInit:true,

            connectors: {
                type: 'bCurve'
            },
            node: {
                HTMLclass: 'nodeExample1',
                collapsable:false
            },
            animation: {
                nodeAnimation: "easeInSine",
                nodeSpeed: 500,
                connectorsAnimation: "linear",
                connectorsSpeed: 500
            }
        },
        ceo = {
            collapsable:false,
            text: {
                name: ""+data[0].nombre +" " +data[0].apellidoPaterno +" " +data[0].apellidoMaterno,
                //name: "Folio: "+data[0].id,
                title: "ID: "+data[0].codigo,
                estatus: "Suscripción: "+ (data[0].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[0].nickname,
                //estatus: "Estatus: "+ (data[0].estatus != 1 ? 'Inactivo' : 'Activo') ,
                desc: verificaDirecto(data[0])
            },
            link: 
                {
                    href: (data[0].estatus != 33 ? 'javascript:subeArbol('+data[0].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },

        cto = {
            parent: ceo,
            HTMLclass: (verificaDirecto(data[1]) == '' ? 'type-empty' : (verificaDirecto(data[1]) == 'Directo' ? 'type-direct' : 'type-indirect')),
            text:{
                name: ""+existe(data[1].nombre) +" " +existe(data[1].apellidoPaterno +" " +existe(data[1].apellidoMaterno)),
                title: "ID: "+data[1].codigo,
                estatus: "Suscripción: "+ (data[1].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[1].nickname,
                desc: verificaDirecto(data[1])
            },
            link: 
                {
                    href: (data[1].estatus != 33 ? 'javascript:recargamatriz('+data[1].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },
        cbo = {
            parent: ceo,
            HTMLclass: (verificaDirecto(data[4]) == '' ? 'type-empty' : (verificaDirecto(data[4]) == 'Directo' ? 'type-direct' : 'type-indirect')),
            text:{
                name: ""+existe(data[4].nombre) +" " +existe(data[4].apellidoPaterno +" " +existe(data[4].apellidoMaterno)),
                title: "ID: "+data[4].codigo,
                estatus: "Suscripción: "+ (data[4].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[4].nickname,
                desc: verificaDirecto(data[4])
            },
            link: 
                {
                    href: (data[4].estatus != 33 ? 'javascript:recargamatriz('+data[4].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },
        cio = {
            parent: cto,
            HTMLclass: (verificaDirecto(data[2]) == '' ? 'type-empty' : (verificaDirecto(data[2]) == 'Directo' ? 'type-direct' : 'type-indirect')),
            text:{
                name: ""+existe(data[2].nombre) +" " +existe(data[2].apellidoPaterno +" " +existe(data[2].apellidoMaterno)),
                title: "ID: "+data[2].codigo,
                estatus: "Suscripción: "+ (data[2].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[2].nickname,
                desc: verificaDirecto(data[2])
            },
            link: 
                {
                    href: (data[2].estatus != 33 ? 'javascript:recargamatriz('+data[2].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },
        ciso = {
            parent: cto,
            HTMLclass: (verificaDirecto(data[3]) == '' ? 'type-empty' : (verificaDirecto(data[3]) == 'Directo' ? 'type-direct' : 'type-indirect')),
            text:{
                name: ""+existe(data[3].nombre) +" " +existe(data[3].apellidoPaterno +" " +existe(data[3].apellidoMaterno)),
                title: "ID: "+data[3].codigo,
                estatus: "Suscripción: "+ (data[3].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[3].nickname,
                desc: verificaDirecto(data[3])
            },
            link: 
                {
                    href: (data[3].estatus != 33 ? 'javascript:recargamatriz('+data[3].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },
        ciso2 = {
            parent: cbo,
            HTMLclass: (verificaDirecto(data[5]) == '' ? 'type-empty' : (verificaDirecto(data[5]) == 'Directo' ? 'type-direct' : 'type-indirect')),
            text:{
                name: ""+existe(data[5].nombre) +" " +existe(data[5].apellidoPaterno +" " +existe(data[5].apellidoMaterno)),
                title: "ID: "+data[5].codigo,
                estatus: "Suscripción: "+ (data[5].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[5].nickname,
                desc: verificaDirecto(data[5])
            },
            link: 
                {
                    href: (data[5].estatus != 33 ? 'javascript:recargamatriz('+data[5].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },
        ciso3 = {
            parent: cbo,
            HTMLclass: (verificaDirecto(data[6]) == '' ? 'type-empty' : (verificaDirecto(data[6]) == 'Directo' ? 'type-direct' : 'type-indirect')),
            text:{
                name: ""+existe(data[6].nombre) +" " +existe(data[6].apellidoPaterno +" " +existe(data[6].apellidoMaterno)),
                title: "ID: "+data[6].codigo,
                estatus: "Suscripción: "+ (data[6].estatus != 1 ? 'Inactiva' : 'Activa') ,
                //contact: "Usuario: "+data[6].nickname,
                desc: verificaDirecto(data[6])
            },
            link: 
                {
                    href: (data[6].estatus != 33 ? 'javascript:recargamatriz('+data[6].nodo+')' : 'javascript:recargamatriz(0) ')
                },
            image: "../../img/perfil/empty.png"
        },

        chart_config = [
            config,
            ceo,cto,cbo,
            cio,ciso,
            ciso2,ciso3
        ];
    chart = new Treant(chart_config);
}

function traeCiclos(idUsuario,idMatriz)
{

    $('#btnComunidades > a').each(function(){
        $(this).removeClass('active');
    });

    var btn = $('#btnComunidades a:eq('+ (idMatriz-1) +')');
    btn.addClass('active');

    $.ajax({
        method: 'post',
        url: '../../traeCiclos',
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:
            {
                idMatriz : idMatriz,
               idUsuario : idUsuario
            },
        success: function (data) 
            {
                data=JSON.parse(data);
                arbol=JSON.parse(data['arbol']);
                cargaArbol(arbol);
                $('#ciclos').empty();
                data['ciclos'].forEach(function(ciclo, index) 
                    {
                        if(data['ciclos'].length==(index+1)){
                            $('#ciclos').append("<label> <input class='btn-circle' type='radio' value='"+index+"' onclick='traeArbolCiclo("+ciclo.id+"); checarCiclo("+ciclo.id+",4,0);' id='ciclo' name='b' checked> <i></i> Ciclo "+(index+1) +" (actual)</label> </br>");
                        }
                        else{
                            if(index==0){
                            $('#ciclos').append("<label> <input class='btn-circle' type='radio' value='"+index+"' onclick='traeArbolCiclo("+ciclo.id+"); checarCiclo("+ciclo.id+",1,0);' id='ciclo' name='b'> <i></i> Ciclo "+(index+1) +"</label> </br>");
                        }
                        if(index==1){
                            val=index-1;
                            $('#ciclos').append("<label> <input class='btn-circle' type='radio' value='"+index+"' onclick='traeArbolCiclo("+ciclo.id+"); checarCiclo("+ciclo.id+",2, "+data['ciclos'][val].id+");' id='ciclo' name='b'> <i></i> Ciclo "+(index+1) +"</label> </br>");

                        }
                        if(index!=0 && index!=1 && data['ciclos'].length!=(index+1)){
                            val=index-1;
                            $('#ciclos').append("<label> <input class='btn-circle' type='radio' value='"+index+"' onclick='traeArbolCiclo("+ciclo.id+"); checarCiclo("+ciclo.id+",3, "+data['ciclos'][val].id+");' id='ciclo' name='b'> <i></i> Ciclo "+(index+1) +"</label> </br>");

                        }
                      
                        }
                      
                    });
            }
    });
}