var map, zoom=15;
	//choferesConectados: array de objetos choferes que corresponde a los choferes que aparecen en la pagina web
	//nuevosChoferes: array de objetos choferes que corresponde a los datos de choferes leidos de la base de datos	
	var choferesConectados, nuevosChoferes;
	function iniciar()
	{
		var temporizador=setInterval(function(){
			
			var post = $.post("gps_data_reader.php", '', siRespuesta, 'json');	
			
		},2000);
		
	}
	
	function siRespuesta(t){
 
var datosChoferes = t;
		
			if (datosChoferes != null) {
				if (typeof(map) === "undefined") {
				initalizeMap();
			}
				if(typeof(choferesConectados) === "undefined"){
					cargarChoferesConectados(datosChoferes);
					for (i=0 ; i<choferesConectados.length ; i++) {
			choferesConectados[i].transformarLonLat(choferesConectados[i], choferesConectados[i].latitud, choferesConectados[i].longitud);
			choferesConectados[i].crearMarcador(choferesConectados[i]);
		}
				}else{
									
				}
				
				
			cargarNuevosChoferes(datosChoferes);		
			
			for (i=0 ; i<nuevosChoferes.length ; i++) {
				nuevosChoferes[i].transformarLonLat(nuevosChoferes[i], nuevosChoferes[i].latitud, nuevosChoferes[i].longitud);
			}			
		
			actualizarChoferes();
			updateMarkers();
			}
			else {
				if (typeof(map) === "undefined") {
					initalizeMap();
				}else {
					if (choferesConectados.length == 1) {
						layerMarkers.removeMarker(choferesConectados[0].marcador);
						choferesConectados[0].popup.destroy();
						choferesConectados.splice(0, 1);
					}
					
				}
			}
}	
	
	function cargarChoferesConectados(datosChoferes){
		var nombre_latitud_longitud, nombreChofer, ubicacionLatitud, ubicacionLongitud;
		choferesConectados = new Array();
		for (i=0 ; i<datosChoferes.length ; i++) {
			nombre_latitud_longitud = datosChoferes[i].toString().split("_");
			//separar los datos
			nombreChofer = nombre_latitud_longitud[0];
			ubicacionLatitud = nombre_latitud_longitud[1];
			ubicacionLongitud = nombre_latitud_longitud[2];
			choferesConectados[i] = new Chofer(nombreChofer, ubicacionLatitud, ubicacionLongitud);
		}		
	}

	//clase Chofer
   function Chofer(nombreChofer, ubicacionLatitud, ubicacionLongitud) {
   	this.nombre = nombreChofer;
   	this.latitud = ubicacionLatitud;
   	this.longitud = ubicacionLongitud;
   	this.marcador = null;
   	this.lonLatTransformada = null;
   	this.popup = null;
   	this.transformarLonLat = transformarLonLat;
   	this.crearMarcador = crearMarcador;
   }
  	function transformarLonLat(chofer, ubicacionLatitud, ubicacionLongitud){
			chofer.lonLatTransformada = new OpenLayers.LonLat(ubicacionLongitud, ubicacionLatitud).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
	}

	function crearMarcador(chofer) {
		chofer.marcador = new OpenLayers.Marker(chofer.lonLatTransformada, new OpenLayers.Icon('http://silav.esy.es/Geolocalizacion/img/marker.png',size,offset));
      chofer.popup = new OpenLayers.Popup(chofer.nombre,
                        chofer.lonLatTransformada,
                        new OpenLayers.Size(145,52),
                        "<font size=-2>"+chofer.nombre+"<br>Lon: "+Math.round(chofer.longitud * 10000) / 10000+", Lat: "+Math.round(chofer.latitud * 10000) / 10000);
      map.addPopup(chofer.popup);
      chofer.popup.hide();
		chofer.popup.opacity=0.5;
		chofer.marcador.events.register('mouseover', chofer.marcador, function (e) { chofer.popup.toggle();OpenLayers.Event.stop (evt); } );
		layerMarkers.addMarker(chofer.marcador);
	}

	function cargarNuevosChoferes(datosChoferes){
		var nombre_latitud_longitud, nombreChofer, ubicacionLatitud, ubicacionLongitud;
		nuevosChoferes = new Array();
		for (i=0 ; i<datosChoferes.length ; i++) {
			nombre_latitud_longitud = datosChoferes[i].toString().split("_");
			//separar los datos
			nombreChofer = nombre_latitud_longitud[0];
			ubicacionLatitud = nombre_latitud_longitud[1];
			ubicacionLongitud = nombre_latitud_longitud[2];
			nuevosChoferes[i] = new Chofer(nombreChofer, ubicacionLatitud, ubicacionLongitud);
		}
	}	
	
	function initalizeMap() {
		map = new OpenLayers.Map ("contenedorMapa", {
            controls:[
                new OpenLayers.Control.Navigation(),
                new OpenLayers.Control.PanZoomBar(),
                new OpenLayers.Control.LayerSwitcher(),
                new OpenLayers.Control.Attribution()],
            maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
                maxResolution: 156543.0399,
            numZoomLevels: 18,
            units: 'm',
            projection: new OpenLayers.Projection("EPSG:900913"),
            displayProjection: new OpenLayers.Projection("EPSG:4326")
        } );
			
		layerMapnik = new OpenLayers.Layer.OSM();
        map.addLayer(layerMapnik);
        layerMarkers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(layerMarkers);
		
        var initLonLat = new OpenLayers.LonLat(-62.086, -31.430).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
        map.setCenter (initLonLat, zoom);
		
		size = new OpenLayers.Size(21,25);
      offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
				
	}

	function actualizarChoferes() {
		var choferEncontrado = false;
		var viejosChoferes = new Array;
		var contador = 0;
		for (i=0 ; i<choferesConectados.length ; i++) {
			for (j=0 ; j<nuevosChoferes.length ; j++) {
				if (choferesConectados[i].nombre == nuevosChoferes[j].nombre) {
					choferesConectados[i].latitud = nuevosChoferes[j].latitud;
					choferesConectados[i].longitud = nuevosChoferes[j].longitud;
					choferEncontrado = true;
					viejosChoferes[contador] = nuevosChoferes[j];
					contador = contador + 1;
				}
			}
			if (choferEncontrado == false) {
				layerMarkers.removeMarker(choferesConectados[i].marcador);
				choferesConectados[i].popup.destroy();
				choferesConectados.splice(i, 1);
				i = i - 1;
			}
			else {
				choferEncontrado = false;
			}
		}

		if (nuevosChoferes.length != viejosChoferes.length) {
			choferEncontrado = false;
			for (i=0 ; i<nuevosChoferes.length ; i++) {
				for (j=0 ; j<viejosChoferes.length ; j++) {
					if (nuevosChoferes[i].nombre == viejosChoferes[j].nombre) {
					choferEncontrado = true;
					}
				}
				if (choferEncontrado == false) {
					choferesConectados[choferesConectados.length] = new Chofer(nuevosChoferes[i].nombre, nuevosChoferes[i].latitud, nuevosChoferes[i].longitud);
					choferesConectados[choferesConectados.length - 1].transformarLonLat(choferesConectados[choferesConectados.length - 1], choferesConectados[choferesConectados.length - 1].latitud, choferesConectados[choferesConectados.length - 1].longitud);
					choferesConectados[choferesConectados.length - 1].crearMarcador(choferesConectados[choferesConectados.length - 1]);
				}
				else {
					choferEncontrado = false;
				}
			}
		}
	}

	function updateMarkers(){
		var nuevoPunto;		
		
		for (i=0 ; i<choferesConectados.length ; i++) {
			nuevoPunto = map.getLayerPxFromViewPortPx(map.getPixelFromLonLat(new OpenLayers.LonLat(choferesConectados[i].longitud, choferesConectados[i].latitud).transform(map.displayProjection, map.projection)));
			choferesConectados[i].marcador.moveTo(nuevoPunto);
			choferesConectados[i].popup.moveTo(nuevoPunto);
			choferesConectados[i].popup.setContentHTML("<font size=-2>"+choferesConectados[i].nombre+"<br>Lon: "+Math.round(choferesConectados[i].longitud * 10000) / 10000+", Lat: "+Math.round(choferesConectados[i].latitud * 10000) / 10000);
		}		
		
	}