var CargarChoferes = {
/*
 * Esta función carga los datos de los choferes conectados en la tabla modal.
 */
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
			
				$(data.choferes).each(function(index){
         		var nuevaFila = "<tr>";
                           
            	nuevaFila += "<td><input type='checkbox' onclick='seleccionar(this)' id='"+data.choferes[index].usuario+"_"+data.choferes[index].numero_movil+"' class='checks'></td>";

					nuevaFila += "<td>"+data.choferes[index].usuario+"</td>";
					nuevaFila += "<td>"+data.choferes[index].numero_movil+"</td>";
		
					nuevaFila +="</tr>";
		
					$("#tablaModal").append(nuevaFila);
                          
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

var CargarTablaModal = {
/*
 * Esta función borra las filas de la tabla modal (que contienen datos viejos)
 * y carga los nuevos datos de choferes.
 */
	init: function () {
		
		var cantidadDeFilas = $("#tablaModal >tbody >tr").length;
		if (cantidadDeFilas > 0) {
			$("#tablaModal >tbody >tr").each(function () {
				$(this).remove();
			});
		}
		CargarChoferes.init();
	}
}

var SeleccionarChofer = {

	init: function () {
	
		var choferMovil;
		$('.checks:checked').each(function (){
      	choferMovil = $(this).prop('id');
    	});
   	var divisionChoferMovil = choferMovil.split("_");
   	$("#listaChoferes").val(divisionChoferMovil[0]);
   	$("#movil").val(divisionChoferMovil[1]);
	}
}