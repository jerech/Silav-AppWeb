var CargarMoviles = {

	init: function(){
		//esta funcion crea la tabla en la ventana modal con todos los registros de la tabla Moviles
		urlObtenerMoviles = "choferes/obtenerMoviles.php";

		$.ajax({
                        type: 'post',
                        url: urlObtenerMoviles, 
                        data: {},           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {

								registrosMoviles = data;
								
								$(data.moviles).each(function(index){
                           
                           var nuevaFila = "<tr>";
                           
                           nuevaFila += "<td><input type='checkbox' id='"+data.moviles[index].id+"' class='checks'></td>";

									nuevaFila += "<td>"+data.moviles[index].numero+"</td>";
									nuevaFila += "<td>"+data.moviles[index].patente+"</td>";
									nuevaFila += "<td>"+data.moviles[index].modelo+"</td>";
									nuevaFila += "<td>"+data.moviles[index].marca+"</td>";
		
									nuevaFila +="</tr>";
		
									$("#tablaModal").append(nuevaFila);                            
                        });
                                                     
                        },
                        error: function(a,b,c){
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });

	}
}