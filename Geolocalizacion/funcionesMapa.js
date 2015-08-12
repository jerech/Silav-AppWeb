var map, zoom=5, lonMapa=-60, latMapa=-40;

//choferesConectados: array de objetos choferes que corresponde a los choferes que aparecen en la pagina web
//nuevosChoferes: array de objetos choferes que corresponde a los datos de choferes leidos de la base de datos	
var choferesConectados, nuevosChoferes;
var pasajesEnCurso, nuevosPasajes;
var urlDirImagenes = '../Geolocalizacion/img/';

function iniciar( $ ) {

	if (navigator.geolocation){
		navigator.geolocation.getCurrentPosition(funcExitoLocalizacion, funcErrorLocalizacion, {
			maximumAge: 75000,
			timeout: 4000
		});
	}else{
		alert("No hay soporte para geolocalizacion.");
	}
		
	var temporizador=setInterval(function() {
			var post = $.post("gps_data_reader.php", '', siRespuesta, 'json');
			var postPasajes = $.post("obtenerPasajes.php", '', siRespuestaPasajes, 'json');	
	},2000);
}
	
function funcExitoLocalizacion(objPosition){
	console.log(objPosition);
	zoom = 15;
	lonMapa = objPosition.coords.longitude;
	latMapa = objPosition.coords.latitude;
	return;
}

function funcErrorLocalizacion(objPositionError){

	console.log(objPositionError);
	return;
}

function siRespuesta(t) {
 
	var datosChoferes = t;
	if (datosChoferes != null) {
		if (typeof(map) === "undefined") {
			initalizeMap();
		}
		if(typeof(choferesConectados) === "undefined") {
			cargarChoferesConectados(datosChoferes);
			for (i=0 ; i<choferesConectados.length ; i++) {
				choferesConectados[i].transformarLonLat(choferesConectados[i], choferesConectados[i].latitud, choferesConectados[i].longitud);
				choferesConectados[i].crearMarcador(choferesConectados[i]);
			}
		}
		else {
									
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
		}
		else {
			if(typeof(choferesConectados) != "undefined") {
				if (choferesConectados.length == 1) {
					layerMarkers.removeMarker(choferesConectados[0].marcador);
					choferesConectados[0].popup.destroy();
					choferesConectados.splice(0, 1);
				}
			}
			else {
				
			}					
		}
	}
}	
	
function cargarChoferesConectados(datosChoferes){

	var nombre_latitud_longitud_estado, nombreChofer, ubicacionLatitud, ubicacionLongitud, estado;
	choferesConectados = new Array();
	for (i=0 ; i<datosChoferes.length ; i++) {
		nombre_latitud_longitud_estado = datosChoferes[i].toString().split("_");
		//separar los datos
		nombreChofer = nombre_latitud_longitud_estado[0];
		ubicacionLatitud = nombre_latitud_longitud_estado[1];
		ubicacionLongitud = nombre_latitud_longitud_estado[2];
		estado = nombre_latitud_longitud_estado[3];
		choferesConectados[i] = new Chofer(nombreChofer, ubicacionLatitud, ubicacionLongitud, estado);
		choferesConectados[i].estadoAnterior = choferesConectados[i].estado;
	}		
}

//clase Chofer
function Chofer(nombreChofer, ubicacionLatitud, ubicacionLongitud, estado) {
	this.nombre = nombreChofer;
   this.latitud = ubicacionLatitud;
   this.longitud = ubicacionLongitud;
   this.estado = estado;
   this.estadoAnterior = "";
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
		
	if(chofer.estado == "LIBRE"){
		chofer.marcador = new OpenLayers.Marker(chofer.lonLatTransformada, new OpenLayers.Icon(urlDirImagenes+'green-marker.png',size,offset));
	}
	else {
		if(chofer.estado == "OCUPADO"){
			chofer.marcador = new OpenLayers.Marker(chofer.lonLatTransformada, new OpenLayers.Icon(urlDirImagenes+'red-marker.png',size,offset));
		}
		else {
			//chofer.estado == "INACTIVO"
			chofer.marcador = new OpenLayers.Marker(chofer.lonLatTransformada, new OpenLayers.Icon(urlDirImagenes+'gray-marker.png',size,offset));	
		}
	}
   chofer.popup = new OpenLayers.Popup(chofer.nombre, chofer.lonLatTransformada, new OpenLayers.Size(85,60),
                        "<div><p><b>"+chofer.nombre+"</b><br><b>"+chofer.estado+"</b></p></div>");
   map.addPopup(chofer.popup);
   chofer.popup.hide();
	chofer.popup.opacity=0.5;
	chofer.marcador.events.register('mouseover', chofer.marcador, function (evt) { chofer.popup.toggle();OpenLayers.Event.stop (evt); } );
	layerMarkers.addMarker(chofer.marcador);
}

