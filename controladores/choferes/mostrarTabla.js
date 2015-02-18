var mostrarDatos = {

	init: function(){

		var urlObtenerDatos = "choferes/obtenerTodos.php";


		$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },   
                    success: function(data) {
								var contador = 0;
                        
                        $(data.choferes).each(function(index){
                        	
                        	contador = contador + 1;
                           
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+contador+"</td>";
									nuevaFila += "<td>"+data.choferes[index].nombre+"</td>";
									nuevaFila += "<td>"+data.choferes[index].apellido+"</td>";
									nuevaFila += "<td>"+data.choferes[index].usuario+"</td>";
									nuevaFila += "<td>"+data.choferes[index].numero_telefono+"</td>";

									nuevaFila += "<td>";
									nuevaFila += "<a href='panelSitio.php?subSeccion=ModificarChofer&id="+data.choferes[index].id+"'><i class='fa fa-pencil'></i></a>";
      							nuevaFila += " <a href='#myModal' onclick='guardarId("+data.choferes[index].id+");' class='boton_eliminar' id='"+data.choferes[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
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