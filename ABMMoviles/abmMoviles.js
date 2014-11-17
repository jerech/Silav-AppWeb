$(document).ready(function () {
	$("#listado").load('tablaMoviles.php'); //Cargamos la lista al inicio

	$("#guardar").click(function (){
	   var datos = $("#formulario").serialize();//Serializamos los datos a enviar
	   $.ajax({
		   type: "POST", //Establecemos como se van a enviar los datos puede POST o GET
		   url: "insertarMovilBD.php", //SCRIPT que procesara los datos, establecer ruta relativa o absoluta
		   data: datos, //Variable que transferira los datos
		   contentType: "application/x-www-form-urlencoded", //Tipo de contenido que se enviara
		   beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				 $("#estado").html("Procesado de satisfactoriamente"); //Mensaje de Satisfacción
				 $("#listado").load('tablaMoviles.php');
			  }else if(datos == 0){ //Dato que proviene del script php
				 $("#estado").html("Por favor ingrese todos los datos"); //Mensaje de error
			  }
		   }
	   });
	});
	
	$("body").keydown(function (e) {
	    if(e.which == "13"){
	    	$('#guardar').trigger('click');
	    }
	});

	
});	


	
	
	function fnc_eliminar(id){
	  $.ajax({
		   type: "POST", //Establecemos como se van a enviar los datos puede POST o GET
		   url: "eliminarMovilBD.php", //SCRIPT que procesara los datos, establecer ruta relativa o absoluta
		   data: 'id=' + id, //Variable que transferira los datos
		   contentType: "application/x-www-form-urlencoded", //Tipo de contenido que se enviara
		   beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				  $("#listado").load('tablaMoviles.php');
				  $("#estado").html("Se elimina registro de Movil correctamente."); //Mensaje de error
			  }else if(datos == 0){ //Dato que proviene del script php
				 $("#estado").html("Error al procesar script verifique sus datos"); //Mensaje de error
			  }
		   }
	   });
	}
	
	
	
	
	
	
	