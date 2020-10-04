$(document).ready(function(){
    $('#usuarios').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
         "language": 
                {
                    "lengthMenu": "Mostrar _MENU_ registros por página.",
                    "zeroRecords": "Nada para mostrar.",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros",
                    "search": "Buscar",
                    "paginate": {
                          "previous": "Anterior",
                          "next": "Siguiente"
                        }
                },
        buttons: [
            
        ]

    });

});