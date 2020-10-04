    $(document).ready(function () {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
   
     $('#form').submit(function(){
     $.ajax({
     type: "POST",
     url: "/datosPatrocinador",
     data: $('#form').serialize(),
     success: function (data) {
     for(i=0; i<data.length; i++){
     if (data[i].nombre===undefined) {
            }else{
     $('#spanPat').html(data[i].nombre+" "+ data[i].apellidoPaterno+" "+ data[i].apellidoMaterno);
     document.getElementById('idPatrocinador').value=data[i].id;
                         }

                      }

                   }
                })
        return false;
                    });
                       });  

    function setPatron(data){
    document.getElementById('idPatrocinador').value=data;
    for(i=0; i<usuarios.length; i++){
    if(usuarios[i].id==data){
    $('#spanPat').html(usuarios[i].nombre+" "+ usuarios[i].apellidoPaterno+" "+ usuarios[i].apellidoMaterno);
                    }
                }
            }  
    function Search(){
    str= document.getElementById("codigo").value;
    if (str.length==0) {
    $('#spanPat').html('');
    document.getElementById("spanPat").style.border="0px";
                                }
              
     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               }
                       });                       
     
    $.ajax({
    type: "POST",
    url: "/datosPatrocinador",
    data: $('#form').serialize(),                           
    success: function (data) {
    $('#spanPat').html('');
                         
    
    for(i=0; i<data.length; i++){                              
    if (data[i].nombre===undefined) {
                            }else{                                   
    document.getElementById("spanPat").style.border="5px";
    $('#spanPat').append('<p id="p" onclick="setPatron('+data[i].id+');" style="border-color:black; border-style: solid; width:331px; padding:5px;  border-width: 2px;">'+data[i].nombre+" "+ data[i].apellidoPaterno+" "+ data[i].apellidoMaterno+'</p>');
    document.getElementById("spanPat").style.display="block";
                     }
                }
            }
         })
    return false;
    }

    function checarCiclo(ciclo,comunidad,anterior){ 
     //  alert(comunidad);
     if(comunidad==4){
      document.getElementById('pagos1').style.display='block';
      document.getElementById('pagos').style.display='none';
     }else{
       $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                 }
                         });                  
      $.ajax({
      type: "POST",
      url: "/verificarCiclo/"+ciclo+'&'+anterior,
     /* data: ciclo,*/                           
      success: function (data) {
       // alert(data);
            var obj = JSON.parse(data);
            document.getElementById('pagos1').style.display='none';
            document.getElementById('pagos').style.display='block';
            document.getElementById('spanDirectos').innerHTML='<span style="float:right" id="spanDirectos">'+obj.directos+'</span>';
      if(obj.matriz=='BRONCE'){
          if(obj.directos==0){
           if(comunidad==1){
            document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 2,000</span>';
            document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
            document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
            document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
            document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
            document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
            document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
           }
           if(comunidad==2){
            document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 2,000</span>';
            document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
            document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
            document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
            document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
            document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
            document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
            }
           if(comunidad==3){
            document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 2,000</span>';
            document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
            document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
            document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
            document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
            document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
            document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>'; 
               }
            }
        
            if(obj.directos==1){
               if(comunidad==1){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 4,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 2,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 1,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 75</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 1,425</span>';
               }
               if(comunidad==2){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 4,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 2,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 1,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 75</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 1,425</span>';
                }
               if(comunidad==3){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 4,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 2,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 1,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 75</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 1,425</span>';
                   }
            } 
            if(obj.directos>=2){
               if(comunidad==1){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 8,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 6,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 1,500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 4,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 225</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 4,275</span>';
               }
               if(comunidad==2){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 8,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 6,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 2,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 1,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 75</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 1,425</span>';
                }
               if(comunidad==3){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 8,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 2,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 6,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 1,500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 4,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 225</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 4,275</span>';
                   }
               }         
   
            }
      if(obj.matriz=='PLATA'){
         if(obj.directos==0){
            if(comunidad==1){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 4,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
            }
            if(comunidad==2){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 4,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
             }
            if(comunidad==3){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 4,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
                }
         }
         if(obj.directos==1){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 8,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 4,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 1,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 3,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 150</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 2,850</span>';
            }
            if(comunidad==2){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 8,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 4,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 1,000</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 3,000</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 150</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 2,850</span>';
             }
            if(comunidad==3){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 8,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 4,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 1,000</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 3,000</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 150</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 2,850</span>';
                }
         } 
         if(obj.directos>=2){
            if(comunidad==1){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 16,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 14,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 2,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 500</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 1,500</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 75</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 1,425</span>';
            }
            if(comunidad==2){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 16,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 12,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 3,000</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 9,000</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 450</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 8,550</span>';
             }
            if(comunidad==3){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 16,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 4,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 12,000</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 3,000</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 9,000</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 450</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 8,550</span>';
                }
         }      
               
                 
        
      }



      if(obj.matriz=='ORO'){
         if(obj.directos==0){
            if(comunidad==1){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 10,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 10,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>'; 
             }
            if(comunidad==3){
                  document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 10,000</span>';
                  document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
                  document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
                  document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
                  document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
                  document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
                  document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
                }
         }
         if(obj.directos==1){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 20,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 10,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 2,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 7,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 375</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 7,125</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 20,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 10,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 2,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 7,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 375</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 7,125</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 20,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 10,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 2,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 7,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 375</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 7,125</span>';  
                }
         } 
         if(obj.directos>=2){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 40,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 35,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 5,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 1,250</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 3,750</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 187.5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 3562.5</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 40,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 30,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 7,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 22,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 1125</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 21,375</span>';
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 40,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 10,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 30,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 7,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 22,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 1125</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 21,375</span>';  
                }
         }      
      }
      if(obj.matriz=='PLATINO'){
         if(obj.directos==0){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 25,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 25,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 25,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
                }
         }
         if(obj.directos==1){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 50,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 25,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 6,250</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 18,750</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 937,5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 17,812.5</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 50,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 25,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 6,250</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 18,750</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 937,5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 17,812.5</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 50,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 25,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 6,250</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 18,750</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 937,5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 17,812.5</span>';
                }
         } 
         if(obj.directos>=2){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 75,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 25,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 6,250</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 18,750</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 937,5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 17,812.5</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 75,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 18,750</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 56,250</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 2,812.5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 53,437.5</span>';
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 25,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 75,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 18,750</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 56,250</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 2,812.5</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 53,437.5</span>';  
                }
         }      
         
      }
      if(obj.matriz=='ESMERALDA'){
         if(obj.directos==0){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 50,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 50,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>';
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 50,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>'; 
                }
         }
         if(obj.directos==1){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 50,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 12,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 37,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 1875</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 35,625</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 50,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 12,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 37,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 1875</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 35,625</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 50,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 12,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 37,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 1875</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 35,625</span>';
                }
         } 
         if(obj.directos>=2){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 200,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 150,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 50,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 12,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 37,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 1875</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 35,625</span>';
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 200,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 150,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 37,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 112,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 5625</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 106,875</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 200,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 50,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 150,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 37,500</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 112,500</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 5625</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 106,875</span>';  
                }
         }      
      }
      if(obj.matriz=='DIAMANTE'){
         if(obj.directos==0){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>'; 
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 100,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 0</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 0</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 0</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 0</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 0</span>'; 
                }
         }
         if(obj.directos==1){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 200,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 100,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 25,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 75,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 3,750</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 71,250</span>'; 
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 200,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 100,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 25,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 75,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 3,750</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 71,250</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 200,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 100,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 25,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 75,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 3,750</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 71,250</span>'; 
                }
         } 
         if(obj.directos>=2){
            if(comunidad==1){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 400,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 300,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 75,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 225,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 11,250</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 213,750</span>'; 
            }
            if(comunidad==2){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 400,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 300,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 75,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 225,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 11,250</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 213,750</span>'; 
             }
            if(comunidad==3){
               document.getElementById('spanAportaciones').innerHTML='<span style="float:right" id="spanAportaciones">$ 400,000</span>';
               document.getElementById('spanRetencion').innerHTML='<span style="float:right" id="spanRetencion">-$ 100,000</span>';
               document.getElementById('spanSaldo1').innerHTML='<span style="float:right" id="spanSaldo1">$ 300,000</span>';
               document.getElementById('spanIsr').innerHTML='<span style="float:right" id="spanIsr">-$ 75,000</span>';
               document.getElementById('spanSaldo2').innerHTML='<span style="float:right" id="spanSaldo2">$ 225,000</span>';
               document.getElementById('spanComision').innerHTML='<span style="float:right" id="spanComision">-$ 11,250</span>';
               document.getElementById('spanTotal').innerHTML='<span style="float:right" id="spanTotal">$ 213,750</span>';   
                }
         }      
      }
              }
           })
      return false;
   }
    }