function cargarNuevosChoferes(datosChoferes){

	var nombre_latitud_longitud_estado, nombreChofer, ubicacionLatitud, ubicacionLongitud, estado;
	nuevosChoferes = new Array();
	for (i=0 ; i<datosChoferes.length ; i++) {
		nombre_latitud_longitud_estado = datosChoferes[i].toString().split("_");
		//separar los datos
		nombreChofer = nombre_latitud_longitud_estado[0];
		ubicacionLatitud = nombre_latitud_longitud_estado[1];
		ubicacionLongitud = nombre_latitud_longitud_estado[2];
		estado = nombre_latitud_longitud_estado[3];
		nuevosChoferes[i] = new Chofer(nombreChofer, ubicacionLatitud, ubicacionLongitud, estado);
		nuevosChoferes[i].estadoAnterior = nuevosChoferes[i].estado;
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
         });
			
	layerMapnik = new OpenLayers.Layer.OSM();
   map.addLayer(layerMapnik);
   layerMarkers = new OpenLayers.Layer.Markers("Markers");
   map.addLayer(layerMarkers);
		
   var initLonLat = new OpenLayers.LonLat(lonMapa, latMapa).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
   map.setCenter (initLonLat, zoom);
		
	size = new OpenLayers.Size(30,30);
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
				choferesConectados[i].estadoAnterior = choferesConectados[i].estado;
				choferesConectados[i].estado = nuevosChoferes[j].estado;
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
				choferesConectados[choferesConectados.length] = new Chofer(nuevosChoferes[i].nombre, nuevosChoferes[i].latitud, nuevosChoferes[i].longitud, nuevosChoferes[i].estado);
				choferesConectados[choferesConectados.length - 1].estadoAnterior = choferesConectados[choferesConectados.length - 1].estado;
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
		if (choferesConectados[i].estado != choferesConectados[i].estadoAnterior) {
			layerMarkers.removeMarker(choferesConectados[i].marcador);
			choferesConectados[i].popup.destroy();
			choferesConectados[i].crearMarcador(choferesConectados[i]);
			
			choferesConectados[i].estadoAnterior = choferesConectados[i].estado;
		}
		choferesConectados[i].marcador.moveTo(nuevoPunto);
		choferesConectados[i].popup.moveTo(nuevoPunto);
	}		
}
/*
 * Funciones para mostrar los pasajes en curso
 */
 function siRespuestaPasajes(t) {
 
 	var datosPasajes = t;
	if (datosPasajes != null) {
		if (typeof(map) === "undefined") {
			initalizeMap();
		}
		if(typeof(pasajesEnCurso) === "undefined") {
			cargarPasajesEnCurso(datosPasajes);
			for (i=0 ; i<pasajesEnCurso.length ; i++) {
				pasajesEnCurso[i].transformarLonLatPasaje(pasajesEnCurso[i], pasajesEnCurso[i].latitud, pasajesEnCurso[i].longitud);
				pasajesEnCurso[i].crearMarcadorPasaje(pasajesEnCurso[i]);
			}
		}
		else {
									
		}	
		cargarNuevosPasajes(datosPasajes);		
		for (i=0 ; i<nuevosPasajes.length ; i++) {
			nuevosPasajes[i].transformarLonLatPasaje(nuevosPasajes[i], nuevosPasajes[i].latitud, nuevosPasajes[i].longitud);
		}			
		actualizarPasajes();
	}
	else {
		if (typeof(map) === "undefined") {
			initalizeMap();
		}
		else {
			if(typeof(pasajesEnCurso) != "undefined") {
				if (pasajesEnCurso.length == 1) {
					layerMarkers.removeMarker(pasajesEnCurso[0].marcador);
					pasajesEnCurso[0].popup.destroy();
					pasajesEnCurso.splice(0, 1);
				}
			}
			else {
				
			}					
		}
	}
 }
 
 function cargarPasajesEnCurso(datosPasajes) {
 
 	var direccion_latitud_longitud, direccion, latitud, longitud;
	pasajesEnCurso = new Array();
	for (i=0 ; i<datosPasajes.length ; i++) {
		direccion_latitud_longitud = datosPasajes[i].toString().split("_");
		//separar los datos
		direccion = direccion_latitud_longitud[0];
		latitud = direccion_latitud_longitud[1];
		longitud = direccion_latitud_longitud[2];
		pasajesEnCurso[i] = new Pasaje(direccion, latitud, longitud);
	}
 }
 
 //clase Pasaje
