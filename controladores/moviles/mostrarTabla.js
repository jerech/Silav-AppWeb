var mostrarDatos = {

	init: function(){

		var urlObtenerDatos = "moviles/obtenerTodos.php";
		var columnasTabla = [
                { "mData": "id" },
                { "mData": "numero" },
                { "mData": "patente" },
                { "mData": "modelo" },
                { "mData": "marca" },
                { "mData": "ee"}
            ];


		/*$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        blockUI($("#div-tabla"));
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
									nuevaFila += "<a href='panelSitio.php?subSeccion=ModificarMovil&id="+data.moviles[index].id+"'><i class='fa fa-pencil'></i></a>";
      								nuevaFila += " <a href='#myModal' onclick='guardarId("+data.moviles[index].id+");' class='boton_eliminar' id='"+data.moviles[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
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

      	            		unblockUI($("#div-tabla"));
       
                    },
                    error: function(a,b,c){
                    	unblockUI($("#div-tabla"));
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});*/

		$('#tabla').dataTable({
                
            });
			
			
}
}