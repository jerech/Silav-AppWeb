var mostrarDatos = {

	init: function(){

		var urlObtenerDatos = "estadisticas/obtenerPasajes.php";


		$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        blockUI($("#contador"), false);
                    },   
                    success: function(data) {
								      var contador = 0;
                      var can_rechazados=0;
                      var can_asignados=0;
                      var can_porasignar=0;
                        
                        $(data.pasajes).each(function(index){
                        	
                        	contador = contador + 1;
                           
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+data.pasajes[index].id+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].fecha+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].usuario_chofer+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].numero_movil+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].nombre_cliente+"</td>";
                  nuevaFila += "<td>"+data.pasajes[index].direccion+"</td>";

                  /*switch(data.pasajes[index].estado){
                    case 'por_asignar':
                          nuevaFila += "<td style='background-color:#F1FF69'>"+data.pasajes[index].estado+"</td>";
                          break;
                    case 'asignado':
                          nuevaFila += "<td style='background-color:#69FF69'>"+data.pasajes[index].estado+"</td>";
                          break;
                    case 'rechazado':
                          nuevaFila += "<td style='background-color:#FF6969'>"+data.pasajes[index].estado+"</td>";
                          break;
                    default:
                          nuevaFila += "<td>"+data.pasajes[index].estado+"</td>";
                  }*/

                  switch(data.pasajes[index].estado){
                    case 'por_asignar':
                          nuevaFila += "<td><span class='label label-info pull-center'>"+data.pasajes[index].estado+"</span></td>";
                          can_porasignar++;
                          break;
                    case 'asignado':
                          nuevaFila += "<td><span class='label label-success pull-center'>"+data.pasajes[index].estado+"</span></td>";
                          can_asignados++;
                          break;
                    case 'rechazado':
                          can_rechazados++;
                          nuevaFila += "<td><span class='label label-warning pull-center'>"+data.pasajes[index].estado+"</span></td>";
                          break;
                    default:
                          nuevaFila += "<td>"+data.pasajes[index].estado+"</td>";
                  }
                  
		
									nuevaFila +="</tr>";
		
									$("#tBody").append(nuevaFila);                            
                        });

                  if (navigator.geolocation){
                        navigator.geolocation.getCurrentPosition(mostrarDatos.funcExitoLocalizacion, mostrarDatos.funcErrorLocalizacion, {
                          maximumAge: 75000,
                          timeout: 4000
                        });
                      }

                  $("#can-rechazados").html(can_rechazados);
                  $("#can-porasignar").html(can_porasignar);
                  $("#can-asignados").html(can_asignados);
                  mostrarDatos.crearMapa(data.pasajes);
      	            		initDataTable($('#tabla'));

      	            		unblockUI($("#contador"));
       
                    },
                    error: function(a,b,c){
                    	unblockUI($("#div-tabla"));
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});
			
			
},


crearMapa: function (pasajes) {


            var zoom = 14;
            
    //Creacion del mapa
    map = new OpenLayers.Map ("mapa", {
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
  
    size = new OpenLayers.Size(15,19);
    offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
  
    $(pasajes).each(function(index){

        mostrarDatos.crearMarcador(pasajes[index].ubicacion_lon, pasajes[index].ubicacion_lat, pasajes[index].estado);

    });

    return;
  },

  crearMarcador: function (longitudMapa, latitudMapa, estado) {

    switch(estado){
                    case 'por_asignar':
                          urlIcon = urlIconYellow;
                          break;
                    case 'asignado':
                          urlIcon = urlIconGreen;
                          break;
                    case 'rechazado':
                          urlIcon = urlIconRed;
                          break;
                    default:
                          urlIcon = urlIconBlue;
                  }
    console.log(longitudMapa+"-"+latitudMapa);
    var lonLatTransformada = new OpenLayers.LonLat(longitudMapa, latitudMapa).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
    marcador = new OpenLayers.Marker(lonLatTransformada, new OpenLayers.Icon(urlIcon,size,offset));
    markers.addMarker(marcador);

    return;
  },


  funcExitoLocalizacion: function(objPosition){
  console.log(objPosition);
  zoom = 15;
  lonMapa = objPosition.coords.longitude;
  latMapa = objPosition.coords.latitude;
  return;
},

funcErrorLocalizacion: function(objPositionError){

  console.log(objPositionError);
  return;
},
}