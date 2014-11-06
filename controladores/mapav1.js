function init() {
        map = new OpenLayers.Map("mapa");
        var mapnik = new OpenLayers.Layer.OSM();
        map.addLayer(mapnik);

        var lonlat = new OpenLayers.LonLat(-62.086, -31.430).transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            new OpenLayers.Projection("EPSG:900913") // to Spherical Mercator
          );

        var zoom = 15;

        var markers = new OpenLayers.Layer.Markers( "Markers" );
        map.addLayer(markers);
        markers.addMarker(new OpenLayers.Marker(lonlat));

        map.setCenter(lonlat, zoom);
      }