function Pasaje(direccion, latitud, longitud) {
	this.direccion = direccion;
   this.latitud = latitud;
   this.longitud = longitud;
   this.marcador = null;
   this.lonLatTransformada = null;
   this.popup = null;
   this.transformarLonLatPasaje = transformarLonLatPasaje;
   this.crearMarcadorPasaje = crearMarcadorPasaje;
}

function transformarLonLatPasaje(pasaje, latitud, longitud){
	
	pasaje.lonLatTransformada = new OpenLayers.LonLat(longitud, latitud).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
}

function crearMarcadorPasaje(pasaje) {
		
	pasaje.marcador = new OpenLayers.Marker(pasaje.lonLatTransformada, new OpenLayers.Icon(urlDirImagenes+'home-marker.png',size,offset));

   pasaje.popup = new OpenLayers.Popup(pasaje.direccion, pasaje.lonLatTransformada, new OpenLayers.Size(85,60),
                        "<div><p><b>"+pasaje.direccion+"</b></p></div>");
   map.addPopup(pasaje.popup);
   pasaje.popup.hide();
	pasaje.popup.opacity=0.5;
	pasaje.marcador.events.register('mouseover', pasaje.marcador, function (evt) { pasaje.popup.toggle();OpenLayers.Event.stop (evt); } );
	layerMarkers.addMarker(pasaje.marcador);
}

function cargarNuevosPasajes(datosPasajes){

	var direccion_latitud_longitud, direccion, latitud, longitud;
	nuevosPasajes = new Array();
	for (i=0 ; i<datosPasajes.length ; i++) {
		direccion_latitud_longitud = datosPasajes[i].toString().split("_");
		//separar los datos
		direccion = direccion_latitud_longitud[0];
		latitud = direccion_latitud_longitud[1];
		longitud = direccion_latitud_longitud[2];
		nuevosPasajes[i] = new Pasaje(direccion, latitud, longitud);
	}
}

function actualizarPasajes() {
	
	var pasajeEncontrado = false;
	var viejosPasajes = new Array;
	var contador = 0;
	
	for (i=0 ; i<pasajesEnCurso.length ; i++) {
		for (j=0 ; j<nuevosPasajes.length ; j++) {
			if (pasajesEnCurso[i].direccion == nuevosPasajes[j].direccion) {
				pasajeEncontrado = true;
				viejosPasajes[contador] = nuevosPasajes[j];
				contador = contador + 1;
			}
		}
		if (pasajeEncontrado == false) {
			layerMarkers.removeMarker(pasajesEnCurso[i].marcador);
			pasajesEnCurso[i].popup.destroy();
			pasajesEnCurso.splice(i, 1);
			i = i - 1;
		}
		else {
			pasajeEncontrado = false;
		}
	}
	if (nuevosPasajes.length != viejosPasajes.length) {
		pasajeEncontrado = false;
		for (i=0 ; i<nuevosPasajes.length ; i++) {
			for (j=0 ; j<viejosPasajes.length ; j++) {
				if (nuevosPasajes[i].direccion == viejosPasajes[j].direccion) {
					pasajeEncontrado = true;
				}
			}
			if (pasajeEncontrado == false) {
				pasajesEnCurso[pasajesEnCurso.length] = new Pasaje(nuevosPasajes[i].direccion, nuevosPasajes[i].latitud, nuevosPasajes[i].longitud);
				pasajesEnCurso[pasajesEnCurso.length - 1].transformarLonLatPasaje(pasajesEnCurso[pasajesEnCurso.length - 1], pasajesEnCurso[pasajesEnCurso.length - 1].latitud, pasajesEnCurso[pasajesEnCurso.length - 1].longitud);
				pasajesEnCurso[pasajesEnCurso.length - 1].crearMarcadorPasaje(pasajesEnCurso[pasajesEnCurso.length - 1]);
			}
			else {
				pasajeEncontrado = false;
			}
		}
	}
}