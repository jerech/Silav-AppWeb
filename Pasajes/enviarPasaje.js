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
                        beforeSend: function(xhr){
                           if(latDireccion==undefined || lonDireccion==undefined || direccionCalle==undefined){
                              xhr.abort();
                              var datoFaltante="";
                              switch(undefined){
                                case latDireccion:
                                    datoFaltante="Falta Latitud";
                                case longitud:
                                    datoFaltante="Falta Longitud";
                                case direccionCalle:
                                    datoFaltante="Falta Calle";
                                //case direccionNumero:
                                    //datoFaltante="Falta Número de Calle"; 
                              }
                              notificacion("error","Error. "+datoFaltante+" del Pasaje.");
                           } 
                        },   
                        success: function(data) {
									var datos = data.split("_");
               				if(datos[0] != "OK"){
               					notificacion("error",data);   
               				}else{
               				
               					    notificacion("success", "Pasaje enviado correctamente");
                  				$(".form-control").val('');
                          $(".lbl-asignacion").html('');
               				} 
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
			});

      $("#abrirModalEdicionCoordenadas").click(function(){

        if (latDireccion == "" && lonDireccion == ""){
          $("#coordenadas").val("");
          
        }else{
          $("#coordenadas").val(latDireccion+","+lonDireccion);
        }
        $('#ModalEdicionCoordenadas').modal();
        registrarClick();
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
        var calle = "";
        var numero = "";
        for(var count = 0;count<array_direccion.length;count++){
          if(array_direccion.length-1 == count && count >0){
             numero = array_direccion[count];
          }else{
            calle += array_direccion[count]+" ";
          }
          
        }
        if(!calle){
          alert("Formato de direccion incorrecta.");
          return;
        }

        //Armamos la query para enviar a la api nominatim
        var query=calle+" "+numero+",+"+ciudadEmpresa+",+"+departamentoEmpresa+",+"+provinciaEmpresa+"&format=json&addressdetails=1";
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

                            if(data.length == 1){
                              latitud = data[0].lat;
                              longitud = data[0].lon;
                              console.log(data[0].type);
                              if(data[0].type == "address"){
                                direccionCompleta = data[0].address.road+" "+data[0].address.house_number+" - "+data[0].address.town+" - "+data[0].address.state;
                              }else{
                                direccionCompleta = eval("data[0].address."+data[0].type) +" - "+data[0].address.road+" - "+data[0].address.town+" - "+data[0].address.state;
                              }
                              

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
                              $(".lbl-asignacion").html("");
                            }

                            unblockUI($("#div-block"));


                            if(data.length > 1){

                              var direccionesHtml = "<ul>";

                              $(data).each(function(index){
                                 var provincia = data[index].address.state;
                                  direccionesHtml += '<li><a href="javascript:void(0);" onclick="EnviarPasaje.setCoordenadas('+data[index].lat+','+data[index].lon+',\''+data[index].address.road+'\',\''+data[index].address.house_number+'\',\''+data[index].address.town+'\',\''+data[index].address.state+'\')">'+data[index].address.road+' '+data[index].address.house_number+' - '+data[index].address.town+' - '+data[index].address.state+'</li></a>';

                              });
                              direccionesHtml += "</ul>";

                              $("#direccionesEncontradas").html(direccionesHtml);
                              var num = $("#ModalSeleccionDireccion").modal();

                            }
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                            unblockUI($("#div-block"));
                        }


                    });
     
   },

   editarCoordenadas: function(){
      var nuevaLat = lonlat.lat;
      var nuevaLon = lonlat.lon;
      var direccion = $("#calle").val();

      if($.isNumeric(nuevaLat) && $.isNumeric(nuevaLon)){
        latDireccion = nuevaLat;
        lonDireccion = nuevaLon;
        direccionCalle = direccion.split(" ")[0];
        direccionNumero = direccion.split(" ")[1];
        $("#lbl-lat").html(latDireccion);
        $("#lbl-lon").html(lonDireccion);


      }
      

   },

   setCoordenadas: function(lat,lon,road,house_number,town,state){
      if(house_number=="undefined"){
        house_number=undefined;
      }
      $("#lbl-lat").html(lat);
      $("#lbl-lon").html(lon);
      $("#lbl-info-direccion").html(road+" "+house_number+" - "+town+" - "+state);

      latDireccion = lat;
      lonDireccion = lon;
      direccionCalle = road;
      direccionNumero = house_number;

      $("#ModalSeleccionDireccion").modal('hide');

   }

 
  
}