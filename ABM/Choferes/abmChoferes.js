$(document).ready(function () {
	$("#tabla").load("tablaChoferes.php");
	
		$("#guardar").click(function () {
		var datosform = $("#formulario").serialize();
		$.ajax({
			type:"POST",
			url: "guardarChoferBD.php",
			data: datosform,
			contentType: "application/x-www-form-urlencoded",		
			beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				 $("#estado").html("Procesado satisfactoriamente"); //Mensaje de Satisfacción
				 $("#tabla").load('tablaMoviles.php');
			  }else if(datos == 0){ //Dato que sproviene del script php
				 $("#estado").html("Por favor ingrese todos los datos"); //Mensaje de error
			  }
		   }
		});
	
	
	});
});


	function fnc_eliminar(id){
	  $.ajax({
		   type: "POST", //Establecemos como se van a enviar los datos puede POST o GET
		   url: "eliminarChoferBD.php", //SCRIPT que procesara los datos, establecer ruta relativa o absoluta
		   data: 'id=' + id, //Variable que transferira los datos
		   contentType: "application/x-www-form-urlencoded", //Tipo de contenido que se enviara
		   beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				  $("#tabla").load('tablaChoferes.php');
				  $("#estado").html("Proceso realizado correctamente (Eliminar)"); //Mensaje de error
			  }else if(datos == 0){ //Dato que proviene del script php
				 $("#estado").html("Error al procesar script, verifique sus datos"); //Mensaje de error
			  }
		   }
	   });
	}