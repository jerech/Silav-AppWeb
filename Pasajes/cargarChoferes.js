var CargarChoferes = {

	init: function(){

		urlObtenerChoferes = "../Pasajes/obtenerChoferes.php";

		$.ajax({
                        type: 'post',
                        url: urlObtenerChoferes, 
                        data: {},           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
								choferesConectados = data;
								var contador = 0;
								$(data.choferes).each(function(index){
                           contador = contador + 1;
                           
                           var nuevaOpcion = "<option ";
                           
									if (contador == 1) {
										nuevaOpcion += " selected='selected' ";
										$("#movil").val(data.choferes[index].numero_movil);
									}
									
									nuevaOpcion += "value="+data.choferes[index].usuario+">"+data.choferes[index].usuario+"</option>";
									
									$('#listaChoferes').append(nuevaOpcion);                           
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