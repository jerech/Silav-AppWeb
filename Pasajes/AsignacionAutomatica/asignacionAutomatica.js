$(function() { 
	var choferes = new Array();
	choferes = choferesConectados.getChoferes();
	choferes = choferesConectados.calcularDistancia(choferes,"-31.4333","-62.0825");
	choferes = choferesConectados.ordenar(choferes);
	
	chofer = choferesConectados.getChoferMasCercano(choferes);
	alert(chofer.usuario);
	/*$.each( choferes, function( i, val ) {
		alert(i + ": " + val.distanciaADestino);
	});*/

});

var choferesConectados = {
	
	getChoferes : function () {
		var urlObtenerChoferes = "obtenerChoferes.php";
		var choferes = new Array();
		
		choferes.push(new Chofer("juan","1","-31.05","-61.77",""));
		choferes.push(new Chofer("pedro","2","-33","-65",""));
		choferes.push(new Chofer("jose","3","-30.78","-62.3",""));
		choferes.push(new Chofer("diego","4","-31.86","-62.99",""));
	
		/*$.ajax({
      	type: 'post',
         url: urlObtenerChoferes, 
         data: {},           
         dataType: 'json',
         beforeSend: function(){
                
         },   
         success: function(data) {
         	var usuario;
         	var numeroDeMovil;
         	var ubicacionLatitud;
         	var ubicacionLongitud;
				$(data.choferes).each(function(index){
					usuario = data.choferes[index].usuario;
					numeroDeMovil = data.choferes[index].numero_movil;
					ubicacionLatitud = data.choferes[index].ubicacion_lat;
					ubicacionLongitud = data.choferes[index].ubicacion_lon;
					
					choferes.push(new Chofer(usuario, numeroDeMovil, ubicacionLatitud, ubicacionLongitud, ""));
          	});                                                  
         },
         error: function(a,b,c){
         	console.log(a);
            console.log(b);
            console.log(c);         
         }
		});*/
		return choferes;	
	},
	
	ordenar : function (choferes) {
		choferes.sort(function(a,b) { 
			return parseFloat(a.distanciaADestino) - parseFloat(b.distanciaADestino); 
		});
		return choferes;
	},
	
	calcularDistancia : function (choferes, latitudDestino, longitudDestino) {
		var catetoLongitud;
		var catetoLatitud;
		var diagonal;
		$.each( choferes, function( i, val ) {
			catetoLongitud = parseFloat(longitudDestino) - parseFloat(val.ubicacionLongitud);
			catetoLatitud = parseFloat(latitudDestino) - parseFloat(val.ubicacionLatitud);
			diagonal = Math.sqrt(Math.pow(catetoLongitud, 2) + Math.pow(catetoLatitud, 2));
			val.distanciaADestino = diagonal;
		});
		return choferes;
	},
	
	getChoferMasCercano : function (choferes) {
		var chofer;
		var distancia;
		var destino = "-31.4333,-62.0825";
		$.each( choferes, function( i, val ) {
			distancia = choferesConectados.getDistanciaChoferDestino(val, destino);
			if (distancia != "ruta_no_encontrada" && distancia != "error") {
				val.distanciaADestino = distancia;
			}
			else {
				val.distanciaADestino = "";
			}
		});
		choferes = choferesConectados.ordenar(choferes);
		return choferes[0];
	},
	
	getDistanciaChoferDestino : function (chofer, destino) {
		var url = "http://router.project-osrm.org/viaroute?";
		var urlCompleta;
		var distancia;
		var ubicacionChofer = "loc=" + chofer.ubicacionLatitud + "," + chofer.ubicacionLongitud;
		var ubicacionDestino = "loc=" + destino;
		urlCompleta = url + ubicacionChofer + "&" + ubicacionDestino;
		$.ajax({
      	type: 'get',
         url: urlCompleta, 
         data: {},           
         dataType: 'json',
         beforeSend: function(){
                
         },   
         success: function(data) {
         	if (data.status_message == "Found route between points") {
         		distancia = data.route_summary.total_distance;
         	}
         	else {
         		if (data.status_message == "Cannot find route between points") {
         			distancia = "ruta_no_encontrada";
         		}
         		else {
         			distancia = "error";	
         		}	
         	}                                                 
         },
         error: function(a,b,c){
         	distancia = "error";
         	console.log(a);
            console.log(b);
            console.log(c);         
         }
		});
		return distancia;
	}
}

//Objeto Chofer
function Chofer(usuario, numeroDeMovil, ubicacionLatitud, ubicacionLongitud, distanciaADestino) {
	this.usuario = usuario;
	this.numeroDeMovil = numeroDeMovil;
	this.ubicacionLatitud = ubicacionLatitud;
	this.ubicacionLongitud = ubicacionLongitud;
	this.distanciaADestino = distanciaADestino;
}