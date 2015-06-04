var mostrarDatos = {


	init: function(){

		var urlObtenerDatos = "administradores/obtenerTodos.php";

		$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        blockUI($("#div-tabla"), false);
                    },   
                    success: function(data) {
								var contador = 0;
                        
                        $(data.administradores).each(function(index){
                        	
                        	contador = contador + 1;
                         
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+data.administradores[index].id+"</td>";
									nuevaFila += "<td>"+data.administradores[index].nombre+"</td>";
									nuevaFila += "<td>"+data.administradores[index].apellido+"</td>";
									nuevaFila += "<td>"+data.administradores[index].usuario+"</td>";
									nuevaFila += "<td>"+data.administradores[index].telefono+"</td>";
									nuevaFila += "<td>";
									nuevaFila += "<a href='panelSitio.php?subSeccion=ModificarAdministrador&id="+data.administradores[index].id+"'><i class='fa fa-pencil'></i></a>";
      							nuevaFila += " <a href='#myModal' onclick='guardarId("+data.administradores[index].id+");' class='boton_eliminar' id='"+data.administradores[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
      							nuevaFila += "</td>";
		
									nuevaFila +="</tr>";
		
									$("#tabla").append(nuevaFila);                            
                        });
      	            	initDataTable($('#tabla'));
      	            	unblockUI($("#div-tabla"));
       
                    },
                    error: function(a,b,c){
                    	unblockUI($("#div-tabla"));
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});

		
	}


}