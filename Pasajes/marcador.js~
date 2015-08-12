var map, marcador, zoom = 15, lonMapa=-62.0851, latMapa=-31.4304;
var urlIcon = "http://93.188.167.207/app/Geolocalizacion/img/blue-marker.png";
var coordenadasMarcador = "";

function iniciar() {
		inicializarMapa();

}

function inicializarMapa() {
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
	
	map.events.register('click', map, handleMapClick);
}

function crearMarcador(longitud, latitud) {
	var lonLatTransformada = new OpenLayers.LonLat(longitud, latitud).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
	
	marcador = new OpenLayers.Marker(lonLatTransformada, new OpenLayers.Icon(urlIcon,size,offset));
	markers.addMarker(marcador);
	/*ll = new OpenLayers.LonLat(longitud,latitud);	
	var feature = new OpenLayers.Feature(markers, ll);                   
   var marker = feature.createMarker();
	markers.addMarker(marker);*/
}

function handleMapClick(e){
	lonlat = map.getLonLatFromViewPortPx(e.xy);
   lonlat.transform( map.projection,map.displayProjection);
   // Longitude = lonlat.lon
   // Latitude  = lonlat.lat
   coordenadasMarcador = lonlat.lat.toFixed(6) + ", " + lonlat.lon.toFixed(6);
   if (typeof(marcador) === "undefined") {
   	crearMarcador(lonlat.lon, lonlat.lat);
   }
   else {
   	markers.removeMarker(marcador);
   	crearMarcador(lonlat.lon, lonlat.lat);
   }
}
