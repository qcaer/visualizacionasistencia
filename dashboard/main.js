


$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    Provincia = fila.find('td:eq(1)').text();
    Oficina = fila.find('td:eq(2)').text();
    ApellidoyNombres = fila.find('td:eq(3)').text();
    Contesto = fila.find('td:eq(11)').text();
 
    
    $("#Provincia").val(Provincia);
    $("#Oficina").val(Oficina);
    $("#ApellidoyNombres").val(ApellidoyNombres);
    $("#Contesto").val(Contesto);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    

   
    $("#btnGuardar").click(function(){


        Swal.fire({
            type:'success',
            title:'¡Actualización exitosa!',
            confirmButtonColor:'#3085d6',
            confirmButtonText:'Cerrar'
        }).then((result) => {
            if(result.value){
                //window.location.href = "vistas/pag_inicio.php";
                window.location.href = "index.php";
            }
        }) 
        
    
    });

});

    






//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            row: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.data(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    

    Contesto = $.trim($("#Contesto").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Provincia:Provincia, Oficina:Oficina, ApellidoyNombres:ApellidoyNombres, Contesto:Contesto, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            Provincia = data[0].Provincia;
            Oficina = data[0].Oficina;
            ApellidoyNombres = data[0].Contesto;
            Contesto = data[0].Contesto;
            if(opcion == 1){tablaPersonas.data.add([id,Provincia,Oficina,ApellidoyNombres,Contesto]).draw();}
            else{tablaPersonas.data(fila).data([id,Provincia,Oficina,ApellidoyNombres,Contesto]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});