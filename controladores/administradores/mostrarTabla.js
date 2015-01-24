var mostrarDatos = {


	init: function(){

		var urlObtenerDatos = "administradores/obtenerTodos.php";

		$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },   
                    success: function(data) {
								var contador = 0;
                        
                        $(data.administradores).each(function(index){
                        	
                        	contador = contador + 1;
                         
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+contador+"</td>";
									nuevaFila += "<td>"+data.administradores[index].nombre+"</td>";
									nuevaFila += "<td>"+data.administradores[index].apellido+"</td>";
									nuevaFila += "<td>"+data.administradores[index].usuario+"</td>";
									nuevaFila += "<td>"+data.administradores[index].telefono+"</td>";
									nuevaFila += "<td>";
									nuevaFila += "<a href='panelSitio.php?subSeccion=ModificarAdministrador&id="+data.administradores[index].id+"'><i class='fa fa-pencil'></i></a>";
      							nuevaFila += " <a href='javascript:;' class='boton_eliminar' id='"+data.administradores[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
      							nuevaFila += "</td>";
		
									nuevaFila +="</tr>";
		
									$("#tabla").append(nuevaFila);                            
                        });
      	            		$('#tabla').dataTable({
											"bPaginate": false,
												"bLengthChange": false,
												"bFilter": true,
												"bSort": false,
												"bInfo": false,
												"bAutoWidth": false });	
       
                    },
                    error: function(a,b,c){
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});

		
	}


}