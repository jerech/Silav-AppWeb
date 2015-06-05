var EnviarPasaje = {


	init: function(){

    latDireccion="";
    lonDireccion="";
    direccionCalle="";
    direccionNumero=""; 
			
			$("#btnAsignar").click(function(){
				
			urlNuevoPasaje = "../Pasajes/nuevo.php";
			
			var form = $(".form").serialize()+"&lat="+latDireccion+"&lon="+lonDireccion+"&direccionCalle="+direccionCalle+"&direccionNumero="+direccionNumero;
      if($("#movil").prop("disabled")==true){
          form += "&movil="; 
      }
      if($("#listaChoferes").prop("disabled")==true){
        form += "&listaChoferes=";
      }
      console.log(form);

		$.ajax({
                        type: 'post',
                        url: urlNuevoPasaje, 
                        data: form,           
                        dataType: 'html',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
									var datos = data.split("_");
               				if(datos[0] != "OK"){
               					notificacion("error",data);   
               				}else{
               				
               					    notificacion("success", "Pasaje enviado correctamente");
                  				$(".form-control").val('');
               				} 
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
			});


      $('#tipo').on('switchChange.bootstrapSwitch', function(event, state) {
                        //Si state en true, la asigancion es manual, si es false es automatica
                        if(state==false){
                          $("#listaChoferes").val("");
                          $("#movil").val("");
                          $("#listaChoferes").attr("disabled", "disabled");
                          $("#movil").attr("disabled", "disabled");
                        }
                        if (state==true){
                          $("#listaChoferes").attr("disabled", false);
                          $("#movil").attr("disabled", false); 
                        }
                      });

      

      
	 },

   buscarCoordenadas: function(){
      
      
        array_direccion=$("#calle").val().split(" ");
        var calle = array_direccion[0];
        var numero = array_direccion[1];
        if(!calle || !numero){
          alert("Formato de direccion incorrecta.");
          return;
        }

        //Armamos la query para enviar a la api nominatim
        var query=numero+"+"+calle+",+san francisco,+departamento san justo,+cordoba&format=json&addressdetails=1";
        var url = "http://nominatim.openstreetmap.org/search?q="+query;

        $.ajax({
                        type: 'get',
                        url: url, 
                        data: {},           
                        dataType: 'json',
                        beforeSend: function(){
                           blockUI($("#div-block"));
                        },   
                        success: function(data) {
                            console.log(data);

                            if(data.length == 1){
                              latitud = data[0].lat;
                              longitud = data[0].lon;
                              direccionCompleta = data[0].address.road+" "+data[0].address.house_number+" - "+data[0].address.town+" "+data[0].address.state;

                              $("#lbl-lat").html(latitud);
                              $("#lbl-lon").html(longitud);
                              $("#lbl-info-direccion").html(direccionCompleta);

                              latDireccion = data[0].lat;
                              lonDireccion = data[0].lon;
                              direccionCalle = data[0].address.road;
                              direccionNumero = data[0].address.house_number;
                            }

                            if(data.length == 0){
                              $("#lbl-info-direccion").html("Sin resultados encontrados");
                            }

                            unblockUI($("#div-block"));
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                            unblockUI($("#div-block"));
                        }


                    });
     
   }

 
  
}