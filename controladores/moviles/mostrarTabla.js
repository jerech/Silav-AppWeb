var mostrarDatos = {

	init: function(){

		var urlObtenerDatos = "moviles/obtenerTodos.php";

		$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },   
                    success: function(data) {
								var contador = 0;
                        
                        $(data.moviles).each(function(index){
                        	
                        	contador = contador + 1;
                           
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+contador+"</td>";
									nuevaFila += "<td>"+data.moviles[index].numero+"</td>";
									nuevaFila += "<td>"+data.moviles[index].patente+"</td>";
									nuevaFila += "<td>"+data.moviles[index].modelo+"</td>";
									nuevaFila += "<td>"+data.moviles[index].marca+"</td>";

									nuevaFila += "<td>";
									nuevaFila += "<a href='panelSitio.php?subSeccion=NuevoMovil&id="+data.moviles[index].id+"'><i class='fa fa-pencil'></i></a>";
      							nuevaFila += " <a href='javascript:;' class='boton_eliminar' id='"+data.moviles[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
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

		$(".boton_eliminar").click(function () {
			alert($(this).prop("id"));
		});
	}
}