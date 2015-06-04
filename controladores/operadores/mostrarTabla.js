var mostrarDatos = {


	init: function(){

		var urlObtenerDatos = "operadores/obtenerTodos.php";

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
                        
                        $(data.operadores).each(function(index){
                        	
                        	contador = contador + 1;
                         
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+data.operadores[index].id+"</td>";
									nuevaFila += "<td>"+data.operadores[index].nombre+"</td>";
									nuevaFila += "<td>"+data.operadores[index].apellido+"</td>";
									nuevaFila += "<td>"+data.operadores[index].usuario+"</td>";
									nuevaFila += "<td>"+data.operadores[index].telefono+"</td>";
									nuevaFila += "<td>";
									nuevaFila += "<a href='panelSitio.php?subSeccion=ModificarOperador&id="+data.operadores[index].id+"'><i class='fa fa-pencil'></i></a>";
      							nuevaFila += " <a href='#myModal' onclick='guardarId("+data.operadores[index].id+");' class='boton_eliminar' id='"+data.operadores[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
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