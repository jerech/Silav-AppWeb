var lonlat = "";

var EnviarPasaje = {


	init: function(){

    latDireccion="";
    lonDireccion="";
    direccionCalle="";
    direccionNumero="";
			
			$("#btnAsignar").click(function(){
				
			urlNuevoPasaje = "../Pasajes/nuevo.php";

      var array_calle = $("#calle").val().split(" ");
      console.log(direccionCalle+"; "+direccionNumero);
      if(direccionCalle==""){
        
        for(c=0;c<array_calle.length-1;c++){
          direccionCalle += array_calle[c]+" ";
        }
        if($.isNumeric(array_calle[array_calle.length-1]) == false){
          direccionCalle += array_calle[array_calle.length-1];
        }else{
          direccionNumero = $("#calle").val().split(" ")[array_calle.length-1];
        }
      }
      if(direccionNumero==undefined){
        direccionCalle = $("#calle").val();
        direccionNumero = "";
      }
      if ($("#coordenadas").val() != "") {
      	array_coordenadas = 	$("#coordenadas").val().split(",");
      	latDireccion = array_coordenadas[0];
      	lonDir = array_coordenadas[1].split(" ");
      	lonDireccion = lonDir[1];
      }
      else {
      	latDireccion = "";
      	lonDireccion = "";
      }
			
			var form = $(".form").serialize()+"&lat="+latDireccion+"&lon="+lonDireccion+"&direccionCalle="+direccionCalle+"&direccionNumero="+direccionNumero;
      if($("#movil").prop("disabled")==true){
          form += "&movil=0"; 
      }

      if($("#listaChoferes").prop("disabled")==true){
      	form += "&listaChoferes=";
      	form += "&asignacionAutomatica=1";
      }
      else {
      	form += "&asignacionAutomatica=0";	
      }
      
		var fechaDePedido = $("#fechaYHora").val()+":00";
		form += "&fechaDePedido="+fechaDePedido;

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

                          direccionCalle = "";
                          direccionNumero = "";
                          latDireccion = "";
                          lonDireccion = "";
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
window.open("marcador.php","","width=600,height=500,left=50,top=50,toolbar=yes");

        /*if (latDireccion == "" && lonDireccion == ""){
          $("#coordenadas").val("");
          
        }else{
        	 var latitud = latDireccion.toFixed(6);
        	 var longitud = lonDireccion.toFixed(6);
          $("#coordenadas").val(latitud+","+longitud);
        }
        $('#ModalEdicionCoordenadas').modal();
        Mapa.iniciar();
        //window.open("marcador.php");*/
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
                              

                              //$("#lbl-lat").html(latitud);
                              //$("#lbl-lon").html(longitud);
                              $("#coordenadas").val(latitud+", "+longitud);
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
        var latitud = latDireccion.toFixed(6);
        var longitud = lonDireccion.toFixed(6);
        //$("#lbl-lat").html(latDireccion);
        //$("#lbl-lon").html(lonDireccion);
		  $("#coordenadas").val(latitud+", "+longitud);

      }
      

   },

   setCoordenadas: function(lat,lon,road,house_number,town,state){
      if(house_number=="undefined"){
        house_number=undefined;
      }
      //$("#lbl-lat").html(lat);
      //$("#lbl-lon").html(lon);
      $("#coordenadas").val(lat+", "+lon);
      $("#lbl-info-direccion").html(road+" "+house_number+" - "+town+" - "+state);

      latDireccion = lat;
      lonDireccion = lon;
      direccionCalle = road;
      direccionNumero = house_number;

      $("#ModalSeleccionDireccion").modal('hide');

   }
}

var map, marcador, zoom = 15, lonMapa=-62.0851, latMapa=-31.4304;
var urlIcon = "../Geolocalizacion/img/blue-marker.png";

var Mapa = {
	
	iniciar: function () {
		if (typeof(map) === "undefined") {
			Mapa.crearBase();	
		}
	},
	
	crearBase: function () {
		//Creacion del mapa
		map = new OpenLayers.Map ("contenedorMapa", {
            	maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
            	maxResolution: 156543.0399,
            	numZoomLevels: 18,
            	units: 'm',
            	projection: new OpenLayers.Projection("EPSG:900913"),
            	displayProjection: new OpenLayers.Projection("EPSG:4326")
          	});
		//Creacion de capas
		capa = new OpenLayers.Layer.OSM("Capa OSM");
		markers = new OpenLayers.Layer.Markers("Marcadores");
		//Adicion de capas al mapa
		map.addLayer(capa);
		map.addLayer(markers);
		//Centro el mapa en la posicion dada
		var initLonLat = new OpenLayers.LonLat(lonMapa, latMapa).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
   	map.setCenter (initLonLat, zoom);	
	
		size = new OpenLayers.Size(30,30);
   	offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
	
		map.events.register('click', map, Mapa.handleMapClick);
	},
	
	crearMarcador: function (longitudMapa, latitudMapa) {
		var lonLatTransformada = new OpenLayers.LonLat(longitudMapa, latitudMapa).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
		marcador = new OpenLayers.Marker(lonLatTransformada, new OpenLayers.Icon(urlIcon,size,offset));
		markers.addMarker(marcador);
	},
	
	handleMapClick: function (e) {
		lonlat = map.getLonLatFromViewPortPx(e.xy);
   	lonlat.transform( map.projection,map.displayProjection);
   	$("#latlon").html("Latitud: "+lonlat.lat.toFixed(6)+", Longitud: "+lonlat.lon.toFixed(6));
   	// Longitude = lonlat.lon
   	// Latitude  = lonlat.lat
   	if (typeof(marcador) === "undefined") {
   		Mapa.crearMarcador(lonlat.lon, lonlat.lat);
   	}
   	else {
   		markers.removeMarker(marcador);
   		Mapa.crearMarcador(lonlat.lon, lonlat.lat);
   	}
	}
}